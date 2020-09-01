<?php


namespace MagePrakash\Helpdesk\Model;

use Magento\Framework\Api\DataObjectHelper;
use MagePrakash\Helpdesk\Api\Data\StatusInterfaceFactory;

class Status extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $statusDataFactory;

    protected $_eventPrefix = 'mageprakash_helpdesk_status';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param StatusInterfaceFactory $statusDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Status $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Status\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\Status $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Status\Collection $resourceCollection,
        array $data = []
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
}
