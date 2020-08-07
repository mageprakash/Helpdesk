<?php


namespace MagePrakash\Helpdesk\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TicketMessageRepositoryInterface
{

    /**
     * Save ticket_message
     * @param \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface $ticketMessage
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface $ticketMessage
    );

    /**
     * Retrieve ticket_message
     * @param string $ticketMessageId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($ticketMessageId);

    /**
     * Retrieve ticket_message matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ticket_message
     * @param \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface $ticketMessage
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface $ticketMessage
    );

    /**
     * Delete ticket_message by ID
     * @param string $ticketMessageId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($ticketMessageId);
}
