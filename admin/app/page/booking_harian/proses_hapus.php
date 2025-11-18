<?php
include '../../../include/all_include.php';

if (!isset($_GET['proses'])) {
?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
<?php
    die();
}

date_default_timezone_set("Asia/Jakarta");
$proses = mysql_real_escape_string($_GET['proses']);
$admin  = mysql_real_escape_string($_GET['admin']);
$id     = id_otomatis("data_hapus_transaksi", "id_hapus_transaksi", 10);

$id_kamar = baca_database("", "id_kamar", "select * from data_booking where id_transaksi='$proses'");
$id_deposit = baca_database("", "id_deposit", "select * from data_booking where id_transaksi='$proses'");
$id_pemasukan = baca_database("", "id_pemasukan", "select * from data_pemasukan where id_transaksi='$proses'");
$id_pajak = baca_database("", "id_pajak", "select * from data_pajak where id_transaksi='$proses'") == null ? '-' : baca_database("", "id_pajak", "select * from data_pajak where id_transaksi='$proses'");
$id_deposit = $id_deposit !== null ? $id_deposit : '-';
if ($id_deposit !== '-') {
    $nominal_deposit = baca_database("", "nominal_deposit", "select * from data_deposit where id_deposit='$id_deposit'");
}
// Mulai transaksi
mysql_query("START TRANSACTION");

// Backup data
//simpan riwayat
$query_pemasukan = "DELETE FROM data_pemasukan WHERE id_transaksi='$proses'";
$query_transaksi = "DELETE FROM data_booking WHERE id_transaksi='$proses'";
if ($id_pajak !== '-') {
    $query_pajak = "DELETE FROM data_pajak WHERE id_transaksi='$proses'";
}

if ($id_deposit !== '-') {
    $query_deposit = "DELETE FROM data_deposit WHERE id_transaksi='$proses'";
    simpan_riwayat("data_deposit", "id_deposit", $id_deposit, $query_deposit, $admin);
}

simpan_riwayat("data_pemasukan", "id_pemasukan", $id_pemasukan, $query_pemasukan, $admin);
simpan_riwayat("data_booking", "id_transaksi", $proses, $query_transaksi, $admin);
if ($id_pajak !== '-') {
    simpan_riwayat("data_pajak", "id_pajak", $id_pajak, $query_pajak, $admin);
}
// Hapus data
$query_update  = mysql_query("UPDATE data_kamar SET status_kamar='Kosong' WHERE id_kamar='$id_kamar'");
$query_delete2 = mysql_query("DELETE FROM data_pemasukan WHERE id_transaksi='$proses'");
$query_delete  = mysql_query("DELETE FROM data_booking WHERE id_transaksi='$proses'");
$query_delete3 = mysql_query("DELETE FROM data_pajak WHERE id_transaksi='$proses'");

if ($id_deposit !== '-' && $id_deposit !== null) {
    $query_delete3 = mysql_query("DELETE FROM data_deposit WHERE id_deposit='$id_deposit'");
} else {
    $query_delete3 = true;
}
// Jika semua query sukses → commit
// var_dump($backup);
// var_dump($query_update);
// var_dump($query_delete);
// var_dump($query_delete2);
// var_dump($query_delete3);

if ($query_update && $query_delete && $query_delete2 && $query_delete3) {
    mysql_query("COMMIT");
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_hapus";
    </script>
<?php
} else {
    // Kalau ada error → rollback
    mysql_query("ROLLBACK");

    echo "<script>alert('Terjadi kesalahan!');location.href='index.php';</script>";
}
?>