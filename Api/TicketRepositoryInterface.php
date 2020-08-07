<?php


namespace MagePrakash\Helpdesk\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TicketRepositoryInterface
{

    /**
     * Save ticket
     * @param \MagePrakash\Helpdesk\Api\Data\TicketInterface $ticket
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \MagePrakash\Helpdesk\Api\Data\TicketInterface $ticket
    );

    /**
     * Retrieve ticket
     * @param string $ticketId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($ticketId);

    /**
     * Retrieve ticket matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MagePrakash\Helpdesk\Api\Data\TicketSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ticket
     * @param \MagePrakash\Helpdesk\Api\Data\TicketInterface $ticket
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \MagePrakash\Helpdesk\Api\Data\TicketInterface $ticket
    );

    /**
     * Delete ticket by ID
     * @param string $ticketId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($ticketId);
}
