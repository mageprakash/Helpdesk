<?php


namespace MagePrakash\Helpdesk\Api\Data;

interface PriorityInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const STATUS = 'status';
    const SORT_ORDER = 'sort_order';
    const PRIORITY_ID = 'priority_id';
    const NAME = 'name';

    /**
     * Get priority_id
     * @return string|null
     */
    public function getPriorityId();

    /**
     * Set priority_id
     * @param string $priorityId
     * @return \MagePrakash\Helpdesk\Api\Data\PriorityInterface
     */
    public function setPriorityId($priorityId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \MagePrakash\Helpdesk\Api\Data\PriorityInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\PriorityExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\PriorityExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\PriorityExtensionInterface $extensionAttributes
    );

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \MagePrakash\Helpdesk\Api\Data\PriorityInterface
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
     * @return \MagePrakash\Helpdesk\Api\Data\PriorityInterface
     */
    public function setSortOrder($sortOrder);
}
