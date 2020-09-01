<?php

namespace MagePrakash\Helpdesk\Model\Config\Source;

class Order implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $collectionFactory;

    /**
     *
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     *
     * @var \MagePrakash\Helpdesk\Model\TicketFactory
     */
    protected $ticketFactory;

    /**
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory
     */
    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->request = $request;
        $this->ticketFactory = $ticketFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            /** @var $collection \Magento\Sales\Model\ResourceModel\Order\CollectionFactory */
            $collection = $this->collectionFactory->create();
            $collection->setPageSize(100)
                ->setCurPage(1);
            $collection->load();
            $this->options = [];
            foreach ($collection as $order) {
                $this->options[$order->getId()] = [
                    'value' => $order->getId(),
                    'label' => $order->getIncrementId(),
                ];
            }
        }

        $ticketId = $this->request->getParam('ticket_id');
        if ($ticketId) {
            $ticket = $this->ticketFactory->create();
            $ticket->load($ticketId);
            if ($ticket->getId()) {
                $orderId = $ticket->getOrderId();

                if (!isset($this->options[$orderId])) {
                    $collection = $this->collectionFactory->create();
                    $collection->addFieldToFilter('entity_id', $orderId);

                    $order = $collection->getFirstItem();
                    if ($order->getId()) {
                        $this->options[$order->getId()] = [
                            'value' => $order->getId(),
                            'label' => $order->getIncrementId(),
                        ];
                    }
                }
            }
        }

        return array_merge(
            [['value' => ' ', 'label' => ' ']],
            $this->options
        );
    }
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->toOptionArray() as $item) {
            $result[$item['value']] = $item['label'];
        }
        return $result;
    }
}
