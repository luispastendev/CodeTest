<?php

namespace App\Models;

use CodeIgniter\Model;

class Reservation extends Model
{
    protected $table      = 'reservation';
    protected $primaryKey = 'id_r';
    protected $allowedFields = ['name', 'rtype', 'phone', 'rdate', 'description'];
}
