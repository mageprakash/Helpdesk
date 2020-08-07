<?php

namespace MagePrakash\Helpdesk\Model\ResourceModel\User;

class Collection extends \Magento\User\Model\ResourceModel\User\Collection
{

    /**
     * Convert items array to array for select options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('user_id', 'username');
    }

    /**
     * Convert items array to hash for select options
     *
     * @return array
     */
    public function toOptionHash()
    {
        return $this->_toOptionHash('user_id', 'username');
    }
}
