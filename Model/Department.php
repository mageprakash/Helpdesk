<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\DepartmentInterfaceFactory;
use MagePrakash\Helpdesk\Api\Data\DepartmentInterface;
use Magento\Framework\Api\DataObjectHelper;
use MagePrakash\Helpdesk\Api\Data\TicketMessageInterfaceFactory;

class Department extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'mageprakash_helpdesk_department';
    protected $departmentDataFactory;
    protected $dataObjectHelper;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param DepartmentInterfaceFactory $departmentDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Department $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Department\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        DepartmentInterfaceFactory $departmentDataFactory,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\Department $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Department\Collection $resourceCollection,
        array $data = []
    ) {
        $this->departmentDataFactory = $departmentDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve department model with department data
     * @return DepartmentInterface
     */
    public function getDataModel()
    {
        $departmentData = $this->getData();
        
        $departmentDataObject = $this->departmentDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $departmentDataObject,
            $departmentData,
            DepartmentInterface::class
        );
        
        return $departmentDataObject;
    }

}
