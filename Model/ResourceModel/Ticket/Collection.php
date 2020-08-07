<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel\Ticket;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

   /**
     * @var \Zend_Db_Expr
     */
    protected $customerNameExpr;
    
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \MagePrakash\Helpdesk\Model\Ticket::class,
            \MagePrakash\Helpdesk\Model\ResourceModel\Ticket::class
        );
    }

       /**
     * {@inheritdoc}
     */
    protected function _initSelect()
    {
        $this->customerNameExpr = $this->getConnection()->getConcatSql(
            [
                'customer_entity.firstname',
                'customer_entity.lastname',
            ],
            ' '
        );
        $this->addFilterToMap('customer_name', $this->customerNameExpr);

        return parent::_initSelect();
    }

    /**
     * Add customer name expression to the collection
     */
    public function addCustomerNameToSelect()
    {
        $this->getSelect()->joinLeft(
            ['customer_entity' => $this->getTable('customer_entity')],
            'customer_id = customer_entity.entity_id',
            ['customer_name' => $this->customerNameExpr]
        );

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

    /**
     * Add filter by number
     *
     * @param string $number
     * @return $this
     */
    public function addFilterByNumber($ticketId)
    {
        $this->addFilter('main_table.ticket_id', $ticketId);

        return $this;
    }

    /**
     * Add filter by customer id
     *
     * @param int $customerId
     * @return $this
     */
    public function addCustomerIdFilter($customerId)
    {
        $this->addFilter('main_table.customer_id', $customerId);

        return $this;
    }

    /**
     * Add filter by status
     *
     * @param int $status
     * @return $this
     */
    public function addFilterByStatus($status)
    {
        $this->addFilter('main_table.status_id', $status);

        return $this;
    }

    /**
     *
     * @param string $time
     */
    public function addLessModifiedAtFilter($time)
    {
        $this->getSelect()->where('main_table.modified_at < ?', $time);

        return $this;
    }

    /**
     * Add filter by store id
     *
     * @param int $storeId
     * @return $this
     */
    public function addStoreIdFilter($storeId)
    {
        $this->addFilter('main_table.store_id', $storeId);

        return $this;
    }
}
