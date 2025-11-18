<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_booking'])) {
        
?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
<?php
    die();
}


$id_booking = id_otomatis("data_booking", "id_booking", "10");
$waktu_booking = xss($_POST['waktu_booking']);
$id_admin = xss($_POST['id_admin']);
$id_hotel = xss($_POST['id_hotel']);
$id_kamar = xss($_POST['id_kamar']);
$waktu_checkin = xss($_POST['waktu_checkin']);
$nama = xss($_POST['nama']);
$no_telepon = xss($_POST['no_telepon']);
$catatan = xss($_POST['catatan']);


$query = mysql_query("insert into data_booking values (
'$id_booking'
 ,'$waktu_booking'
 ,'$id_admin'
 ,'$id_hotel'
 ,'$id_kamar'
 ,'$waktu_checkin'
 ,'$nama'
 ,'$no_telepon'
 ,'$catatan'

)");

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