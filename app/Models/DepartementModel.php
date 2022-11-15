<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartementModel extends Model
{

    protected $table            = 'tbl_dept';
    protected $primaryKey       = 'id_dept';
    protected $allowedFields    = ['id_dept', 'nama_dep'];
}
