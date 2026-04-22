<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Master Promo</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Promo
        </button>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kode Promo</th>
                <th>Nama Promo</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promo as $p) : ?>
                <tr>
                    <td><?= $p['kode_promo'] ?></td>
                    <td><?= $p['nama_promo'] ?></td>
                    <td><?= $p['keterangan'] ?></td>
                    <td>
                        <button type="button"
                            class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEdit"
                            data-kode="<?= $p['kode_promo'] ?>"
                            data-nama="<?= $p['nama_promo'] ?>"
                            data-ket="<?= $p['keterangan'] ?>">
                            Edit
                        </button>
                        <a href="/promo/delete/<?= $p['kode_promo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus promo ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/promo/store" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Promo Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Promo</label>
                        <input type="text" name="kode_promo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Promo</label>
                        <input type="text" name="nama_promo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEdit" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Promo</label>
                        <input type="text" id="edit_kode" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Promo</label>
                        <input type="text" name="nama_promo" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="edit_ket" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalEdit = document.getElementById('modalEdit');
        if (modalEdit) {
            modalEdit.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;

                const kode = button.getAttribute('data-kode');
                const nama = button.getAttribute('data-nama');
                const ket = button.getAttribute('data-ket');

                const form = modalEdit.querySelector('#formEdit');
                form.action = '/promo/update/' + kode;

                modalEdit.querySelector('#edit_kode').value = kode;
                modalEdit.querySelector('#edit_nama').value = nama;
                modalEdit.querySelector('#edit_ket').value = ket;
            });
        }
    </script>
</body>

</html>