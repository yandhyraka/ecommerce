<?php

namespace App\Controllers;

use App\Models\PromoModel;

class Promo extends BaseController {
    protected $promoModel;

    public function __construct() {
        $this->promoModel = new PromoModel();
    }

    public function index() {
        $data = [
            'title' => 'Promo',
            'promo' => $this->promoModel->findAll()
        ];
        return view('promo/index', $data);
    }

    public function store() {
        $rules = [
            'kode_promo' => [
                'rules'  => 'required|is_unique[promo.kode_promo]',
                'errors' => [
                    'is_unique' => 'Kode Promo {value} sudah terdaftar.'
                ]
            ],
            'nama_promo' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getError('kode_promo'));
        }
        
        $this->promoModel->insert([
            'kode_promo' => $this->request->getPost('kode_promo'),
            'nama_promo' => $this->request->getPost('nama_promo'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/promo')->with('success', 'Promo berhasil ditambahkan');
    }

    public function update($kode_promo) {
        $this->promoModel->update($kode_promo, [
            'nama_promo' => $this->request->getPost('nama_promo'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/promo')->with('success', 'Promo berhasil diubah');
    }

    public function delete($kode_promo) {
        $this->promoModel->delete($kode_promo);
        return redirect()->to('/promo')->with('success', 'Promo berhasil dihapus');
    }
}
