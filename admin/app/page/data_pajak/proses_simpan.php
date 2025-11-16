<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_pajak'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_pajak = id_otomatis("data_pajak", "id_pajak", "10");
$waktu=xss($_POST['waktu']);
$id_transaksi=xss($_POST['id_transaksi']);
$jenis_pajak=xss($_POST['jenis_pajak']);
$persentase_pajak=xss($_POST['persentase_pajak']);
$pajak=xss($_POST['pajak']);
$id_hotel=xss($_POST['id_hotel']);
if(isset($_COOKIE['id_hotel'])){
	$id_hotel=decrypt($_COOKIE['id_hotel']);
	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
}else{
	$username=decrypt($_COOKIE['jenenge']);
	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username'");
}
$query = mysql_query("insert into data_pajak values (
'$id_pajak'
 ,'$waktu'
 ,'$id_transaksi'
 ,'$jenis_pajak'
 ,'$persentase_pajak'
 ,'$pajak'
 ,'$id_hotel'
)");
$sql="insert into data_pajak values (
'$id_pajak'
 ,'$waktu'
 ,'$id_transaksi'
 ,'$jenis_pajak'
 ,'$persentase_pajak'
 ,'$pajak'
 ,'$id_hotel'
)";
simpan_riwayat("data_pajak","id_pajak",$id_pajak,$sql,$id_handler);
if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
