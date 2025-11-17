<?php
header('Content-Type: application/json');
include '../../../include/koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'msg' => 'Invalid request']);
    exit;
}

$id_transaksi = mysql_real_escape_string($_POST['id_transaksi']);
$jumlah_hari  = intval($_POST['jumlah_hari']);

// Ambil semua kamar di transaksi untuk di-update totalnya
$q = mysql_query("SELECT id_transaksi_list_kamar, harga_kamar_harian 
                  FROM data_transaksi_list_kamar 
                  WHERE id_transaksi = '$id_transaksi'");

if (!$q) {
    echo json_encode(['status' => 'error', 'msg' => mysql_error()]);
    exit;
}

while ($row = mysql_fetch_assoc($q)) {
    $id_list = $row['id_transaksi_list_kamar'];
    $harga_perhari = $row['harga_kamar_harian'];
    $total = $harga_perhari * $jumlah_hari;

    mysql_query("
        UPDATE data_transaksi_list_kamar 
        SET jumlah_hari = '$jumlah_hari',
            total_harga_kamar = '$total'
        WHERE id_transaksi_list_kamar = '$id_list'
    ");
}

echo json_encode(['status' => 'success']);
