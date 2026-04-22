<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanHeaderModel extends Model {
    protected $table            = 'penjualan_header';
    protected $primaryKey       = 'no_transaksi';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'no_transaksi',
        'tgl_transaksi',
        'customer',
        'kode_promo',
        'total_biaya',
        'ppn',
        'grand_total'
    ];
}
