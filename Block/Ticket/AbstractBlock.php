<?php

namespace MagePrakash\Helpdesk\Block\Ticket;

class AbstractBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * Customer session
     *
     * @var \Magento\Customer\Model\SessionFactory
     */
    protected $customerSessionFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * @var \Magento\Framework\Data\Helper\PostHelper
     */
    protected $postDataHelper;

    /**
     * @var \MagePrakash\Helpdesk\Helper\Config
     */
    protected $configHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\SessionFactory $customerSessionFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param \MagePrakash\Helpdesk\Helper\Config $configHelper
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\SessionFactory $customerSessionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \MagePrakash\Helpdesk\Helper\Config $configHelper,
        array $data = []
    ) {

        $this->customerSessionFactory = $customerSessionFactory;
        $this->coreRegistry = $coreRegistry;
        $this->configHelper = $configHelper;
        parent::__construct($context, $data);
    }

    public function getAction()
    {
        return $this->getUrl('helpdesks/ticket/save');
    }

    protected function getCustomerSession()
    {
        return $this->customerSessionFactory->create();
    }

    public function isCustomerLoggedIn()
    {
        return $this->getCustomerSession()->isLoggedIn();
    }

    public function getCurrentTicket()
    {
        $key = 'current_ticket';
        if (!$this->hasData($key)) {
            $this->setData($key, $this->coreRegistry->registry($key));
        }
        return $this->getData($key);
    }

    public function getConfigHelper()
    {
        return $this->configHelper;
    }

    public function escapeHtmlAttr($string, $escapeSingleQuote = true)
    {
        return $this->_escaper->escapeHtmlAttr($string, $escapeSingleQuote);
    }

    protected function isEnabledToHtml()
    {
        return $this->configHelper->isEnabled();
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    protected function _toHtml()
    {
        if (!$this->isEnabledToHtml()) {
            return '';
        }

        return parent::_toHtml();
    }
}
