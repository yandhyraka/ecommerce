<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromoSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'kode_promo' => 'promo-001',
                'nama_promo' => 'promo facial car',
                'keterangan' => 'setiap pembelian Facial Care sejumlah 2 pcs akan mendapat potongan harga 3000'
            ],
        ];
        $this->db->table('promo')->insertBatch($data);
    }
}
