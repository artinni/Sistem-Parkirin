<?php
	class Jeniskendaraan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('validasi');
			$this->validasi->validasiakun();
		}
		// memunculkan tabel dan konten [] ini array yang menyimpan 1 variabel
		function index()
		{
			$datalist['hasil']=$this->tampildata();
			$data['konten']=$this->load->view('jeniskendaraan_view','',TRUE);
			$data['table']=$this->load->view('jeniskendaraan_table', $datalist,TRUE);
			$this->load->view('admin_view',$data);	
		}
		
		function simpandata() {
			$jenis_id = $this->input->post('jenis_id');
			$jeniskendaraan = $this->input->post('jeniskendaraan');
			$harga = $this->input->post('harga');
			$hargawaktu = $this->input->post('hargawaktu');
			$waktu = $this->input->post('waktu');
			
			$data = array(
				'jeniskendaraan' => $jeniskendaraan,
				'harga' => $harga,
				'hargawaktu' => $hargawaktu,
				'waktu' => $waktu
			);
		
			if($jenis_id == "") {
				// Jika jenis_id kosong, berarti data baru
				$this->db->insert('jeniskendaraan', $data);
				$this->session->set_flashdata('pesan', 'Data anda sudah disimpan');
			} else 
			{
				// $update=array(
				// 	'jenis_id'=>$jenis_id
				// );
				// Jika ada jenis_id, berarti update data yang ada
				$this->db->where('jenis_id', $jenis_id);
				$this->db->update('jeniskendaraan', $data); // Gunakan $data, bukan $update
				$this->session->set_flashdata('pesan', 'Data sudah diedit');
			}
			
			redirect('jeniskendaraan', 'refresh');
		}

		// foreach sama dengan looping
		// logika kita queri buat sintaks dijalankan ada hasilnya karna data banyak makanya memakai foreach
		function tampildata()
		{
			$sql="select * from jeniskendaraan";
			$query=$this->db->query($sql);
			if($query->num_rows()>0)
			{
				foreach($query->result() as $data)
				{
					$hasil[]=$data;
				}
			}
			else{
				$hasil="";
			}
			return $hasil;
		}

		function hapusdata($jenis_id)
		{
			$sql="delete from jeniskendaraan where jenis_id='".$jenis_id."'";
			 $this->db->query($sql); //jalankan querry

			redirect('jeniskendaraan', 'refresh');
		}

		public function editdata($jenis_id)
		{
			$this->db->where('jenis_id', $jenis_id);
			$query = $this->db->get('jeniskendaraan');
			
			if ($query->num_rows() > 0) {
				$data = $query->row();
				$response = array(
					'jenis_id' => $data->jenis_id,
					'jeniskendaraan' => $data->jeniskendaraan,
					'harga' => $data->harga
				);
				echo json_encode($response);
			} else {
				echo json_encode(null);
			}
		}
		// function editdata($jenis_id)
		// {
		// 	$sql="select * from jeniskendaraan where ";
		// 	$sql.="jenis_id='".$jenis_id."'";	
		// 	$query=$this->db->query($sql);
		// 	if($query->num_rows()>0)
		// 	{
		// 		$data=$query->row();
		// 		echo "<script>$('#jenis_id').val('".$data->jenis_id."')</script>";
		// 		echo "<script>$('#jeniskendaraan').val('".$data->jeniskendaraan."')</script>";
		// 		echo "<script>$('#harga').val('".$data->harga."')</script>";

		// 	}
		// }
	}
	
	
?>