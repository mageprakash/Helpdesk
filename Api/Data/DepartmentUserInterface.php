<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface DepartmentUserInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const DEPARTMENT_USER_ID = 'department_user_id';
    const DEPARTMENT_ID = 'department_id';
    const USER_ID = 'user_id';

    /**
     * Get department_user_id
     * @return string|null
     */
    public function getDepartmentUserId();

    /**
     * Set department_user_id
     * @param string $departmentUserId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface
     */
    public function setDepartmentUserId($departmentUserId);

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId();

    /**
     * Set department_id
     * @param string $departmentId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface
     */
    public function setDepartmentId($departmentId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\DepartmentUserExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\DepartmentUserExtensionInterface $extensionAttributes
    );

    /**
     * Get user_id
     * @return string|null
     */
    public function getUserId();

    /**
     * Set user_id
     * @param string $userId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface
     */
    public function setUserId($userId);
}
