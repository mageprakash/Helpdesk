<?php

namespace MagePrakash\Helpdesk\Controller\Ticket;

use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;

class View extends \MagePrakash\Helpdesk\Controller\AbstractAction
{
    private $ticketFactory;
    private $registry;
    protected $resultForwardFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\Registry $registry
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory,
        \Magento\Framework\Registry $registry,
        ForwardFactory $resultForwardFactory,
        \MagePrakash\Helpdesk\Helper\Config $helperConfig   
    ) {
        $this->ticketFactory = $ticketFactory;
        $this->registry = $registry;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context, $customerSession,$helperConfig);
    }

    /**
     * @return \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $ticketId = $this->getRequest()->getParam('ticket_id');
        if (!$ticketId) {
            /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }

        $ticket = $this->ticketFactory->create()->getCollection()
            ->addDepartmentNameToSelect()
            ->addStatusNameToSelect()
            ->addPriorityToSelect()
            ->addFieldToFilter('ticket_id',['eq' => $ticketId])           
            ->getFirstItem();
            
       
        if (!$ticket->getTicketId()) {

            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('*/index/index');
            return $resultRedirect;
        }

        $currentTicket = false;
        if ($ticket->getCustomerId()) {
            $currentCustomer = $this->customerSession->getCustomerDataObject();
            if (!$this->customerSession->isLoggedIn()
                || $ticket->getCustomerId() !== $currentCustomer->getId()
            ) {
                $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
            }
            $currentTicket = $ticket;
        }
        
        $this->registry->register('current_ticket', $currentTicket);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        return $resultPage;
    }
}
