
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>Login-Parkirin</title>

        <link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-image: url(img/background.jpg);">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <marquee behavior=" " direction="">
                                        <h3 class="text-center font-weight-light fs-1 my-7"> SELAMAT DATANG DI SISTEM PARKIRIN TOKO SIAR CL</h3>
                                        </marquee>
                                    <div class="text-center">
                                    <img src="<?php echo base_url('img/icon2-02.jpg'); ?> " alt="User Icon" style="width: 500px; height: auto;">
                                    </div>
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
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
									   <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close">
									  </button>
										<?php echo $pesan; ?>                        
										</div>
										
										<?php
										}
										?>
                                        <form name="formlogin" id="formlogin" method="post" action="<?php echo base_url('halaman/proseslogin'); ?>">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="username" />
                                                <label>username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="password" />
                                                <label>password</label>
                                            </div>
                                           
                                            <div class="d-flex justify-content-center mt-4 mb-0">
                                            <a class="btn btn-primary" style="width: 200px;" href="javascript:void(0)" onClick="proseslogin();">Login</a>
                                            </div>

                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                    <div class="copyright text-center my-auto">
                    <span>Copyright &copy; sistem parkir artini 2024</span>
                        <div class="d-flex align-items-center justify-content-between small">
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>js/scripts.js"></script>
       	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script language="javascript">
        	function proseslogin()
			{
				var username=$('#username').val();
				if(username=="")
				{
					alert("username masih kosong");
					$('#username').focus();
					return false;
				}	
				
				var password=$('#password').val();
				if(password=="")
				{
					alert("password masih kosong");
					$('#password').focus();
					return false;
				}
                $('#formlogin').submit();
			}

            $(document).on('keydown', function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Mencegah form reload saat Enter ditekan
            proseslogin(); // Panggil fungsi proseslogin()
        }
    });
        </script>
    </body>
</html>
