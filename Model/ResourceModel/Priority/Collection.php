<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel\Priority;

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
            \MagePrakash\Helpdesk\Model\Priority::class,
            \MagePrakash\Helpdesk\Model\ResourceModel\Priority::class
        );
    }
        /**
     * Convert items array to array for select options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('priority_id', 'name');
    }

    /**
     * Convert items array to hash for select options
     *
     * @return array
     */
    public function toOptionHash()
    {
        return $this->_toOptionHash('priority_id', 'name');
    }    
}
