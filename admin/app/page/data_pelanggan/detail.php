
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
            $sql = mysql_query("SELECT * FROM data_pelanggan where id_pelanggan = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Pelanggan </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_pelanggan']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo ucwords($data['nama']); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jenis Kelamin </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo ucwords($data['jenis_kelamin']); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nama Hotel </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo ucwords(baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'"))  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">No Hp </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['no_hp']; ?></td>
            </tr>





            </tbody>
        </table>
    </div>
</div>
