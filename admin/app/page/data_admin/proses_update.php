<?php
include '../../../include/all_include.php';
date_default_timezone_set("Asia/Jakarta");
if (!isset($_POST['id_admin'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_admin = xss($_POST['id_admin']);
$id_hotel = xss($_POST['id_hotel']);
$nama = xss($_POST['nama']);
$username = xss($_POST['username']);
$password = md5($_POST['password']);




if(isset($_COOKIE['id_hotel'])){
	$id_hotel=decrypt($_COOKIE['id_hotel']);
	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
}else{
	$username1=decrypt($_COOKIE['jenenge']);
	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username1'");
}
$sql="update data_admin set 
id_hotel='$id_hotel',
nama='$nama',
username='$username',
password='$password'

where id_admin='$id_admin'";
simpan_riwayat("data_admin","id_admin",$id_admin,$sql,$id_handler);
$query = mysql_query("update data_admin set 
id_hotel='$id_hotel',
nama='$nama',
username='$username',
password='$password'

where id_admin='$id_admin' ") or die(mysql_error());
if ($query ) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo mysql_error();
}
?>
