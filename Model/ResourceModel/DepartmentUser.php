<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel;

class DepartmentUser extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mageprakash_helpdesk_department_user', 'department_user_id');
    }
}
