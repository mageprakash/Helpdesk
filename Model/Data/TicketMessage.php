<?php


namespace MagePrakash\Helpdesk\Model\Data;

use MagePrakash\Helpdesk\Api\Data\TicketMessageInterface;

class TicketMessage extends \Magento\Framework\Api\AbstractExtensibleObject implements TicketMessageInterface
{

    /**
     * Get ticket_message_id
     * @return string|null
     */
    public function getTicketMessageId()
    {
        return $this->_get(self::TICKET_MESSAGE_ID);
    }

    /**
     * Set ticket_message_id
     * @param string $ticketMessageId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setTicketMessageId($ticketMessageId)
    {
        return $this->setData(self::TICKET_MESSAGE_ID, $ticketMessageId);
    }

    /**
     * Get ticket_id
     * @return string|null
     */
    public function getTicketId()
    {
        return $this->_get(self::TICKET_ID);
    }

    /**
     * Set ticket_id
     * @param string $ticketId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setTicketId($ticketId)
    {
        return $this->setData(self::TICKET_ID, $ticketId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get email_message_id
     * @return string|null
     */
    public function getEmailMessageId()
    {
        return $this->_get(self::EMAIL_MESSAGE_ID);
    }

    /**
     * Set email_message_id
     * @param string $emailMessageId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setEmailMessageId($emailMessageId)
    {
        return $this->setData(self::EMAIL_MESSAGE_ID, $emailMessageId);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get text
     * @return string|null
     */
    public function getText()
    {
        return $this->_get(self::TEXT);
    }

    /**
     * Set text
     * @param string $text
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setText($text)
    {
        return $this->setData(self::TEXT, $text);
    }

    /**
     * Get file
     * @return string|null
     */
    public function getFile()
    {
        return $this->_get(self::FILE);
    }

    /**
     * Set file
     * @param string $file
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setFile($file)
    {
        return $this->setData(self::FILE, $file);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get priority_id
     * @return string|null
     */
    public function getPriorityId()
    {
        return $this->_get(self::PRIORITY_ID);
    }

    /**
     * Set priority_id
     * @param string $priority_id
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setPriorityId($priorityId)
    {
        return $this->setData(self::PRIORITY_ID, $priorityId);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
    }

    /**
     * Get enabled
     * @return string|null
     */
    public function getEnabled()
    {
        return $this->_get(self::ENABLED);
    }

    /**
     * Set enabled
     * @param string $enabled
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setEnabled($enabled)
    {
        return $this->setData(self::ENABLED, $enabled);
    }
}
