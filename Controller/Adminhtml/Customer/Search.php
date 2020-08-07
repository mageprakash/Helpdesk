<?php

// declare(strict_types=1);

namespace MagePrakash\Helpdesk\Controller\Adminhtml\Customer;

use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Controller to search customer for ui-select component
 */
class Search extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Customer::manage';

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var \Swissup\Helpdesk\Model\CustomerLink\Search
     */
    private $customerSearch;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultFactory
     * @param \Swissup\Helpdesk\Model\CustomerLink\Search $customerSearch
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $resultFactory,
        \MagePrakash\Helpdesk\Model\CustomerLink\Search $customerSearch,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->resultJsonFactory = $resultFactory;
        $this->customerSearch = $customerSearch;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() : \Magento\Framework\Controller\ResultInterface
    {
        $searchKey = $this->getRequest()->getParam('searchKey');
        $pageNum = (int) $this->getRequest()->getParam('page');
        $limit = (int) $this->getRequest()->getParam('limit');

        /** @var \Magento\Customer\Model\ResourceModel\Customer\Collection $customerCollcetion */
        $customerCollcetion = $this->customerSearch->prepareCollection($searchKey, $pageNum, $limit);
        $totalValues = $customerCollcetion->getSize();
        $customerById = [];
        /** @var  ProductInterface $customer */
        foreach ($customerCollcetion as $customer) {
            $customerId = $customer->getId();
            $customerById[$customerId] = [
                'value' => $customerId,
                'label' => $customer->getName(),
                'email' => $customer->getEmail(),
                // 'is_active' => $customer->getStatus(),
                'path' => $customer->getEmail(),
                'optgroup' => false
            ];
        }
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData([
            'options' => $customerById,
            'total' => empty($customerById) ? 0 : $totalValues
        ]);
    }
}
