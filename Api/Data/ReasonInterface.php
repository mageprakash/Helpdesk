<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MagePrakash\Helpdesk\Api\Data;

interface ReasonInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const NAME = 'name';
    const REASON_ID = 'reason_id';
    const STATUS = 'status';
    const SORT_ORDER = 'sort_order';

    /**
     * Get reason_id
     * @return string|null
     */
    public function getReasonId();

    /**
     * Set reason_id
     * @param string $reasonId
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     */
    public function setReasonId($reasonId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\ReasonExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\ReasonExtensionInterface $extensionAttributes
    );

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
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
     * @return \MagePrakash\Helpdesk\Api\Data\ReasonInterface
     */
    public function setSortOrder($sortOrder);
}

