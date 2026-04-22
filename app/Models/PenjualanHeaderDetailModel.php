<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanHeaderDetailModel extends Model {
    protected $table            = 'penjualan_header_detail';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'no_transaksi',
        'kode_barang',
        'qty',
        'harga',
        'discount',
        'subtotal'
    ];

    public function getDetailByTrans($no_transaksi) {
        return $this->where('no_transaksi', $no_transaksi)->findAll();
    }
}
