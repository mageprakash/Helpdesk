<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\StatusInterface;
use Magento\Framework\Api\DataObjectHelper;
use MagePrakash\Helpdesk\Api\Data\StatusInterfaceFactory;

class Status extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $statusDataFactory;

    protected $_eventPrefix = 'mageprakash_helpdesk_status';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param StatusInterfaceFactory $statusDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Status $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Status\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        StatusInterfaceFactory $statusDataFactory,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\Status $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Status\Collection $resourceCollection,
        array $data = []
    ) {
        $this->statusDataFactory = $statusDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve status model with status data
     * @return StatusInterface
     */
    public function getDataModel()
    {
        $statusData = $this->getData();
        
        $statusDataObject = $this->statusDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $statusDataObject,
            $statusData,
            StatusInterface::class
        );
        
        return $statusDataObject;
    }
}
