<?php
include '../../../include/koneksi/koneksi.php';

$id_trx = mysql_escape_string($_GET['id_trx']);
$q = mysql_query("SELECT * FROM data_booking WHERE id_transaksi='$id_trx'") or die(mysql_error());
$data = mysql_fetch_array($q);

if (!$data) {
    echo json_encode(['error' => 'Data booking tidak ditemukan']);
} else {
    echo json_encode($data);
}
