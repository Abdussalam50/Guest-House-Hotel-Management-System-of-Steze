<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_pelanggan'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_pelanggan = xss($_POST['id_pelanggan']);
$nama = xss($_POST['nama']);
$jenis_kelamin = xss($_POST['jenis_kelamin']);
$id_hotel = xss($_POST['id_hotel']);
$no_hp = xss($_POST['no_hp']);



$query = mysql_query("update data_pelanggan set 
nama='$nama',
jenis_kelamin='$jenis_kelamin',
id_hotel='$id_hotel',
no_hp='$no_hp'

where id_pelanggan='$id_pelanggan' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
