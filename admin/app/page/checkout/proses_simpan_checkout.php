<?php

include '../../../include/all_include.php';

// Validasi input dari $_GET
if (
    !isset($_GET['id_transaksi']) || !isset($_GET['total_tambahan_non_pajak']) ||
    !isset($_GET['id_metode_pembayaran']) || !isset($_GET['metode_pembayaran']) ||
    !isset($_GET['nominal']) || !isset($_GET['kembalian']) || !isset($_GET['sisa'])
) {
    die("Error: Input tidak lengkap.");
}

// Ambil dan sanitasi input dari $_GET
$id_transaksi = mysql_real_escape_string($_GET['id_transaksi']);
$total_tambahan_non_pajak = (int)$_GET['total_tambahan_non_pajak'];
$id_metode_pembayaran = mysql_real_escape_string($_GET['id_metode_pembayaran']);
$metode_pembayaran = mysql_real_escape_string($_GET['metode_pembayaran']);
$nominal = (int)$_GET['nominal'];
$kembalian = (int)$_GET['kembalian'];
$sisa = (int)$_GET['sisa'];
$deskripsi = isset($_GET['tambahan_desc']) ? mysql_real_escape_string($_GET['tambahan_desc']) : 'Biaya tambahan check-out';

// Ambil data transaksi
$q = mysql_query("SELECT id_hotel, nama_pelanggan, no_kamar, tipe_kamar, id_kamar, nama_bank, no_rekening,
                        harga_sebelum_pajak, persentase_pajak, pajak, total_bayar,
                        harga_kamar_harian, jumlah_hari, total_harga_kamar, discount, biaya_tambahan_checkin, potongan_harga
                  FROM data_transaksi
                  WHERE id_transaksi='$id_transaksi'");
if (!$q) die("Error: Gagal mengambil data transaksi - " . mysql_error());
$data = mysql_fetch_array($q);
if (!$data) die("Error: Transaksi tidak ditemukan.");

// Sanitasi data dari database
$id_hotel = mysql_real_escape_string($data['id_hotel']);
$nama_pelanggan = mysql_real_escape_string($data['nama_pelanggan']);
$nomor_kamar = mysql_real_escape_string($data['no_kamar']);
$tipe_kamar = mysql_real_escape_string($data['tipe_kamar']);
$id_kamar = mysql_real_escape_string($data['id_kamar']);
$nama_bank = mysql_real_escape_string($data['nama_bank']);
$no_rekening = mysql_real_escape_string($data['no_rekening']);

$harga_sebelum_pajak_db = (int)$data['harga_sebelum_pajak'];
$persentase_pajak = (float)$data['persentase_pajak'];
$pajak_db = (int)$data['pajak'];
$total_bayar_db = (int)$data['total_bayar'];

// Data tambahan
$harga_kamar_harian_db = (int)$data['harga_kamar_harian'];
$jumlah_hari_db = (int)$data['jumlah_hari'];
$total_harga_kamar_db_raw = $data['total_harga_kamar'];
$discount_db = (float)$data['discount'];
$biaya_tambahan_checkin_db = (int)$data['biaya_tambahan_checkin'];
$potongan_harga_db = (int)$data['potongan_harga'];

// Hitung harga kamar total
if ($harga_kamar_harian_db > 0 && $jumlah_hari_db > 0) {
    $harga_kamar_total = $harga_kamar_harian_db * $jumlah_hari_db;
} else {
    $harga_kamar_total = (int)preg_replace('/\D/', '', $total_harga_kamar_db_raw);
}

// Keterangan pemasukan
$keterangan = 'Pembayaran Checkout A.n ' . $nama_pelanggan . ', Kamar Nomor ' . $nomor_kamar . ' (' . $tipe_kamar . ') ' . $deskripsi;

// ============ LOGIC PERHITUNGAN (FIX PAJAK PENUH) ============
if ($total_tambahan_non_pajak > 0) {
    // Diskon
    $diskon_nominal = ($discount_db / 100) * $harga_kamar_total;
    $discounted_room_price = $harga_kamar_total - $diskon_nominal;

    // Biaya tambahan
    $biaya_checkin = $biaya_tambahan_checkin_db;
    $biaya_checkout = $total_tambahan_non_pajak;

    // Subtotal = kamar (setelah diskon) + tambahan checkin + tambahan checkout - potongan
    $subtotal = $discounted_room_price + $biaya_checkin + $biaya_checkout - $potongan_harga_db;
    if ($subtotal < 0) $subtotal = 0;

    // Pajak penuh dari subtotal
    $pajak_total = (int) round(($subtotal * $persentase_pajak) / 100);

    // Pajak tambahan (selisih dari pajak sebelumnya)
    $pajak_tambahan = $pajak_total - $pajak_db;
    if ($pajak_tambahan < 0) $pajak_tambahan = 0;

    // Harga sebelum pajak & total bayar final
    $harga_sebelum_pajak = $subtotal;
    $total_bayar = $harga_sebelum_pajak + $pajak_total;

    // Jumlah pemasukan baru saat checkout (tambahan + pajak tambahan)
    $total_tambahan = $biaya_checkout + $pajak_tambahan;

    // Validasi pembayaran
    $net_paid = $nominal - $kembalian;
    $expected_sisa = $total_bayar - $net_paid;
    if ($sisa != $expected_sisa) {
        error_log("Peringatan: Sisa pembayaran tidak sesuai. Diharapkan: $expected_sisa, diterima: $sisa");
    }

    $expected_total_bayar = $harga_sebelum_pajak + $pajak_total;
    if ($total_bayar != $expected_total_bayar) {
        die("Error: Total bayar tidak sesuai. Diharapkan: $expected_total_bayar, diterima: $total_bayar");
    }

    // Update status kamar
    $query_kamar = mysql_query("UPDATE data_kamar SET status_kamar='Kosong' WHERE id_kamar='$id_kamar'");
    if (!$query_kamar) die("Error: Gagal update status kamar - " . mysql_error());

    // Update transaksi
    $status_transaksi = ($sisa > 0) ? 'Belum Lunas' : 'Selesai';
    //     echo $status_transaksi; 
    // echo $id_transaksi;
    // die();
    $query_transaksi = mysql_query("
        UPDATE data_transaksi SET 
            biaya_tambahan_checkout='" . mysql_real_escape_string($biaya_checkout) . "',
            deskripsi_biaya_checkout='" . mysql_real_escape_string($deskripsi) . "',
            harga_sebelum_pajak='" . (int)$harga_sebelum_pajak . "',
            pajak='" . (int)$pajak_total . "',
            total_bayar='" . (int)$total_bayar . "',
            nominal_bayar='" . (int)$nominal . "',
            jumlah_kembalian='" . (int)$kembalian . "',
            sisa_pembayaran='" . (int)$sisa . "',
            status_transaksi='" . mysql_real_escape_string($status_transaksi) . "'
        WHERE id_transaksi='$id_transaksi'
    ");
    if (!$query_transaksi) die("Error: Gagal update transaksi - " . mysql_error());

    // Insert pemasukan
    $id_pemasukan = id_otomatis("data_pemasukan", "id_pemasukan", "10");
    $query_pemasukan = mysql_query("
        INSERT INTO data_pemasukan 
        (id_pemasukan, waktu, id_transaksi, jumlah_bayar, id_metode_pembayaran,metode_pembayaran, nama_bank, rekening, atas_nama, keterangan, id_hotel) 
        VALUES 
        ('$id_pemasukan', NOW(), '" . mysql_real_escape_string($id_transaksi) . "', '" . (int)$total_tambahan . "', '" . mysql_real_escape_string($id_metode_pembayaran) . "','" . mysql_real_escape_string($metode_pembayaran) . "', '" . mysql_real_escape_string($nama_bank) . "', '" . mysql_real_escape_string($no_rekening) . "', '" . mysql_real_escape_string($nama_pelanggan) . "', '" . mysql_real_escape_string($keterangan) . "', '" . mysql_real_escape_string($id_hotel) . "')
    ");
    if (!$query_pemasukan) die("Error: Gagal insert pemasukan - " . mysql_error());

    // Update pajak (full, bukan cuma selisih)
    if ($persentase_pajak > 0) {
        $query_pajak = mysql_query("
            UPDATE data_pajak 
            SET waktu = NOW(),
                jenis_pajak = 'PPN',
                persentase_pajak = '" . (float)$persentase_pajak . "',
                pajak = '" . (int)$pajak_total . "'
            WHERE id_transaksi = '$id_transaksi' 
              AND id_hotel = '" . mysql_real_escape_string($id_hotel) . "'
            LIMIT 1
        ");
        if (!$query_pajak) die("Error: Gagal update pajak - " . mysql_error());
    }
} else {
    // Jika tidak ada tambahan biaya

    $query_kamar = mysql_query("UPDATE data_kamar SET status_kamar='Kosong' WHERE id_kamar='$id_kamar'");
    if (!$query_kamar) die("Error: Gagal update status kamar - " . mysql_error());

    $query_transaksi = mysql_query("UPDATE data_transaksi SET status_transaksi='Selesai' WHERE id_transaksi='$id_transaksi'");
    if (!$query_transaksi) die("Error: Gagal update transaksi - " . mysql_error());
}
?>

<script>
    alert("Proses Checkout Berhasil");
    window.location.href = '../home/index.php';
</script>