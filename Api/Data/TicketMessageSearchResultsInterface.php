<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface TicketMessageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get ticket_message list.
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface[]
     */
    public function getItems();

    /**
     * Set ticket_id list.
     * @param \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
