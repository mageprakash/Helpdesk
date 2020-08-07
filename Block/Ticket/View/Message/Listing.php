<?php

namespace MagePrakash\Helpdesk\Block\Ticket\View\Message;

use Magento\Framework\Data\Collection;

class Listing extends \MagePrakash\Helpdesk\Block\Ticket\AbstractBlock
{
    protected $_template = 'MagePrakash_Helpdesk::ticket/view/message/listing.phtml';

    public function getMessages()
    {
        if (!$this->getCurrentTicket()) {
            return;
        }

        $sortOrder = $this->getData('sort_order');
        if (!in_array($sortOrder, [Collection::SORT_ORDER_ASC, Collection::SORT_ORDER_DESC])) {
            $sortOrder = Collection::SORT_ORDER_ASC;
        }
        
        $collection = $this->getCurrentTicket()->getTicketMessageCollecion()
            ->addDepartmentNameToSelect()
            ->addStatusNameToSelect()
            ->addPriorityToSelect()
            ->addFilterByEnabled()
            ->addAttachmentToSelect()
            ->setOrder('main_table.ticket_message_id', $sortOrder);

        $collection->getSelect()->group('ticket_message_id');

        return $collection;
    }
}
