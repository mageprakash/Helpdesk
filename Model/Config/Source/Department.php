<?php

namespace MagePrakash\Helpdesk\Model\Config\Source;

class Department implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     *
     * @var int
     */
    protected $storeId;

    /**
     * @var \MagePrakash\Helpdesk\Model\ResourceModel\Department\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Department\CollectionFactory $collectionFactory
     */
    public function __construct(\MagePrakash\Helpdesk\Model\ResourceModel\Department\CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     *
     * @param int $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
        return $this;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->options) {

            $collection = $this->collectionFactory->create();
            if ($this->storeId !== null) {
                $collection->addStoreIdFilter($this->storeId);
            }

            foreach ($collection as $item) {

                $this->options[] = [
                                    'label' =>  $item->getName(),
                                    'value' =>  $item->getDepartmentId()
                                 ];
            }
        }
        
        return $this->options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->toOptionArray() as $item) {
            $result[$item['value']] = $item['label'];
        }
        return $result;
    }
}
