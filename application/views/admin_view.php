
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Parkir</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>      


    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #0b1957" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('dashboard/admin'); ?>">
                <div class="sidebar-brand-icon ">
                <i class="fa fa-bicycle" aria-hidden="true"></i>
                </div>
                <div class="sidebar-brand-text mx-1">SISTEM PARKIR SIAR CL<br>
                <!-- <?php
                $level = $this->session->userdata('level');
                    if ($level == "Admin") {
                        echo "Admin";
                    } else {
                        echo "Kasir";
                    }
                    ?> -->
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('dashboard/admin'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            


            <!-- Heading -->
            <div class="sidebar-heading">
                TRANSAKSI
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php 
             if($level=="Kasir")
             {
             ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-car"></i>
                    <span>Kendaraan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Transaksi Kendaraan</h6>
                        <a class="collapse-item" href="<?php echo base_url('kendaraan') ?>">Masuk</a>
                        <a class="collapse-item" href="<?php echo base_url('transaksi') ?>">Keluar</a>
                    </div>
                </div>
            </li>
            <?php 
        } ?>

            <?php 
             if($level=="Admin")
             {
             ?>
             <!-- masuk ke jeniskendaraan yang ada di controller tanpa membuat fungsi -->
            <li class="nav-item">
                 <a class="nav-link collapsed" href="<?php echo base_url('jeniskendaraan') ?>"   
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <span>Jenis Kendaraan</span>
                </a>
            <?php 
        } ?>
            

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('laporan') ?>">
                <i class="fa fa-file" aria-hidden="true"></i>
                    <span>Laporan</span></a>
            </li>

            <?php 
             if($level=="Admin")
             {
             ?>

            <!-- Heading -->
            <div class="sidebar-heading">
                LAINNYA
            </div>

            <!-- Nav Item - Charts -->

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                <i class="fa fa-tag" aria-hidden="true"></i>
                    <span>Data Kasir</span></a>
            </li>
            <?php 
             
             }
             ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="card-header">
                                        <marquee behavior=" " direction="">
                                        <h3 class="text-center font-weight-light fs-1 my-7"> SELAMAT DATANG DI SISTEM PARKIRIN TOKO SIAR CL</h3>
                                        </marquee>
                                    <div class="text-center">
                                    </div>
                                </div>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Search -->
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="#">
    <div class="input-group">
        <input id="search-input" type="text" name="query" class="form-control bg-light border-0 small" placeholder="Pencarian" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn" style="background-color: #0b1957; color:white" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form> -->



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 large"><?php echo $this->session->userdata('nama'); ?></span>
                                <div> 
                                <i class="fa fa-user" aria-hidden="true" ></i>
                                </div>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="<?php echo base_url('dashboard/logout'); ?>">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
</div>

                            
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800">DASHBOARD 
                        <?php
                    $level = $this->session->userdata('level');
                    if ($level == "Admin") {
                        echo "ADMIN";
                    } else {
                        echo "KASIR";
                    }
                    ?> </h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-10">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-10" style="font-size:large">
                                               <a href="<?php echo base_url ('kendaraan/index') ?>" style="color: #4e73df">KENDARAAN MASUK</a>
                                               
                                            </div>
                                            </div>
                                        <div class="col-auto">
                                            <i class="fa fa-download fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-10">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size:large">                                               
                                            <a href="<?php echo base_url('transaksi') ?>" style="color: #1cc88a">KENDARAAN KELUAR</a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-upload fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                         
                        
                        <div class="col-xl-3 col-md-6 mb-10">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size:large" >                                                
                                                <a href="<?php echo base_url('laporan') ?>" style="color: #e74a3b">LAPORAN</a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file fa-2x text-danger"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </li>
                        </ul>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-10">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size:large">
                                            <a href="" style="color: #f6c23e">KASIR</a>
                                            </div>
                                                </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-circle fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
						if(empty($konten))
						{
							echo "";	
						}
						else
						{
							echo $konten;	
						}
						?>
                        
                        <?php
						if(empty($table))
						{
							echo "";	
						}
						else
						{
							echo $table;	
						}
						?>    
                    </div>

                    <!-- Content Row -->
                        </div>
                    </div>

                    <!-- Content Row -->
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; sistem kasir artini 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- tambahkan sintaks, sebelumnya copy paste 2 folder ke project -->
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                  <!-- JavaScript untuk Fitur Pencarian -->

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll("#productTable tbody tr");
        
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(filter) ? "" : "none";
                });
            });
</script>

</body>

</html>