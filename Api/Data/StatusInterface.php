<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface StatusInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const NAME = 'name';
    const SORT_ORDER = 'sort_order';
    const STATUS = 'status';
    const STATUS_ID = 'status_id';

    /**
     * Get status_id
     * @return string|null
     */
    public function getStatusId();

    /**
     * Set status_id
     * @param string $statusId
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setStatusId($statusId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\StatusExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\StatusExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\StatusExtensionInterface $extensionAttributes
    );

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setStatus($status);

    /**
     * Get sort_order
     * @return string|null
     */
    public function getSortOrder();

    /**
     * Set sort_order
     * @param string $sortOrder
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setSortOrder($sortOrder);
}
