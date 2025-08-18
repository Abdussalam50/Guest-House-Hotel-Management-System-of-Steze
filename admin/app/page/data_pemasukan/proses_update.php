<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_pemasukan'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_pemasukan=xss($_POST['id_pemasukan']);
$waktu=xss($_POST['waktu']);
$id_transaksi=xss($_POST['id_transaksi']);
$jumlah_bayar=xss($_POST['jumlah_bayar']);
$metode=xss($_POST['metode']);
$nama_bank=xss($_POST['nama_bank']);
$rekening=xss($_POST['rekening']);
$atas_nama=xss($_POST['atas_nama']);
$keterangan=xss($_POST['keterangan']);
$id_hotel=xss($_POST['id_hotel']);


$query = mysql_query("UPDATE data_pemasukan SET
            waktu = '$waktu'
        ,             id_transaksi = '$id_transaksi'
        ,             jumlah_bayar = '$jumlah_bayar'
        ,             metode = '$metode'
        ,             nama_bank = '$nama_bank'
        ,             rekening = '$rekening'
        ,             atas_nama = '$atas_nama'
        ,             keterangan = '$keterangan'
        ,             id_hotel = '$id_hotel'
            WHERE id_pemasukan = '$id_pemasukan'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
