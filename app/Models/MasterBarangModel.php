<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBarangModel extends Model {
    protected $table            = 'master_barang';
    protected $primaryKey       = 'kode_barang';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = ['kode_barang', 'nama_barang', 'harga'];
}
