<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel;

class TicketMessage extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mageprakash_helpdesk_ticket_message', 'ticket_message_id');
    }
}
