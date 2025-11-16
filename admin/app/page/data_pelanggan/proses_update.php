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
$identitas = xss($_POST['identitas']);
$no_identitas = xss($_POST['no_identitas']);
$alamat = xss($_POST['alamat']);
$jenis_kelamin = xss($_POST['jenis_kelamin']);
$id_hotel = xss($_POST['id_hotel']);
$no_hp = xss($_POST['no_hp']);

if(isset($_COOKIE['id_hotel'])){
	$id_hotel=decrypt($_COOKIE['id_hotel']);
	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
}else{
	$username=decrypt($_COOKIE['jenenge']);
	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username'");
}
$query = mysql_query("UPDATE data_pelanggan SET
            nama = '$nama'
        ,identitas = '$identitas'
        ,no_identitas = '$no_identitas'
        ,alamat = '$alamat'
        ,jenis_kelamin = '$jenis_kelamin'
        ,id_hotel = '$id_hotel'
        ,no_hp = '$no_hp'
            WHERE id_pelanggan = '$id_pelanggan'") or die(mysql_error());

$sql="UPDATE data_pelanggan SET
            nama = '$nama'
        ,identitas = '$identitas'
        ,no_identitas = '$no_identitas'
        ,alamat = '$alamat'
        ,jenis_kelamin = '$jenis_kelamin'
        ,id_hotel = '$id_hotel'
        ,no_hp = '$no_hp'
            WHERE id_pelanggan = '$id_pelanggan'";

simpan_riwayat("data_pelanggan","id_pelanggan",$id_pelanggan,$sql,$id_handler);
if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_edit";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>