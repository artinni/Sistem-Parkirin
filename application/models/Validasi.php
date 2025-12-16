<?php
	class Validasi extends CI_Model
	{
		function validasiakun()
		{
			$level=$this->session->userdata('level');
			if($level=="")
			{
				echo "<script>alert('Maaf anda tidak dapat mengakses halaman ini')</script>";
				redirect('Halaman','refresh');	
			}	
		}	
	}
?>