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

$id_pemasukan = id_otomatis("data_pemasukan", "id_pemasukan", "10");
$waktu=xss($_POST['waktu']);
$id_transaksi=xss($_POST['id_transaksi']);
$jumlah_bayar=xss($_POST['jumlah_bayar']);
$metode=xss($_POST['metode']);
$nama_bank=xss($_POST['nama_bank']);
$rekening=xss($_POST['rekening']);
$atas_nama=xss($_POST['atas_nama']);
$keterangan=xss($_POST['keterangan']);
$id_hotel=xss($_POST['id_hotel']);

$query = mysql_query("insert into data_pemasukan values (
'$id_pemasukan'
 ,'$waktu'
 ,'$id_transaksi'
 ,'$jumlah_bayar'
 ,'$metode'
 ,'$nama_bank'
 ,'$rekening'
 ,'$atas_nama'
 ,'$keterangan'
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
