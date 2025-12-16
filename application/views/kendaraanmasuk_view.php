<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script language="javascript">
   
        // Fungsi untuk validasi dan submit data
        function simpankendaraanmasuk() {
            var jenis_id = $('#jenis_id').val();
            if (jenis_id == "") 
            {
                alert("Nama jenis kendaraan masih kosong...");
                $('#jenis_id').focus();
                return false;
            }


            $('#formkendaraanmasuk').submit(); // Submit form jika validasi berhasil
        }

</script>
<script>
$(document).ready(function(){
    $("#jenis_id").change(function(){
        var jenis_id = $('#jenis_id').val();
        
        if (jenis_id == "") {
            $('#harga').val('');
            return;
        }
        
        // AJAX untuk mendapatkan harga
        $.ajax({
            url: "<?php echo base_url('kendaraan/caridatakendaraan/'); ?>" + jenis_id,
            type: "GET",
            success: function(response) {
                $('#harga').val(response); // Isi input harga
            },
            error: function() {
                alert("Gagal mengambil data harga.");
            }
        });
    });
});
</script>

<script>
    function updateClock() {
        const clockElement = document.getElementById("waktu_masuk");
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
                <h5 class="mb-0 text-center">Form Transaksi Kendaraan Masuk </h5>
            </div>
            <div class="card-body">
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
                <form name="formkendaraanmasuk" id="formkendaraanmasuk" method="post" action="<?php echo base_url('kendaraan/simpankendaraanmasuk') ?>">

                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="col-sm-2">
                                Pilih Jenis Kendaraan
                            </div>
                            <div class="col-sm-10">
                                <?php echo $this->Modelcombo->combojeniskendaraan('jenis_id'); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
<div class="row mb-3">
    <div class="col-sm-2">
       Harga
    </div>
    <div class="col-sm-10">
    	<input type="text" name="harga" id="harga" class="form-control" readonly="readonly"/>
    </div>
</div>
</div>


<div class="form-group">
<div class="row mb-3">
    <div class="col-sm-2">
       Tanggal Transaksi
    </div>
    <div class="col-sm-10">
    	<input type="date" name="TglMasuk" id="TglMasuk" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly="readonly"/>
    </div>
</div>
</div>

<div class="form-group">
    <div class="row mb-3">
        <div class="col-sm-2">
            Waktu Masuk
        </div>
        <div class="col-sm-10">
            <input type="time" name="waktu_masuk" id="waktu_masuk" class="form-control" readonly="readonly" />
        </div>
    </div>
</div>
                    <!-- Tombol Aksi -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <input type="button" value="Simpan" class="btn btn-primary btn-sm" onClick="simpankendaraanmasuk();">
                                <input type="reset" value="Batal" class="btn btn-warning btn-sm">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</body>
</html>
