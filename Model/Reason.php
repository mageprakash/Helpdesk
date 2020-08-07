<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\ReasonInterface;
use MagePrakash\Helpdesk\Api\Data\ReasonInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Reason extends \Magento\Framework\Model\AbstractModel
{

    protected $reasonDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'mageprakash_helpdesk_reason';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ReasonInterfaceFactory $reasonDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Reason $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\Reason\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ReasonInterfaceFactory $reasonDataFactory,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\Reason $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\Reason\Collection $resourceCollection,
        array $data = []
    ) {
        $this->reasonDataFactory = $reasonDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve reason model with reason data
     * @return ReasonInterface
     */
    public function getDataModel()
    {
        $reasonData = $this->getData();
        
        $reasonDataObject = $this->reasonDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $reasonDataObject,
            $reasonData,
            ReasonInterface::class
        );
        
        return $reasonDataObject;
    }
}

