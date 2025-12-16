<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Laporan Parkir</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <style>
        .header-section {
            background-color: #f8f9fc;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .summary-card {
            border-left: 4px solid #4e73df;
            margin-bottom: 1.5rem;
        }

        .table-header {
            background-color: #4e73df;
            color: white;
        }

        .status-active {
            color: #1cc88a;
        }

        .status-completed {
            color: #858796;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="header-section d-flex align-items-center justify-content-center">
            <div class="container text-center">
                <h1 class="h3 text-gray-800 mb-2">Sistem Laporan Parkir</h1>
                <p class="text-muted mb-0">Laporan aktivitas parkir dan transaksi</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container">
            <!-- Summary Cards -->
            <div class="row mb-4">
    <!-- Total Kendaraan -->
    <div class="col-xl-3 col-md-6">
        <div class="card summary-card h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Kendaraan Hari Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_kendaraan, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendapatan Hari Ini -->
    <div class="col-xl-3 col-md-6">
        <div class="card summary-card h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pendapatan Hari Ini
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_pendapatan, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



            <div class="row mb-3">
    Tanggal Filter
    <form method="get" action="<?= base_url('laporan/index') ?>">
    <input type="date" name="tanggal" class="form-control" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ?>">
    <button type="submit" class="btn btn-primary mt-2">Filter</button>
</form>


    <!-- Search Feature -->
    <div class="mb-3">
        	<input type="text" id="searchInput" class="form-control" placeholder="Pencarian...">
  		</div>
</div>
            </div>

            <!-- Data Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 table-header">
                    
                    <h6 class="m-0 font-weight-bold">Laporan Transaksi Parkir</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="laporanTable">
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

                                <?php if (!empty($hasil)) : ?>
                                    <?php $no = 1; foreach ($hasil as $data) : ?>
                                        <tr data-tanggal="<?= $data->TglTransaksi; ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->TglTransaksi; ?></td>
                                            <td><?= $data->NoTransaksi; ?></td>
                                            <td><?= $data->jenis_kendaraan; ?></td>
                                            <td><?= number_format($data->harga, 0, ',', '.'); ?></td>
                                            <td><?= $data->waktu_masuk; ?></td>
                                            <td><?= $data->waktu_keluar; ?></td>
                                            <td><?= number_format($data->total_harga, 0, ',', '.'); ?></td>
                                            <td><?= $data->lama_parkir; ?> menit</td>
                                            <td><?= $data->status; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data transaksi</td>
                                    </tr>
                                <?php endif; ?>
                                
                                
                            </tbody>
                        </table>
                        <tr>
                                <td><input type="button" value="Selesai dan Cetak" class="btn btn-sm btn-primary" onclick="cetak_laporan();"/></td>

                                </tr>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                  <!-- JavaScript untuk Fitur Pencarian -->

    <script>
       $(document).ready(function () {
    var table = $('#laporanTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "info": true
    });

    // Filter berdasarkan tanggal
    $('#filterDate').on('change', function () {
        var selectedDate = $(this).val(); // Mengambil tanggal yang dipilih (format YYYY-MM-DD)
        
        if (selectedDate) {
            var dataFound = false; // Flag untuk mengecek apakah ada data yang sesuai

            table.rows().every(function () {
                var rowDate = $(this.node()).data('tanggal'); // Mendapatkan tanggal dari data-attribute
                
                if (rowDate === selectedDate) {
                    $(this.node()).show(); // Menampilkan baris yang sesuai
                    dataFound = true; // Menandakan ada data yang cocok
                } else {
                    $(this.node()).hide(); // Menyembunyikan baris yang tidak sesuai
                }
            });

            if (!dataFound) {
                // Jika tidak ada data yang cocok, tampilkan pesan "Tidak ada data transaksi"
                $('#laporanTable tbody').html('<tr><td colspan="10" class="text-center">Tidak ada transaksi pada tanggal ini</td></tr>');
            }
        } else {
            // Jika tidak ada tanggal yang dipilih, tampilkan semua data
            table.rows().show();
        }
    });

    // Pencarian
    $('#searchInput').on('keyup', function () {
        table.search(this.value).draw();
    });
});


function cetak_laporan()
	{
       

		if(confirm("Apakah yakin selesaikan transaksi ini?"))
		{
			window.open("<?php echo base_url()?>laporan/cetak_laporan", "_self");
		}	
	}


            document.getElementById("searchInput").addEventListener("keyup", function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll("#laporanTable tbody tr");
        
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(filter) ? "" : "none";
                });
            });



    </script>
</body>

</html>
