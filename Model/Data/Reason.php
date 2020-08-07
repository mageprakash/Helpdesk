<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MagePrakash\Helpdesk\Model\Data;

use MagePrakash\Helpdesk\Api\Data\ReasonInterface;

class Reason extends \Magento\Framework\Api\AbstractExtensibleObject implements ReasonInterface
{

    /**
     * Get reason_id
     * @return string|null
     */
    public function getReasonId()
    {
        return $this->_get(self::REASON_ID);
    }

    /**
     * Set reason_id
     * @param string $reasonId
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     */
    public function setReasonId($reasonId)
    {
        return $this->setData(self::REASON_ID, $reasonId);
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
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\ReasonExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\ReasonExtensionInterface $extensionAttributes
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
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
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
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }
}

