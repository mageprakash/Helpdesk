<?php
namespace MagePrakash\Helpdesk\Block\Ticket;

use \Magento\Framework\App\ObjectManager;

/**
 * helpdesk ticket history block
 *
 */
class History extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'MagePrakash_Helpdesk::template.phtml';
    
    public $searchCriteriaBuilder;
    public $ticketMessageRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \MagePrakash\Helpdesk\Model\TicketMessageRepository $ticketMessageRepository,
        array $data = []
    ) {
        $this->ticketMessageRepository = $ticketMessageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    public function getTicketMessages(){

        $ticketId = $this->getRequest()->getParam('ticket_id');
        $ticketMessage = $this->ticketMessageRepository->getMessageList($ticketId);
        return $ticketMessage;
    }
}
