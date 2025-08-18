<?php
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);
$id_trx = $data['idtrx'];

// Ambil data transaksi terkait
$trx = mysql_fetch_array(mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$id_trx'"));
if (!$trx) {
    echo json_encode(['response' => 'no', 'message' => 'Transaksi tidak ditemukan']);
    exit;
}

// Hitung ulang sub_total dan pajak tanpa biaya_tambahan_checkout
$harga_kamar_total = ($trx['jenis_transaksi'] == 'bulanan')
    ? $trx['harga_kamar_bulanan'] * ($trx['jumlah_hari'] / 30)
    : $trx['harga_kamar_harian'] * $trx['jumlah_hari'];
$disc_nominal = ($harga_kamar_total * $trx['discount']) / 100;
$harga_setelah_disc = $harga_kamar_total - $disc_nominal;
$sub_total = $harga_setelah_disc + $trx['biaya_tambahan_checkin'] - $trx['potongan_harga'];
$pajak = ($sub_total * $trx['persentase_pajak']) / 100;
$total_bayar = $sub_total + $pajak;

// Update transaksi: reset biaya checkout dan sesuaikan total_bayar
$query = mysql_query("
    UPDATE data_transaksi 
    SET 
        total_bayar = '$total_bayar',
        biaya_tambahan_checkout = 0,
        deskripsi_biaya_checkout = ''
    WHERE id_transaksi = '$id_trx'
");

// Update data_pemasukan: set nominal_bayar ke 0
$check_pemasukan = mysql_fetch_array(mysql_query("SELECT id_pemasuman FROM data_pemasukan WHERE id_transaksi='$id_trx' AND keterangan LIKE 'Pembayaran Checkout%'"));
$query_pemasukan = true;
if ($check_pemasukan) {
    $id_pemasukan = $check_pemasuman['id_pemasuman'];
    $waktu = date("Y-m-d H:i:s");
    $query_pemasuman = mysql_query("UPDATE data_pemasuman SET 
        waktu='$waktu',
        nominal_bayar='0'
    WHERE id_pemasukan='$id_pemasuman'");
}

// Update data_pajak jika persentase_pajak > 0
$query_pajak = true;
if ($trx['persentase_pajak'] > 0) {
    $check_pajak = mysql_fetch_array(mysql_query("SELECT id_pajak FROM data_pajak WHERE id_transaksi='$id_trx'"));
    if ($check_pajak) {
        $id_pajak = $check_pajak['id_pajak'];
        $waktu = date("Y-m-d H:i:s");
        $type_pajak = pengaturan_aplikasi('type_pajak');
        $query_pajak = mysql_query("UPDATE data_pajak SET 
            waktu='$waktu',
            jenis_pajak='$type_pajak',
            persentase_pajak='{$trx['persentase_pajak']}',
            pajak='$pajak',
            id_hotel='{$trx['id_hotel']}'
        WHERE id_pajak='$id_pajak'");
    }
}

if ($query && $query_pemasukan && $query_pajak) {
    echo json_encode(['response' => 'yes']);
} else {
    echo json_encode(['response' => 'no', 'message' => mysql_error()]);
}
