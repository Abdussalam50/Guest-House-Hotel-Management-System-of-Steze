<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_pengaturan_aplikasi'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_pengaturan_aplikasi = id_otomatis("data_pengaturan_aplikasi", "id_pengaturan_aplikasi", "10");
$nama_pengaturan=xss($_POST['nama_pengaturan']);
$value=xss($_POST['value']);
$catatan=isset($_POST['catatan'])?$_POST['catatan']:NULL;

$query = mysql_query("insert into data_pengaturan_aplikasi() values (
'$id_pengaturan_aplikasi'
 ,'$nama_pengaturan'
 ,'$value'
 ,'$catatan'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo mysql_error();
}
?>
