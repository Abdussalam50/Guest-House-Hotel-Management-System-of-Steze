<?php include '../../../include/all_include.php';

if (!isset($_GET['proses'])) {
	     ?>
	<script>
		alert("AKSES DITOLAK");
		location.href = "index.php";
	</script>
<?php
	die();
}
$proses =  (mysql_real_escape_string($_GET['proses']));
$query = mysql_query("delete from data_booking where id_booking='$proses'");

if ($query) {
?>
	<script>
		location.href = "<?php index(); ?>";
	</script>
<?php
} else {
	echo "GAGAL DIPROSES";
}
?>