<?php
include '../../../include/koneksi/koneksi.php';

$postData = json_decode(file_get_contents('php://input'), true);

$tanggalCheckin  = $postData['tanggal_checkin_check'] ?? '';
$tanggalCheckout = $postData['tanggal_checkout_check'] ?? '';
$idHotel         = $postData['id_hotel'] ?? '';

if (!$tanggalCheckin || !$tanggalCheckout || !$idHotel) {
    echo json_encode([]);
    exit;
}

// Ambil semua kamar hotel
$query = "SELECT * FROM data_kamar WHERE id_hotel = '$idHotel' ORDER BY urutan ASC";
$result = mysql_query($query) or die(mysql_error());

$kamarList = [];

while ($kamar = mysql_fetch_assoc($result)) {
    $idKamar = $kamar['id_kamar'];
    $noKamar = $kamar['no_kamar'];

    $qBooking = "
        SELECT id_transaksi FROM data_booking 
        WHERE id_hotel = '$idHotel'
        AND (
                '$tanggalCheckin' <= DATE_SUB(waktu_checkout, INTERVAL 1 DAY)
            AND waktu_checkin <= DATE_SUB('$tanggalCheckout', INTERVAL 1 DAY)
        )
        AND id_kamar LIKE '%$idKamar%'
        AND status_transaksi = 'Booking'
    ";
    $resBooking = mysql_query($qBooking);
    $isBooking = mysql_num_rows($resBooking) > 0;

    // Untuk Transaksi (Check-in aktual)
    $qTransaksi = "
        SELECT id_transaksi FROM data_transaksi 
        WHERE id_hotel = '$idHotel'
        AND (
                '$tanggalCheckin' <= DATE_SUB(waktu_checkout, INTERVAL 1 DAY)
            AND waktu_checkin <= DATE_SUB('$tanggalCheckout', INTERVAL 1 DAY)
        )
        AND id_kamar LIKE '%$idKamar%'
        AND status_transaksi <> 'Selesai'
    ";
    $resTransaksi = mysql_query($qTransaksi);
    $isTerisi = mysql_num_rows($resTransaksi) > 0;


    // ===============================
    // TENTUKAN STATUS
    // ===============================
    if ($isBooking) {
        $badgeClass = 'bg-primary';
        $statusText = 'Booking';
        $bgcolor = '#f6f7f9';
    } elseif ($isTerisi) {
        $badgeClass = 'bg-danger';
        $statusText = 'Terisi';
        $bgcolor = '#f6f7f9';
    } else {
        $badgeClass = 'bg-success';
        $statusText = 'Tersedia';
        $bgcolor = '#ffffff';
    }

    // Ambil tipe kamar
    $tipeQuery = "SELECT tipe_kamar FROM data_tipe_kamar WHERE id_tipe_kamar='" . $kamar['id_tipe_kamar'] . "'";
    $tipe = mysql_fetch_assoc(mysql_query($tipeQuery));
    $tipeKamar = $tipe['tipe_kamar'] ?? '-';

    // Harga rupiah tanpa koma
    $hargaHarian = "Rp " . number_format($kamar['harga_bulanan'], 0, '', '.');

    // Simpan
    $kamarList[] = [
        'id_kamar'      => $idKamar,
        'no_kamar'      => $noKamar,
        'tipe_kamar'    => $tipeKamar,
        'harga_harian'  => $hargaHarian,
        'badgeClass'    => $badgeClass,
        'statusText'    => $statusText,
        'bgcolor'       => $bgcolor
    ];
}

echo json_encode($kamarList);
