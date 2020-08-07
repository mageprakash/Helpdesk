<?php


namespace MagePrakash\Helpdesk\Controller\Adminhtml\Status;

class Edit extends \MagePrakash\Helpdesk\Controller\Adminhtml\Status
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
        $id = $this->getRequest()->getParam('status_id');
        $model = $this->_objectManager->create(\MagePrakash\Helpdesk\Model\Status::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Status no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('mageprakash_helpdesk_status', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Status') : __('New Status'),
            $id ? __('Edit Status') : __('New Status')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Statuss'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Status %1', $model->getId()) : __('New Status'));
        return $resultPage;
    }
}
