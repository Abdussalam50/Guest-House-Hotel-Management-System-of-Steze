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

$id_booking = xss($_POST['id_booking']);
$waktu_booking = xss($_POST['waktu_booking']);
$id_admin = xss($_POST['id_admin']);
$id_hotel = xss($_POST['id_hotel']);
$id_kamar = xss($_POST['id_kamar']);
$waktu_checkin = xss($_POST['waktu_checkin']);
$nama = xss($_POST['nama']);
$no_telepon = xss($_POST['no_telepon']);
$catatan = xss($_POST['catatan']);


$query = mysql_query("update data_booking set 
waktu_booking='$waktu_booking',
id_admin='$id_admin',
id_hotel='$id_hotel',
id_kamar='$id_kamar',
waktu_checkin='$waktu_checkin',
nama='$nama',
no_telepon='$no_telepon',
catatan='$catatan'

where id_booking='$id_booking' ") or die(mysql_error());

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