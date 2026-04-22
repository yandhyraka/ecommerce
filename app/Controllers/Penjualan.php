<?php

namespace App\Controllers;

use App\Models\MasterBarangModel;
use App\Models\PromoModel;
use App\Models\PenjualanHeaderModel;
use App\Models\PenjualanHeaderDetailModel;

class Penjualan extends BaseController {
    public function index() {
        $barangModel = new MasterBarangModel();
        $promoModel  = new PromoModel();
        $headerModel = new PenjualanHeaderModel();

        $data = [
            'title'      => 'Transaksi Penjualan',
            'barang'     => $barangModel->findAll(),
            'promo'      => $promoModel->findAll(),
            'penjualan'  => $headerModel->orderBy('tgl_transaksi', 'DESC')->findAll()
        ];
        return view('penjualan/index', $data);
    }

    public function getDetail($no_transaksi) {
        $detailModel = new PenjualanHeaderDetailModel();
        $data = $detailModel->where('no_transaksi', $no_transaksi)->findAll();
        return $this->response->setJSON($data);
    }

    public function store() {
        $db = \Config\Database::connect();
        $db->transStart();

        $headerModel = new PenjualanHeaderModel();
        $detailModel = new PenjualanHeaderDetailModel();

        $no_transaksi = $this->request->getPost('no_transaksi');

        $headerModel->insert([
            'no_transaksi'  => $no_transaksi,
            'tgl_transaksi' => $this->request->getPost('tgl_transaksi'),
            'customer'      => $this->request->getPost('customer'),
            'kode_promo'    => $this->request->getPost('kode_promo'),
            'total_biaya'   => $this->request->getPost('total_biaya'),
            'ppn'           => $this->request->getPost('ppn'),
            'grand_total'   => $this->request->getPost('grand_total'),
        ]);

        $kode_barang = $this->request->getPost('kode_barang');
        $qty         = $this->request->getPost('qty');
        $harga       = $this->request->getPost('harga_satuan');
        $discount    = $this->request->getPost('discount_item');
        $subtotal    = $this->request->getPost('subtotal_item');

        $details = [];
        for ($i = 0; $i < count($kode_barang); $i++) {
            $details[] = [
                'no_transaksi' => $no_transaksi,
                'kode_barang'  => $kode_barang[$i],
                'qty'          => $qty[$i],
                'harga'        => $harga[$i],
                'discount'     => $discount[$i],
                'subtotal'     => $subtotal[$i],
            ];
        }
        $detailModel->insertBatch($details);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi.');
        }

        return redirect()->to('/penjualan')->with('success', 'Transaksi Berhasil!');
    }

    public function edit($no_transaksi) {
        $barangModel = new MasterBarangModel();
        $promoModel  = new PromoModel();
        $headerModel = new PenjualanHeaderModel();
        $detailModel = new PenjualanHeaderDetailModel();

        $data = [
            'title'      => 'Edit Transaksi',
            'header'     => $headerModel->find($no_transaksi),
            'details'    => $detailModel->where('no_transaksi', $no_transaksi)->findAll(),
            'barang'     => $barangModel->findAll(),
            'promo'      => $promoModel->findAll(),
        ];

        return view('penjualan/edit', $data);
    }

    public function update($no_transaksi) {
        $db = \Config\Database::connect();
        $db->transStart();

        $headerModel = new PenjualanHeaderModel();
        $detailModel = new PenjualanHeaderDetailModel();

        $headerModel->update($no_transaksi, [
            'tgl_transaksi' => $this->request->getPost('tgl_transaksi'),
            'customer'      => $this->request->getPost('customer'),
            'kode_promo'    => $this->request->getPost('kode_promo'),
            'total_biaya'   => $this->request->getPost('total_biaya'),
            'ppn'           => $this->request->getPost('ppn'),
            'grand_total'   => $this->request->getPost('grand_total'),
        ]);

        $detailModel->where('no_transaksi', $no_transaksi)->delete();

        $kode_barang = $this->request->getPost('kode_barang');
        $qty         = $this->request->getPost('qty');
        $harga       = $this->request->getPost('harga_satuan');
        $discount    = $this->request->getPost('discount_item');
        $subtotal    = $this->request->getPost('subtotal_item');

        $details = [];
        for ($i = 0; $i < count($kode_barang); $i++) {
            $details[] = [
                'no_transaksi' => $no_transaksi,
                'kode_barang'  => $kode_barang[$i],
                'qty'          => $qty[$i],
                'harga'        => $harga[$i],
                'discount'     => $discount[$i],
                'subtotal'     => $subtotal[$i],
            ];
        }
        $detailModel->insertBatch($details);

        $db->transComplete();
        return redirect()->to('/penjualan')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function delete($no_transaksi) {
        $db = \Config\Database::connect();
        $db->transStart();

        $headerModel = new PenjualanHeaderModel();
        $detailModel = new PenjualanHeaderDetailModel();

        $detailModel->where('no_transaksi', $no_transaksi)->delete();
        $headerModel->delete($no_transaksi);

        $db->transComplete();
        return redirect()->to('/penjualan')->with('success', 'Transaksi berhasil dihapus');
    }
}
