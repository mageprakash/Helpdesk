<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MagePrakash\Helpdesk\Block;


class Link extends \Magento\Framework\View\Element\Html\Link\Current
{
    /**
     * Rma data
     *
     * @var \MagePrakash\Helpdesk\Helper\Data
     */
    protected $_configHelper = null;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\DefaultPathInterface $defaultPath
     * @param \Magento\Rma\Helper\Data $configHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\DefaultPathInterface $defaultPath,
        \MagePrakash\Helpdesk\Helper\Config $configHelper,
        array $data = []
    ) {
        parent::__construct($context, $defaultPath, $data);
        $this->_configHelper = $configHelper;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    protected function _toHtml()
    {
        if ($this->_configHelper->isEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}
