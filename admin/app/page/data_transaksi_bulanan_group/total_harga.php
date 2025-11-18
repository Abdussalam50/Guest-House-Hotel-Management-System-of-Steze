<?php
header('Content-Type: application/json');
include '../../../include/koneksi/koneksi.php';

$id_transaksi = mysql_real_escape_string($_POST['id_transaksi']);

$q = mysql_query("
    SELECT SUM(harga_kamar_bulanan * jumlah_hari) AS total
    FROM data_transaksi_list_kamar
    WHERE id_transaksi = '$id_transaksi'
");

$row = mysql_fetch_assoc($q);

$total = intval($row['total']);

// format Rupiah → tanpa desimal
$formatted = number_format($total, 0, ',', '.');

echo json_encode([
    'total'  => $total,
    'format' => $formatted
]);
