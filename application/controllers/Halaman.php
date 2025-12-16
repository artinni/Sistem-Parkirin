<?php 
class Halaman extends CI_Controller 
{
  
    function index() 
    { 
        $this->load->view('login_view'); 
    } 

    function proseslogin() 
    { 
        //ambil data dari form 
		$username = $this->input->post('username');
        $password = $this->input->post('password'); 

        //sintak query untuk cek data username di tb = form 
        $sql = "select * from user where username= ? "; 
        $query = $this->db->query($sql, array($username)); 

        if ($query->num_rows() > 0) 
        { 
            //jika username ada 
            $data = $query->row(); //ambil semua field di tb 
            if ($data->password == $password) //pwd tb = form 
            { 
                $array = array( 
                    'user_id' => $data->user_id, 
                    'username' => $data->username, 
                    'nama' => $data->nama, 
                    'level' => $data->level, 
                ); 
                $this->session->set_userdata($array); 
                redirect('Dashboard/admin', 'refresh'); //halaman admin 
            } 
            else //jika pwd != form 
            { 
                $this->session->set_flashdata('pesan', 'password Salah...'); 
                redirect('halaman', 'refresh'); //halaman login 
            } 
        } 
        else 
        { 
            $this->session->set_flashdata('pesan', 'Username dan password Salah...'); 
            redirect('halaman', 'refresh'); 
        } 
    } 
}
?>