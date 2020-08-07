<?php

namespace MagePrakash\Helpdesk\Block\Ticket;

class View extends AbstractBlock
{
    protected $_template = 'MagePrakash_Helpdesk::ticket/view.phtml';

    /**
     * Get review product post action
     *
     * @return string
     */
    public function getGuestEmailVerificationAction()
    {
        $number = $this->getRequest()->getParam('ticket_id');

        return $this->getUrl('helpdesks/ticket/view', [
            'number' => $number
        ]);
    }
}
