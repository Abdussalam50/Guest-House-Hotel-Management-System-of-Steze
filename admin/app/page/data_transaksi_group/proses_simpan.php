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


// echo "\n=== POST ===\n";
// print_r($_POST);
// echo "</pre>";

// die();

// ================================
// GENERATE ID DAN WAKTU
// ================================
$id_transaksi = xss($_POST['id_transaksi']);
$jumlah_hari = is_numeric($_POST['jumlah_hari']) ? $_POST['jumlah_hari'] : 1;
$waktu = date("Y-m-d H:i:s");


// ================================
// DATA KAMAR (AMBIL DARI TRANSAKSI LIST)
// ================================


// Bersihkan input
$id_transaksi = mysql_real_escape_string(trim($_POST['id_transaksi']));

// Query ambil semua kamar untuk transaksi ini
$sql = "SELECT  *
        FROM data_transaksi_list_kamar 
        WHERE id_transaksi = '$id_transaksi' ";

$query = mysql_query($sql) or die('Error query: ' . mysql_error());
$jml   = mysql_num_rows($query);

// Default value
$id_kamar        = '';
$no_kamar        = '';
$tipe_kamar      = '';
$jumlah_dewasa   = 0;
$jumlah_anak_anak = 0;
$harga_kamar_total = 0;

