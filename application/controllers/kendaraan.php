<?php
	class kendaraan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Modelcombo');
			$this->load->model('validasi');
			$this->validasi->validasiakun();
		}
		
		function index() // untuk kendaraan masuk
		{
			$datalist['hasil']=$this->tampildata();
			$data['konten']=$this->load->view('kendaraanmasuk_view','',TRUE);
			$data['table']=$this->load->view('kendaraanmasuk_table', $datalist,TRUE);
			$this->load->view('admin_view',$data);	
		}


		function simpankendaraanmasuk()
		{
			$jenis_id=$this->input->post('jenis_id');
			$harga=$this->input->post('harga');
			$TglMasuk=$this->input->post('TglMasuk');
			$waktu_masuk=$this->input->post('waktu_masuk');
			
			$data=array(
				'jenis_id'=>$jenis_id,
				'harga'=>$harga,
				'TglMasuk'=>$TglMasuk,
				'waktu_masuk'=>$waktu_masuk,
				'status'=>"Masuk"
			);
			
			$this->db->insert('kendaraan',$data);
			$this->session->set_flashdata('pesan','Data sudah disimpan...');
			redirect('kendaraan/index','refresh');
			
		}

		function tampildata() //menggabungkan dua tabel berbeda dengan menggunakan primarykey jenis_id dari tabel jeniskendaraan dan tabel kendaraan
{
    $sql = "SELECT
        kendaraan.*, jeniskendaraan.jeniskendaraan
    FROM
        kendaraan
    LEFT JOIN
        jeniskendaraan ON kendaraan.jenis_id = jeniskendaraan.jenis_id
    WHERE
        Status = 'Masuk'";
        
    $query = $this->db->query($sql);

    if ($query->num_rows() > 0) {
        return $query->result(); // Kembalikan semua data
    } else {
        return []; // Kembalikan array kosong jika tidak ada data
    }
}

function hapusmasuk($kendaraan_id)
{
	$sql="delete from kendaraan where kendaraan_id='".$kendaraan_id."'";
	 $this->db->query($sql); //jalankan querry

	redirect('kendaraan/index', 'refresh');
}


		public function caridatakendaraan($jenis_id)
		{
			// Cari data kendaraan berdasarkan jenis_id
			$query = $this->db->get_where('jeniskendaraan', ['jenis_id' => $jenis_id]);
			
			// Jika data ditemukan, kembalikan harga
			if ($query->num_rows() > 0) {
				$data = $query->row();
				echo $data->harga; // Kirim harga sebagai plain text
			} else {
				echo ""; // Kosong jika data tidak ditemukan
			}
		}

		function KodeMasuk()
		{
			$kata="ABC123456789";
			$nomoracak=substr(str_shuffle($kata),0,4);	
			$KodeMasuk="SR-".$nomoracak;
			return $KodeMasuk;
		}
		

		function selesaidancetak_masuk()
		{
			// Generate nomor kendaraan baru
			$KodeMasuk = $this->KodeMasuk();
		
			// Update kolom KodeMasuk dan Status di tabel kendaraan
			$this->db->set('KodeMasuk', $KodeMasuk);
			$this->db->set('status', 'Parkir');
			$this->db->where('KodeMasuk', NULL); // Cek untuk nilai NULL
			$this->db->or_where('KodeMasuk', ''); // Cek untuk string kosong
			$this->db->update('kendaraan');
		
			// Debugging: cek apakah data berhasil diperbarui
			if ($this->db->affected_rows() > 0) {
				echo "Data berhasil diperbarui dengan KodeMasuk: " . $KodeMasuk;
			} else {
				echo "Gagal memperbarui data. Pastikan kondisi WHERE cocok.";
			}
		
			// Cetak nota
			$this->cetak_masuk();
		}

		function cetak_masuk()
		{
			// Ambil data kendaraan terbaru berdasarkan status atau kriteria tertentu
			$this->db->select('kendaraan.*, jeniskendaraan.jeniskendaraan');
    $this->db->from('kendaraan');
    $this->db->join('jeniskendaraan', 'kendaraan.jenis_id = jeniskendaraan.jenis_id', 'left');
    $this->db->where('status', 'Parkir');
    $this->db->order_by('kendaraan_id', 'DESC');
    $this->db->limit(1);

	$query = $this->db->get();
    $data['kendaraan'] = $query->row(); // Ambil data baris pertama (terbaru)

		
			// Pastikan data ditemukan
			if ($data['kendaraan']) {
				$qrCodePath = $this->generateQRCode($data['kendaraan']->KodeMasuk);
				$data['qrCodePath'] = $qrCodePath; // Tambahkan path QR Code ke data
		

				require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
				$pdf = new Dompdf\Dompdf();
				$pdf->setPaper('B8', 'portrait');
				$pdf->set_option('isRemoteEnabled', TRUE);
				$pdf->set_option('isHtml5ParserEnabled', true);
		
				// Load tampilan dengan data kendaraan
				$pdf->loadHtml($this->load->view('cetak_masuk', $data, true));
				$pdf->render();
				$pdf->stream('Nota Kendaraan Masuk', ['Attachment' => false]);
			} 
		}

		private function generateQRCode($KodeMasuk)
{
    include(APPPATH . 'libraries/qrcode/qrlib.php'); // Include library QR Code

    // URL untuk endpoint detail kendaraan
    $url = base_url('kendaraan/cetak_masuk/' . $KodeMasuk);

    // Path ke folder publik
    $tempDir = FCPATH . 'assets/qr/';
    if (!file_exists($tempDir)) {
        mkdir($tempDir, 0755, true); // Buat folder jika belum ada
    }
    $filePath = $tempDir . $KodeMasuk . '.png';

    // Generate QR Code
    QRcode::png($url, $filePath, QR_ECLEVEL_L, 4);

    // Return path relatif (untuk HTML view)
    return base_url('assets/qr/' . $KodeMasuk . '.png');
}
	

	}
		
?>