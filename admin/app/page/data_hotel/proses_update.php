<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_hotel'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_hotel=xss($_POST['id_hotel']);
$nama=xss($_POST['nama']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$koordinat=mysql_real_escape_string($_POST['koordinat']);
if ($_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
$gambar = upload('gambar');
} else {
$gambar = $_POST['gambar1'];
}


$query = mysql_query("UPDATE data_hotel SET
            nama = '$nama'
        ,             alamat = '$alamat'
        ,             no_telepon = '$no_telepon'
        ,             koordinat = '$koordinat'
        ,             gambar = '$gambar'
            WHERE id_hotel = '$id_hotel'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
