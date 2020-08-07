<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel;

class Priority extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mageprakash_helpdesk_priority', 'priority_id');
    }
}
