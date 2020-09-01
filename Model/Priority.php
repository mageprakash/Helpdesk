<?php


namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\PriorityInterface;
use Magento\Framework\Api\DataObjectHelper;

class Priority extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'mageprakash_helpdesk_priority';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Priority $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Priority\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\Priority $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Priority\Collection $resourceCollection,
        array $data = []
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
}
