<?php


namespace MagePrakash\Helpdesk\Controller\Adminhtml\Ticket;

use Magento\Framework\Exception\LocalizedException;
use MagePrakash\Helpdesk\Helper\Config;
use Magento\Backend\Model\Auth\Session;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $authSession;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Backend\Model\Auth\Session $authSession
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->authSession = $authSession;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('ticket_id');
        
            $model = $this->_objectManager->create(\MagePrakash\Helpdesk\Model\Ticket::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Ticket no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);
            $model->setAuthorName($this->authSession->getUser()->getUsername());
            $model->setAuthorEmail($this->authSession->getUser()->getEmail());

            if(isset($data['file']))
            {
                $model->setFile($data['file']);
            }else{
                $model->setFile([]);
            }
            $model->setReplyBy(Config::TICKET_MESSAGE_ADMIN);
            
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Ticket.'));
                $this->dataPersistor->clear('mageprakash_helpdesk_ticket');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['ticket_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Ticket.'));
            }
        
            $this->dataPersistor->set('mageprakash_helpdesk_ticket', $data);
            return $resultRedirect->setPath('*/*/edit', ['ticket_id' => $this->getRequest()->getParam('ticket_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}