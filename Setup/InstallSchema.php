<?php


namespace MagePrakash\Helpdesk\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $this->departmentTable($setup);
        $this->statusTable($setup);
        $this->priority($setup);
        $this->departmentUserTable($setup);
        $this->ticketTable($setup);       
        $this->ticketMessageTable($setup);
        $this->fileTable($setup);

        $setup->endSetup();
    }

    public function fileTable($setup){
        $installer  = $setup;
                
        $table_mageprakash_helpdesk_file = $setup->getConnection()->newTable($setup->getTable('mageprakash_helpdesk_file'));

        $table_mageprakash_helpdesk_file->addColumn(
            'file_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_mageprakash_helpdesk_file->addColumn(
            'ticket_message_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'unsigned'  => true,
                'nullable'  => false
            ],
            'ticket_message_id'
        );

        $table_mageprakash_helpdesk_file->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [
                'nullable'  => false                
            ],
            'name'
        );
         $table_mageprakash_helpdesk_file->addColumn(
            'path',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [
                 'nullable'  => false
            ],
            'path'
        );
        $table_mageprakash_helpdesk_file->addColumn(
            'size',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [
                'nullable'  => false
            ],
            'size'
        );
        $table_mageprakash_helpdesk_file->addColumn(
            'type',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [
                 'nullable'  => false
            ],
            'type'
        );

        $table_mageprakash_helpdesk_file->addIndex(
            $installer->getIdxName('mageprakash_helpdesk_file', ['ticket_message_id']),
            ['ticket_message_id']
        );

        $table_mageprakash_helpdesk_file->addForeignKey(
            $installer->getFkName('mageprakash_helpdesk_file', 'ticket_message_id', 'mageprakash_helpdesk_ticket_message', 'ticket_message_id'),
            'ticket_message_id',
            $installer->getTable('mageprakash_helpdesk_ticket_message'),
            'ticket_message_id',
            Table::ACTION_NO_ACTION
        );

        $setup->getConnection()->createTable($table_mageprakash_helpdesk_file);
    }

    public function departmentTable($setup){
        $installer  = $setup;

        $helpdeskDepartmentTableName  = $installer->getTable('mageprakash_helpdesk_department');
        $connection = $installer->getConnection();

        /*if ($connection->isTableExists($helpdeskDepartmentTableName)) {
            throw new \Zend_Db_Exception(sprintf('Table "%s" already exists', $helpdeskDepartmentTableName));
        }*/

        $table_mageprakash_helpdesk_department = $setup->getConnection()->newTable($helpdeskDepartmentTableName);

        $table_mageprakash_helpdesk_department->addColumn(
            'department_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_mageprakash_helpdesk_department->addColumn(
            'active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false,'default'  => 1],
            'active'
        );

        $table_mageprakash_helpdesk_department->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 
                'nullable'  => false
            ],
            'name'
        );

        $table_mageprakash_helpdesk_department->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [
                'unsigned'  => true,
                'nullable'  => false,
            ],
            'store_id'
        );

      
        $table_mageprakash_helpdesk_department->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [
                'default'   => "CURRENT_TIMESTAMP",
                'nullable'  => false,
            ],
            'created_at'
        );

        $table_mageprakash_helpdesk_department->addColumn(
            'sender',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [
                'nullable'  => false
            ],
            'sender'
        );

        $table_mageprakash_helpdesk_department->addColumn(
            'email_template_new',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            150,
            [
                'nullable'  => false
            ],
            'email_template_new'
        );

        $table_mageprakash_helpdesk_department->addColumn(
            'email_template_answer',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            150,
            [
                'nullable'  => false
            ],
            'email_template_answer'
        );

        $table_mageprakash_helpdesk_department->addColumn(
            'email_template_admin',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            150,
            [
                'nullable'  => false
            ],
            'email_template_admin'
        );

        $table_mageprakash_helpdesk_department->addIndex(
                $installer->getIdxName('mageprakash_helpdesk_department', ['store_id']),
                ['store_id']
        );
        
        $table_mageprakash_helpdesk_department->addForeignKey(
                $installer->getFkName('mageprakash_helpdesk_department', 'store_id', 'store', 'store_id'),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                Table::ACTION_CASCADE
        );

        $setup->getConnection()->createTable($table_mageprakash_helpdesk_department);        
    }

    public function departmentUserTable($setup){
        $installer  = $setup;

        $departmentUserTableName  = $installer->getTable('mageprakash_helpdesk_department_user');
        $connection = $installer->getConnection();

        /*if ($connection->isTableExists($departmentUserTableName)) {
            throw new \Zend_Db_Exception(sprintf('Table "%s" already exists', $departmentUserTableName));
        }*/
        $table_mageprakash_helpdesk_department_user = $setup->getConnection()->newTable($departmentUserTableName);

        $table_mageprakash_helpdesk_department_user->addColumn(
            'department_user_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_mageprakash_helpdesk_department_user->addColumn(
            'department_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'nullable'  => false,                
                'unsigned'  => true,
            ],
            'department_id'
        );

        $table_mageprakash_helpdesk_department_user->addColumn(
            'user_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'nullable'  => false,                
                'unsigned'  => true,
            ],
            'user_id'
        );
        
        $table_mageprakash_helpdesk_department_user->addIndex(
                $installer->getIdxName('mageprakash_helpdesk_department_user', ['user_id']),
                ['user_id']
        );

        $table_mageprakash_helpdesk_department_user->addIndex(
                $installer->getIdxName('mageprakash_helpdesk_department_user', ['department_id']),
                ['department_id']
        );

        $table_mageprakash_helpdesk_department_user->addForeignKey(
                $installer->getFkName('mageprakash_helpdesk_department_user', 'department_id', 'mageprakash_helpdesk_department', 'department_id'),
                'department_id',
                $installer->getTable('mageprakash_helpdesk_department'),
                'department_id',
                Table::ACTION_CASCADE
        );

        $table_mageprakash_helpdesk_department_user->addForeignKey(
                $installer->getFkName('mageprakash_helpdesk_department_user', 'user_id', 'admin_user', 'user_id'),
                'user_id',
                $installer->getTable('admin_user'),
                'user_id',
                Table::ACTION_CASCADE
        );

        $setup->getConnection()->createTable($table_mageprakash_helpdesk_department_user);        
    }

    public function statusTable($setup){
        $installer  = $setup;

        $statusTableName  = $installer->getTable('mageprakash_helpdesk_status');
        $connection = $installer->getConnection();

        /*if ($connection->isTableExists($statusTableName)) {
            throw new \Zend_Db_Exception(sprintf('Table "%s" already exists', $statusTableName));
        }*/

        $table_mageprakash_helpdesk_status = $setup->getConnection()->newTable($statusTableName);

        $table_mageprakash_helpdesk_status->addColumn(
            'status_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_mageprakash_helpdesk_status->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [
                'nullable'  => false,
                'default'  => null,
            ],
            'name'
        );

        $table_mageprakash_helpdesk_status->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [
                'default'  => 0,
                'nullable' => false
            ],
            'status'
        );

        $table_mageprakash_helpdesk_status->addColumn(
            'sort_order',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [
                'unsigned'  => true,
                'nullable'  => false,
                'default'  => 0
            ],
            'sort_order'
        );

        $setup->getConnection()->createTable($table_mageprakash_helpdesk_status);        
    }

    public function ticketMessageTable($setup){

        $installer  = $setup;

        $ticketMessageTableName  = $installer->getTable('mageprakash_helpdesk_ticket_message');
        $connection = $installer->getConnection();

        /*if ($connection->isTableExists($ticketMessageTableName)) {
            throw new \Zend_Db_Exception(sprintf('Table "%s" already exists', $ticketMessageTableName));
        }*/

        $table_mageprakash_helpdesk_ticket_message = $setup->getConnection()->newTable($ticketMessageTableName);

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'ticket_message_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'ticket_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'unsigned'  => true,
                'nullable'  => false
            ],
            'ticket_id'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'email_message_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [
                'nullable'  => false
            ],
            'email_message_id'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [   'nullable'  => false,
                'default'   => "CURRENT_TIMESTAMP"
            ],
            'created_at'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'text',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [
                'nullable'  => false
            ],
            'text'
        );


        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'user_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'unsigned'  => true,
                'nullable'  => true,
                'default'  => null
            ],
            'user_id'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'status_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'nullable'  => false,
                'default'  => 1
            ],
            'status_id'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'priority_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'nullable'  => false,
                'default'  => 1
            ],
            'priority_id'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'reply_by',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [
                'nullable'  => false,
                'default'  => 1
            ],
            'reply_by'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable'  => false],
            'number'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'department_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'unsigned'  => true,
                'nullable'  => false
            ],
            'department_id'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'author_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable'  => false],
            'author_email'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'author_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [ 
                'unsigned'  => true,
                'nullable'  => false
            ],
            'author_email'
        );

        $table_mageprakash_helpdesk_ticket_message->addColumn(
            'enabled',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [
                'nullable'  => false,
                'default'  => 1
            ],
            'enabled'
        );

        $table_mageprakash_helpdesk_ticket_message->addIndex(
                $installer->getIdxName('mageprakash_helpdesk_ticket_message', ['user_id']),
                ['user_id']
        );

        $table_mageprakash_helpdesk_ticket_message->addIndex(
                $installer->getIdxName('mageprakash_helpdesk_ticket_message', ['department_id']),
                ['department_id']
        );

        $table_mageprakash_helpdesk_ticket_message->addIndex(
                $installer->getIdxName('mageprakash_helpdesk_ticket_message', ['ticket_id']),
                ['ticket_id']
        );

    
        
        $table_mageprakash_helpdesk_ticket_message->addForeignKey(
                $installer->getFkName('mageprakash_helpdesk_ticket_message', 'department_id', 'mageprakash_helpdesk_department', 'department_id'),
                'department_id',
                $installer->getTable('mageprakash_helpdesk_department'),
                'department_id',
                Table::ACTION_NO_ACTION
        );

        $table_mageprakash_helpdesk_ticket_message->addForeignKey(
                $installer->getFkName('mageprakash_helpdesk_ticket_message', 'ticket_id', 'mageprakash_helpdesk_ticket', 'ticket_id'),
                'ticket_id',
                $installer->getTable('mageprakash_helpdesk_ticket'),
                'ticket_id',
                Table::ACTION_CASCADE
        );

        $table_mageprakash_helpdesk_ticket_message->addForeignKey(
                $installer->getFkName('mageprakash_helpdesk_ticket_message', 'user_id', 'admin_user', 'user_id'),
                'user_id',
                $installer->getTable('admin_user'),
                'user_id',
                Table::ACTION_CASCADE
        );


        $setup->getConnection()->createTable($table_mageprakash_helpdesk_ticket_message);
    }

    public function ticketTable($setup){
        $installer  = $setup;

        $ticketTableName  = $installer->getTable('mageprakash_helpdesk_ticket');
        $connection       = $installer->getConnection();

        /*if ($connection->isTableExists($ticketTableName)) {
            throw new \Zend_Db_Exception(sprintf('Table "%s" already exists', $ticketTableName));
        }*/


        $table_mageprakash_helpdesk_ticket = $setup->getConnection()->newTable($ticketTableName);

        $table_mageprakash_helpdesk_ticket->addColumn(
            'ticket_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable'  => false],
            'number'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [ 
                'unsigned'  => true,
                'nullable'  => true,
                'default'  => null
            ],
            'customer_id'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable'  => false],
            'email'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'author_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [  'nullable'  => false,
                'default' => ''
            ],
            'author_name'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'status_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'unsigned'  => true,
                'nullable'  => false,
                'default'  => 1
            ],
            'status_id'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [
                'nullable'  => false,
                'default'  => null
            ],
            'title'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'priority_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'unsigned'  => true,
                'nullable'  => false,
                'default'  => 1                
            ],
            'priority_id'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable'  => false,
                'default'   => "CURRENT_TIMESTAMP"
            ],
            'created_at'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'modified_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable'  => false,
                'default'   => "CURRENT_TIMESTAMP"
            ],
            'modified_at'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'department_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [
                'unsigned'  => true,
                'nullable'  => false
            ],
            'department_id'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'user_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            10,
            [   'unsigned'  => true,
                'nullable'  => true,
                'default'  => null
            ],
            'user_id'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 
                'unsigned'  => true,
                'nullable'  => false
            ],
            'store_id'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'notes',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'notes'
        );

        $table_mageprakash_helpdesk_ticket->addColumn(
            'order_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'unsigned'  => true,
                'nullable'  => true,
                'default'  => null
            ],
            'order_id'
        );

        $table_mageprakash_helpdesk_ticket->addIndex(
            $installer->getIdxName('mageprakash_helpdesk_ticket', ['department_id']),
            ['department_id']
        );
        $table_mageprakash_helpdesk_ticket->addIndex(
            $installer->getIdxName('mageprakash_helpdesk_ticket', ['customer_id']),
            ['customer_id']
        );

        $table_mageprakash_helpdesk_ticket->addIndex(
            $installer->getIdxName('mageprakash_helpdesk_ticket', ['store_id']),
            ['store_id']
        );

        $table_mageprakash_helpdesk_ticket->addIndex(
            $installer->getIdxName('mageprakash_helpdesk_ticket', ['user_id']),
            ['user_id']
        );

        $table_mageprakash_helpdesk_ticket->addIndex(
            $installer->getIdxName('mageprakash_helpdesk_ticket', ['status_id']),
            ['status_id']
        );
        
        $table_mageprakash_helpdesk_ticket->addIndex(
            $installer->getIdxName('mageprakash_helpdesk_ticket', ['priority_id']),
            ['priority_id']
        );

        $table_mageprakash_helpdesk_ticket->addForeignKey(
            $installer->getFkName('mageprakash_helpdesk_ticket', 'customer_id', 'customer_entity', 'entity_id'),
            'customer_id',
            $installer->getTable('customer_entity'),
            'entity_id',
            Table::ACTION_SET_NULL
        );

        $table_mageprakash_helpdesk_ticket->addForeignKey(
            $installer->getFkName('mageprakash_helpdesk_ticket', 'department_id', 'mageprakash_helpdesk_department', 'department_id'),
            'department_id',
            $installer->getTable('mageprakash_helpdesk_department'),
            'department_id',
            Table::ACTION_NO_ACTION
        );

       

        $table_mageprakash_helpdesk_ticket->addForeignKey(
            $installer->getFkName('mageprakash_helpdesk_ticket', 'store_id', 'store', 'store_id'),
            'store_id',
            $installer->getTable('store'),
            'store_id',
            Table::ACTION_CASCADE
        );

        $table_mageprakash_helpdesk_ticket->addForeignKey(
            $installer->getFkName('mageprakash_helpdesk_ticket', 'user_id', 'admin_user', 'user_id'),
            'user_id',
            $installer->getTable('admin_user'),
            'user_id',
            Table::ACTION_SET_NULL
        );


        $table_mageprakash_helpdesk_ticket->addForeignKey(
            $installer->getFkName('mageprakash_helpdesk_ticket', 'status_id', 'mageprakash_helpdesk_status', 'status_id'),
            'status_id',
            $installer->getTable('mageprakash_helpdesk_status'),
            'status_id',
            Table::ACTION_NO_ACTION
        );
        
        $table_mageprakash_helpdesk_ticket->addForeignKey(
            $installer->getFkName('mageprakash_helpdesk_ticket', 'priority_id', 'mageprakash_helpdesk_priority', 'priority_id'),
            'priority_id',
            $installer->getTable('mageprakash_helpdesk_priority'),
            'priority_id',
            Table::ACTION_NO_ACTION
        );

        $setup->getConnection()->createTable($table_mageprakash_helpdesk_ticket);
    }

    public function priority($setup){

        $table_mageprakash_helpdesk_priority = $setup->getConnection()->newTable($setup->getTable('mageprakash_helpdesk_priority'));

        $table_mageprakash_helpdesk_priority->addColumn(
            'priority_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_mageprakash_helpdesk_priority->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable'  => false],
            'name'
        );

        $table_mageprakash_helpdesk_priority->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable'  => false],
            'status'
        );

        $table_mageprakash_helpdesk_priority->addColumn(
            'sort_order',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'sort_order'
        );

        $setup->getConnection()->createTable($table_mageprakash_helpdesk_priority);
    }
}
