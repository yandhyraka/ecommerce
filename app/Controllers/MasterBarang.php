<?php

namespace App\Controllers;

use App\Models\MasterBarangModel;

class MasterBarang extends BaseController {
    protected $masterBarangModel;

    public function __construct() {
        $this->masterBarangModel = new MasterBarangModel();
    }

    public function index() {
        $data = [
            'title'  => 'Master Barang',
            'barang' => $this->masterBarangModel->findAll()
        ];

        return view('masterBarang/index', $data);
    }

    public function store() {
        $rules = [
            'kode_barang' => [
                'rules'  => 'required|is_unique[master_barang.kode_barang]',
                'errors' => [
                    'is_unique' => 'Kode Barang {value} sudah ada di database. Gunakan kode lain.'
                ]
            ],
            'nama_barang' => 'required',
            'harga'       => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getError('kode_barang'));
        }

        $this->masterBarangModel->insert([
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga'       => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/master-barang')->with('success', 'Data berhasil ditambahkan');
    }

    public function update($kode_barang) {
        $this->masterBarangModel->update($kode_barang, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga'       => $this->request->getPost('harga'),
        ]);

        return redirect()->to('/master-barang')->with('success', 'Data berhasil diubah');
    }

    public function delete($kode_barang) {
        $this->masterBarangModel->delete($kode_barang);
        return redirect()->to('/master-barang')->with('success', 'Data berhasil dihapus');
    }
}
