<?php
	class Modelcombo extends CI_Model
	{
		function combojeniskendaraan($namafield)
		{
			$sql="select * from jeniskendaraan";
			$query=$this->db->query($sql);

			$data[""]="Pilih";
			$no=1;
			foreach ($query->result() as $row )
			{
				$data[$row->jenis_id]=$no.") ".$row->jeniskendaraan;
				$no++;
			}
			echo form_dropdown($namafield,$data,"","class='form-control' id='".$namafield."'");

		}
		
		public function get_harga($jenis_id) {
			$sql = "SELECT harga FROM jeniskendaraan WHERE jenis_id = ?";
			$query = $this->db->query($sql, array($jenis_id));
			if ($query->num_rows() > 0) {
				return $query->row()->harga;
			}
			return null;
		}

	
	}
?>