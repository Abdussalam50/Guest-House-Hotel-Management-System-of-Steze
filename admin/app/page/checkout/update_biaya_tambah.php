<?php
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);
$id_trx = $data['id_trx'];
$deskripsi = $data['deskripsi'];
$tambahan = $data['tambahan'];

// Ambil data transaksi terkait untuk info pelanggan, kamar, dan pajak
$trx = mysql_fetch_array(mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$id_trx'"));
if (!$trx) {
    echo json_encode(['response' => 'no', 'message' => 'Transaksi tidak ditemukan']);
    exit;
}

$nama_pelanggan = baca_database("", "nama", "SELECT * FROM data_pelanggan WHERE id_pelanggan='$trx[id_pelanggan]'");
$nomor_kamar = baca_database("", "no_kamar", "SELECT * FROM data_kamar WHERE id_kamar='$trx[id_kamar]'");
$tipe_kamar = baca_database("", "tipe_kamar", "SELECT * FROM data_tipe_kamar WHERE id_tipe_kamar='" . baca_database("", "id_tipe_kamar", "SELECT * FROM data_kamar WHERE id_kamar='$trx[id_kamar]'") . "'");
$id_hotel = $trx['id_hotel'];
$waktu = date("Y-m-d H:i:s");
$nominal_bayar = $tambahan;
$metode_transaksi = $trx['metode_transaksi'];
$nama_bank = $trx['nama_bank'];
$no_rekening = $trx['no_rekening'];

// Hitung ulang sub_total dan pajak
$harga_kamar_total = ($trx['jenis_transaksi'] == 'bulanan')
    ? $trx['harga_kamar_bulanan'] * ($trx['jumlah_hari'] / 30)
    : $trx['harga_kamar_harian'] * $trx['jumlah_hari'];
$disc_nominal = ($harga_kamar_total * $trx['discount']) / 100;
$harga_setelah_disc = $harga_kamar_total - $disc_nominal;
$sub_total = $harga_setelah_disc + $trx['biaya_tambahan_checkin'] + $tambahan - $trx['potongan_harga'];
$pajak = ($sub_total * $trx['persentase_pajak']) / 100;
$total_bayar = $sub_total + $pajak;

// Update biaya checkout dan total bayar
$query = mysql_query("UPDATE data_transaksi SET 
    deskripsi_biaya_checkout = '$deskripsi',
    biaya_tambahan_checkout = '$tambahan',
    pajak='$pajak',
    total_bayar = '$total_bayar'
WHERE id_transaksi='$id_trx'");

if ($query) {
    // Update atau insert ke data_pemasukan
    $keterangan = 'Pembayaran Checkout A.n ' . $nama_pelanggan . ', Kamar Nomor ' . $nomor_kamar . ' (' . $tipe_kamar . ") " . $deskripsi;
    $check_pemasukan = mysql_fetch_array(mysql_query("SELECT id_pemasukan FROM data_pemasukan WHERE id_transaksi='$id_trx' AND keterangan LIKE 'Pembayaran Checkout%'"));
    if ($check_pemasukan) {
        $id_pemasukan = $check_pemasukan['id_pemasukan'];
        $query_pemasukan = mysql_query("UPDATE data_pemasukan SET 
            waktu='$waktu',
            nominal_bayar='$nominal_bayar',
            metode_transaksi='$metode_transaksi',
            nama_bank='$nama_bank',
            no_rekening='$no_rekening',
            nama_pelanggan='$nama_pelanggan',
            keterangan='$keterangan',
            id_hotel='$id_hotel'
        WHERE id_pemasukan='$id_pemasukan'");
    } else {
        $id_pemasukan = id_otomatis("data_pemasukan", "id_pemasukan", "10");
        $query_pemasukan = mysql_query("INSERT INTO data_pemasukan VALUES (
            '$id_pemasukan','$waktu','$id_trx','$nominal_bayar','$metode_transaksi','$nama_bank','$no_rekening','$nama_pelanggan','$keterangan','$id_hotel'
        )");
    }

    // Update atau insert ke data_pajak jika persentase_pajak > 0
    $query_pajak = true;
    if ($trx['persentase_pajak'] > 0) {
        $type_pajak = pengaturan_aplikasi('type_pajak');
        $check_pajak = mysql_fetch_array(mysql_query("SELECT id_pajak FROM data_pajak WHERE id_transaksi='$id_trx'"));
        if ($check_pajak) {
            $id_pajak = $check_pajak['id_pajak'];
            $query_pajak = mysql_query("UPDATE data_pajak SET 
                waktu='$waktu',
                jenis_pajak='$type_pajak',
                persentase_pajak='{$trx['persentase_pajak']}',
                pajak='$pajak',
                id_hotel='$id_hotel'
            WHERE id_pajak='$id_pajak'");
        } else {
            $id_pajak = id_otomatis("data_pajak", "id_pajak", "10");
            $query_pajak = mysql_query("INSERT INTO data_pajak VALUES (
                '$id_pajak','$waktu','$id_trx','$type_pajak','{$trx['persentase_pajak']}','$pajak','$id_hotel'
            )");
        }
    }

    if ($query_pemasukan && $query_pajak) {
        echo json_encode(['response' => 'yes']);
    } else {
        echo json_encode(['response' => 'no', 'message' => mysql_error()]);
    }
} else {
    echo json_encode(['response' => 'no', 'message' => mysql_error()]);
}
