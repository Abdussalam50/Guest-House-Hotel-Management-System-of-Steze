<?php
include '../../../include/all_include.php';

date_default_timezone_set("Asia/Jakarta");

if (!isset($_POST['id_transaksi'])) {
?>
  <script>
    alert("AKSES DITOLAK");
    location.href = "index.php";
  </script>
  <?php
  die();
}

// ================================
// GET EXISTING TRANSACTION ID
// ================================
$id_transaksi = xss($_POST['id_transaksi']);
$waktu = date("Y-m-d H:i:s");

// ================================
// DATA ADMIN & HOTEL
// ================================
$id_admin = xss($_POST['id_admin']);
$nama_admin = baca_database("", "nama", "select * from data_admin where id_admin='$id_admin'");
$id_hotel = xss($_POST['id_hotel']);
$nama_hotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$id_hotel'");

// ================================
// DATA PELANGGAN
// ================================
$id_pelanggan = xss($_POST['id_pelanggan']);
$nama = xss($_POST['nama']);
$identitas = xss($_POST['identitas']);
$no_identitas = xss($_POST['no_identitas']);
$alamat = xss($_POST['alamat']);
$no_telp = xss($_POST['no_telp']);
$jenis_kelamin = xss($_POST['jenis_kelamin']);

// Update data pelanggan
$query = mysql_query("UPDATE data_pelanggan SET
        nama = '$nama',
        identitas = '$identitas',
        no_identitas = '$no_identitas',
        alamat = '$alamat',
        jenis_kelamin = '$jenis_kelamin',
        no_hp = '$no_telp',
        id_hotel = '$id_hotel'
        WHERE id_pelanggan = '$id_pelanggan'");

$nama_pelanggan = baca_database("", "nama", "select * from data_pelanggan where id_pelanggan='$id_pelanggan'");
$no_hp_pelanggan = baca_database("", "no_hp", "select * from data_pelanggan where id_pelanggan='$id_pelanggan'");

// ================================
// DATA KAMAR
// ================================
$id_kamar = xss($_POST['id_kamar']);
$id_tipe_kamar = baca_database("", "id_tipe_kamar", "select * from data_kamar where id_kamar='$id_kamar'");
$tipe_kamar = baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$id_tipe_kamar'");
$nomor_kamar = baca_database("", "no_kamar", "select * from data_kamar where id_kamar='$id_kamar'");

// ================================
// WAKTU CHECKIN / CHECKOUT
// ================================
$waktu_checkin = xss($_POST['waktu_checkin']);
$jam_checkin = date('H:i:s');
$waktu_check_out = xss($_POST['waktu_check_out']);
$jam_checkout = date("H:i:s");

// ================================
// DATA TRANSAKSI & HARGA
// ================================
$no_rekening = xss($_POST['no_rekening']);
$jumlah_dewasa = is_numeric($_POST['jumlah_dewasa']) ? $_POST['jumlah_dewasa'] : 0;
$jumlah_anak_anak = is_numeric($_POST['jumlah_anak_anak']) ? $_POST['jumlah_anak_anak'] : 0;
$discount = is_numeric($_POST['discount']) ? $_POST['discount'] : 0;
$status_transaksi = xss($_POST['status']);
$id_channel = xss($_POST['id_channel']);
$channel = baca_database("", "channel", "select * from data_channel where id_channel='$id_channel'");
// Harga kamar
$harga_kamar_harian = baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$id_kamar'");
$harga_kamar_bulanan = baca_database("", "harga_bulanan", "select * from data_kamar where id_kamar='$id_kamar'");
$jumlah_hari = is_numeric($_POST['jumlah_hari']) ? $_POST['jumlah_hari'] : 1;

// Jenis transaksi
if (pengaturan_aplikasi('transaksi_bulanan') == "aktif" && isset($_POST['jumlah_bulan']) && $_POST['jumlah_bulan'] > 0) {
  $jumlah_bulan = $_POST['jumlah_bulan'];
  $jenis_transaksi = 'bulanan';
} else {
  $jenis_transaksi = 'harian';
}

// Metode pembayaran
$id_metode_pembayaran = xss($_POST['id_metode_pembayaran']);
$metode_pembayaran = xss($_POST['metode_pembayaran']);
$id_bank = baca_database("", "id_bank", "select * from data_metode_pembayaran where id_metode_pembayaran='$id_metode_pembayaran'");
$nama_bank = baca_database("", "nama_bank", "select * from data_bank where id_bank='$id_bank'");

// Biaya tambahan & catatan
$biaya_tambahan_checkin = is_numeric($_POST['tambahan']) ? $_POST['tambahan'] : 0;
$deskripsi_biaya_checkin = xss($_POST['deskripsi']);
$biaya_tambahan_checkout = 0; // bisa dari form jika ada
$deskripsi_biaya_checkout = '';
$catatan = xss($_POST['catatan']);

// Potongan harga
$potongan_harga = isset($_POST['potongan_harga']) && is_numeric($_POST['potongan_harga']) ? $_POST['potongan_harga'] : 0;

// Pajak
$persentase_pajak = isset($_POST['persentase_pajak']) && is_numeric($_POST['persentase_pajak']) ? $_POST['persentase_pajak'] : 0;

// Nominal bayar
$nominal_bayar = isset($_POST['nominal_bayar']) && is_numeric($_POST['nominal_bayar']) ? $_POST['nominal_bayar'] : 0;

$kembalian = isset($_POST['kembalian']) && is_numeric($_POST['kembalian']) ? $_POST['kembalian'] : 0;
$sisa_bayar = isset($_POST['sisa']) && is_numeric($_POST['sisa']) ? $_POST['sisa'] : 0;

// ================================
// HITUNG TOTAL
// ================================
if ($jenis_transaksi == 'bulanan') {
  $harga_kamar_total = $jumlah_bulan * $harga_kamar_bulanan;
} else {
  $harga_kamar_total = $jumlah_hari * $harga_kamar_harian;
}

// Diskon
$diskon_nominal = ($discount / 100) * $harga_kamar_total;
$discounted_room_price = $harga_kamar_total - $diskon_nominal;

// Subtotal
$subtotal = $discounted_room_price + $biaya_tambahan_checkin + $biaya_tambahan_checkout - $potongan_harga;

// Pajak
$pajak = ($subtotal * $persentase_pajak) / 100;

// Total bayar
$harga_sebelum_pajak = $subtotal;
$total_bayar = $subtotal + $pajak;

if ($nominal_bayar == 0) {
  $nominal_bayar = $total_bayar;
}

// ================================
// MULAI TRANSACTION
// ================================
mysql_query("START TRANSACTION");

// UPDATE DATA TRANSAKSI
$query_transaksi = mysql_query("UPDATE data_transaksi SET
    id_pelanggan = '$id_pelanggan',
    id_kamar = '$id_kamar',
    waktu_checkin = '$waktu_checkin',
    waktu_check_out = '$waktu_check_out',
    no_rekening = '$no_rekening',
    harga_kamar_total = '$harga_kamar_total',
    id_metode_pembayaran = '$id_metode_pembayaran',
    metode_pembayaran = '$metode_pembayaran',
    jumlah_dewasa = '$jumlah_dewasa',
    jumlah_anak_anak = '$jumlah_anak_anak',
    discount = '$discount',
    status_transaksi = '$status_transaksi',
    nama_pelanggan = '$nama_pelanggan',
    no_hp_pelanggan = '$no_hp_pelanggan',
    nomor_kamar = '$nomor_kamar',
    tipe_kamar = '$tipe_kamar',
    jam_checkin = '$jam_checkin',
    jam_checkout = '$jam_checkout',
    jumlah_hari = '$jumlah_hari',
    jenis_transaksi = '$jenis_transaksi',
    id_admin = '$id_admin',
    nama_admin = '$nama_admin',
    id_hotel = '$id_hotel',
    nama_hotel = '$nama_hotel',
    waktu = '$waktu',
    id_bank = '$id_bank',
    nama_bank = '$nama_bank',
    biaya_tambahan_checkin = '$biaya_tambahan_checkin',
    deskripsi_biaya_checkin = '$deskripsi_biaya_checkin',
    biaya_tambahan_checkout = '$biaya_tambahan_checkout',
    deskripsi_biaya_checkout = '$deskripsi_biaya_checkout',
    catatan = '$catatan',
    harga_kamar_harian = '$harga_kamar_harian',
    harga_kamar_bulanan = '$harga_kamar_bulanan',
    potongan_harga = '$potongan_harga',
    persentase_pajak = '$persentase_pajak',
    pajak = '$pajak',
    harga_sebelum_pajak = '$harga_sebelum_pajak',
    total_bayar = '$total_bayar',
    nominal_bayar = '$nominal_bayar',
    kembalian = '$kembalian',
    sisa_bayar = '$sisa_bayar',
    id_channel = '$id_channel',
    channel = '$channel',
    identitas = '$identitas',
    no_identitas = '$no_identitas',
    alamat = '$alamat',
    jenis_kelamin = '$jenis_kelamin'
    WHERE id_transaksi = '$id_transaksi'");

// UPDATE DATA PAJAK
if ($persentase_pajak > 0) {
  $type_pajak = pengaturan_aplikasi('type_pajak');
  $query_pajak = mysql_query("UPDATE data_pajak SET
        waktu = '$waktu',
        id_transaksi = '$id_transaksi',
        type_pajak = '$type_pajak',
        persentase_pajak = '$persentase_pajak',
        pajak = '$pajak',
        id_hotel = '$id_hotel'
        WHERE id_transaksi = '$id_transaksi'");
} else {
  $query_pajak = mysql_query("DELETE FROM data_pajak WHERE id_transaksi = '$id_transaksi'");
}

// UPDATE DATA PEMASUKAN
$keterangan = 'Pembayaran Checkin A.n ' . $nama_pelanggan . ', Kamar Nomor ' . $nomor_kamar . ' (' . ($tipe_kamar) . ")";
$query_pemasukan = mysql_query("UPDATE data_pemasukan SET
    waktu = '$waktu',
    id_transaksi = '$id_transaksi',
    jumlah = '$total_bayar',
    id_metode_pembayaran = '$id_metode_pembayaran',
    metode_pembayaran = '$metode_pembayaran',
    nama_bank = '$nama_bank',
    no_rekening = '$no_rekening',
    nama_pelanggan = '$nama_pelanggan',
    keterangan = '$keterangan',
    id_hotel = '$id_hotel'
    WHERE id_transaksi = '$id_transaksi'");

// UPDATE STATUS KAMAR
$query_status = mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='$id_kamar'");

// CEK SEMUA QUERY
if ($query_transaksi && $query_pajak && $query_pemasukan && $query_status) {
  mysql_query("COMMIT");

  ?>
    <script>
      window.location.href = "index.php?input=popup_edit";
    </script>
  <?php

  
} else {
  mysql_query("ROLLBACK");
  echo "Terjadi kesalahan: " . mysql_error();
}
?>