if ($jml == 0) {
  // Tidak ada kamar (jarang, tapi untuk aman)
  $id_kamar = '';
  $no_kamar = '';
} elseif ($jml == 1) {
  // === HANYA 1 KAMAR → PAKAI STRING BIASA ===
  $row = mysql_fetch_assoc($query);

  $id_kamar         = $row['id_kamar'];
  $no_kamar         = $row['no_kamar'];
  $jumlah_dewasa    = (int)$row['jumlah_dewasa'];
  $jumlah_anak_anak = (int)$row['jumlah_anak_anak'];
  $harga_kamar_harian = $row['harga_kamar_harian'];
  $harga_kamar_bulanan = $row['harga_kamar_bulanan'];
  $harga_kamar_total = $harga_kamar_harian * $jumlah_hari;

  // Ambil tipe kamar (dari tabel data_kamar & data_tipe_kamar)
  $q_tipe = mysql_query("SELECT dk.id_tipe_kamar, dtk.tipe_kamar 
                           FROM data_kamar dk 
                           JOIN data_tipe_kamar dtk ON dk.id_tipe_kamar = dtk.id_tipe_kamar 
                           WHERE dk.id_kamar = '$id_kamar'");
  $r_tipe = mysql_fetch_assoc($q_tipe);
  $id_tipe_kamar = $r_tipe['id_tipe_kamar'];
  $tipe_kamar    = $r_tipe['tipe_kamar'];


  // UPDATE STATUS KAMAR
  $query_status = mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='$id_kamar'");
} else {
  // === LEBIH DARI 1 KAMAR → SEMUA JADI JSON ===
  $arr_id_kamar    = array();
  $arr_no_kamar    = array();
  $arr_tipe_kamar  = array();
  $arr_dewasa      = array();
  $arr_anak        = array();

  while ($row = mysql_fetch_assoc($query)) {
    $arr_id_kamar[]    = $row['id_kamar'];
    $arr_no_kamar[]    = $row['no_kamar'];
    $arr_dewasa[]      = (int)$row['jumlah_dewasa'];
    $arr_anak[]        = (int)$row['jumlah_anak_anak'];
    $arr_harian[]        = (int)$row['harga_kamar_harian'];
    $arr_bulanan[]        = (int)$row['harga_kamar_bulanan'];
    $harga_kamar_total = $harga_kamar_total + ((int)$row['harga_kamar_harian'] * $jumlah_hari);

    // Ambil tipe kamar tiap kamar
    $q_tipe = mysql_query("SELECT dtk.tipe_kamar 
                               FROM data_kamar dk 
                               JOIN data_tipe_kamar dtk ON dk.id_tipe_kamar = dtk.id_tipe_kamar 
                               WHERE dk.id_kamar = '" . $row['id_kamar'] . "'");
    $r_tipe = mysql_fetch_assoc($q_tipe);
    $arr_tipe_kamar[] = $r_tipe['tipe_kamar'];


    // UPDATE STATUS KAMAR
    $id_kamar =  $row['id_kamar'];
    $query_status = mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='$id_kamar'");
  }

  // Hasil akhir dalam bentuk JSON
  $id_kamar         = json_encode($arr_id_kamar);        // ["K001","K005"]
  $no_kamar         = json_encode($arr_no_kamar);        // ["101","205"]
  $tipe_kamar       = json_encode($arr_tipe_kamar);      // ["Deluxe","Suite"]
  $jumlah_dewasa    = json_encode($arr_dewasa);          // [2,1]
  $jumlah_anak_anak = json_encode($arr_anak);            // [0,2]
  $harga_kamar_harian = json_encode($arr_harian);            // [0,2]
  $harga_kamar_bulanan = json_encode($arr_bulanan);            // [0,2]
}


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
$discount = is_numeric($_POST['discount']) ? $_POST['discount'] : 0;
$status_transaksi = xss($_POST['status']);
$id_channel = xss($_POST['id_channel']);
$channel = baca_database("", "channel", "select * from data_channel where id_channel='$id_channel'");


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

//deposit
$id_metode_deposit = xss($_POST['id_metode_pembayaran_deposit']) == null ? '-' : xss($_POST['id_metode_pembayaran_deposit']);
$no_rek_deposit = xss($_POST['no_rekening_deposit']) == null ? '-' : xss($_POST['no_rekening_deposit']);
$metode_deposit = xss($_POST['metode_pembayaran_deposit']) == null ? '-' : xss($_POST['metode_pembayaran_deposit']);
$nominal_deposit = xss($_POST['nominal_deposit']) == 0 ? 0 : xss($_POST['nominal_deposit']);
if ($nominal_deposit !== 0 && $nominal_deposit !== null) {
  $id_deposit = id_otomatis("data_deposit", "id_deposit", 10);
} else {
  $id_deposit = '-';
}
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
'$no_rekening','$harga_kamar_total','$id_metode_pembayaran','$metode_pembayaran','$jumlah_dewasa','$jumlah_anak_anak',
'$discount','$status_transaksi','$nama_pelanggan','$no_hp_pelanggan','$no_kamar','$tipe_kamar',
'$jam_checkin','$jam_checkout','$jumlah_hari','$jenis_transaksi','$id_admin','$nama_admin','$id_hotel','$nama_hotel',
'$waktu','$id_bank','$nama_bank','$biaya_tambahan_checkin','$deskripsi_biaya_checkin','$biaya_tambahan_checkout','$deskripsi_biaya_checkout',
'$catatan','$harga_kamar_harian','$harga_kamar_bulanan','$potongan_harga','$persentase_pajak','$pajak','$harga_sebelum_pajak','$total_bayar','$nominal_bayar','$kembalian','$sisa_bayar'
,'$id_channel'
,'$channel'
,'$identitas'
,'$no_identitas'
,'$alamat'
,'$jenis_kelamin'
,'$id_deposit'
,'$id_metode_deposit'
,'$no_rek_deposit'
,'$metode_deposit'
,'$nominal_deposit')");

$sql_transaksi = "INSERT INTO data_transaksi VALUES (
'$id_transaksi','$id_pelanggan','$id_kamar','$waktu_checkin','$waktu_check_out',
'$no_rekening','$harga_kamar_total','$id_metode_pembayaran','$metode_pembayaran','$jumlah_dewasa','$jumlah_anak_anak',
'$discount','$status_transaksi','$nama_pelanggan','$no_hp_pelanggan','$no_kamar','$tipe_kamar',
'$jam_checkin','$jam_checkout','$jumlah_hari','$jenis_transaksi','$id_admin','$nama_admin','$id_hotel','$nama_hotel',
'$waktu','$id_bank','$nama_bank','$biaya_tambahan_checkin','$deskripsi_biaya_checkin','$biaya_tambahan_checkout','$deskripsi_biaya_checkout',
'$catatan','$harga_kamar_harian','$harga_kamar_bulanan','$potongan_harga','$persentase_pajak','$pajak','$harga_sebelum_pajak','$total_bayar','$nominal_bayar','$kembalian','$sisa_bayar'
,'$id_channel'
,'$channel'
,'$identitas'
,'$no_identitas'
,'$alamat'
,'$jenis_kelamin'
,'$id_deposit'
,'$id_metode_deposit'
,'$no_rek_deposit'
,'$metode_deposit'
,'$nominal_deposit')";
// INSERT DATA PAJAK

