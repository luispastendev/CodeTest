<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;

class Contact extends Model
{
    protected $table      = 'contact';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'bday', 'phone', 'id_ctype', 'description'];

    protected $returnType     = 'array';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updateField  = 'update_at';

    public function fake(Generator &$faker)
    {
        return [
            'name'  => $faker->name,
            'bday' => $faker->dateTimeBetween($startDate = '-80 years', $endDate = '-18 years')->format('Y-m-d'),
            'phone' => $faker->tollFreePhoneNumber,
            'id_ctype' => $faker->randomElements(['Contact Type 1', 'Contact Type 2', 'Contact Type 3']),
            'created_at'  => $faker->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s')
        ];
    }
}