<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_tipe_kamar'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_tipe_kamar = xss($_POST['id_tipe_kamar']);
$tipe_kamar = xss($_POST['tipe_kamar']);
$id_hotel = xss($_POST['id_hotel']);


$query = mysql_query("update data_tipe_kamar set 
tipe_kamar='$tipe_kamar',
id_hotel='$id_hotel'

where id_tipe_kamar='$id_tipe_kamar' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
