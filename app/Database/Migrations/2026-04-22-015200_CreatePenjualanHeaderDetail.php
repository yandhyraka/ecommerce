<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenjualanHeaderDetail extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_transaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'harga' => [
                'type'       => 'DOUBLE',
                'constraint' => '20,2',
            ],
            'discount' => [
                'type'       => 'DOUBLE',
                'constraint' => '20,2',
                'default'    => 0,
            ],
            'subtotal' => [
                'type'       => 'DOUBLE',
                'constraint' => '20,2',
            ],
        ]);
        $this->forge->addPrimaryKey('id', 'id');
        $this->forge->createTable('penjualan_header_detail');
    }

    public function down() {
        $this->forge->dropTable('penjualan_header_detail');
    }
}
