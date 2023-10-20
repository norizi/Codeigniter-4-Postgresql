<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuditlogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255, 
                ],

                'action_made' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255, 
                ],
                
                 
                'created_at timestamp default current_timestamp', 
            ]
        );
        
        $this->forge->addKey('id', true); 
        $this->forge->createTable('auditlogs');
    }

    public function down()
    {
        $this->forge->dropTable('auditlogs');
    }
}
