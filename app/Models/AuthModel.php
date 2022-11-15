<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';

    // protected $allowedFields    = [];
    protected $returnType       = 'object';
    // Dates
    protected $useTimestamps = false;
}
