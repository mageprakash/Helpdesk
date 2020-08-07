<?php

namespace MagePrakash\Helpdesk\Model\Ticket\Source;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var \MagePrakash\Helpdesk\Model\ResourceModel\Status\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Status\CollectionFactory $collectionFactory
     */
    public function __construct(\MagePrakash\Helpdesk\Model\ResourceModel\Status\CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->collectionFactory->create();
            foreach ($collection as $item) {

                 $this->options[] = [
                                    'label' =>  $item->getName(),
                                    'value' =>  $item->getStatusId()
                                 ];
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

    /**
     *
     * @return array
     */
    public function toOptionHash()
    {
        return $this->toArray();
    }
}
