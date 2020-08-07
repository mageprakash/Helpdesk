<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\PriorityInterfaceFactory;
use MagePrakash\Helpdesk\Api\Data\PriorityInterface;
use Magento\Framework\Api\DataObjectHelper;

class Priority extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $priorityDataFactory;

    protected $_eventPrefix = 'mageprakash_helpdesk_priority';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PriorityInterfaceFactory $priorityDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Priority $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Priority\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PriorityInterfaceFactory $priorityDataFactory,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\Priority $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Priority\Collection $resourceCollection,
        array $data = []
    ) {
        $this->priorityDataFactory = $priorityDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve priority model with priority data
     * @return PriorityInterface
     */
    public function getDataModel()
    {
        $priorityData = $this->getData();
        
        $priorityDataObject = $this->priorityDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $priorityDataObject,
            $priorityData,
            PriorityInterface::class
        );
        
        return $priorityDataObject;
    }
}
