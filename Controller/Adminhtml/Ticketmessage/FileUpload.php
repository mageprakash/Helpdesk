<?php
namespace MagePrakash\Helpdesk\Controller\Adminhtml\TicketMessage;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class FileUpload
 */
class FileUpload extends \Magento\Backend\App\Action
{
    protected $uploadModel;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \MagePrakash\Helpdesk\Model\Upload $uploadModel
    ) {
        $this->uploadModel = $uploadModel;

        parent::__construct($context);
    }

    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $uploadData = $this->getRequest()->getFiles();

        $uploadData = $uploadData['file'];

        try {
            $result = $this->uploadModel->uploadFileAndGetInfo($uploadData);
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
