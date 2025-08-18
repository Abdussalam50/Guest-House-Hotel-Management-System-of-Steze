<?php include '../../../include/all_include.php';

if (!isset($_POST['id_pengaturan_printer'])) {
	     ?>
	<script>
		alert("AKSES DITOLAK");
		location.href = "index.php";
	</script>
<?php
	die();
}


$id_pengaturan_printer = xss($_POST['id_pengaturan_printer']);
$nama_printer_nota = xss($_POST['nama_printer_nota']);
$ukuran_kertas = xss($_POST['ukuran_kertas']);
$nama_printer_laporan = xss($_POST['nama_printer_laporan']);
$gambar_logo = upload('gambar_logo');
$header1 = xss($_POST['header1']);
$header2 = xss($_POST['header2']);
$header3 = xss($_POST['header3']);
$footer1 = xss($_POST['footer1']);
$footer2 = xss($_POST['footer2']);
$nota_email = xss($_POST['nota_email']);
$email_sumber = xss($_POST['email_sumber']);
$nota_wa = xss($_POST['nota_wa']);
$no_wa_sumber = xss($_POST['no_wa_sumber']);



$query = mysql_query("insert into data_pengaturan_printer values (
'$id_pengaturan_printer'
 ,'$nama_printer_nota'
 ,'$ukuran_kertas'
 ,'$nama_printer_laporan'
 ,'$gambar_logo'
 ,'$header1'
 ,'$header2'
 ,'$header3'
 ,'$footer1'
 ,'$footer2'
 ,'$nota_email'
 ,'$email_sumber'
 ,'$nota_wa'
 ,'$no_wa_sumber'

)");

if ($query) {
?>
	<script>
		location.href = "<?php index(); ?>?input=popup_tambah";
	</script>
<?php
} else {
	echo "GAGAL DIPROSES";
}
?>