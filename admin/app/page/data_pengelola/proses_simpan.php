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

$id_pengelola = id_otomatis("data_pengelola", "id_pengelola", "10");
$nama=xss($_POST['nama']);
$username=xss($_POST['username']);
$password=md5($_POST['password']);

$query = mysql_query("insert into data_pengelola values (
'$id_pengelola'
 ,'$nama'
 ,'$username'
 ,'$password'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
