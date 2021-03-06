<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\TicketMessageInterfaceFactory;
use MagePrakash\Helpdesk\Api\Data\TicketInterface;
use MagePrakash\Helpdesk\Api\Data\TicketInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use MagePrakash\Helpdesk\Helper\Config;

class Ticket extends \Magento\Framework\Model\AbstractModel
{

    protected $ticketDataFactory;
    protected $ticketMessageFactory;
    protected $_eventPrefix = 'mageprakash_helpdesk_ticket';
    protected $dataObjectHelper;
    protected $ticketMessageCollectionFactory;
    protected $departmentFactory;
    protected $customerRepositoryFactory;
    protected $dateTime;
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TicketInterfaceFactory $ticketDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Ticket $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Ticket\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TicketInterfaceFactory $ticketDataFactory,
        TicketMessageFactory $TicketMessageFactory,        
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\DepartmentFactory $departmentFactory,        
        \MagePrakash\Helpdesk\Model\ResourceModel\Ticket $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Ticket\Collection $resourceCollection,
        \MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage\CollectionFactory $ticketMessageCollectionFactory,
        \Magento\Customer\Api\CustomerRepositoryInterfaceFactory $customerRepositoryFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        $this->ticketMessageCollectionFactory = $ticketMessageCollectionFactory;        
        $this->ticketMessageFactory = $TicketMessageFactory;        
        $this->ticketDataFactory = $ticketDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->departmentFactory = $departmentFactory;
        $this->customerRepositoryFactory = $customerRepositoryFactory;
        $this->dateTime = $dateTime;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve ticket model with ticket data
     * @return TicketInterface
     */
    public function getDataModel()
    {
        $ticketData = $this->getData();
        
        $ticketDataObject = $this->ticketDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $ticketDataObject,
            $ticketData,
            TicketInterface::class
        );
        
        return $ticketDataObject;
    }

     public function getTicketMessageCollecion()
    {
        $ticketMessageCollection = $this->ticketMessageCollectionFactory->create();
        $ticketMessageCollection->addFieldToFilter('main_table.ticket_id', $this->getTicketId());
        $ticketMessageCollection->addTicketSelect();
        $ticketMessageCollection->addCustomerEmailToSelect();
        $ticketMessageCollection->addAdminUserEmailToSelect();
        $ticketMessageCollection->addEmailToSelect();
        $ticketMessageCollection->setOrder('main_table.ticket_message_id', \Magento\Framework\Data\Collection::SORT_ORDER_DESC);

        return $ticketMessageCollection;
    }

    /**
     *
     * @return \Swissup\Helpdesk\Api\Data\DepartmentInterface
     */
    public function getDepartment()
    {
        return $this->departmentFactory->create()->load(
            $this->getDepartmentId()
        );
    }

    public function getCustomer()
    {
        return $this->getCustomerId() ? $this->customerRepositoryFactory->create()->getById(
            $this->getCustomerId()
        ) : false;
    }

    public function beforeSave(){
        parent::beforeSave();
        
        if ($this->isObjectNew()) {
            $this->setData('created_at', $this->dateTime->gmtDate());
        }
        
        $this->setData('modified_at', $this->dateTime->gmtDate());

        return parent::beforeSave();
    }

    public function afterSave()
    {
        parent::afterSave();

        $ticketMessage = $this;

        $ticketMessageFactory = $this->ticketMessageFactory->create();
        
        if($ticketMessage->getText() != "" || !empty($ticketMessage->getFile()))
        {
            $ticketMessageFactory->addData([
                'ticket_id'         => $ticketMessage->getTicketId(),
                'created_at'        => date('Y-m-d H:i:s'),
                'text'              => $ticketMessage->getText(),
                'file'              => $ticketMessage->getFile(),
                'user_id'           => $ticketMessage->getUserId(),
                'status_id'         => $ticketMessage->getStatusId(),
                'priority_id'       => $ticketMessage->getPriorityId(),
                'department_id'     => $ticketMessage->getDepartmentId(),
                'reply_by'          => $ticketMessage->getReplyBy(),
                'author_name'       => $ticketMessage->getAuthorName(), 
                'author_email'      => $ticketMessage->getAuthorEmail()
            ]);
        }
        
        $ticketMessageFactory->save();

        return $this;
    }
}
