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

$id_pengaturan_aplikasi=xss($_POST['id_pengaturan_aplikasi']);
$nama_pengaturan=xss($_POST['nama_pengaturan']);
$value=xss($_POST['value']);


$query = mysql_query("UPDATE data_pengaturan_aplikasi SET
            nama_pengaturan = '$nama_pengaturan'
        ,             value = '$value'
            WHERE id_pengaturan_aplikasi = '$id_pengaturan_aplikasi'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
