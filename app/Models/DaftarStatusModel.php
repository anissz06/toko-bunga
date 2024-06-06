<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarStatusModel extends Model
{
    protected $table            = 'daftarstatus';
    protected $primaryKey       = 'status_id';
    protected $allowedFields    = ['status'];
}
