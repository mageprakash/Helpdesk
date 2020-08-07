<?php


namespace MagePrakash\Helpdesk\Model\Data;

use MagePrakash\Helpdesk\Api\Data\StatusInterface;

class Status extends \Magento\Framework\Api\AbstractExtensibleObject implements StatusInterface
{

    /**
     * Get status_id
     * @return string|null
     */
    public function getStatusId()
    {
        return $this->_get(self::STATUS_ID);
    }

    /**
     * Set status_id
     * @param string $statusId
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setStatusId($statusId)
    {
        return $this->setData(self::STATUS_ID, $statusId);
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
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\StatusExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\StatusExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\StatusExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
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
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get sort_order
     * @return string|null
     */
    public function getSortOrder()
    {
        return $this->_get(self::SORT_ORDER);
    }

    /**
     * Set sort_order
     * @param string $sortOrder
     * @return \MagePrakash\Helpdesk\Api\Data\StatusInterface
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }
}
