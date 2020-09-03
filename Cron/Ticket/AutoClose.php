<?php
namespace MagePrakash\Helpdesk\Cron\Ticket;

class AutoClose
{
    /**
     * @var \MagePrakash\Helpdesk\Model\TicketFactory
     */
    protected $ticketFactory;

    /**
     * Get extension configuration helper
     * @var \MagePrakash\Helpdesk\Helper\Config
     */
    protected $configHelper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory
     * @param \MagePrakash\Helpdesk\Helper\Config $configHelper
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \MagePrakash\Helpdesk\Model\TicketFactory $ticketFactory,
        \MagePrakash\Helpdesk\Helper\Config $configHelper,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->ticketFactory = $ticketFactory;
        $this->configHelper = $configHelper;
        $this->logger = $logger;
    }

    /**
     *
     * @return boolean
     */
    public function execute()
    {
        if (!$this->configHelper->isAutoCloseTicket()) {
            return false;
        }

        $xDays = $this->configHelper->getAutoCloseAfterXDay();
        $time = \Zend_Date::now()->subDay($xDays);
        $time = $time->toString('YYYY-MM-dd HH:mm:ss', 'iso');
        $statusIds = array_unique(
                        array_merge(
                            explode(",", $this->configHelper->getAutoCloseStatusSkip()),
                            [$this->configHelper->getCloseStatusTicket()]
                        )
                    );

        try {
            $ticketCollection = $this->ticketFactory->create()->getCollection()
                ->addFieldToFilter('status_id',array('nin' => $statusIds))
                ->addLessModifiedAtFilter($time);
            foreach ($ticketCollection as $ticket) {
                $ticket->setStatusId($this->configHelper->getCloseStatusTicket())
                    ->setText(" Auto close ticket after {$xDays} days")
                    ->setAuthorName("Cron Job")
                    ->setReplyBy(\MagePrakash\Helpdesk\Helper\Config::TICKET_MESSAGE_ADMIN)
                    ->save();
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }

        return true;
    }
}
