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

$id_hotel = xss($_POST['id_hotel']);
$nama = xss($_POST['nama']);
$alamat = xss($_POST['alamat']);


$query = mysql_query("update data_hotel set 
nama='$nama',
alamat='$alamat'

where id_hotel='$id_hotel' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
