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

$id_hotel = id_otomatis("data_hotel", "id_hotel", "10");
$nama=xss($_POST['nama']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$koordinat=mysql_real_escape_string($_POST['koordinat']);
$gambar=upload('gambar');

$query = mysql_query("insert into data_hotel values (
'$id_hotel'
 ,'$nama'
 ,'$alamat'
 ,'$no_telepon'
 ,'$koordinat'
 ,'$gambar'
)");
$sql="insert into data_hotel values (
'$id_hotel'
 ,'$nama'
 ,'$alamat'
 ,'$no_telepon'
 ,'$koordinat'
 ,'$gambar'
)";
simpan_riwayat("data_hotel","id_hotel",$id_hotel,$sql);
if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
