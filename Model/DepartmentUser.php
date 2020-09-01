<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface;
use Magento\Framework\Api\DataObjectHelper;

class DepartmentUser extends \Magento\Framework\Model\AbstractModel
{

    protected $department_userDataFactory;

    protected $_eventPrefix = 'mageprakash_helpdesk_department_user';
    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param DepartmentUserInterfaceFactory $department_userDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser\Collection $resourceCollection,
        array $data = []
    ) {
        $this->department_userDataFactory = $department_userDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
}
