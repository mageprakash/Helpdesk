<?php

namespace MagePrakash\Helpdesk\Block\Ticket;

use MagePrakash\Helpdesk\Block\Ticket\AbstractBlock;

class Form extends AbstractBlock
{
    protected $formId = 'mageprakash_helpdesk_new_ticket_form';

    protected $_template = 'MagePrakash_Helpdesk::ticket/form.phtml';

    protected $sourceDepartmentFactory;

    protected $sourcePriorityFactory;
    
    protected $_orderCollectionFactory;

    /**
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\SessionFactory $customerSessionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \MagePrakash\Helpdesk\Helper\Config $configHelper,
        \MagePrakash\Helpdesk\Model\DepartmentFactory $sourceDepartmentFactory,
        \MagePrakash\Helpdesk\Model\PriorityFactory $sourcePriorityFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,        
        array $data = []
    ) {
        $this->sourceDepartmentFactory = $sourceDepartmentFactory;
        $this->sourcePriorityFactory = $sourcePriorityFactory;
        $this->storeManager = $storeManager;
        $this->_orderCollectionFactory = $orderCollectionFactory;

        parent::__construct(
            $context,
            $customerSessionFactory,
            $coreRegistry,
            $configHelper,
            $data
        );
    }

    public function getCustomerSession(){
         return $this->customerSessionFactory->create();
    }

    /**
     *
     * @return array
     */
    public function getDepartmentOptionArray()
    {
        $storeId = $this->storeManager->getStore()->getId();

        return $this->sourceDepartmentFactory->create()->getCollection()
            ->toOptionArray();
    }

    /**
     *
     * @return array
     */
    public function getPriorityOptionArray()
    {
        return $this->sourcePriorityFactory->create()->getCollection()->toOptionArray();
    }

    /**
     *
     * @return array
     */
    public function getOrderList()
    {
        return  $this->_orderCollectionFactory->create()->addFieldToSelect(
                '*'
            )->addFieldToFilter(
                'customer_id',
                $this->getCustomerSession()->getCustomer()->getId()
            )->setOrder(
                'created_at',
                'desc'
            );
    }
}
