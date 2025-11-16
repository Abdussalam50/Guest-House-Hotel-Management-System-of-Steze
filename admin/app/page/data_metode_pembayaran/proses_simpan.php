<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_metode_pembayaran'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_metode_pembayaran = id_otomatis("data_metode_pembayaran", "id_metode_pembayaran", "10");
              $nama_hotel=xss($_POST['nama_hotel']);
              $metode_pembayaran=xss($_POST['metode_pembayaran']);
              $id_bank=xss($_POST['id_bank']);


$query = mysql_query("insert into data_metode_pembayaran values (
'$id_metode_pembayaran'
 ,'$nama_hotel'
 ,'$metode_pembayaran'
 ,'$id_bank'

)");
$sql="insert into data_metode_pembayaran values (
'$id_metode_pembayaran'
 ,'$nama_hotel'
 ,'$metode_pembayaran'
 ,'$id_bank'

)";
$username_admin=decrypt($_COOKIE['jenenge']);
$id_pengelola=baca_database("","id_pengelola","select * from data_pengelola where username='$username_admin'");
simpan_riwayat("data_metode_pembayaran","id_metode_pembayaran",$id_metode_pembayaran,$sql,$id_pengelola);
if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
