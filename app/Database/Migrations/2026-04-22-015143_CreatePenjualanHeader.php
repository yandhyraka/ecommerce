<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanHeader extends Migration {
    public function up() {
        $this->forge->addField([
            'no_transaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tgl_transaksi' => [
                'type' => 'DATE',
            ],
            'customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kode_promo' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'total_biaya' => [
                'type'       => 'DOUBLE',
                'constraint' => '20,2',
            ],
            'ppn' => [
                'type'       => 'DOUBLE',
                'constraint' => '20,2',
            ],
            'grand_total' => [
                'type'       => 'DOUBLE',
                'constraint' => '20,2',
            ],
        ]);
        $this->forge->addPrimaryKey('no_transaksi', 'no_transaksi');
        $this->forge->createTable('penjualan_header');
    }

    public function down() {
        $this->forge->dropTable('penjualan_header');
    }
}
