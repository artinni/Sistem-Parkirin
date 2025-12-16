<!-- Tampilan Tabel -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container mt-6">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Data Jenis Kendaraan</h4>
            <p class="mb-0 text-center">Jenis kendaraan dan harga</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Jenis Kendaraan</th>
                            <th>Harga</th>
                            <th>hargawaktu</th>
                            <th>waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($hasil)) {
                            echo "<tr><td colspan='6'>Data tidak tersedia</td></tr>";
                        } else {
                            $no = 01;
                            foreach ($hasil as $data): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($no); ?></td>
                                    <td><?php echo htmlspecialchars($data->jeniskendaraan ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($data->harga ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($data->hargawaktu ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($data->waktu ?? '-'); ?></td>
                                    <td width="150">
                                        <input type="button" value="edit" class="btn btn-sm btn-primary" onclick="editdata('<?php echo htmlspecialchars($data->jenis_id ?? ''); ?>')"/>
                                        <input type="button" value="hapus" class="btn btn-sm btn-danger" onclick="hapusdata('<?php echo htmlspecialchars($data->jenis_id ?? ''); ?>')"/>
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
                    function hapusdata(jenis_id) {
                        if (confirm("Apakah anda yakin menghapus data ini?")) {
                            window.open("<?php echo base_url(); ?>jeniskendaraan/hapusdata/" + jenis_id, "_self");
                        }
                    }

                    function editdata(jenis_id) {
    $.ajax({
        url: "<?php echo base_url('jeniskendaraan/editdata/'); ?>" + jenis_id,
        type: "GET",
        dataType: "json",
        success: function(response) {
            if(response) {
                // Isi form dengan data yang diterima
                document.getElementById('jenis_id').value = response.jenis_id;
                document.getElementById('jeniskendaraan').value = response.jeniskendaraan;
                document.getElementById('harga').value = response.harga;
                
            }
        },
    });
}
                </script>
            </div>
        </div>
    </div>
</div>
</body>
</html>
