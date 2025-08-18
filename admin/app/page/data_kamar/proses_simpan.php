<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_kamar'])) {
        
?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
<?php
    die();
}


$id_kamar = id_otomatis("data_kamar", "id_kamar", 10);
$id_hotel = xss($_POST['id_hotel']);
$kapasitas = xss($_POST['kapasitas']);
$harga_harian = xss($_POST['harga_harian']);

if (pengaturan_aplikasi('transaksi_bulanan') == "aktif") {
    $harga_bulanan = xss($_POST['harga_bulanan']);
} else {
    $harga_bulanan = $harga_harian * 30;
}


$no_kamar = xss($_POST['no_kamar']);
$id_tipe_kamar = xss($_POST['id_tipe_kamar']);
$status_kamar = xss($_POST['status_kamar']);


$query = mysql_query("insert into data_kamar values (
'$id_kamar'
 ,'$id_hotel'
 ,'$kapasitas'
 ,'$harga_harian'
 ,'$harga_bulanan'
 ,'$no_kamar'
 ,'$id_tipe_kamar'
 ,'$status_kamar'

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