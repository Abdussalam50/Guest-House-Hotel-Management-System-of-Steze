<?php
include '../../../include/all_include.php';
date_default_timezone_set('Asia/Jakarta');
if (!isset($_POST['id_admin'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_admin = id_otomatis("data_admin", "id_admin", "10");
              $id_hotel=xss($_POST['id_hotel']);
              $nama=xss($_POST['nama']);
              $username=xss($_POST['username']);
              $password=md5($_POST['password']);


$query = mysql_query("insert into data_admin values (
'$id_admin'
 ,'$id_hotel'
 ,'$nama'
 ,'$username'
 ,'$password'

)");

if(isset($_COOKIE['id_hotel'])){
	$id_hotel=decrypt($_COOKIE['id_hotel']);
	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
}else{
	$username=decrypt($_COOKIE['jenenge']);
	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username'");
}
//tambahkan ke riwayat
$sql="insert into data_admin values (
'$id_admin'
 ,'$id_hotel'
 ,'$nama'
 ,'$username'
 ,'$password'

)";
simpan_riwayat("data_admin","id_admin",$id_admin,$sql,$id_handler);
if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
