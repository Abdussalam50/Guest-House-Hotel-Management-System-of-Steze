<?php
include '../../../include/koneksi/koneksi.php';

$postData = json_decode(file_get_contents('php://input'), true);
$tanggal_check = isset($postData['tanggal_check']) ?$postData['tanggal_check']: '';
$idHotel = isset($postData['id_hotel']) ?$postData['id_hotel']: '';

if (!$tanggal_check) {
    echo json_encode([]);
    exit;
}

if (!$idHotel) {
    echo json_encode([]);
    exit;
}

// Ambil semua kamar hotel
$query = "SELECT * FROM data_kamar WHERE id_hotel = '$idHotel' ORDER BY no_kamar ASC";
$result = mysql_query($query) or die(mysql_error());

$kamarList = [];
while ($kamar = mysql_fetch_assoc($result)) {
    $idKamar = $kamar['id_kamar'];
    $noKamar = $kamar['no_kamar'];

    // Cek apakah kamar sedang dibooking
    $qBooking = "SELECT id_transaksi FROM data_booking 
                 WHERE id_hotel = '$idHotel'
                 AND ('$tanggal_check' BETWEEN waktu_checkin AND waktu_checkout)
                 AND (id_kamar LIKE '%$idKamar%') 
                 AND status_transaksi = 'Booking'";
    $resBooking = mysql_query($qBooking);
    $sedangDibooking = mysql_num_rows($resBooking) > 0;
    $statusAwal = $kamar['status_kamar'];

    if ($sedangDibooking) {
        $badgeClass = 'bg-primary';
        $statusText = 'Booking';
        $bgcolor = '#f6f7f9';
    } elseif ($statusAwal == 'Terisi') {
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
    $tipeResult = mysql_query($tipeQuery);
    $tipeRow = mysql_fetch_assoc($tipeResult);
    $tipeKamar = isset($tipeRow['tipe_kamar']) ?$tipeRow['tipe_kamar']: '-';

    // Format harga harian menjadi Rupiah dengan titik
    $hargaHarian = "Rp " . number_format($kamar['harga_harian'], 0, '', '.');

    $kamarList[] = [
        'no_kamar' => $noKamar,
        'tipe_kamar' => $tipeKamar,
        'harga_harian' => $hargaHarian,
        'badgeClass' => $badgeClass,
        'statusText' => $statusText,
        'bgcolor' => $bgcolor
    ];
}

echo json_encode($kamarList);
