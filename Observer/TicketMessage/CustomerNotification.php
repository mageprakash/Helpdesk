<?php
namespace MagePrakash\Helpdesk\Observer\TicketMessage;

class CustomerNotification extends \MagePrakash\Helpdesk\Observer\AbstractNotification
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $ticketMessage = $observer->getEvent()->getDataObject();
        $ticket = $ticketMessage->getTicket();
        
        $isNotificationEnabled = $this->configHelper->isCustomerNotificationEnabled(
            $ticket->getStoreId()
        );
        
        $department = $ticket->getDepartment();
        $from = $department->getSender();
        
        if ($ticketMessage->isObjectNew() && $isNotificationEnabled) {
            $templateId = $department->getData('email_template_answer');
            $customerName = $ticket->getAuthorName();
            $customerEmail = $ticket->getEmail();

            $customer = $ticket->getCustomer();
            if ($customer) {
                $customerName = $customer->getFirstName() . ' ' . $customer->getLastName();
                $customerEmail = $customer->getEmail();
            }

            $to = [
                'email' => "prakash.patel@krishtechnolabs.com",
                'name'  => $customerName
            ];

            if($templateId){
                $store = $this->storeManager->getStore($ticket->getStoreId());
                $vars = [
                    'ticket' => $ticket,
                    'customer_name' => $customerName,
                    'ticket_title'  => $ticket->getTitle(),
                    'ticket_number' => $ticket->getNumber(),
                    'ticket_id' => $ticket->getTicketId()
                ];
                $this->sendEmail($from, $to, $templateId, $vars, $store);
            }
        }
        return $this;
    }
}
