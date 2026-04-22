<!DOCTYPE html>
<html>

<head>
    <title>Invoice - <?= $penjualan['no_transaksi'] ?></title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
        }

        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        table td {
            padding: 5px;
            vertical-align: top;
        }

        table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        table tr.item td {
            border-bottom: 1px solid #eee;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="3">
                    <h2>INVOICE</h2>
                </td>
                <td colspan="2" style="text-align:right">
                    No: <?= $penjualan['no_transaksi'] ?><br>
                    Tanggal: <?= date('d/m/Y', strtotime($penjualan['tgl_transaksi'])) ?><br><br>
                    Promo: <?= $penjualan['kode_promo'] ?><br>
                    Customer: <?= $penjualan['customer'] ?><br>
                </td>
            </tr>
            <tr class="heading">
                <td>Barang</td>
                <td>Harga</td>
                <td>Qty</td>
                <td>Discount</td>
                <td>Subtotal</td>
            </tr>
            <?php foreach ($detail as $item): ?>
                <tr class="item">
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= number_format($item['discount'], 0, ',', '.') ?></td>
                    <td><?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td colspan="3"></td>
                <td>Total Biaya</td>
                <td><?= number_format($penjualan['total_biaya'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>PPN (11%)</td>
                <td><?= number_format($penjualan['ppn'], 0, ',', '.') ?></td>
            </tr>
            <tr class="total">
                <td colspan="3"></td>
                <td>Grand Total</td>
                <td><?= number_format($penjualan['grand_total'], 0, ',', '.') ?></td>
            </tr>
        </table>
        <br>
        <button onclick="window.print()" class="no-print">Cetak Lagi</button>
        <button onclick="window.close()" class="no-print">Tutup</button>
    </div>
</body>

</html>