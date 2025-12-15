<?php
include '../../../include/koneksi/koneksi.php';
include '../../../include/function/all.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$id_transaksi = mysql_real_escape_string($data->request);

// Hapus data yang bergantung terlebih dahulu
$delete_list_booking = mysql_query("
    DELETE FROM data_booking_list_kamar 
    WHERE id_transaksi = '$id_transaksi'
");

// Jika data tidak ada, anggap sukses
if ($delete_list_booking === false) {
    $delete_list_booking = true;
}

$delete_pajak = mysql_query("
    DELETE FROM data_pajak 
    WHERE id_transaksi = '$id_transaksi'
");

if ($delete_pajak === false) {
    $delete_pajak = true;
}

$delete_pemasukan = mysql_query("
    DELETE FROM data_pemasukan 
    WHERE id_transaksi = '$id_transaksi'
");

if ($delete_pemasukan === false) {
    $delete_pemasukan = true;
}

$delete_deposit = mysql_query("
    DELETE FROM data_deposit 
    WHERE id_transaksi = '$id_transaksi'
");

if ($delete_deposit === false) {
    $delete_deposit = true;
}

// Hapus data utama
$delete_booking = mysql_query("
    DELETE FROM data_booking 
    WHERE id_transaksi = '$id_transaksi'
");

if ($delete_booking === false) {
    $delete_booking = true;
}

// Validasi seluruh proses
if (
    $delete_list_booking &&
    $delete_pajak &&
    $delete_pemasukan &&
    $delete_deposit &&
    $delete_booking
) {
    echo json_encode(['response' => true]);
} else {
    echo json_encode(['response' => false]);
}
