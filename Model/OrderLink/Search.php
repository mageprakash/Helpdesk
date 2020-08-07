<?php

namespace MagePrakash\Helpdesk\Model\OrderLink;

/** Returns collection of order by search key */
class Search
{
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    private $orderCollectionFactory;

    /**
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     */
    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    /**
     * Add required filters and limitations for product collection
     *
     * @param string $searchKey
     * @param int $pageNum
     * @param int $limit
     * @return \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    public function prepareCollection(
        string $searchKey,
        int $pageNum,
        int $limit
    ): \Magento\Sales\Model\ResourceModel\Order\Collection {
        $orderCollection = $this->orderCollectionFactory->create();
        $orderCollection->addFieldToSelect('*');
        $orderCollection->setPage($pageNum, $limit);
        $orderCollection->addFieldToSearchFilter('entity_id', $searchKey);
        $orderCollection->setPage($pageNum, $limit);

        return $orderCollection;
    }
}
