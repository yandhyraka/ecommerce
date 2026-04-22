<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMasterBarang extends Migration {
    public function up() {
        $this->forge->addField([
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga' => [
                'type'       => 'DOUBLE',
                'constraint' => '20,2',
            ],
        ]);
        $this->forge->addPrimaryKey('kode_barang', 'kode_barang');
        $this->forge->createTable('master_barang');
    }

    public function down() {
        $this->forge->dropTable('master_barang');
    }
}
