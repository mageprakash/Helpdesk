<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

     /**
     * @var \Magento\Framework\Api\ExtensibleDataObjectConverter
     */
    private $extensibleDataObjectConverter;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Framework\Api\ExtensibleDataObjectConverter $extensibleDataObjectConverter
     * @param \Magento\Framework\DB\Adapter\AdapterInterface $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\Api\ExtensibleDataObjectConverter $extensibleDataObjectConverter,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }
    
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \MagePrakash\Helpdesk\Model\TicketMessage::class,
            \MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage::class
        );
    }

    

    /**
     * Add customer name expression to the collection
     */
    public function addTicketSelect()
    {
        $this->getSelect()->joinLeft(
            ['mageprakash_helpdesk_ticket' => $this->getTable('mageprakash_helpdesk_ticket')],
            'main_table.ticket_id = mageprakash_helpdesk_ticket.ticket_id',
            ['customer_id', 'ticket_email' => 'email']
        );

        return $this;
    }

    /**
     * Add customer email expression to the collection
     */
    public function addCustomerEmailToSelect()
    {
        $this->getSelect()->joinLeft(
            ['customer_entity' => $this->getTable('customer_entity')],
            'mageprakash_helpdesk_ticket.customer_id = customer_entity.entity_id',
            ['customer_email' => 'customer_entity.email']
        );

        return $this;
    }

    /**
     * Add admin user email expression to the collection
     */
    public function addAdminUserEmailToSelect()
    {
        $this->getSelect()->joinLeft(
            ['admin_user' => $this->getTable('admin_user')],
            'main_table.user_id = admin_user.user_id',
            ['user_email' => 'admin_user.email']
        );

        return $this;
    }

    /**
     * Add user email expression to the collection
     */
    public function addEmailToSelect()
    {
        $emailExpr0 = 'IF(`customer_entity`.`email` IS NULL, `mageprakash_helpdesk_ticket`.`email`, `customer_entity`.`email`)';

        $emailExpr = 'IF(main_table.user_id IS NULL, ' . $emailExpr0 . ', `admin_user`.`email`)';
        $this->getSelect()->columns([
            'email' => new \Zend_Db_Expr($emailExpr)
        ]);

        return $this;
    }

    /**
     * Add department name to the collection
     */
    public function addDepartmentNameToSelect()
    {
        $this->getSelect()->joinLeft(
            ['mageprakash_helpdesk_department' => $this->getTable('mageprakash_helpdesk_department')],
            'main_table.department_id = mageprakash_helpdesk_department.department_id',
            ['department_name' => 'mageprakash_helpdesk_department.name']
        );

        return $this;
    }

    /**
     * Add Priority to the collection
     */
    public function addPriorityToSelect()
    {
        $tableName = $this->getTable('mageprakash_helpdesk_priority');

        $this->getSelect()->joinLeft(
            $tableName,
            "main_table.priority_id = {$tableName}.priority_id",
            ['priority_label' => "{$tableName}.name"]
        );

        return $this;
    }

    /**
     * Add attachmentToSelect collection
     */
    public function addAttachmentToSelect()
    {
        $tableName = $this->getTable('mageprakash_helpdesk_file');
        $this->getSelect()->joinLeft(
            $tableName,
            "main_table.ticket_message_id = {$tableName}.ticket_message_id",
            [
                'filename'  => new \Zend_Db_Expr('group_concat(mageprakash_helpdesk_file.name SEPARATOR ",")'),
                'filepath'  => new \Zend_Db_Expr('group_concat(mageprakash_helpdesk_file.path SEPARATOR ",")'),
                'filesize'  => new \Zend_Db_Expr('group_concat(mageprakash_helpdesk_file.size SEPARATOR ",")'),
                'filetype'  => new \Zend_Db_Expr('group_concat(mageprakash_helpdesk_file.type SEPARATOR ",")')
            ]
        );

        return $this;
    }

    /**
     * Add status name to the collection
     */
    public function addStatusNameToSelect()
    {
        $tableName = $this->getTable('mageprakash_helpdesk_status');

        $this->getSelect()->joinLeft(
            $tableName,
            "main_table.status_id = {$tableName}.status_id",
            ['status_name' => "{$tableName}.name"]
        );

        return $this;
    }

}
