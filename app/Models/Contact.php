<?php

namespace App\Models;

use CodeIgniter\Model;

class Contact extends Model
{
    protected $table      = 'contact';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'bday', 'phone', 'ctype', 'description'];

    protected $returnType     = 'array';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updateField  = 'update_at';
}