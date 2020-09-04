<?php
namespace MagePrakash\Helpdesk\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $connection = $setup->getConnection();
        $setup->startSetup();
        
        $this->departmentData($setup,$connection);
        $this->priorityData($setup,$connection);
        $this->statusData($setup,$connection);

        $setup->endSetup();
    }

    public function departmentData($setup,$connection){

        $disabledStatus = 1;
        $adminUserId = 1;
        $departmentId = 1;

        $connection->insert($setup->getTable('mageprakash_helpdesk_department'), [
            'active'                => $disabledStatus,
            'name'                  => 'Sales Department',
            'store_id'              => 0,
            'sender'                => 'general',
            'email_template_new'    => 'mageprakash_helpdesk_ticket_create_notify_customer_email_template',
            'email_template_answer' => 'mageprakash_helpdesk_ticket_changed_notify_customer_email_template',
            'email_template_admin'  => 'mageprakash_helpdesk_ticket_changed_notify_admin_email_template',
            'created_at'            => date("Y/m/d")
        ]);

        $connection->insert($setup->getTable('mageprakash_helpdesk_department'), [
            'active'                => $disabledStatus,
            'name'                  => 'Support Department',
            'store_id'              => 0,
            'sender'                => 'general',
            'email_template_new'    => 'mageprakash_helpdesk_ticket_create_notify_customer_email_template',
            'email_template_answer' => 'mageprakash_helpdesk_ticket_changed_notify_customer_email_template',
            'email_template_admin'  => 'mageprakash_helpdesk_ticket_changed_notify_admin_email_template',
            'created_at'            => date("Y/m/d")
        ]);

        $connection->insert($setup->getTable('mageprakash_helpdesk_department_user'), [
            'department_id' => $departmentId,
            'user_id'       => $adminUserId,
        ]);
    }

    public function statusData($setup,$connection){
        $statuses = [
            'Open',
            'Replied',
            'Onhold',
            'Closed'
        ];

        $sortOrder = 1;
        /**
         * Insert default statuses
         */
        foreach ($statuses as $id => $label) {
            $statusData = [
                'name'       => $label,
                'status'     => true,
                'sort_order' => $sortOrder
            ];
            $connection->insert(
                $setup->getTable('mageprakash_helpdesk_status'),
                $statusData
            );
            $sortOrder += 10;
        }
    }

    public function priorityData($setup,$connection){
            $priority = [
                'Low',
                'Medium',
                'High',
                'Emergency',
                'Critical'
            ];

            $prioritySortOrder = 1;

            foreach ($priority as $label) {
                $statusData = [
                    'name'       => $label,
                    'status'     => true,
                    'sort_order' => $prioritySortOrder
                ];
                $connection->insert(
                    $setup->getTable('mageprakash_helpdesk_priority'),
                    $statusData
                );
                $prioritySortOrder += 10;
            }
    }
}
