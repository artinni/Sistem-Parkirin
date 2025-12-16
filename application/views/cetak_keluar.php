<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ 'dark' if session['darkMode'] == 'true' else 'light' }}">
<head>
    <style>
        @page {
            width: 62mm;
            height: 88mm;
            margin: 2mm;
            font-family: 'times';
        }
        
        body {
            width: 58mm;
            margin: 0 auto;
            padding: 0;
        }
        
        tr, td, h1, h2, h3, h4, h5 {
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            font-size: 8pt;
            margin-bottom: 5px;
        }
        
        .company-name {
            font-weight: bold;
            font-size: 9pt;
        }
        
        .address {
            font-size: 7pt;
        }
        
        hr {
            border: none;
            border-top: 1px outset #000;
            margin: 5px 0;
        }
        
        .detail-karcis {
        font-family: monospace;
        font-size: 8pt;
        margin: 8px 0;
    }
    
    .detail-row {
    margin-bottom: 10px;
}
.detail-label {
    min-width: 100px;
    display: inline-block;
}
.detail-separator {
    margin: 0 8px;
}
    
    .detail-value {
        display: inline-block;
        text-align: left;
    }

        .footer {
            text-align: center;
            font-size: 7pt;
            margin-top: 10px;
        }

        .detail-JK{
          text-align: left;
          font-size: 15pt;
        }

        .detail-label-tr{
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="header">
        ~~~<br/>
        <span class="company-name">SIAR-COLLECTION</span><br/>
        <span class="address">KYOTO - JAPAN</span>
    </div>

    <hr/>

    <div class="detail-JK">
        <span class="detail-label"><?php echo htmlspecialchars($transaksi->jeniskendaraan ?? '-'); ?></span>
    </div>
    <div class="detail-karcis">
    <div class="detail-row">
        <span class="detail-label"><?php echo htmlspecialchars($transaksi->NoTransaksi ?? '-'); ?></span>
    </div>
    <div class="detail-row">
    <span class="detail-label-tr">Masuk</span>
    <span class="detail-separator">:</span>
    <span class="detail-value">
        <?= date('d-m-Y', strtotime($transaksi->TglMasuk ?? '-')) ?>
        <?php echo htmlspecialchars($transaksi->waktu_masuk ?? '-'); ?>
    </span>
</div>
<div class="detail-row">
    <span class="detail-label-tr">Keluar</span>
    <span class="detail-separator">:</span>
    <span class="detail-value">
        <?= date('d-m-Y', strtotime($transaksi->TglTransaksi ?? '-')) ?>
        <?php echo htmlspecialchars($transaksi->waktu_keluar ?? '-'); ?>
    </span>
</div>
<div class="detail-row">
    <span class="detail-label-tr">Lama Parkir: </span>
    <?php 
    echo isset($transaksi->lama_parkir) && $transaksi->lama_parkir !== '' 
        ? htmlspecialchars($transaksi->lama_parkir) . ' menit' 
        : '-'; 
    ?>
</div>

<div class="detail-row">
    <span class="detail-label-tr">Total Bayar: </span>
    <?php 
    echo isset($transaksi->total_harga) && $transaksi->total_harga !== '' 
        ? 'Rp ' . number_format($transaksi->total_harga, 0, ',', '.') 
        : '-'; 
    ?>
</div>



</div>
    <hr/>

    <div class="footer">
        Terima kasih telah menggunakan<br/>
        layanan parkir kami <br/>
        ~Semoga selamat sampai tujuan!~
    </div>
</body>
</html>