<?php

namespace MagePrakash\Helpdesk\Model\Config\Source;

use \Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Profile
 * @package Vendor\Package\Model\Config\Source
 */
class TicketStatus implements OptionSourceInterface
{

    public function __construct(
        \MagePrakash\Helpdesk\Model\ResourceModel\Status\Collection $status
    ) {
        $this->status = $status;
    }

    
    /**
     * @return array
     */
    public function toOptionArray() : array
    {
        return $this->status->toOptionArray();
    }
}