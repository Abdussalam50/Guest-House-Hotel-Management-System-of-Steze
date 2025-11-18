<?php
include '../../../include/koneksi/koneksi.php';
date_default_timezone_set("Asia/Jakarta");

// Header JSON
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    die(json_encode(['status' => 'error', 'msg' => 'Invalid Request']));

$id_transaksi     = mysql_real_escape_string($_POST['id_transaksi']);
$no_kamar         = mysql_real_escape_string($_POST['no_kamar']);
$jumlah_dewasa    = mysql_real_escape_string($_POST['jumlah_dewasa']);
$jumlah_anak_anak = mysql_real_escape_string($_POST['jumlah_anak_anak']);
$jumlah_bulan      = mysql_real_escape_string($_POST['jumlah_bulan']);

$q = "SELECT * FROM data_kamar WHERE no_kamar = '$no_kamar' LIMIT 1";
$r = mysql_query($q);

if (mysql_num_rows($r) == 0) {
    echo json_encode(['status' => 'error', 'msg' => 'Kamar tidak ditemukan']);
    exit;
}

$row    = mysql_fetch_assoc($r);
$id_list = "LIST-" . date('YmdHis') . rand(100, 999);
$waktu   = date('Y-m-d H:i:s');
$harga_kamar_harian   = $row['harga_harian'];
$harga_kamar_bulanan   = $row['harga_bulanan'];

$total_harga_kamar = $harga_kamar_bulanan * $jumlah_bulan;

$insert = "INSERT INTO data_booking_list_kamar 
(id_transaksi_list_kamar, id_transaksi, waktu, id_kamar, no_kamar, jumlah_dewasa, jumlah_anak_anak, harga_kamar_harian,harga_kamar_bulanan, total_harga_kamar,jumlah_hari,jenis_transaksi)
VALUES ('$id_list','$id_transaksi','$waktu','{$row['id_kamar']}','$no_kamar','$jumlah_dewasa','$jumlah_anak_anak','$harga_kamar_harian','$harga_kamar_bulanan','$total_harga_kamar','$jumlah_bulan','bulanan')";

if (mysql_query($insert)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'msg' => mysql_error()]);
}
