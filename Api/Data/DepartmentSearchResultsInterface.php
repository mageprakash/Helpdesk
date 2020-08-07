<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface DepartmentSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get department list.
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface[]
     */
    public function getItems();

    /**
     * Set active list.
     * @param \MagePrakash\Helpdesk\Api\Data\DepartmentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
