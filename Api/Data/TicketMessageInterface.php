<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface TicketMessageInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TICKET_MESSAGE_ID = 'ticket_message_id';
    const CREATED_AT = 'created_at';
    const PRIORITY_ID = 'priority_id';
    const TEXT = 'text';
    const STATUS = 'status';
    const USER_ID = 'user_id';
    const TICKET_ID = 'ticket_id';
    const EMAIL_MESSAGE_ID = 'email_message_id';
    const ENABLED = 'enabled';
    const FILE = 'file';
    const DEPARTMENT_ID = 'department_id';

    /**
     * Get ticket_message_id
     * @return string|null
     */
    public function getTicketMessageId();

    /**
     * Set ticket_message_id
     * @param string $ticketMessageId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setTicketMessageId($ticketMessageId);

    /**
     * Get ticket_id
     * @return string|null
     */
    public function getTicketId();

    /**
     * Set ticket_id
     * @param string $ticketId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setTicketId($ticketId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface $extensionAttributes
    );

    /**
     * Get email_message_id
     * @return string|null
     */
    public function getEmailMessageId();

    /**
     * Set email_message_id
     * @param string $emailMessageId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setEmailMessageId($emailMessageId);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get text
     * @return string|null
     */
    public function getText();

    /**
     * Set text
     * @param string $text
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setText($text);

    /**
     * Get file
     * @return string|null
     */
    public function getFile();

    /**
     * Set file
     * @param string $file
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setFile($file);

    /**
     * Get user_id
     * @return string|null
     */
    public function getUserId();

    /**
     * Set user_id
     * @param string $userId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setUserId($userId);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setStatus($status);

    /**
     * Get priority_id
     * @return string|null
     */
    public function getPriorityId();

    /**
     * Set priority_id
     * @param string $priority_id
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setPriorityId($priorityId);

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId();

    /**
     * Set department_id
     * @param string $departmentId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setDepartmentId($departmentId);

    /**
     * Get enabled
     * @return string|null
     */
    public function getEnabled();

    /**
     * Set enabled
     * @param string $enabled
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setEnabled($enabled);
}
