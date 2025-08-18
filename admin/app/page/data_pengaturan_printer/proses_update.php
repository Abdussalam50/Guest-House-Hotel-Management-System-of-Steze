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
$pengaturan_cash_drawer = xss($_POST['pengaturan_cash_drawer']);
$nama_printer_laporan = xss($_POST['nama_printer_laporan']);
$gambar_logo = xss($_FILES['gambar_logo']['name']);
if (empty($gambar_logo)) {
	$gambar_logo = $_POST['gambar_logo1'];
} else {
	$gambar_logo = upload('gambar_logo');
};
$header1 = xss($_POST['header1']);
$header2 = xss($_POST['header2']);
$header3 = xss($_POST['header3']);
$footer1 = xss($_POST['footer1']);
$footer2 = xss($_POST['footer2']);
$footer3 = xss($_POST['footer3']);
$nota_email = xss($_POST['nota_email']);
$email_sumber = xss($_POST['email_sumber']);
$nota_wa = xss($_POST['nota_wa']);

$no_wa_sumber = $_POST['no_wa_sumber'];

$query = mysql_query("update data_pengaturan_printer set 
nama_printer_nota='$nama_printer_nota',
ukuran_kertas='$ukuran_kertas',
pengaturan_cash_drawer='$pengaturan_cash_drawer',
nama_printer_laporan='$nama_printer_laporan',
gambar_logo='$gambar_logo',
header1='$header1',
header2='$header2',
header3='$header3',
footer1='$footer1',
footer2='$footer2',
footer3='$footer3',
nota_email='$nota_email',
email_sumber='$email_sumber',
nota_wa='$nota_wa',

no_wa_sumber='$no_wa_sumber'
where id_pengaturan_printer='$id_pengaturan_printer' ") or die(mysql_error());

if ($query) {
?>
	<script>
		location.href = "<?php index(); ?>?input=detail";
	</script>
<?php
} else {
	echo "GAGAL DIPROSES";
}
?>