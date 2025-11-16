<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_operasional'])) {
        
?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
<?php
    die();
}

$id_operasional = xss($_POST['id_operasional']);
$id_hotel = xss($_POST['id_hotel']);
$tanggal = xss($_POST['tanggal']);
$operasional = xss($_POST['operasional']);
$jumlah = xss($_POST['jumlah']);
$biaya = xss($_POST['biaya']);
$id_admin = xss($_POST['id_admin']);
$keperluan = xss($_POST['keperluan']);

$sql="update data_operasional set 
id_hotel='$id_hotel',
tanggal='$tanggal',
operasional='$operasional',
jumlah='$jumlah',
keperluan='$keperluan',
biaya='$biaya',
id_admin='$id_admin'

where id_operasional='$id_operasional'";
simpan_riwayat("data_operasional","id_operasional",$id_operasional,$sql,$id_admin);

$query = mysql_query("update data_operasional set 
id_hotel='$id_hotel',
tanggal='$tanggal',
operasional='$operasional',
jumlah='$jumlah',
keperluan='$keperluan',
biaya='$biaya',
id_admin='$id_admin'

where id_operasional='$id_operasional' ") or die(mysql_error());
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