
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data pemasukan </h5>
<br>
    <div class="content-box-content">
        <table <?php tabel_in(100, '%', 0, 'center'); ?>>		
            <tbody>
               
                <?php
                if (!isset($_GET['proses'])) {
                        
                    ?>
                <script>
                    alert("AKSES DITOLAK");
                    location.href = "index.php";
                </script>
                <?php
                die();
            }
            $proses = decrypt(mysql_real_escape_string($_GET['proses']));
            $sql = mysql_query("SELECT * FROM data_pemasukan where id_pemasukan = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id pemasukan </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_pemasukan']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Waktu </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo format_indo($data['waktu']); ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Id pelanggan </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","id_pelanggan","select * from data_transaksi where id_transaksi='$data[id_transaksi]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">Jumlah bayar </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['jumlah_bayar']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Metode </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['metode']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nama bank </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['nama_bank']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Rekening </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['rekening']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Atas nama </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['atas_nama']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Keterangan </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo readmore($data['keterangan']); ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nama </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
</tr>

            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
