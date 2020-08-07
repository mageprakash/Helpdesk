<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\TicketMessageInterfaceFactory;
use MagePrakash\Helpdesk\Api\Data\TicketInterface;
use MagePrakash\Helpdesk\Api\Data\TicketInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Ticket extends \Magento\Framework\Model\AbstractModel
{

    protected $ticketDataFactory;
    protected $ticketMessageFactory;
    protected $_eventPrefix = 'mageprakash_helpdesk_ticket';
    protected $dataObjectHelper;
    protected $ticketMessageCollectionFactory;


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
        \MagePrakash\Helpdesk\Model\ResourceModel\Ticket $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Ticket\Collection $resourceCollection,
        \MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage\CollectionFactory $ticketMessageCollectionFactory,
        array $data = []
    ) {
        $this->ticketMessageCollectionFactory = $ticketMessageCollectionFactory;        
        $this->ticketMessageFactory = $TicketMessageFactory;        
        $this->ticketDataFactory = $ticketDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
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
        $ticketMessageCollection->addCustomerIdToSelect();
        $ticketMessageCollection->addCustomerEmailToSelect();
        $ticketMessageCollection->addAdminUserEmailToSelect();
        $ticketMessageCollection->addEmailToSelect();
        $ticketMessageCollection->setOrder('main_table.ticket_message_id', \Magento\Framework\Data\Collection::SORT_ORDER_DESC);

        return $ticketMessageCollection;
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
                'email_message_id'  => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'text'              => $ticketMessage->getText(),
                'file'              => $ticketMessage->getFile(),
                'user_id'           => $ticketMessage->getUserId(),
                'status_id'         => $ticketMessage->getStatusId(),
                'priority_id'       => $ticketMessage->getPriorityId(),
                'department_id'     => $ticketMessage->getDepartmentId(),
                'enabled'           => 1
            ]);
        }
        
        $ticketMessageFactory->save();

        return $this;
    }
}