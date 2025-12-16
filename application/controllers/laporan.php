<?php
class laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('validasi');
        $this->validasi->validasiakun();
    }

    function index()
{
    // Ambil tanggal dari parameter GET
    $tanggal = $this->input->get('tanggal');  // Mengambil tanggal yang dipilih dari form

    // Panggil tampildata dengan tanggal (jika ada)
    $datalist = $this->tampildata($tanggal);
    
    // Kirim data transaksi dan perhitungan ke view
    $data['table'] = $this->load->view('laporan_view', $datalist, TRUE);
    $this->load->view('admin_view', $data);    
}


    public function tampildata($tanggal = null)
{
    // Jika ada tanggal yang dipilih, tambahkan filter
    if ($tanggal) {
        $this->db->where('DATE(transaksi.TglTransaksi)', $tanggal); // Filter berdasarkan tanggal
    }

    // Ambil data transaksi
    $sql = "SELECT 
                transaksi.transaksi_id,
                transaksi.NoTransaksi, 
                transaksi.TglTransaksi, 
                jeniskendaraan.jeniskendaraan AS jenis_kendaraan, 
                transaksi.harga, 
                transaksi.waktu_masuk, 
                transaksi.waktu_keluar, 
                transaksi.total_harga, 
                transaksi.lama_parkir, 
                transaksi.status 
            FROM 
                transaksi
            LEFT JOIN 
                jeniskendaraan ON transaksi.jenis_id = jeniskendaraan.jenis_id
            ORDER BY 
                transaksi.TglTransaksi DESC";

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $data) {
            $hasil[] = $data;    
        }
    } else {
        $hasil = "";    
    }

    // Menghitung total kendaraan dan total pendapatan
    $this->db->select('COUNT(*) as total_kendaraan, SUM(total_harga) as total_pendapatan');
    if ($tanggal) {
        $this->db->where('DATE(TglTransaksi)', $tanggal); // Jika ada tanggal filter
    }
    $pendapatan_query = $this->db->get('transaksi');
    $pendapatan_result = $pendapatan_query->row();

    $total_kendaraan = $pendapatan_result->total_kendaraan;
    $total_pendapatan = $pendapatan_result->total_pendapatan;

    return [
        'hasil' => $hasil,
        'total_kendaraan' => $total_kendaraan,
        'total_pendapatan' => $total_pendapatan
    ];
}


    function cetak_laporan()
    {
        // Ambil data transaksi dari database
        $data['transaksi'] = $this->tampildata();  // Mengambil semua transaksi

        // Load DOMPDF library
        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
        $pdf = new Dompdf\Dompdf();
        $pdf->setPaper('A4', 'landscape');  // Menyesuaikan kertas dengan A4 landscape
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isPhpEnabled', true);
        $pdf->set_option('isFontSubsettingEnabled', true);
        
        // Memuat view dan mengirimkan data transaksi ke dalam view cetak_laporan
        $pdf->loadHtml($this->load->view('cetak_laporan', $data, true));
        $pdf->render();
        $pdf->stream('Laporan_Transaksi_Parkir.pdf', ['Attachment' => false]); // Menampilkan PDF
    }

	public function pencarian()
{
    // Ambil data pencarian dari form
    $query = $this->input->get('query');

    // Jika ada pencarian
    if (!empty($query)) {
        // Menjalankan query pencarian langsung ke database
        $this->db->like('status', $query); 
        $query_result = $this->db->get('transaksi'); 
        // Menyimpan hasil query ke dalam variabel
        $data['results'] = $query_result->result();
    } else {
        $data['results'] = []; // Jika tidak ada pencarian, hasilnya kosong
    }

    // Kirimkan hasil pencarian ke view
    $this->load->view('admin_view', $data); 
}

}
?>
