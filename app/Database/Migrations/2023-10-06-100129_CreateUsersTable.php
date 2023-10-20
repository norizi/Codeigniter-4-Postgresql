<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
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

                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255, 
                ],
                 
                'created_at timestamp default current_timestamp',
                'updated_at timestamp default current_timestamp', 
            ]
        );
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['email']);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
