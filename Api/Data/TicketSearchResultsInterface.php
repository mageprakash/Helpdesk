<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface TicketSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get ticket list.
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface[]
     */
    public function getItems();

    /**
     * Set number list.
     * @param \MagePrakash\Helpdesk\Api\Data\TicketInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
