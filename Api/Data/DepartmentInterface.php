<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface DepartmentInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ACTIVE = 'active';
    const EMAIL_TEMPLATE_ANSWER = 'email_template_answer';
    const CREATED_AT = 'created_at';
    const EMAIL_TEMPLATE_NEW = 'email_template_new';
    const STORE_ID = 'store_id';
    const SENDER = 'sender';
    const DEFAULT_USER_ID = 'default_user_id';
    const NAME = 'name';
    const DEPARTMENT_ID = 'department_id';
    const EMAIL_TEMPLATE_ADMIN = 'email_template_admin';

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId();

    /**
     * Set department_id
     * @param string $departmentId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setDepartmentId($departmentId);

    /**
     * Get active
     * @return string|null
     */
    public function getActive();

    /**
     * Set active
     * @param string $active
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setActive($active);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\DepartmentExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\DepartmentExtensionInterface $extensionAttributes
    );

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setName($name);

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $storeId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setStoreId($storeId);

    /**
     * Get default_user_id
     * @return string|null
     */
    public function getDefaultUserId();

    /**
     * Set default_user_id
     * @param string $defaultUserId
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setDefaultUserId($defaultUserId);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get sender
     * @return string|null
     */
    public function getSender();

    /**
     * Set sender
     * @param string $sender
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setSender($sender);

    /**
     * Get email_template_new
     * @return string|null
     */
    public function getEmailTemplateNew();

    /**
     * Set email_template_new
     * @param string $emailTemplateNew
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setEmailTemplateNew($emailTemplateNew);

    /**
     * Get email_template_answer
     * @return string|null
     */
    public function getEmailTemplateAnswer();

    /**
     * Set email_template_answer
     * @param string $emailTemplateAnswer
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setEmailTemplateAnswer($emailTemplateAnswer);

    /**
     * Get email_template_admin
     * @return string|null
     */
    public function getEmailTemplateAdmin();

    /**
     * Set email_template_admin
     * @param string $emailTemplateAdmin
     * @return \MagePrakash\Helpdesk\Api\Data\DepartmentInterface
     */
    public function setEmailTemplateAdmin($emailTemplateAdmin);
}
