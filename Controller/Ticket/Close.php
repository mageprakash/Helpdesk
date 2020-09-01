<?php

namespace MagePrakash\Helpdesk\Controller\Ticket;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\StoreManagerInterface;
use MagePrakash\Helpdesk\Helper\Config;

class Close extends \MagePrakash\Helpdesk\Controller\AbstractAction
{
    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;

    /**
     * @var \MagePrakash\Helpdesk\Model\TicketFactory
     */
    private $ticketFactory;
    
    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \MagePrakash\Helpdesk\Helper\Config
     */
    protected $helperConfig;    
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory,
        StoreManagerInterface $storeManager,
        \MagePrakash\Helpdesk\Helper\Config $helperConfig
    ) {
        $this->formKeyValidator = $formKeyValidator;
        $this->ticketFactory    = $ticketFactory;
        $this->storeManager     = $storeManager;
        $this->helperConfig     = $helperConfig;
        parent::__construct($context, $customerSession,$helperConfig);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {      
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $customer = $this->customerSession->getCustomer();

        $ticketId = $this->getRequest()->getParam('ticket_id');
        $ticket = $this->ticketFactory->create()->getCollection()
            ->addFieldToFilter('ticket_id',['eq' => $ticketId])
            ->getFirstItem();

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
            
            $ticket->setReplyBy(Config::TICKET_MESSAGE_CUSTOMER);
            $ticket->setAuthorName($customer->getFirstname().' '.$customer->getLastname());
            $ticket->setAuthorEmail($customer->getEmail());

            $ticket->setData('text' ,Config::TICKET_MESSAGE_CLOSE_STATUS_TEXT);
            $ticket->setData('status_id' ,$this->helperConfig->getCloseStatusTicket());

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
}
