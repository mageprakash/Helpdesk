<?php

namespace MagePrakash\Helpdesk\Model\Ticket\Source;

class Customer implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
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
     * @param \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory
     */
    public function __construct(
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory,
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
            $this->options = [];
            /** @var $collection \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory */
            $collection = $this->collectionFactory->create();

            $collection->setPageSize(100)
                ->setCurPage(1);

            $collection->load();
            foreach ($collection as $customer) {
                $this->options[$customer->getId()] = [
                    'value' => $customer->getId(),
                    'label' => $customer->getName(),
                    'email' => $customer->getEmail()
                ];
            }
            // $this->options = $collection->load()->toOptionArray();
        }

        $ticketId = $this->request->getParam('ticket_id');
        if ($ticketId) {
            $ticket = $this->ticketFactory->create();
            $ticket->load($ticketId);
            if ($ticket->getId()) {
                $customerId = $ticket->getCustomerId();

                if (!isset($this->options[$customerId])) {
                    $collection = $this->collectionFactory->create();
                    $collection->addFieldToFilter('entity_id', $customerId);

                    $customer = $collection->getFirstItem();
                    if ($customer->getId()) {
                        $this->options[$customer->getId()] = [
                            'value' => $customer->getId(),
                            'label' => $customer->getName(),
                            'email' => $customer->getEmail()
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
