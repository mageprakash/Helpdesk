<?php


namespace MagePrakash\Helpdesk\Model;

use Magento\Framework\Api\DataObjectHelper;
use MagePrakash\Helpdesk\Api\Data\FileInterface;

class File extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'mageprakash_helpdesk_file';
    protected $dataObjectHelper;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param DataObjectHelper $dataObjectHelper
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\File $resource
     * @param \MagePrakash\Helpdesk\Model\ResourceModel\File\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        DataObjectHelper $dataObjectHelper,
        \MagePrakash\Helpdesk\Model\ResourceModel\File $resource,
        \MagePrakash\Helpdesk\Model\ResourceModel\File\Collection $resourceCollection,
        array $data = []
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
}
