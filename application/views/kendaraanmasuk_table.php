
    <div class="container mt-4">
        <div class="card">
            <div >
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
                                <th>Jenis Kendaraan</th>
                                <th>Harga</th>
                                <th>Waktu Masuk</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (empty($hasil)) {
                                echo "<tr><td colspan='6'>Data tidak tersedia</td></tr>";
                            } else {
                                $no = 1;
                                foreach ($hasil as $data): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($no); ?></td>
                                        <td><?php echo htmlspecialchars($data->jeniskendaraan ?? '-'); ?></td>
                                        <td><?php echo "Rp " . number_format($data->harga, 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($data->waktu_masuk ?? '-'); ?></td>
                                        <td><?php echo htmlspecialchars($data->status ?? '-'); ?></td>
                                        <td width="150">
                                            <input type="button" value="cetak" class="btn btn-sm btn-warning" onclick="cetak_masuk();"/>
                                            <?php 
                                        if($level=="Admin")
                                        {
                                            ?>
                                            <input type="button" value="Hapus" class="btn btn-sm btn-danger" onclick="hapusmasuk('<?php echo htmlspecialchars($data->kendaraan_id ?? ''); ?>')"/>
                                            <?php } ?>
                                            
                                        </td>
                                
                                    </tr>
                                <?php
                                    $no++;
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                    <script language="javascript">
        function hapusmasuk(kendaraan_id) {
                            if (confirm("Apakah anda yakin menghapus data ini?")) {
                                window.open("<?php echo base_url(); ?>kendaraan/hapusmasuk/" + kendaraan_id, "_self");
                            }
                        }

        function cetak_masuk()
        {
            if(confirm("Apakah yakin selesaikan transaksi ini?"))
            {
                window.open("<?php echo base_url()?>kendaraan/selesaidancetak_masuk", "_self");
            }	
        }

                    </script>
                    
                </div>
            </div>
        </div>
    </div>
