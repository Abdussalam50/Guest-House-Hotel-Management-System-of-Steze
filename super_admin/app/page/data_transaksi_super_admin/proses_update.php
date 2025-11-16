<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_transaksi'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_transaksi = xss($_POST['id_transaksi']);
$id_pelanggan = xss($_POST['id_pelanggan']);
$id_kamar = xss($_POST['id_kamar']);

$waktu_checkin = xss($_POST['waktu_checkin']);
$waktu_check_out = xss($_POST['waktu_check_out']);
$no_rekening = xss($_POST['no_rekening']);
$harga = xss($_POST['harga']);
$metode_transaksi = xss($_POST['metode_transaksi']);
$jumlah_dewasa = xss($_POST['jumlah_dewasa']);
$jumlah_anak_anak = xss($_POST['jumlah_anak_anak']);
$discount = xss($_POST['discount']);


$query = mysql_query("update data_transaksi set 
id_pelanggan='$id_pelanggan',
id_kamar='$id_kamar',
waktu_checkin='$waktu_checkin',
waktu_checkout='$waktu_check_out',
no_rekening='$no_rekening',
harga='$harga',
metode_transaksi='$metode_transaksi',
jumlah_dewasa='$jumlah_dewasa',
jumlah_anak_anak='$jumlah_anak_anak',
discount='$discount'

where id_transaksi='$id_transaksi' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
