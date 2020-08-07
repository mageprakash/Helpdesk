<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MagePrakash\Helpdesk\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ReasonRepositoryInterface
{

    /**
     * Save reason
     * @param \MagePrakash\Helpdesk\Api\Data\ReasonInterface $reason
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \MagePrakash\Helpdesk\Api\Data\ReasonInterface $reason
    );

    /**
     * Retrieve reason
     * @param string $reasonId
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($reasonId);

    /**
     * Retrieve reason matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete reason
     * @param \MagePrakash\Helpdesk\Api\Data\ReasonInterface $reason
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \MagePrakash\Helpdesk\Api\Data\ReasonInterface $reason
    );

    /**
     * Delete reason by ID
     * @param string $reasonId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($reasonId);
}

