<?php
namespace MagePrakash\Helpdesk\Block\Ticket;

use \Magento\Framework\App\ObjectManager;

/**
 * helpdesk ticket history block
 *
 */
class Listing extends \MagePrakash\Helpdesk\Block\Ticket\AbstractBlock
{
    /**
     * @var string
     */
    protected $_template = 'MagePrakash_Helpdesk::ticket/list.phtml';

    protected $collectionFactory;

    protected $collection;

    /**
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\SessionFactory $customerSessionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \MagePrakash\Helpdesk\Model\ResourceModel\Ticket\CollectionFactory $collectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
         \MagePrakash\Helpdesk\Helper\Config $configHelper,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;

        parent::__construct(
            $context,
            $customerSessionFactory,
            $coreRegistry,
            $configHelper,
            $data
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->pageConfig->getTitle()->set(__('My Tickets'));
    }


    public function getTickets()
    {
        if (!($customerId = $this->getCustomerSession()->getCustomerId())) {
            return false;
        }
        if (!$this->collection) {
            $storeId = $this->storeManager->getStore()->getId();

            $this->collection = $this->collectionFactory->create()
                ->addFieldToSelect('*')
                ->addDepartmentNameToSelect()
                ->addStatusNameToSelect()
                ->addPriorityToSelect()
                ->addFieldToFilter('main_table.customer_id', $customerId)
                ->addFieldToFilter('main_table.store_id', $storeId)//addStoreIdFilter
                ->setOrder('created_at', 'desc')
            ;
        }
        return $this->collection;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ($this->getTickets()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'mageprakash.helpdesk.ticket.history.pager'
            )->setCollection(
                $this->getTickets()
            );
            $this->setChild('pager', $pager);
            $this->getTickets()->load();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @param object $ticket
     * @return string
     */
    public function getViewUrl($ticket)
    {
        return $this->getUrl('helpdesks/ticket/view', ['ticket_id' => $ticket->getTicketId()]);
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('customer/account/');
    }
}
