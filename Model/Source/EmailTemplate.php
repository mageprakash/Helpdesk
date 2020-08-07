<?php

namespace MagePrakash\Helpdesk\Model\Source;

class EmailTemplate extends \Magento\Framework\DataObject implements \Magento\Framework\Option\ArrayInterface{

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Magento\Email\Model\Template\Config
     */
    private $emailConfig;

    /**
     * @var \Magento\Email\Model\ResourceModel\Template\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Email\Model\ResourceModel\Template\CollectionFactory $collectionFactory
     * @param \Magento\Email\Model\Template\Config $emailConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Email\Model\ResourceModel\Template\CollectionFactory $collectionFactory,
        \Magento\Email\Model\Template\Config $emailConfig,
        array $data = []
    ) {
        parent::__construct($data);
        $this->coreRegistry = $coreRegistry;
        $this->collectionFactory = $collectionFactory;
        $this->emailConfig = $emailConfig;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (!($collection = $this->coreRegistry->registry('config_system_email_template'))) {
            $collection = $this->collectionFactory->create();
            $collection->load();
            $this->coreRegistry->register('config_system_email_template', $collection);
        }

        $options = array_merge(
            $this->emailConfig->getAvailableTemplates(),
            $collection->toOptionArray('template_id', 'template_code')
        );

        $options = array_merge(
            [['value' => '', 'label' => '', 'group' => '']],
            $options
        );
        uasort(
            $options,
            function (array $firstElement, array $secondElement) {
                return strcmp($firstElement['label'], $secondElement['label']);
            }
        );
        return $options;
    }
}
