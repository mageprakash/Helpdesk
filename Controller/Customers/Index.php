<?php
namespace MagePrakash\Helpdesk\Controller\Customers;

use \Magento\Framework\App\RequestInterface;
use \Magento\Framework\Controller\ResultFactory;

class Index extends \MagePrakash\Helpdesk\Controller\AbstractAction
{
    /**
     *
     * @var boolean
     */
    protected $isOnlyForLoginedCustomer = true;

    /**
     * Default customer account page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('My Tickets'));
        return $resultPage;
    }
}
