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

$query = mysql_query("insert into data_pajak values (
'$id_pajak'
 ,'$waktu'
 ,'$id_transaksi'
 ,'$jenis_pajak'
 ,'$persentase_pajak'
 ,'$pajak'
 ,'$id_hotel'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
