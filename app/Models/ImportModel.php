<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportModel extends Model
{
    protected $table = 'students';
    protected $allowedFields = [
        'name', 
        'email', 
        'phone',
        'created_at'
    ];
}