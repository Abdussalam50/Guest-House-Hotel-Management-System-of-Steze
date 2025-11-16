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

$metode_pembayaran = xss($_POST['metode_pembayaran']);
$nama = xss($_POST['nama_hotel']);
$bank = xss($_POST['bank']);


$query = mysql_query("update metode_pembayaran set 
nama='$nama',
bank='$bank'

where metode_pembayaran='$metode_pembayaran' ") or die(mysql_error());

$sql="update metode_pembayaran set 
nama='$nama',
bank='$bank'

where metode_pembayaran='$metode_pembayaran'";
simpan_riwayat("data_metode_pembayaran","id_metode_pembayaran",$id_metode_pembayaran,$sql);
if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
