<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class InitSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $contact = [];
        for ($i = 0; $i <= 14; $i++) {
            $created_at = $faker->dateTime();
            $bday = $faker->dateTimeBetween($startDate = '-80 years', $endDate = '-18 years');

            $contact[] =
                [
                    'name' => $faker->name,
                    'bday' => $bday->format('Y-m-d'),
                    'phone' => $faker->tollFreePhoneNumber,
                    'created_at' => $created_at->format('Y-m-d H:i:s')
                ];
        }
        $builder = $this->db->table('contact');
        $builder->insertBatch($contact);


        $reservation = [];
        for ($i = 0; $i <= 14; $i++) {
            $created_at = $faker->dateTime();
            $reservation_date = $faker->dateTimeBetween($startDate = '2021-12-01');

            $reservation[] =
                [
                    'name' => $faker->name,
                    'phone' => $faker->phoneNumber,
                    'rdate' => $reservation_date->format('Y-m-d'),
                    'description' => $faker->text(150),
                    'created_at' => $created_at->format('Y-m-d H:i:s')
                ];
        }
        $builder = $this->db->table('reservation');
        $builder->insertBatch($reservation);
    }
}
