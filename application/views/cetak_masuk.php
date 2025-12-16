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
        margin: 2px 0;  /* Mengurangi margin agar lebih compact */
        display: flex;
        align-items: flex-start;
    }
    
    .detail-label {
        width: 100px;     /* Menyesuaikan lebar untuk label yang lebih pendek */
        display: inline-block;
        text-align: left;
    }
    
    .detail-separator {
        margin: 0 4px;   /* Spasi sebelum dan sesudah titik dua */
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
          text-align: right;
          font-size: 15pt;
        }

    </style>
</head>

<body>
    <div class="header">
        TANDA MASUK<br/>
        <span class="company-name">SIAR-COLLECTION</span><br/>
        <span class="address">KYOTO - JAPAN</span>
    </div>

    <hr/>

    <div class="detail-JK">
        <span class="detail-label"><?php echo htmlspecialchars($kendaraan->jeniskendaraan ?? '-'); ?></span>
    </div>
    <div class="detail-karcis">
    <div class="detail-row">
        <span class="detail-label">CODE</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo htmlspecialchars($kendaraan->KodeMasuk ?? '-'); ?></span>
    </div>
    <div class="detail-row">
        <span class="detail-label">Tanggal</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?= date('d-m-Y', strtotime($kendaraan->TglMasuk ?? '-')) ?></span>
    </div>
    <div class="detail-row">
        <span class="detail-label">Jam Masuk</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo htmlspecialchars($kendaraan->waktu_masuk ?? '-'); ?></span>
    </div>
</div>
<div class="qrcode" style="text-align: center; margin-top: 10px;">
<img src="<?php echo htmlspecialchars($qrCodePath); ?>" alt="QR Code" style="width:100px;height:100px;"><br/>
<span class="detail-value">
    <b><?php echo htmlspecialchars($kendaraan->KodeMasuk ?? '-'); ?> </b></span>
    <hr/>

    <div class="footer">
        Terima kasih telah menggunakan<br/>
        layanan parkir kami <br/>
    Jika struk parkir menghilang, pengendara wajib menunjukan tanda kepemilikan kendaraan
    </div>
</body>
</html>