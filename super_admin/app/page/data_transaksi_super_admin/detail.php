
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
            $sql = mysql_query("SELECT * FROM data_transaksi where id_transaksi = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Transaksi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_transaksi']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo ucwords(baca_database("","nama","select * from data_pelanggan where id_pelanggan='$data[id_pelanggan]'"))  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Kamar </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo 'Kamar '.(baca_database("","no_kamar","select * from data_kamar where id_kamar='$data[id_kamar]'"))  ?></td>
            </tr>

            <tr>
                <td class="clleft" width="25%">Waktu Check In </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo format_indo($data['waktu_checkin']); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Waktu Check Out </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo format_indo($data['waktu_checkout']); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jumlah Hari </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php 
                $waktu_checkin =new DateTime($data['waktu_checkin']);
                $waktu_checkout = new DateTime($data['waktu_checkout']);
                $selisih=$waktu_checkin->diff($waktu_checkout);
                echo $selisih->d; ?> Hari</td>
            </tr>
            
            <tr>
                <td class="clleft" width="25%">No Rekening Bayar</td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['no_rekening']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Harga </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo rupiah($data['harga']); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Metode Transaksi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","metode_pembayaran","select * from data_metode_pembayaran where id_metode_pembayaran='{$data['metode_transaksi']}'"); ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jumlah Dewasa </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['jumlah_dewasa']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jumlah Anak Anak </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['jumlah_anak_anak']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Discount </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['discount']; ?> %</td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Status Transaksi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['status_transaksi']; ?></td>
            </tr>




            </tbody>
        </table>
       <a href="<?php index()?>?input=hapus&proses=<?php echo encrypt($data['id_transaksi'])?>&admin=<?php echo $_COOKIE['jenenge'] ?>" class='btn btn-danger'><i class="fa fa-remove"></i> Hapus Transaksi</a>
       <a href="<?php index()?>?input=checkout&" target="_blank" rel="noopener noreferrer"></a>
    </div>
</div>
