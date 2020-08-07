<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel\Department;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \MagePrakash\Helpdesk\Model\Department::class,
            \MagePrakash\Helpdesk\Model\ResourceModel\Department::class
        );
    }

        /**
     * Convert items array to array for select options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('department_id', 'name');
    }

    /**
     * Convert items array to hash for select options
     *
     * @return array
     */
    public function toOptionHash()
    {
        return $this->_toOptionHash('department_id', 'name');
    }

    /**
     * Add filter by active
     *
     * @param bool $active
     * @return $this
     */
    public function addFilterByEnabled($active = true)
    {
        $active = (bool) $active;

        $this->addFilter('main_table.active', $active);

        return $this;
    }

    /**
     * Add filter by store id
     *
     * @param int|array $storeId
     * @return $this
     */
    public function addStoreIdFilter($storeId)
    {
        if (!is_array($storeId)) {
            $storeId = [$storeId];
        }

        $this->addFieldToFilter(
            'main_table.store_id',
            ['in' => $storeId]
        );
        // $this->addFilter('main_table.store_id', $storeId);

        return $this;
    }
}
