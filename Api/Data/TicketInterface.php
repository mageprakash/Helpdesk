<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface TicketInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const NOTES = 'notes';
    const DEPARTMENT_ID = 'department_id';
    const AUTHOR_NAME = 'author_name';
    const CREATED_AT = 'created_at';
    const PRIORITY_ID = 'priority_id';
    const MODIFIED_AT = 'modified_at';
    const STATUS = 'status';
    const USER_ID = 'user_id';
    const EMAIL = 'email';
    const TICKET_ID = 'ticket_id';
    const CUSTOMER_ID = 'customer_id';
    const STORE_ID = 'store_id';
    const RATE = 'rate';
    const NUMBER = 'number';
    const TITLE = 'title';
    const ORDER_ID = 'order_id';

    /**
     * Get ticket_id
     * @return string|null
     */
    public function getTicketId();

    /**
     * Set ticket_id
     * @param string $ticketId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setTicketId($ticketId);

    /**
     * Get number
     * @return string|null
     */
    public function getNumber();

    /**
     * Set number
     * @param string $number
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setNumber($number);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\TicketExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\TicketExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\TicketExtensionInterface $extensionAttributes
    );

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setEmail($email);

    /**
     * Get author_name
     * @return string|null
     */
    public function getAuthorName();

    /**
     * Set author_name
     * @param string $authorName
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setAuthorName($authorName);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setStatus($status);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setTitle($title);

    /**
     * Get priority_id
     * @return string|null
     */
    public function getPriorityId();

    /**
     * Set priority_id
     * @param string $priority_id
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setPriorityId($priorityId);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get modified_at
     * @return string|null
     */
    public function getModifiedAt();

    /**
     * Set modified_at
     * @param string $modifiedAt
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setModifiedAt($modifiedAt);

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId();

    /**
     * Set department_id
     * @param string $departmentId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setDepartmentId($departmentId);

    /**
     * Get user_id
     * @return string|null
     */
    public function getUserId();

    /**
     * Set user_id
     * @param string $userId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setUserId($userId);

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $storeId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setStoreId($storeId);

    /**
     * Get notes
     * @return string|null
     */
    public function getNotes();

    /**
     * Set notes
     * @param string $notes
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setNotes($notes);

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $orderId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setOrderId($orderId);

    /**
     * Get rate
     * @return string|null
     */
    public function getRate();

    /**
     * Set rate
     * @param string $rate
     * @return \MagePrakash\Helpdesk\Api\Data\TicketInterface
     */
    public function setRate($rate);
}
