<?php


namespace MagePrakash\Helpdesk\Model\Data;

use MagePrakash\Helpdesk\Api\Data\TicketInterface;

class Ticket extends \Magento\Framework\Api\AbstractExtensibleObject implements TicketInterface
{

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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setTicketId($ticketId)
    {
        return $this->setData(self::TICKET_ID, $ticketId);
    }

    /**
     * Get number
     * @return string|null
     */
    public function getNumber()
    {
        return $this->_get(self::NUMBER);
    }

    /**
     * Set number
     * @param string $number
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setNumber($number)
    {
        return $this->setData(self::NUMBER, $number);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\TicketExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\TicketExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\TicketExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_get(self::CUSTOMER_ID);
    }

    /**
     * Set customer_id
     * @param string $customerId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get author_name
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->_get(self::AUTHOR_NAME);
    }

    /**
     * Set author_name
     * @param string $authorName
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setAuthorName($authorName)
    {
        return $this->setData(self::AUTHOR_NAME, $authorName);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get title
     * @return string|null
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setPriorityId($priorityId)
    {
        return $this->setData(self::PRIORITY_ID, $priorityId);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get modified_at
     * @return string|null
     */
    public function getModifiedAt()
    {
        return $this->_get(self::MODIFIED_AT);
    }

    /**
     * Set modified_at
     * @param string $modifiedAt
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setModifiedAt($modifiedAt)
    {
        return $this->setData(self::MODIFIED_AT, $modifiedAt);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
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
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Get notes
     * @return string|null
     */
    public function getNotes()
    {
        return $this->_get(self::NOTES);
    }

    /**
     * Set notes
     * @param string $notes
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setNotes($notes)
    {
        return $this->setData(self::NOTES, $notes);
    }

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->_get(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $orderId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get rate
     * @return string|null
     */
    public function getRate()
    {
        return $this->_get(self::RATE);
    }

    /**
     * Set rate
     * @param string $rate
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setRate($rate)
    {
        return $this->setData(self::RATE, $rate);
    }
}
