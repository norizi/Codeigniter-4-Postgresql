<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaffsTable extends Migration
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

                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255, 
                ],

                 
                'age' => [
                    'type' => 'INT',
                    'constraint' => 11, 
                ],
                'address' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255, 
                ],
                'gender' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255, 
                ],
                'state' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255, 
                ],
                 
                'created_at timestamp default current_timestamp',
                'updated_at timestamp default current_timestamp', 
            ]
        );
        
        $this->forge->addKey('id', true); 
        $this->forge->createTable('staffs');
    }

    public function down()
    {
        $this->forge->dropTable('staffs');
    }
}
