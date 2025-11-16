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

$id_hotel = xss($_POST['nama_hotel']);
$metode = xss($_POST['metode_pembayaran']);
$id_bank = xss($_POST['id_bank']);


$query = mysql_query("update data_hotel set 
metode_pembayaran='$metode',
id_bank='$id_bank'

where id_hotel='$id_hotel' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
