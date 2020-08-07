<?php


namespace MagePrakash\Helpdesk\Model\Data;

use MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface;

class DepartmentUser extends \Magento\Framework\Api\AbstractExtensibleObject implements DepartmentUserInterface
{

    /**
     * Get department_user_id
     * @return string|null
     */
    public function getDepartmentUserId()
    {
        return $this->_get(self::DEPARTMENT_USER_ID);
    }

    /**
     * Set department_user_id
     * @param string $departmentUserId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface
     */
    public function setDepartmentUserId($departmentUserId)
    {
        return $this->setData(self::DEPARTMENT_USER_ID, $departmentUserId);
    }

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId()
    {
        return $this->_get(self::DEPARTMENT_ID);
    }

    /**
     * Set department_id
     * @param string $departmentId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\DepartmentUserExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\DepartmentUserExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get user_id
     * @return string|null
     */
    public function getUserId()
    {
        return $this->_get(self::USER_ID);
    }

    /**
     * Set user_id
     * @param string $userId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentUserInterface
     */
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
    }
}
