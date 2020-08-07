<?php

namespace MagePrakash\Helpdesk\Block\Ticket\View\Message;

use MagePrakash\Helpdesk\Block\Ticket\AbstractBlock;

class Form extends AbstractBlock
{
    protected $formId = 'mageprakash_helpdesk_new_message_form';

    protected $_template = 'MagePrakash_Helpdesk::ticket/view/message/form.phtml';

    /**
     * Get review product post action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getUrl('helpdesks/ticketMessage/save');
    }
}
