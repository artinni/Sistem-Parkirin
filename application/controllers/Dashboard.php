<?php
	class Dashboard extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('validasi');
			$this->validasi->validasiakun();
		}

		function admin()
		{
			$this->load->view('admin_view');	
		}


		function logout()
		{
			$this->session->sess_destroy();
			redirect('Halaman','refresh');
		}

		// public function pencarian()
		// {
		// 	// Ambil data pencarian dari form
		// 	$query = $this->input->get('query');
		
		// 	if (!empty($query)) {
		// 		// Gabungkan tabel kendaraan dan pemilik menggunakan JOIN
		// 		$this->db->select('kendaraan.*, KodeM'); // Gantilah kolom sesuai kebutuhan Anda
		// 		$this->db->from('kendaraan');
		// 		$this->db->join('pemilik', 'pemilik.id = kendaraan.pemilik_id'); // Sesuaikan dengan relasi antar tabel
		// 		$this->db->like('kendaraan.nama_kendaraan', $query); // Pencarian di kolom nama_kendaraan
		// 		$this->db->or_like('pemilik.nama', $query); // Pencarian di kolom nama pemilik
		// 		$query_result = $this->db->get();
		
		// 		// Simpan hasil pencarian ke dalam variabel
		// 		$data['results'] = $query_result->result();
		// 	} else {
		// 		$data['results'] = [];
		// 	}
		
		// 	// Kirimkan data hasil pencarian ke view
		// 	$this->load->view('view_name', $data); // Gantilah dengan nama view yang sesuai
		// }
		



	}
?>