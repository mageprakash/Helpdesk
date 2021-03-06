<?php


namespace MagePrakash\Helpdesk\Model;


use Magento\Framework\Api\DataObjectHelper;
use MagePrakash\Helpdesk\Api\Data\TicketMessageInterfaceFactory;

class Department extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'mageprakash_helpdesk_department';
    protected $departmentDataFactory;
    protected $dataObjectHelper;
    protected $dateTime;
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
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\Department $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Department\Collection $resourceCollection,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dateTime = $dateTime;        
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function beforeSave(){
        parent::beforeSave();
        $this->setData('created_at', $this->dateTime->gmtDate());
        return parent::beforeSave();
    }
}
