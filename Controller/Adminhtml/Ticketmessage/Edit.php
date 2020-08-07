<?php


namespace MagePrakash\Helpdesk\Controller\Adminhtml\Ticketmessage;

class Edit extends \MagePrakash\Helpdesk\Controller\Adminhtml\Ticketmessage
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('ticket_message_id');
        $model = $this->_objectManager->create(\MagePrakash\Helpdesk\Model\TicketMessage::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Ticket Message no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('mageprakash_helpdesk_ticket_message', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Ticket Message') : __('New Ticket Message'),
            $id ? __('Edit Ticket Message') : __('New Ticket Message')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Ticket Messages'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Ticket Message %1', $model->getId()) : __('New Ticket Message'));
        return $resultPage;
    }
}
