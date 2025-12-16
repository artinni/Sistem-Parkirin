<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script language="javascript">
   
        // Fungsi untuk validasi dan submit data
        function simpankendaraankeluar() {
    var KodeMasuk = $('#KodeMasuk').val().trim();

    if (KodeMasuk === "") {
        alert("Kode Masuk masih kosong!");
        $('#jenis_id').val('');
        $('#harga').val('');
        $('#TglMasuk').val('');
        $('#waktu_masuk').val('');
        $('#KodeMasuk').focus(); // Kembalikan fokus ke input
        return false;
    }

    // Submit form jika validasi berhasil
    $('#formkendaraankeluar').submit();
}


</script>
<script>
$(document).ready(function () {
    // Event untuk mendeteksi tombol Enter
    $('#KodeMasuk').on('keyup', function (event) {
        if (event.key === 'Enter') { // Jika tombol Enter ditekan
            processKodeMasuk();
        }
    });



    // Fungsi untuk memproses KodeMasuk
    function processKodeMasuk() {
        const KodeMasuk = $('#KodeMasuk').val().trim(); // Ambil nilai KodeMasuk

        // Reset error message jika ada
        $('#error-message').hide();
        $('#error-message').text('');

        // Validasi jika input kosong
        if (KodeMasuk === '') {
            $('#error-message').text('Kode Masuk tidak boleh kosong!').show();
            
        }

        // Lakukan request AJAX ke server
        $.ajax({
            url: "<?= site_url('transaksi/getKendaraanByKodeMasuk'); ?>", // Endpoint controller
            type: "POST",
            data: { KodeMasuk: KodeMasuk }, // Kirim KodeMasuk sebagai parameter
            dataType: "json",
            success: function (response) {
                if (response.status !== 'error') {
                    // Isi input dengan data yang diterima
                    $('#jenis_id').val(response.jenis_id);
                    $('#harga').val(response.harga);
                    $('#TglMasuk').val(response.TglMasuk);
                    $('#waktu_masuk').val(response.waktu_masuk);
                } else {
                    // Tampilkan pesan error jika data tidak ditemukan
                    $('#error-message').text(response.message).show();
                    $('#jenis_id').val('');
                    $('#harga').val('');
                    $('#TglMasuk').val('');
                    $('#waktu_masuk').val('');
                }
            },
            
        });
    }

});
</script>

<script>
    function updateClock() {
        const clockElement = document.getElementById("waktu_keluar");
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        // Update the value of the time input with real-time data (HH:mm:ss)
        clockElement.value = hours + ":" + minutes + ":" + seconds;
    }

    // Update clock every second
    setInterval(updateClock, 1000);
    // Initialize the clock immediately on page load
    updateClock();
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .card {
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 text-center">Form Transaksi Kendaraan Keluar </h5>
            </div>
            <div class="card-body">
<!-- Elemen untuk menampilkan pesan error -->
<div id="error-message" class="alert alert-danger" style="display: none;">
    <button type="button" class="close" aria-label="Close" id="close-error-message">
        <span aria-hidden="true">&times;</span> <!-- Simbol X -->
    </button>
    <span id="error-message-text"></span> <!-- Tempat untuk pesan error -->
</div>

                <?php
                $pesan = $this->session->flashdata('pesan');
                if ($pesan != "") {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                        <?php echo $pesan; ?>
                    </div>
                    <?php
                }
                ?>
                <form name="formkendaraankeluar" id="formkendaraankeluar" method="post" action="<?php echo base_url('transaksi/simpankendaraankeluar') ?>">

                <!-- untuk masukan kode -->
                <div class="form-group">
    <div class="row mb-3 justify-content-center">
        <div class="col-sm-6">
            <input type="text" placeholder="Masukkan Kode Masuk" id="KodeMasuk" name="KodeMasuk" 
            class="form-control bg-light from-control-lg" style="padding: 20px; font-size: 22px; height: 60px;" maxlength="7" required autofocus/>
        </div>
    </div>
</div>


                    
<div class="form-group">
    <div class="row mb-3">
        <!-- Form Tanggal Masuk -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-3">
                    Jenis_id
                </div>
                <div class="col-sm-9">
                    <input type="text" name="jenis_id" id="jenis_id" value="" class="form-control" readonly="readonly"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-3">
                    Harga
                </div>
                <div class="col-sm-9">
                    <input type="text" name="harga" id="harga" value="" class="form-control" readonly="readonly"/>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="form-group">
    <div class="row mb-3">
        <!-- Form Tanggal Masuk -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-3">
                    Masuk
                </div>
                <div class="col-sm-9">
                    <input type="date" name="TglMasuk" id="TglMasuk" value="<?= date('Y-m-d', strtotime($transaksi->TglMasuk ?? '-')) ?>" class="form-control" readonly="readonly"/>
                </div>
            </div>
        </div>
        
        <!-- Form Waktu Masuk -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-3">
                    Waktu Masuk
                </div>
                <div class="col-sm-9">
                    <input type="time" name="waktu_masuk" id="waktu_masuk" value="" class="form-control" readonly="readonly" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row mb-3">
        <!-- Form Tanggal Masuk -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-3">
                    Keluar
                </div>
                <div class="col-sm-9">
                    <input type="date" name="TglTransaksi" id="TglTransaksi" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly="readonly"/>
                </div>
            </div>
        </div>
        
        <!-- Form Waktu Masuk -->
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-3">
                    Waktu Keluar
                </div>
                <div class="col-sm-9">
                    <input type="time" name="waktu_keluar" id="waktu_keluar" value="" class="form-control" readonly="readonly" />
                </div>
            </div>
        </div>
    </div>
</div>
                    <!-- Tombol Aksi -->
                    <div class="form-group">
    <div class="row justify-content-center">
        <div class="col-sm-12 text-center">
            <input type="button" value="Simpan" class="btn btn-primary btn-sm mx-2" onClick="simpankendaraankeluar();">
            <input type="reset" value="Batal" class="btn btn-warning btn-sm mx-2">
        </div>
    </div>
</div>
                </form>
            </div>
        </div>
    </div>

    
</body>
</html>
