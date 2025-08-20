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
// GENERATE ID DAN WAKTU
// ================================
$id_transaksi = id_otomatis("data_transaksi", "id_transaksi", "10");
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

if ($id_pelanggan == "") {
  $id_pelanggan = id_otomatis("data_pelanggan", "id_pelanggan", 10);
  $query = mysql_query("INSERT INTO data_pelanggan 
        (id_pelanggan, nama, identitas, no_identitas, alamat, jenis_kelamin, id_hotel, no_hp) 
        VALUES ('$id_pelanggan','$nama','$identitas','$no_identitas','$alamat','$jenis_kelamin','$id_hotel','$no_telp')");
} else {
  // Update data pelanggan
  $query = mysql_query("UPDATE data_pelanggan SET
        nama = '$nama',
        identitas = '$identitas',
        no_identitas = '$no_identitas',
        alamat = '$alamat',
        jenis_kelamin = '$jenis_kelamin',
        no_hp = '$no_telp'
        WHERE id_pelanggan = '$id_pelanggan'");
}


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
$metode_transaksi = xss($_POST['id_metode_pembayaran']);
$id_bank = baca_database("", "id_bank", "select * from data_metode_pembayaran where id_metode_pembayaran='$metode_transaksi'");
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

// INSERT DATA TRANSAKSI
$query_transaksi = mysql_query("INSERT INTO data_transaksi VALUES (
'$id_transaksi','$id_pelanggan','$id_kamar','$waktu_checkin','$waktu_check_out',
'$no_rekening','$harga_kamar_total','$metode_transaksi','$jumlah_dewasa','$jumlah_anak_anak',
'$discount','$status_transaksi','$nama_pelanggan','$no_hp_pelanggan','$nomor_kamar','$tipe_kamar',
'$jam_checkin','$jam_checkout','$jumlah_hari','$jenis_transaksi','$id_admin','$nama_admin','$id_hotel','$nama_hotel',
'$waktu','$id_bank','$nama_bank','$biaya_tambahan_checkin','$deskripsi_biaya_checkin','$biaya_tambahan_checkout','$deskripsi_biaya_checkout',
'$catatan','$harga_kamar_harian','$harga_kamar_bulanan','$potongan_harga','$persentase_pajak','$pajak','$harga_sebelum_pajak','$total_bayar','$nominal_bayar','$kembalian','$sisa_bayar'
,'$id_channel','$channel'
)");

// INSERT DATA PAJAK

if ($persentase_pajak > 0) {
  $id_pajak = id_otomatis("data_pajak", "id_pajak", "10");
  $waktu = date("Y-m-d H:i:s");
  $type_pajak = pengaturan_aplikasi('type_pajak');
  $query_pajak = mysql_query("INSERT INTO data_pajak VALUES (
        '$id_pajak','$waktu','$id_transaksi','$type_pajak','$persentase_pajak','$pajak','$id_hotel'
    )");
} else {
  $query_pajak = true;
}

// INSERT DATA PEMASUKAN
$id_pemasukan = id_otomatis("data_pemasukan", "id_pemasukan", "10");
$keterangan = 'Pembayaran Checkin A.n ' . $nama_pelanggan . ', Kamar Nomor ' . $nomor_kamar . ' (' . ($tipe_kamar) . ")";
$query_pemasukan = mysql_query("INSERT INTO data_pemasukan VALUES (
    '$id_pemasukan','$waktu','$id_transaksi','$total_bayar','$metode_transaksi','$nama_bank','$no_rekening','$nama_pelanggan','$keterangan','$id_hotel'
)");

// UPDATE STATUS KAMAR
$query_status = mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='$id_kamar'");

// CEK SEMUA QUERY
if ($query_transaksi && $query_pajak && $query_pemasukan && $query_status) {
  mysql_query("COMMIT");


  if (pengaturan_printer("ukuran_kertas", $id_hotel) == "A4") {
  ?>
    <script>
      window.location.href = "../checkout/notaA4.php?id_trx=<?php echo $id_transaksi ?>&status=checkin";
    </script>
  <?php
  } else {
  ?>
    <script>
      // Redirect nota
      window.location.href = "../checkout/cetak_nota.php?id_trx=<?php echo $id_transaksi ?>&status=checkin";
    </script>
<?php
  }
} else {
  mysql_query("ROLLBACK");
  echo "Terjadi kesalahan: " . mysql_error();
}
?>