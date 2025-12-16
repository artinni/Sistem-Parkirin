<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            font-size: 9pt;
        }

        th {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .header {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 8pt;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        Laporan Transaksi Parkir<br/>
        <span style="font-size: 12pt;">SIAR-COLLECTION - KYOTO, JAPAN</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Transaksi</th>
                <th>Transaksi Code</th>
                <th>Jenis Kendaraan</th>
                <th>Harga</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Total Harga</th>
                <th>Lama Parkir</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($transaksi as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($row->TglTransaksi ?? '-')) ?></td>
                    <td><?php echo htmlspecialchars($row->NoTransaksi ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($row->jenis_kendaraan ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($row->harga ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($row->waktu_masuk ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($row->waktu_keluar ?? '-'); ?></td>
                    <td><?php echo isset($row->total_harga) && $row->total_harga !== '' ? 'Rp ' . number_format($row->total_harga, 0, ',', '.') : '-'; ?></td>
                    <td><?php echo isset($row->lama_parkir) && $row->lama_parkir !== '' ? htmlspecialchars($row->lama_parkir) . ' menit' : '-'; ?></td>
                    <td><?php echo htmlspecialchars($row->status ?? '-'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        Terima kasih telah menggunakan layanan parkir kami!<br/>
        ~ Semoga selamat sampai tujuan ~
    </div>
</body>
</html>
