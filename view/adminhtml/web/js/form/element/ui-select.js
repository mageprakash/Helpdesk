define([
    'Magento_Ui/js/form/element/ui-select',
    'underscore',
    'ko',
    'jquery',
], function (Select, _, ko, $) {
    'use strict';

    return Select.extend({
        defaults: {
            searchOptions: false,
            loading: false,
            searchUrl: false,
            lastSearchKey: '',
            lastSearchPage: 1,
            filterPlaceholder: '',
            emptyOptionsHtml: '',
            cachedSearchResults: {},
            pageLimit: 50,
            deviation: 30,
            validationLoading: false,
            isRemoveSelectedIcon: false,
            debounce: 300
        },

        /**
         * Calls 'initObservable' of parent, initializes 'options' and 'initialOptions'
         *     properties, calls 'setOptions' passing options to it
         *
         * @returns {Object} Chainable.
         */
        initObservable: function () {
            this._super();
            this.observe([
                'listVisible',
                'placeholder',
                'multiselectFocus',
                'options',
                'itemsQuantity',
                'filterInputValue',
                'filterOptionsFocus',
                'loading',
                'validationLoading',
                'isDisplayMissingValuePlaceholder'
            ]);

            this.filterInputValue.extend({
                rateLimit: this.filterRateLimit
            });

            return this;
        },

        /**
         * Filtered options list by value from filter options list
         */
        filterOptionsList: function () {
            var value = this.filterInputValue().trim().toLowerCase(),
                array = [];

            if (value && value.length < 2) {
                return false;
            }

            if (this.searchOptions) {
                return _.debounce(this.loadOptions.bind(this, value), this.debounce)();
            }

            this.cleanHoveredElement();

            if (!value) {
                this.renderPath = false;
                this.options(this.cacheOptions.tree);
                this._setItemsQuantity(false);

                return false;
            }

            this.showPath ? this.renderPath = true : false;

            if (this.filterInputValue()) {

                array = this.selectType === 'optgroup' ?
                    this._getFilteredArray(this.cacheOptions.lastOptions, value) :
                    this._getFilteredArray(this.cacheOptions.plain, value);

                if (!value.length) {
                    this.options(this.cacheOptions.plain);
                    this._setItemsQuantity(this.cacheOptions.plain.length);
                } else {
                    this.options(array);
                    this._setItemsQuantity(array.length);
                }

                return false;
            }

            this.options(this.cacheOptions.plain);
        },

        /**
         * Check selected option
         *
         * @param {Object} option - option value
         * @return {Boolean}
         */
        isSelectedValue: function (option) {
            if (_.isUndefined(option)) {
                return false;
            }

            return this.isSelected(option.value);
        },

        /**
         * Check hovered option
         *
         * @param {Object} data - element data
         * @return {Boolean}
         */
        isHovered: function (data) {
            var element = this.hoveredElement,
                elementData;

            if (!element) {
                return false;
            }

            elementData = ko.dataFor(this.hoveredElement);

            if (_.isUndefined(elementData)) {
                return false;
            }

            return data.value === elementData.value;
        },

        /**
         * Returns options from cache or send request
         *
         * @param {String} searchKey
         */
        loadOptions: function (searchKey) {
            var currentPage = searchKey === this.lastSearchKey ? this.lastSearchPage + 1 : 1,
                cachedSearchResult;

            this.renderPath = !!this.showPath;

            if (this.isSearchKeyCached(searchKey)) {
                cachedSearchResult = this.getCachedSearchResults(searchKey);
                this.options(cachedSearchResult.options);
                this.afterLoadOptions(searchKey, cachedSearchResult.lastPage, cachedSearchResult.total);

                return;
            }

            if (searchKey !== this.lastSearchKey) {
                this.options([]);
            }
            this.processRequest(searchKey, currentPage);
        },

        /**
         * Load more options on scroll down
         * @param {Object} data
         * @param {Event} event
         */
        onScrollDown: function (data, event) {
            var clientHight = event.target.scrollTop + event.target.clientHeight,
                scrollHeight = event.target.scrollHeight;

            if (!this.searchOptions) {
                return;
            }

            if (clientHight > scrollHeight - this.deviation && !this.isSearchKeyCached(data.filterInputValue())) {
                this.loadOptions(data.filterInputValue());
            }
        },

        /**
         * Returns cached search result by search key
         *
         * @param {String} searchKey
         * @return {Object}
         */
        getCachedSearchResults: function (searchKey) {
            if (this.cachedSearchResults.hasOwnProperty(searchKey)) {
                return this.cachedSearchResults[searchKey];
            }

            return {
                options: [],
                lastPage: 1,
                total: 0
            };
        },

        /**
         * Cache loaded data
         *
         * @param {String} searchKey
         * @param {Array} optionsArray
         * @param {Number} page
         * @param {Number} total
         */
        setCachedSearchResults: function (searchKey, optionsArray, page, total) {
            var cachedData = {};

            cachedData.options = optionsArray;
            cachedData.lastPage = page;
            cachedData.total = total;
            this.cachedSearchResults[searchKey] = cachedData;
        },

        /**
         * Check if search key cached
         *
         * @param {String} searchKey
         * @return {Boolean}
         */
        isSearchKeyCached: function (searchKey) {
            var totalCached = this.cachedSearchResults.hasOwnProperty(searchKey) ?
                this.deviation * this.cachedSearchResults[searchKey].lastPage :
                0;

            return totalCached > 0 && totalCached >= this.cachedSearchResults[searchKey].total;
        },

        /**
         * Submit request to load data
         *
         * @param {String} searchKey
         * @param {Number} page
         */
        processRequest: function (searchKey, page) {
            var total = 0,
                existingOptions = this.options();

            this.loading(true);
            $.ajax({
                url: this.searchUrl,
                type: 'post',
                dataType: 'json',
                context: this,
                data: {
                    searchKey: searchKey,
                    page: page,
                    limit: this.pageLimit
                },

                /** @param {Object} response */
                success: function (response) {
                    _.each(response.options, function (opt) {
                        existingOptions.push(opt);
                    });
                    total = response.total;
                    this.options(existingOptions);
                },

                /** set empty array if error occurs */
                error: function () {
                    this.options([]);
                },

                /** cache options and stop loading*/
                complete: function () {
                    this.setCachedSearchResults(searchKey, this.options(), page, total);
                    this.afterLoadOptions(searchKey, page, total);
                }
            });
        },

        /**
         * Stop loading and update data after options were updated
         *
         * @param {String} searchKey
         * @param {Number} page
         * @param {Number} total
         */
        afterLoadOptions: function (searchKey, page, total) {
            this._setItemsQuantity(total);
            this.lastSearchPage = page;
            this.lastSearchKey = searchKey;
            this.loading(false);
        }
    });
});
