<?php
header('Content-Type: application/json');
include '../../../include/koneksi/koneksi.php';

$post = json_decode(file_get_contents("php://input"), true);
$idKamar = $post['id_kamar'] ?? '';

if (!$idKamar) {
    echo json_encode([]);
    exit;
}

// PENCARIAN KHUSUS UNTUK JSON DAN SINGLE VALUE
$likeQuery = "%$idKamar%";

$data = [];

/* ============================
   1. Ambil data TRANSAKSI
   ============================ */


$q1 = mysql_query("
    SELECT waktu_checkin, waktu_checkout, nama_pelanggan
    FROM data_transaksi
    WHERE id_kamar LIKE '$likeQuery'
        AND status_transaksi <> 'Selesai'
") or die(mysql_error());

while ($d = mysql_fetch_assoc($q1)) {
    $data[] = [
        "type" => "transaksi",
        "checkin" => $d['waktu_checkin'],
        "checkout" => $d['waktu_checkout'],
        "info" => " Transaksi A.n " . $d['nama_pelanggan']
    ];
}

/* ============================
   2. Ambil data BOOKING
   ============================ */
$q2 = mysql_query("
    SELECT waktu_checkin, waktu_checkout, nama_pelanggan
    FROM data_booking
    WHERE id_kamar LIKE '$likeQuery'
      AND status_transaksi = 'Booking'
") or die(mysql_error());

while ($d = mysql_fetch_assoc($q2)) {
    // Booking harus TIDAK menutupi transaksi
    $data[] = [
        "type" => "booking",
        "checkin" => $d['waktu_checkin'],
        "checkout" => $d['waktu_checkout'],
        "info" => " Booking A.n " . $d['nama_pelanggan']
    ];
}

echo json_encode($data);
