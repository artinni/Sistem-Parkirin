<?php
	class transaksi extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Modelcombo');
			$this->load->model('validasi');
			$this->validasi->validasiakun();
		}
		
		function index() // untuk menu kendaraan keluar
		{
			$datalist['hasil']=$this->tampildata();
			$data['konten']=$this->load->view('keluar_view','',TRUE);
			$data['table']=$this->load->view('keluar_table', $datalist,TRUE);
			$this->load->view('admin_view',$data);	
		}


		function simpankendaraankeluar() {
            // $transaksi_id = $this->input->post('transaksi_id');
            $TglTransaksi = $this->input->post('TglTransaksi');
            $jenis_id = $this->input->post('jenis_id'); // jenis_id yang diinputkan
            $harga = $this->input->post('harga'); // Harga dasar yang diinputkan (untuk 1 jam pertama)
            $TglMasuk = $this->input->post('TglMasuk');
            $waktu_masuk = $this->input->post('waktu_masuk');
            $waktu_keluar = $this->input->post('waktu_keluar');
        
            // Menghitung selisih waktu parkir dalam menit
            $datetime_masuk = new DateTime($waktu_masuk);
            $datetime_keluar = new DateTime($waktu_keluar);
            $interval = $datetime_masuk->diff($datetime_keluar);
            $selisih_menit = ($interval->h * 60) + $interval->i;
        
            // Query untuk mendapatkan jenis kendaraan dan harga per 30 menit berdasarkan jenis_id
            $this->db->select('jeniskendaraan.jeniskendaraan as jenis_kendaraan');
            $this->db->from('jeniskendaraan');
            $this->db->where('jenis_id', $jenis_id);
            $query = $this->db->get();
        
            if ($query->num_rows() > 0) {
                $jenis_kendaraan = $query->row()->jenis_kendaraan;
            } else {
                // Jika tidak ditemukan jenis kendaraan, set default
                $jenis_kendaraan = 'Unknown';
            }
        
            // Tentukan harga per 30 menit berdasarkan jenis kendaraan
            if ($jenis_kendaraan == 'Motor') {
                $harga_per_30menit = 1000; // 1000 untuk motor setiap 30 menit
            } elseif ($jenis_kendaraan == 'Mobil') {
                $harga_per_30menit = 2000; // 2000 untuk mobil setiap 30 menit
            }
        
            if ($selisih_menit <= 30) {
                // Jika waktu parkir kurang dari atau sama dengan 30 menit, harga tetap
                $total_harga = $harga;
            } else {
                // Hitung biaya tambahan berdasarkan blok 30 menit
                $total_menit = ceil($selisih_menit / 30); // Total blok 30 menit
                $total_harga = $harga + (($total_menit - 1) * $harga_per_30menit); // Harga pertama untuk 30 menit sudah dihitung, jadi dikurangi 1
            }
        
            // Membuat data transaksi untuk disimpan
            $data = array(
                // 'transaksi_id' => $transaksi_id,
                'TglTransaksi' => $TglTransaksi,
                'jenis_id' => $jenis_id,
                'harga' => $harga,
                'TglMasuk' => $TglMasuk,
                'waktu_masuk' => $waktu_masuk,
                'waktu_keluar' => $waktu_keluar,
                'total_harga' => $total_harga,
                'lama_parkir' => $selisih_menit,
                'status' => "Parkir"
            );
        
            // Simpan ke database
            $this->db->insert('transaksi', $data);
            $this->session->set_flashdata('pesan', 'Data sudah disimpan...');
            redirect('transaksi/index', 'refresh');
        }
        
        
        

		function tampildata() //menggabungkan dua tabel berbeda dengan menggunakan primarykey jenis_id dari tabel jeniskendaraan dan tabel transaksi
{
    $sql = "SELECT
        transaksi.*, jeniskendaraan.jeniskendaraan
    FROM
        transaksi
    LEFT JOIN
        jeniskendaraan ON transaksi.jenis_id = jeniskendaraan.jenis_id
    WHERE
        Status = 'Parkir'";
        
    $query = $this->db->query($sql);

    if ($query->num_rows() > 0) {
        return $query->result(); // Kembalikan semua data
    } else {
        return []; // Kembalikan array kosong jika tidak ada data
    }
}

