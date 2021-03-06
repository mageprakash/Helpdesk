<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\TicketMessageInterfaceFactory;
use MagePrakash\Helpdesk\Api\Data\TicketMessageInterface;
use Magento\Framework\Api\DataObjectHelper;

class TicketMessage extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'mageprakash_helpdesk_ticket_message';
    protected $ticket_messageDataFactory;
    protected $fileFactory;
    protected $dataObjectHelper;
    protected $ticketFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TicketMessageInterfaceFactory $ticket_messageDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TicketMessageInterfaceFactory $ticket_messageDataFactory,
        FileFactory $fileFactory,        
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage\Collection $resourceCollection,
        \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory,
        array $data = []
    ) {
        $this->ticket_messageDataFactory = $ticket_messageDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->fileFactory = $fileFactory;
        $this->ticketFactory = $ticketFactory;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve ticket_message model with ticket_message data
     * @return TicketMessageInterface
     */
    public function getDataModel()
    {
        $ticket_messageData = $this->getData();
        $ticket_messageDataObject = $this->ticket_messageDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $ticket_messageDataObject,
            $ticket_messageData,
            TicketMessageInterface::class
        );
        
        return $ticket_messageDataObject;
    }

    public function getTicket()
    {
        return $this->ticketFactory->create()->load($this->getTicketId());
    }

    public function afterSave()
    {
        parent::afterSave();        
    
        $ticketMessage = $this;
        $files = $ticketMessage->getFile();
        if(!empty($files)){
            foreach ($files as $fileDetail) {
                $fileFactory = $this->fileFactory->create();
                $fileFactory->addData([
                    'ticket_message_id' => $ticketMessage->getTicketMessageId(),
                    'name' => $fileDetail['name'],
                    'path' => $fileDetail['file'],
                    'size' => $fileDetail['size'],
                    'type' => $fileDetail['type'],
                ]);    
                $fileFactory->save();
                
            }
        }
    }

    public function getEmailTemplateIdByTicketId(){
        
    }
}
