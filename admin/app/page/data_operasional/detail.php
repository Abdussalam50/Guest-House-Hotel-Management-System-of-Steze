
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
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
            $sql = mysql_query("SELECT * FROM data_operasional where id_operasional = '$proses'");
            $data = mysql_fetch_array($sql);
            $id_hotel=decrypt($_COOKIE['id_hotel']);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_operasional']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Tanggal </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo format_indo($data['tanggal']); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['operasional']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jumlah </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['jumlah']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Keperluan</td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['keperluan']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Biaya </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo rupiah($data['biaya']); ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
