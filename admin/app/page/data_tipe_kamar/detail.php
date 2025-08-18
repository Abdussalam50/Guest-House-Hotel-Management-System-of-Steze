
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
            $sql = mysql_query("SELECT * FROM data_tipe_kamar where id_tipe_kamar = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Tipe Kamar </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_tipe_kamar']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Tipe Kamar </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['tipe_kamar']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nama Hotel</td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
