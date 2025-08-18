<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_kamar'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_kamar = xss($_POST['id_kamar']);
$id_hotel = xss($_POST['id_hotel']);
$kapasitas = xss($_POST['kapasitas']);
$harga_harian = xss($_POST['harga_harian']);
$harga_bulanan = xss($_POST['harga_bulanan']);
$no_kamar = xss($_POST['no_kamar']);
$id_tipe_kamar = xss($_POST['id_tipe_kamar']);
$status_kamar = xss($_POST['status_kamar']);


$query = mysql_query("update data_kamar set 
id_hotel='$id_hotel',
kapasitas='$kapasitas',
harga_harian='$harga_harian',
harga_bulanan='$harga_bulanan',
no_kamar='$no_kamar',
id_tipe_kamar='$id_tipe_kamar',
status_kamar='$status_kamar'

where id_kamar='$id_kamar' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
