<?php
 
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class StaffSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        //for ($i = 0; $i < 1000000; $i++) {
        for ($i = 0; $i < 5000000; $i++) {

            $data = [
                'name' => $faker->name,
                'email'    => $faker->email,
                'age'    => $faker->numberBetween(1, 100),
                'address'    => $faker->address,
                'gender'    => $faker->randomElement(['Male', 'Female']),
                'state'    => $faker->randomElement(['Putrajaya', 'Melaka', 'Kedah', 'Kelantan', 'Perlis', 'Perak', 'Sabah']),
            ];

            $this->db->table('staffs')->insert($data);

        }

        // Simple Queries
        //$this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);
        //$this->db->query('INSERT INTO staffs (name, email, age, address, gender, state)VALUES(:name:, :email:, :age:, :address:, :gender:, :state:)', $data);

        // Using Query Builder
        
    }
}
 
 