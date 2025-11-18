<?php
header('Content-Type: application/json');
include '../../../include/koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'msg' => 'Invalid request']);
    exit;
}

$id_transaksi = mysql_real_escape_string($_POST['id_transaksi']);
$jumlah_bulan  = intval($_POST['jumlah_bulan']);

// Ambil semua kamar di transaksi untuk di-update totalnya
$q = mysql_query("SELECT id_transaksi_list_kamar, harga_kamar_bulanan 
                  FROM data_booking_list_kamar 
                  WHERE id_transaksi = '$id_transaksi'");

if (!$q) {
    echo json_encode(['status' => 'error', 'msg' => mysql_error()]);
    exit;
}

while ($row = mysql_fetch_assoc($q)) {
    $id_list = $row['id_transaksi_list_kamar'];
    $harga_perbulan = $row['harga_kamar_bulanan'];
    $total = $harga_perbulan * $jumlah_bulan;

    mysql_query("
        UPDATE data_booking_list_kamar 
        SET jumlah_hari = '$jumlah_bulan',
            total_harga_kamar = '$total'
        WHERE id_transaksi_list_kamar = '$id_list'
    ");
}

echo json_encode(['status' => 'success']);
