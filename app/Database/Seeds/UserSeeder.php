<?php
 
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {

        $data = [
            'name' => 'Admin',
            'email'    => 'admin@gmail.com',
            'password'    => password_hash('admin@gmail.com', PASSWORD_DEFAULT),
        ];

        // Simple Queries
        //$this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
 
 