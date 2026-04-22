<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model {
    protected $table            = 'promo';
    protected $primaryKey       = 'kode_promo';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = ['kode_promo', 'nama_promo', 'keterangan'];
}
