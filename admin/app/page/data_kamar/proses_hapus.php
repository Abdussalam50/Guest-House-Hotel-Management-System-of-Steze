<?php include '../../../include/all_include.php';

if (!isset($_GET['proses']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 
$proses =  (mysql_real_escape_string($_GET['proses']));
$query=mysql_query("delete from data_kamar where id_kamar='$proses'");
$sql="delete from data_kamar where id_kamar='$proses'";
$username=decrypt($_COOKIE['jenenge']);
$id_super_admin=baca_database("","id_pengelola","select * from data_pengelola where id_pengelola='$username'");
simpan_riwayat("data_kamar","id_kamar",$id_kamar,$sql,$id_super_admin);

if($query){
?>
<script>location.href = "<?php index(); ?>?input=popup_hapus"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
?>
