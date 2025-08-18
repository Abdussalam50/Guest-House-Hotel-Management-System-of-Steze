
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
            $sql = mysql_query("SELECT * FROM data_metode_pembayaran where id_metode_pembayaran = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Hotel </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_metode_pembayaran']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Hotel </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='{$data['id_hotel']}'"); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Metode Pembayaran </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['metode_pembayaran']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Bank </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo ucwords(baca_database("","nama_bank","select * from data_bank where id_bank='{$data['id_bank']}'")); ?></td>
            </tr>
                <td class="clleft" width="25%">Nomor Rekening</td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","rekening","select * from data_bank where id_bank='{$data['id_bank']}'"); ?></td>
            </tr>
            </tr>
                <td class="clleft" width="25%">Atas Nama</td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","atas_nama","select * from data_bank where id_bank='{$data['id_bank']}'"); ?></td>
            </tr>




            </tbody>
        </table>
        <div class="container d-flex">
            <div class='me-5'><a class="btn btn-danger" href='<?php index()?>?input=edit&proses=<?php echo encrypt($data['id_metode_pembayaran']); ?>'><i class="fa fa-edit"></i> Edit Metode Bayar</a></div>
            <div class=''><a class="btn btn-danger" href='<?php index()?>?input=hapus&proses=<?php echo encrypt($data['id_metode_pembayaran']); ?>'><i class="fa fa-remove"></i> Hapus Metode Bayar</a></div>
        </div>
    </div>
</div>
