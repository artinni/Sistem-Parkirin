<script>
$(document).ready(function(){
  $("#Kembalian").click(function(){
     var UangKonsumen = $('#UangKonsumen').val();
	 var TotalBayar = $('#TotalBayar').val();
	 if(UangKonsumen=="")
	 {
		alert('Uang konsumen kosong');
		$('#UangKonsumen').focus();
		return false;	 
	 }
	 
	 var Kembalian = parseInt(UangKonsumen - TotalBayar);
	 $('#Kembalian').val(Kembalian);
  });
});
</script>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Form Kendaraan Keluar</h4>
            <?php
                    $level = $this->session->userdata('level');
                    ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tgl Transaksi</th>
                            <th>Jenis Kendaraan</th>
                            <th>Harga</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
	if(empty($hasil))
	{
		echo "";
		$TotalBayar=0;	
	}
	else
	{
		$no=1;
		$TotalBayar=0;
		foreach($hasil as $data):
	?>
                                <tr>
                                    <td><?php echo htmlspecialchars($no); ?></td>

                                    <td><?php echo htmlspecialchars($data->TglTransaksi ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($data->jeniskendaraan ?? '-'); ?></td>
                                    <td><?php echo "Rp " . number_format($data->harga, 0, ',', '.'); ?></td>
                                    <td><?php echo htmlspecialchars($data->waktu_masuk ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($data->waktu_keluar ?? '-'); ?></td>
                                    <td width="200"><?php echo "Rp " . number_format($data->total_harga, 0, ',', '.'); ?></td>
                                    <td width="150">
                                         <input type="button" value="Hapus" class="btn btn-sm btn-danger" onclick="hapuskeluar('<?php echo htmlspecialchars($data->transaksi_id ?? ''); ?>')"/>
                                    </td>
                                </tr>
                            <?php
                            $TotalBayar = $TotalBayar + $data->total_harga;
                            $no++;
                            endforeach;
                        }
                        ?>

<tr>
    	<td colspan="6" align="right"><b>Total Bayar</b></td>
        <td><b><?php echo "Rp " . number_format($TotalBayar, 0, ',', '.'); ?></b></td>
        <td></td>
    </tr>

    
    <input type="hidden" name="TotalBayar"  id="TotalBayar" value="<?php echo $TotalBayar; ?>"/>
    
     <tr>
    	<td colspan="6" align="right"><b>Uang Konsumen</b></td>
        <td><input type="text" name="UangKonsumen" id="UangKonsumen" class="form-control"/></td>
        <td></td>
    </tr>
    
    <tr>
    	<td colspan="6" align="right"><b>Kembalian</b></td>
        <td><input type="text" name="Kembalian" id="Kembalian" class="form-control"/></td>
        <td><input type="button" value="Selesai dan Cetak" class="btn btn-sm btn-primary" onclick="cetak_keluar();"/></td>
    </tr>

                    </tbody>
                </table>
                <script language="javascript">
  	function hapuskeluar(transaksi_id) {
                        if (confirm("Apakah anda yakin menghapus data ini?")) {
                            window.open("<?php echo base_url(); ?>transaksi/hapuskeluar/" + transaksi_id, "_self");
                        }
                    }

    function cetak_keluar()
	{
        var Kembalian=$('#Kembalian').val();
		if(Kembalian=="")
		{
			alert ('Data belum lengkap');
			return false;	
		}

		if(confirm("Apakah yakin selesaikan transaksi ini?"))
		{
			window.open("<?php echo base_url()?>transaksi/selesaidancetak_keluar", "_self");
		}	
	}
                </script>
                
            </div>
        </div>
    </div>
</div>
