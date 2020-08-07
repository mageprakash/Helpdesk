<?php

namespace MagePrakash\Helpdesk\Controller\Adminhtml\Order;

use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Controller to search order for ui-select component
 */
class Search extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Sales::sales_order';

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var \Swissup\Helpdesk\Model\OrderLink\Search
     */
    private $orderSearch;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultFactory
     * @param \Swissup\Helpdesk\Model\OrderLink\Search $orderSearch
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $resultFactory,
        \MagePrakash\Helpdesk\Model\OrderLink\Search $orderSearch,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->resultJsonFactory = $resultFactory;
        $this->orderSearch = $orderSearch;
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

        /** @var \Magento\Sales\Model\ResourceModel\Order\Collection $orderCollection */
        $orderCollection = $this->orderSearch->prepareCollection($searchKey, $pageNum, $limit);
        $totalValues = $orderCollection->getSize();
        $orderById = [];
        /** @var  ProductInterface $order */
        foreach ($orderCollection as $order) {
            // $orderId = $order->getId();
            $orderId = $order->getId();
            $orderById[$orderId] = [
                'value' => $orderId,
                'label' => $order->getIncrementId(),
                'optgroup' => false
            ];
        }
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData([
            'options' => $orderById,
            'total' => empty($orderById) ? 0 : $totalValues
        ]);
    }
}
