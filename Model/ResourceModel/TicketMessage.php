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

 /*   public function insertTicketMessageData($ticketMessage)
    {

    	$ticketMessageData = [
		    	'ticket_id' 		=> $ticketMessage->getTicketId(),
		    	'email_message_id'	=> 1,
		    	'created_at'		=> date('Y-m-d H:i:s'),
		    	'text' 				=> $ticketMessage->getText(),
		    	'file' 				=> $ticketMessage->getFile(),
		    	'user_id' 			=> $ticketMessage->getUserId(),
		    	'status' 			=> 1,
		    	'priority_id' 	    => $ticketMessage->getPriorityId(),
		    	'department_id' 	=> $ticketMessage->getDepartmentId(),
		    	'enabled'			=> 1
    	];
        
    	$this->getConnection()->insert($this->getMainTable(), $ticketMessageData);
    }*/
}
