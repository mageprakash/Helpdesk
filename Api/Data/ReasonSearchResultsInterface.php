<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MagePrakash\Helpdesk\Api\Data;

interface ReasonSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get reason list.
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \MagePrakash\Helpdesk\Api\Data\ReasonInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

