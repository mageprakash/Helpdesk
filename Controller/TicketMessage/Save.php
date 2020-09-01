<?php

namespace MagePrakash\Helpdesk\Controller\TicketMessage;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use MagePrakash\Helpdesk\Api\Data\StatusInterface;
use MagePrakash\Helpdesk\Helper\Config;

class Save extends \MagePrakash\Helpdesk\Controller\AbstractAction
{
    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;

    private $ticketFactory;

    private $ticketMessageFactory;
    
    protected $currentCustomer;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory,
        \MagePrakash\Helpdesk\Helper\Config $configHelper,
        \MagePrakash\Helpdesk\Model\TicketMessageFactory $ticketMessageFactory
    ) {
        $this->formKeyValidator = $formKeyValidator;
        $this->ticketFactory = $ticketFactory;
        $this->ticketMessageFactory = $ticketMessageFactory;
        parent::__construct($context, $customerSession,$configHelper);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $customer = $this->customerSession->getCustomer();
        
        if (!$this->getRequest()->isPost()) {
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }

        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addError(__('Invalid Form Key. Please refresh the page.'));
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }
        

        $isCancel = $this->getRequest()->getParam('is_cancel');
        $number = $this->getRequest()->getParam('ticket_id');

        $cancelStatusId = $this->configHelper->getCloseStatusTicket();
        if (!$number) {
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }

        $ticket = $this->ticketFactory->create()->getCollection()
            ->addFieldToFilter('ticket_id',['eq' => $number])
            ->getFirstItem()
        ;

        if (!$ticket->getTicketId()) {
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }

        if (!$this->customerSession->isLoggedIn()
            || $ticket->getCustomerId() !== $customer->getId()
        ) {
            $this->messageManager->addError(__('Ticket mismatch found.'));
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }
        
        try {
            $data = $this->getRequest()->getPostValue();
            
            $ticket->setReplyBy(Config::TICKET_MESSAGE_CUSTOMER);
            $ticket->setAuthorName($customer->getFirstname().' '.$customer->getLastname());
            $ticket->setAuthorEmail($customer->getEmail());

            $message = $this->ticketMessageFactory->create();
            $message->setData($data);
            
            if($ticket->getStatusId() == $cancelStatusId){
                $ticket->setStatusId($this->configHelper->getNewStatusTicket());
            }

            $ticket->setData('text' ,$message->getText());

            if(isset($data['file']) && !empty($data['file']))
            {
                $file = $this->getFileDetails($data['file']);
            }else{
                $file = [];
            }

            $ticket->setFile($file);
            $ticket->save();

            $this->messageManager->addSuccess(__('Message has been added.'));
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    public function getFileDetails($uploadFiles){
        $result = [];
        foreach ($uploadFiles as $key => $file){
            foreach ($file as $postion => $data){
                $result[$postion][$key] = $data;
            }
        }
        return $result;
    }
}