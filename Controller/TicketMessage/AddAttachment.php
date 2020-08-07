<?php

namespace MagePrakash\Helpdesk\Controller\TicketMessage;

use Magento\Framework\Json\Helper\Data as JsonHelper;

class AddAttachment extends \MagePrakash\Helpdesk\Controller\AbstractAction
{
    protected $uploadModel;
    protected $jsonHelper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,        
        \MagePrakash\Helpdesk\Model\Upload $uploadModel,
        jsonHelper $jsonHelper,
        \MagePrakash\Helpdesk\Helper\Config $helperConfig        
        ){
        $this->jsonHelper  = $jsonHelper;
        $this->uploadModel = $uploadModel;
        parent::__construct($context, $customerSession,$helperConfig);
    }

    public function execute(){
    
        $uploadData = $this->getRequest()->getFiles();

        $uploadData = $uploadData['file'];

        try {
            $result = $this->uploadModel->uploadFileAndGetInfo($uploadData);
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        return $this->jsonResponse($result);
    }
 
    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($response)
        );
    }
}