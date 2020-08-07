<?php

namespace MagePrakash\Helpdesk\Controller\Ticket;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\StoreManagerInterface;

class Save extends \MagePrakash\Helpdesk\Controller\AbstractAction
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
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        StoreManagerInterface $storeManager,
        \MagePrakash\Helpdesk\Helper\Config $helperConfig
    ) {
        $this->currentCustomer  = $currentCustomer;
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

        if (!$this->getRequest()->isPost()) {
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }


        try {
            $data = $this->getRequest()->getPostValue();

            $data['customer_id'] = $this->currentCustomer->getCustomerId();
            $data['store_id']    = $this->storeManager->getStore()->getId();
            $data['status_id']   = $this->helperConfig->getNewStatusTicket(1);

            $model = $this->ticketFactory->create();
            $model->setData($data);

            if(isset($data['file']) && !empty($data['file']))
            {
                $file = $this->getFileDetails($data['file']);
            }else{
                $file = [];
            }

            $model->setFile($file);

            $model->save();

            $this->messageManager->addSuccess(__('Ticket has been saved.'));
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
