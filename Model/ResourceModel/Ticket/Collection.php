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
        return parent::_initSelect();
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
