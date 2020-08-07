define([
    'MagePrakash_Helpdesk/js/form/element/ui-select'
], function (Select) {
    'use strict';

    return Select.extend({
        defaults: {
            emailElem: '${ $.parentName }.email',
            exports: {
                findedEmail: '${ $.emailElem }:value'
            }
        },

        /**
         * Callback that fires when 'value' property is updated.
         */
        onUpdate: function () {
            var i = 0,
                value = this.value(),
                length = this.options().length,
                result = false;

            this._super();

            for (i; i < length; i++) {
                if (this.options()[i].value === value) {
                    result = this.options()[i];
                }
            }

            if (result && result.email) {
                this.set('findedEmail', result.email);
            }
        }
    });
});
