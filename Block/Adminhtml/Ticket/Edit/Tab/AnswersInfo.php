<?php

namespace MagePrakash\Helpdesk\Block\Adminhtml\Ticket\Edit\Tab;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Customer\Model\Address\Mapper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Customer\Model\Customer;

class AnswersInfo extends \Magento\Backend\Block\Template
{
    public $searchCriteriaBuilder;
    public $ticketMessageRepository;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
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

        $searchCriteriaBuilder = $this->searchCriteriaBuilder;
        $searchCriteria = $searchCriteriaBuilder->addFilter(
                            'ticket_id',
                            $ticketId,
                            'eq'
                            )->create();

        $items = $this->ticketMessageRepository->getList($searchCriteria);
        return $items;
    }
}
