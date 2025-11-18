<?php
include '../../../include/koneksi/koneksi.php';

header('Content-Type: application/json');

$id = isset($_POST['id']) ? mysql_real_escape_string($_POST['id']) : '';

if ($id == '') {
    echo json_encode([
        'status' => 'error',
        'message' => 'ID tidak ditemukan'
    ]);
    exit;
}

$q = mysql_query("DELETE FROM data_booking_list_kamar WHERE id_transaksi_list_kamar = '$id'");

if ($q) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Kamar berhasil dihapus'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal menghapus kamar'
    ]);
}
