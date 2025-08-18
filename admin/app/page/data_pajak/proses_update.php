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

$id_pajak=xss($_POST['id_pajak']);
$waktu=xss($_POST['waktu']);
$id_transaksi=xss($_POST['id_transaksi']);
$jenis_pajak=xss($_POST['jenis_pajak']);
$persentase_pajak=xss($_POST['persentase_pajak']);
$pajak=xss($_POST['pajak']);
$id_hotel=xss($_POST['id_hotel']);


$query = mysql_query("UPDATE data_pajak SET
            waktu = '$waktu'
        ,             id_transaksi = '$id_transaksi'
        ,             jenis_pajak = '$jenis_pajak'
        ,             persentase_pajak = '$persentase_pajak'
        ,             pajak = '$pajak'
        ,             id_hotel = '$id_hotel'
            WHERE id_pajak = '$id_pajak'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
