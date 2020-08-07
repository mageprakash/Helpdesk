<?php
namespace MagePrakash\Helpdesk\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;

abstract class AbstractAction extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     *
     * @var boolean
     */
    protected $isOnlyForLoginedCustomer = false;

    /**
     * @var \MagePrakash\Helpdesk\Helper\Config
     */
    protected $configHelper;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \MagePrakash\Helpdesk\Helper\Config $configHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \MagePrakash\Helpdesk\Helper\Config $configHelper
    ) {
        $this->customerSession = $customerSession;
        $this->configHelper = $configHelper;
        parent::__construct($context);
    }

    /**
     * Check customer authentication
     *
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$request->isDispatched()) {
            return parent::dispatch($request);
        }

        if (!$this->configHelper->isEnabled()) {
            throw new NotFoundException(__('Page not found.'));
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }

        if ($this->isOnlyForLoginedCustomer() && !$this->customerSession->authenticate()) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }

        return parent::dispatch($request);
    }

    /**
     *
     * @return boolean
     */
    protected function isOnlyForLoginedCustomer()
    {
        return (bool) $this->isOnlyForLoginedCustomer;
    }
}