public function getKendaraanByKodeMasuk()
{
    $KodeMasuk = $this->input->post('KodeMasuk'); // Ambil input dari AJAX

    if (!$KodeMasuk) {
        echo json_encode(['status' => 'error', 'message' => 'Masukan Kode Dengan Benar']);
        
    }

    // Cek log KodeMasuk
    log_message('debug', 'KodeMasuk yang diterima: ' . $KodeMasuk);

    // Query untuk mendapatkan data kendaraan
    $this->db->select('jenis_id, harga, TglMasuk, waktu_masuk');
    $this->db->from('kendaraan');
    $this->db->where('KodeMasuk', $KodeMasuk);
    $query = $this->db->get();

    // Log query yang dijalankan
    log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

    if ($query->num_rows() > 0) {
        echo json_encode($query->row_array());
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data kendaraan tidak ditemukan!']);
    }
}

		function hapuskeluar($transaksi_id)
		{
			$sql="delete from transaksi where transaksi_id='".$transaksi_id."'";
			 $this->db->query($sql); //jalankan querry

			redirect('transaksi/index', 'refresh');
		}


		function NoTransaksi()
		{
			$kata="ABCDEFG123456789";
            $Tahun=date('Y');
			$Bulan=date('m');
			$nomoracak=substr(str_shuffle($kata),0,4);	
			$NoTransaksi="SR-".$Tahun.$Bulan.$nomoracak;
			return $NoTransaksi;
		}
		

		function selesaidancetak_keluar()
		{
			// Generate nomor transaksi baru
			$NoTransaksi = $this->NoTransaksi();
		
			// Update kolom NoTransaksi dan Status di tabel transaksi
			$this->db->set('NoTransaksi', $NoTransaksi);
			$this->db->set('status', 'Keluar');
			$this->db->where('NoTransaksi', NULL); // Cek untuk nilai NULL
			$this->db->or_where('NoTransaksi', ''); // Cek untuk string kosong
			$this->db->update('transaksi');
		
			// Debugging: cek apakah data berhasil diperbarui
			if ($this->db->affected_rows() > 0) {
				echo "Data berhasil diperbarui dengan NoTransaksi: " . $NoTransaksi;
			} else {
				echo "Gagal memperbarui data. Pastikan kondisi WHERE cocok.";
			}
		
			// Cetak nota
			$this->cetak_keluar();
		}

		function cetak_keluar()
		{
			// Ambil data transaksi terbaru berdasarkan status atau kriteria tertentu
			$this->db->select('transaksi.*, jeniskendaraan.jeniskendaraan');
    $this->db->from('transaksi');
    $this->db->join('jeniskendaraan', 'transaksi.jenis_id = jeniskendaraan.jenis_id', 'left');
    $this->db->where('status', 'Keluar');
    $this->db->order_by('transaksi_id', 'DESC');
    $this->db->limit(1);

	$query = $this->db->get();
    $data['transaksi'] = $query->row(); // Ambil data baris pertama (terbaru)

		
    require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
    $pdf = new Dompdf\Dompdf();
    $pdf->setPaper('B8', 'potarit');
    $pdf->set_option('isRemoteEnabled', TRUE);
    $pdf->set_option('isHtml5ParserEnabled', true);
    $pdf->set_option('isPhpEnabled', true);
    $pdf->set_option('isFontSubsettingEnabled', true);
    
    $pdf->loadHtml($this->load->view('cetak_keluar', $data, true));
    $pdf->render();
    $pdf->stream('Nota Pembelian', ['Attachment' => false]); 
		}

	}
		
?>