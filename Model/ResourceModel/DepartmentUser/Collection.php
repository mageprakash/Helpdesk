<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser;

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
            \MagePrakash\Helpdesk\Model\DepartmentUser::class,
            \MagePrakash\Helpdesk\Model\ResourceModel\DepartmentUser::class
        );
    }
}