if ($persentase_pajak > 0) {
  $id_pajak = id_otomatis("data_pajak", "id_pajak", "10");
  $waktu = date("Y-m-d H:i:s");
  $type_pajak = pengaturan_aplikasi('type_pajak');
  $query_pajak = mysql_query("INSERT INTO data_pajak VALUES (
        '$id_pajak','$waktu','$id_transaksi','$type_pajak','$persentase_pajak','$pajak','$id_hotel'
    )");
  $sql_pajak = "INSERT INTO data_pajak VALUES (
        '$id_pajak','$waktu','$id_transaksi','$type_pajak','$persentase_pajak','$pajak','$id_hotel'
    )";
} else {
  $query_pajak = true;
}



// INSERT DATA PEMASUKAN
$id_pemasukan = id_otomatis("data_pemasukan", "id_pemasukan", "10");
$keterangan = 'Pembayaran Checkin Group Harian A.n ' . $nama_pelanggan . ', Kamar Nomor ' . $no_kamar . ' (' . ($tipe_kamar) . ")";
$query_pemasukan = mysql_query("INSERT INTO data_pemasukan VALUES (
    '$id_pemasukan','$waktu','$id_transaksi','$total_bayar','$id_metode_pembayaran','$metode_pembayaran','$nama_bank','$no_rekening','$nama_pelanggan','$keterangan','$id_hotel'
)");
$sql_pemasukan = "INSERT INTO data_pemasukan VALUES (
    '$id_pemasukan','$waktu','$id_transaksi','$total_bayar','$id_metode_pembayaran','$metode_pembayaran','$nama_bank','$no_rekening','$nama_pelanggan','$keterangan','$id_hotel'
)";
//INSERT DATA DEPOSIT
if ($nominal_deposit !== 0) {
  $query_deposit = mysql_query("INSERT INTO data_deposit VALUES('$id_deposit','$id_pelanggan','$id_transaksi',NOW(),'$nominal_deposit','$id_admin','$nama_admin','$id_metode_deposit','$no_rek_deposit','$metode_deposit','$id_hotel')");
  $sql_deposit = "INSERT INTO data_deposit VALUES('$id_deposit','$id_pelanggan','$id_transaksi',NOW(),'$nominal_deposit','$id_admin','$nama_admin','$id_metode_deposit','$no_rek_deposit','$metode_deposit','$id_hotel')";
} else {
  $query_deposit = true;
}


// CEK SEMUA QUERY

if ($query_transaksi && $query_pajak && $query_pemasukan && $query_deposit && $query_status) {
  mysql_query("COMMIT");

  //SIMPAN 
  if ($id_admin == null) {
    $username_pengelola = decrypt($_COOKIE['jenenge']);
    $id_admin = baca_database("", "", "select * from data_pengelola where username='$username'");
  }
  simpan_riwayat("data_transaksi", "id_transaksi", $id_transaksi, $sql_transaksi, $id_admin);
  simpan_riwayat("data_pemasukan", "id_pemasukan", $id_pemasukan, $sql_pemasukan, $id_admin);
  if ($nominal_deposit > 0) {
    simpan_riwayat("data_deposit", "id_deposit", $id_deposit, $sql_deposit, $id_admin);
  } elseif ($pajak > 0) {
    simpan_riwayat("data_pajak", "id_pajak", $id_pajak, $sql_pajak, $id_admin);
  }

  if (pengaturan_printer("ukuran_kertas", $id_hotel) == "A4") {
  ?>
    <script>
      window.location.href = "../checkout/notaA4-group.php?id_trx=<?php echo $id_transaksi ?>&status=checkin";
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