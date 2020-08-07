<?php

namespace MagePrakash\Helpdesk\Model\Department\Source;

class User implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var \MagePrakash\Helpdesk\Model\ResourceModel\User\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\User\CollectionFactory $collectionFactory
     */
    public function __construct(\MagePrakash\Helpdesk\Model\ResourceModel\User\CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            /** @var $collection \MagePrakash\Helpdesk\Model\ResourceModel\User\CollectionFactory */
            $collection = $this->collectionFactory->create();
            $this->options = $collection->load()->toOptionArray();
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
