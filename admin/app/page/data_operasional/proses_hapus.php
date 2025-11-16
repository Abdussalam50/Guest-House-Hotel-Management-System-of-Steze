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

if(isset($_COOKIE['id_hotel'])){
	$id_hotel=decrypt($_COOKIE['id_hotel']);
	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
}else{
	$username=decrypt($_COOKIE['jenenge']);
	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username'");
}
$proses =  (mysql_real_escape_string($_GET['proses']));
$sql="delete from data_operasional where id_operasional='$proses'";
simpan_riwayat('data_operasional',"id_operasional",$proses,$sql,$id_handler);
$query=mysql_query("delete from data_operasional where id_operasional='$proses'");
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
