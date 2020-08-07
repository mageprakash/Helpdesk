<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface;
use MagePrakash\Helpdesk\Api\Data\DepartmentUserInterfaceFactory;
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
        DepartmentUserInterfaceFactory $department_userDataFactory,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser\Collection $resourceCollection,
        array $data = []
    ) {
        $this->department_userDataFactory = $department_userDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve department_user model with department_user data
     * @return DepartmentUserInterface
     */
    public function getDataModel()
    {
        $department_userData = $this->getData();
        
        $department_userDataObject = $this->department_userDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $department_userDataObject,
            $department_userData,
            DepartmentUserInterface::class
        );
        
        return $department_userDataObject;
    }
}
