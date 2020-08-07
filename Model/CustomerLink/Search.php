<?php

namespace MagePrakash\Helpdesk\Model\CustomerLink;

use Magento\Catalog\Api\Data\ProductInterface;

/** Returns collection of customer by search key */
class Search
{
    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
     */
    private $customerCollectionFactory;

    /**
     * @param \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory
     */
    public function __construct(
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory
    ) {
        $this->customerCollectionFactory = $customerCollectionFactory;
    }

    /**
     * Add required filters and limitations for product collection
     *
     * @param string $searchKey
     * @param int $pageNum
     * @param int $limit
     * @return \Magento\Customer\Model\ResourceModel\Customer\Collection
     */
    public function prepareCollection(
        string $searchKey,
        int $pageNum,
        int $limit
    ): \Magento\Customer\Model\ResourceModel\Customer\Collection {
        $customerCollection = $this->customerCollectionFactory->create();
        $customerCollection->addNameToSelect();
        $customerCollection->setPage($pageNum, $limit);

        $searchKey = '%' . $searchKey . '%';
        $customerCollection->addFieldToFilter('name', ['like' => $searchKey]);
        $customerCollection->addFieldToFilter('email', ['like' => $searchKey]);
        $customerCollection->setPage($pageNum, $limit);

        return $customerCollection;
    }
}
