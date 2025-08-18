
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data pajak </h5>
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
            $sql = mysql_query("SELECT * FROM data_pajak where id_pajak = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id pajak </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_pajak']; ?></td>	
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
    <td class="clleft" width="25%">Jenis pajak </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['jenis_pajak']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Persentase pajak </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['persentase_pajak']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Pajak </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['pajak']; ?></td>
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
