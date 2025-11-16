<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_pengelola'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_pengelola=xss($_POST['id_pengelola']);
$nama=xss($_POST['nama']);
$username=xss($_POST['username']);
$password=md5($_POST['password']);


$query = mysql_query("UPDATE data_pengelola SET
            nama = '$nama'
        ,             username = '$username'
        ,             password = '$password'
            WHERE id_pengelola = '$id_pengelola'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
