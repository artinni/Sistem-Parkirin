
<script language="javascript">
   
        // Fungsi untuk validasi dan submit data
        function simpanjeniskendaraan() {
            var jeniskendaraan = $('#jeniskendaraan').val();
            if (jeniskendaraan == "") {
                alert("Nama jenis kendaraan masih kosong...");
                $('#jeniskendaraan').focus();
                return false;
            }

            var harga = $('#harga').val();
            if (harga == "") {
                alert("Harga masih kosong...");
                $('#harga').focus();
                return false;
            }

            $('#formjeniskendaraan').submit(); // Submit form jika validasi berhasil
        }

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                <h5 class="mb-0">Form Jenis Kendaraan</h5>
            </div>
            <div class="card-body">
            <?php
	$pesan=$this->session->flashdata('pesan');
	if ($pesan=="")
	{
		echo "";	
	}
	else
	{

	?>
	
	<div class="alert alert-success alert-dismissible fade show" role="alert">
   <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close">
  </button>
	<?php echo $pesan; ?>                        
	</div>
	
	<?php
	}
	?>
            <!-- View (parkir_view.php) -->
                  <form name="formjeniskendaraan" id="formjeniskendaraan" method="post" action="<?php echo base_url('jeniskendaraan/simpandata') ?> ">
                  <input type="hidden" name="jenis_id" id="jenis_id"/>
                  <div class="form-group">
                    <div class="row mb-3">
                        <div class="col-sm-2">
                         Jenis Kendaraan
                        </div>
                        <div class="col-sm-10">
                        <input type="text" name="jeniskendaraan" id="jeniskendaraan" class="form-control" required/>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="row mb-3">
                        <div class="col-sm-2">
                         Harga Parkir
                        </div>
                        <div class="col-sm-10">
                        <input type="text" name="harga" id="harga" class="form-control"required/>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="row mb-3">
                        <div class="col-sm-2">
                         Harga per waktu
                        </div>
                        <div class="col-sm-10">
                        <input type="text" name="harga" id="harga" class="form-control"required/>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="row mb-3">
                        <div class="col-sm-2">
                         waktu
                        </div>
                        <div class="col-sm-10">
                        <input type="text" name="harga" id="harga" class="form-control"required/>
                        </div>
                    </div>
                    </div>
      </form>

                    <!-- Tombol Aksi -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"></div> 
                            <div class="col-sm-9">
                            <input type="button" value="Simpan" class="btn btn-primary btn-sm " onClick="simpanjeniskendaraan();">
                            <input type="reset" value="Batal" class="btn btn-warning btn-sm ">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>