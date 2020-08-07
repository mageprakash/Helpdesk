<?php


namespace MagePrakash\Helpdesk\Model\Data;

use MagePrakash\Helpdesk\Api\Data\DepartmentInterface;

class Department extends \Magento\Framework\Api\AbstractExtensibleObject implements DepartmentInterface
{

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
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
    }

    /**
     * Get active
     * @return string|null
     */
    public function getActive()
    {
        return $this->_get(self::ACTIVE);
    }

    /**
     * Set active
     * @param string $active
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setActive($active)
    {
        return $this->setData(self::ACTIVE, $active);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\DepartmentExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\DepartmentExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId()
    {
        return $this->_get(self::STORE_ID);
    }

    /**
     * Set store_id
     * @param string $storeId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Get default_user_id
     * @return string|null
     */
    public function getDefaultUserId()
    {
        return $this->_get(self::DEFAULT_USER_ID);
    }

    /**
     * Set default_user_id
     * @param string $defaultUserId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setDefaultUserId($defaultUserId)
    {
        return $this->setData(self::DEFAULT_USER_ID, $defaultUserId);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get sender
     * @return string|null
     */
    public function getSender()
    {
        return $this->_get(self::SENDER);
    }

    /**
     * Set sender
     * @param string $sender
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setSender($sender)
    {
        return $this->setData(self::SENDER, $sender);
    }

    /**
     * Get email_template_new
     * @return string|null
     */
    public function getEmailTemplateNew()
    {
        return $this->_get(self::EMAIL_TEMPLATE_NEW);
    }

    /**
     * Set email_template_new
     * @param string $emailTemplateNew
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setEmailTemplateNew($emailTemplateNew)
    {
        return $this->setData(self::EMAIL_TEMPLATE_NEW, $emailTemplateNew);
    }

    /**
     * Get email_template_answer
     * @return string|null
     */
    public function getEmailTemplateAnswer()
    {
        return $this->_get(self::EMAIL_TEMPLATE_ANSWER);
    }

    /**
     * Set email_template_answer
     * @param string $emailTemplateAnswer
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setEmailTemplateAnswer($emailTemplateAnswer)
    {
        return $this->setData(self::EMAIL_TEMPLATE_ANSWER, $emailTemplateAnswer);
    }

    /**
     * Get email_template_admin
     * @return string|null
     */
    public function getEmailTemplateAdmin()
    {
        return $this->_get(self::EMAIL_TEMPLATE_ADMIN);
    }

    /**
     * Set email_template_admin
     * @param string $emailTemplateAdmin
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setEmailTemplateAdmin($emailTemplateAdmin)
    {
        return $this->setData(self::EMAIL_TEMPLATE_ADMIN, $emailTemplateAdmin);
    }
}
