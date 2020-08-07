<?php


namespace MagePrakash\Helpdesk\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface DepartmentRepositoryInterface
{

    /**
     * Save department
     * @param \MagePrakash\Helpdesk\Api\Data\DepartmentInterface $department
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \MagePrakash\Helpdesk\Api\Data\DepartmentInterface $department
    );

    /**
     * Retrieve department
     * @param string $departmentId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($departmentId);

    /**
     * Retrieve department matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete department
     * @param \MagePrakash\Helpdesk\Api\Data\DepartmentInterface $department
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \MagePrakash\Helpdesk\Api\Data\DepartmentInterface $department
    );

    /**
     * Delete department by ID
     * @param string $departmentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($departmentId);
}
