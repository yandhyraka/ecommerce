<!DOCTYPE html>
<html lang="id">

<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        input[type="number"] {
            text-align: right;
        }

        input[readonly] {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="container mt-5">
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="/master-barang" class="btn btn-outline-primary btn-sm">Master Barang</a>
            <a href="/promo" class="btn btn-outline-primary btn-sm">Master Promo</a>
        </div>
        <span class="badge bg-secondary">Halaman Penjualan</span>
    </div>
    <hr>

    <h2>Input Transaksi Penjualan</h2>
    <hr>

    <form action="/penjualan/store" method="post">
        <div class="row mb-4">
            <div class="col-md-3">
                <label>No. Transaksi</label>
                <input type="text" name="no_transaksi" class="form-control" value="<?= $auto_no_transaksi ?>" readonly>
            </div>
            <div class="col-md-3">
                <label>Tanggal</label>
                <input type="date" name="tgl_transaksi" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-md-3">
                <label>Customer</label>
                <input type="text" name="customer" class="form-control" placeholder="Nama Pelanggan" required>
            </div>
            <div class="col-md-3">
                <label>Promo</label>
                <select name="kode_promo" class="form-control">
                    <option value="">- Tanpa Promo -</option>
                    <?php foreach ($promo as $p): ?>
                        <option value="<?= $p['kode_promo'] ?>"><?= $p['nama_promo'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <h5>Daftar Barang</h5>
        <table class="table table-bordered" id="tableDetail">
            <thead class="table-light">
                <tr>
                    <th width="30%">Barang</th>
                    <th>Harga</th>
                    <th width="10%">Jumlah</th>
                    <th>Diskon</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="item-list">
                <tr>
                    <td>
                        <select name="kode_barang[]" class="form-select select-barang" required>
                            <option value="">Pilih Barang</option>
                            <?php foreach ($barang as $b): ?>
                                <option value="<?= $b['kode_barang'] ?>" data-harga="<?= $b['harga'] ?>">
                                    <?= $b['nama_barang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="number" name="harga_satuan[]" class="form-control harga" readonly></td>
                    <td><input type="number" name="qty[]" class="form-control qty" value="1" min="1"></td>
                    <td><input type="number" name="discount_item[]" class="form-control disc" value="0"></td>
                    <td><input type="number" name="subtotal_item[]" class="form-control subtotal" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary btn-sm mb-4" id="add-row">+ Tambah Barang</button>

        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <span class="input-group-text">Total Biaya</span>
                    <input type="number" name="total_biaya" id="total_biaya" class="form-control" readonly>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">PPN (11%)</span>
                    <input type="number" name="ppn" id="ppn" class="form-control" readonly>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">Grand Total</span>
                    <input type="number" name="grand_total" id="grand_total" class="form-control" readonly>
                </div>
                <div class="d-flex gap-2 mt-2">
                    <button type="submit" name="action" value="save" class="btn btn-success w-100">Simpan Transaksi</button>
                    <button type="submit" name="action" value="save_print" class="btn btn-warning w-100 text-white">Simpan & Print</button>
                </div>
            </div>
        </div>
    </form>

    <hr class="my-5">

    <h3>Riwayat Transaksi</h3>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Grand Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penjualan as $row): ?>
                <tr>
                    <td><?= $row['no_transaksi'] ?></td>
                    <td><?= $row['tgl_transaksi'] ?></td>
                    <td><?= $row['customer'] ?></td>
                    <td>Rp<?= number_format($row['grand_total'], 0, ',', '.') ?></td>
                    <td>
                        <button class="btn btn-sm btn-info text-white btn-edit-transaksi"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditPenjualan"
                            data-no="<?= $row['no_transaksi'] ?>"
                            data-tgl="<?= $row['tgl_transaksi'] ?>"
                            data-customer="<?= $row['customer'] ?>"
                            data-promo="<?= $row['kode_promo'] ?>">
                            Edit
                        </button>
                        <a href="/penjualan/print/<?= $row['no_transaksi'] ?>" target="_blank" class="btn btn-sm btn-secondary">Print</a>
                        <a href="/penjualan/delete/<?= $row['no_transaksi'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalEditPenjualan" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="formEditPenjualan" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Transaksi: <span id="display_no_transaksi"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Tanggal</label>
                            <input type="date" name="tgl_transaksi" id="edit_tgl" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Customer</label>
                            <input type="text" name="customer" id="edit_customer" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Promo</label>
                            <select name="kode_promo" id="edit_promo" class="form-control">
                                <option value="">- Tanpa Promo -</option>
                                <?php foreach ($promo as $p): ?>
                                    <option value="<?= $p['kode_promo'] ?>"><?= $p['nama_promo'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th width="10%">Qty</th>
                                <th>Disc</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="edit-item-list">
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary btn-sm" id="add-row-edit">+ Tambah Barang</button>

                    <div class="row justify-content-end mt-3">
                        <div class="col-md-5">
                            <div class="row mb-1">
                                <label class="col-sm-5 col-form-label">Total Biaya</label>
                                <div class="col-sm-7"><input type="number" name="total_biaya" id="edit_total_biaya" class="form-control form-control-sm" readonly></div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-sm-5 col-form-label">PPN (11%)</label>
                                <div class="col-sm-7"><input type="number" name="ppn" id="edit_ppn" class="form-control form-control-sm" readonly></div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-sm-5 col-form-label">Grand Total</label>
                                <div class="col-sm-7"><input type="number" name="grand_total" id="edit_grand_total" class="form-control form-control-sm" readonly></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('add-row').addEventListener('click', function() {
            let tbody = document.getElementById('item-list');
            let firstRow = tbody.querySelector('tr');
            let newRow = firstRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = input.classList.contains('qty') ? 1 : 0);
            tbody.appendChild(newRow);
        });

        document.getElementById('add-row-edit').addEventListener('click', function() {
            let tbody = document.getElementById('edit-item-list');
            let firstRow = tbody.querySelector('tr');
            let newRow = firstRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = input.classList.contains('qty') ? 1 : 0);
            tbody.appendChild(newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                let tbody = e.target.closest('tbody');
                let rows = tbody.querySelectorAll('tr');
                if (rows.length > 1) e.target.closest('tr').remove();

                if (tbody.id === 'item-list') calculateTotal();
                else calculateTotalEdit();
            }
        });

        function calculateTotal() {
            let totalBiaya = 0;
            document.querySelectorAll('#item-list .subtotal').forEach(el => totalBiaya += parseFloat(el.value) || 0);
            let ppn = totalBiaya * 0.11;
            document.getElementById('total_biaya').value = totalBiaya;
            document.getElementById('ppn').value = Math.round(ppn);
            document.getElementById('grand_total').value = Math.round(totalBiaya + ppn);
        }

        function calculateTotalEdit() {
            let totalBiaya = 0;
            document.querySelectorAll('#edit-item-list .subtotal').forEach(el => totalBiaya += parseFloat(el.value) || 0);
            let ppn = totalBiaya * 0.11;
            document.getElementById('edit_total_biaya').value = totalBiaya;
            document.getElementById('edit_ppn').value = Math.round(ppn);
            document.getElementById('edit_grand_total').value = Math.round(totalBiaya + ppn);
        }

        document.querySelectorAll('.btn-edit-transaksi').forEach(button => {
            button.addEventListener('click', function() {
                const noTrx = this.dataset.no;
                const tgl = this.dataset.tgl;
                const cust = this.dataset.customer;
                const promo = this.dataset.promo;

                document.getElementById('display_no_transaksi').innerText = noTrx;
                document.getElementById('edit_tgl').value = tgl;
                document.getElementById('edit_customer').value = cust;
                document.getElementById('edit_promo').value = promo;

                document.getElementById('formEditPenjualan').action = '/penjualan/update/' + noTrx;

                const listContainer = document.getElementById('edit-item-list');
                listContainer.innerHTML = '<tr><td colspan="6" class="text-center">Memuat data...</td></tr>';

                fetch('/penjualan/getDetail/' + noTrx)
                    .then(response => response.json())
                    .then(data => {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                html += `
                                    <tr>
                                        <td>
                                            <select name="kode_barang[]" class="form-select select-barang-edit" required>
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $b): ?>
                                                    <option value="<?= $b['kode_barang'] ?>" 
                                                            data-harga="<?= $b['harga'] ?>" 
                                                            ${item.kode_barang == '<?= $b['kode_barang'] ?>' ? 'selected' : ''}>
                                                        <?= $b['nama_barang'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><input type="number" name="harga_satuan[]" class="form-control harga" value="` + item.harga + `" readonly></td>
                                        <td><input type="number" name="qty[]" class="form-control qty" value="` + item.qty + `"></td>
                                        <td><input type="number" name="discount_item[]" class="form-control disc" value="` + item.discount + `"></td>
                                        <td><input type="number" name="subtotal_item[]" class="form-control subtotal" value="` + item.subtotal + `" readonly></td>
                                        <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                                    </tr>`;
                            });
                        } else {
                            html = '<tr><td colspan="6" class="text-center">Tidak ada detail barang</td></tr>';
                        }
                        listContainer.innerHTML = html;

                        calculateTotalEdit();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        listContainer.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Gagal mengambil data</td></tr>';
                    });
            });
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('select-barang') || e.target.classList.contains('qty') || e.target.classList.contains('disc')) {
                let row = e.target.closest('tr');

                if (e.target.classList.contains('select-barang')) {
                    let selectedOption = e.target.options[e.target.selectedIndex];
                    let harga = selectedOption.dataset.harga || 0;
                    row.querySelector('.harga').value = harga;
                }

                let valHarga = parseFloat(row.querySelector('.harga').value) || 0;
                let valQty = parseFloat(row.querySelector('.qty').value) || 0;
                let valDisc = parseFloat(row.querySelector('.disc').value) || 0;

                row.querySelector('.subtotal').value = (valHarga * valQty) - valDisc;

                calculateTotal();
            }
        });

        document.getElementById('modalEditPenjualan').addEventListener('input', function(e) {
            if (e.target.classList.contains('select-barang-edit') || e.target.classList.contains('qty') || e.target.classList.contains('disc')) {
                let row = e.target.closest('tr');

                if (e.target.classList.contains('select-barang-edit')) {
                    let selectedOption = e.target.options[e.target.selectedIndex];
                    let harga = selectedOption.dataset.harga || 0;
                    row.querySelector('.harga').value = harga;
                }

                let valHarga = parseFloat(row.querySelector('.harga').value) || 0;
                let valQty = parseFloat(row.querySelector('.qty').value) || 0;
                let valDisc = parseFloat(row.querySelector('.disc').value) || 0;

                row.querySelector('.subtotal').value = (valHarga * valQty) - valDisc;

                calculateTotalEdit();
            }
        });
    </script>
</body>

</html>