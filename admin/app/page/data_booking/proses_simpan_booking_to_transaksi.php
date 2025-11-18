<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

?>

<?php
include '../../../include/all_include.php';

date_default_timezone_set("Asia/Jakarta");

// Pastikan hanya diproses lewat tombol "Proses Check-in"
if (!isset($_POST['bayar_booking_lunas'])) {
    echo "<script>alert('Akses ditolak'); window.history.back();</script>";
    exit;
}

$id_booking = xss($_POST['id_transaksi']);
$nominal_bayar_baru = (int)$_POST['nominal_bayar'];
$kembalian = (int)$_POST['kembalian'];
$deposit_tambahan = (int)($_POST['deposit_tambahan'] ?? 0);
$id_metode_pembayaran = xss($_POST['id_metode_pembayaran']);
$metode_pembayaran = xss($_POST['metode_pembayaran_text']);
$no_rekening = xss($_POST['no_rekening'] ?? '-');
$no_rekening_deposit = xss($_POST['no_rekening_deposit'] ?? '-');
$id_bank = xss($_POST['id_bank'] ?? '-');
$nama_bank = xss($_POST['nama_bank'] ?? '-');

$id_metode_deposit = xss($_POST['id_metode_deposit'] ?? '');
$metode_deposit = xss($_POST['metode_deposit_text'] ?? '');

// Ambil data booking
$query_bk = mysql_query("SELECT * FROM data_booking WHERE id_transaksi='$id_booking'") or die(mysql_error());
if (mysql_num_rows($query_bk) == 0) {
    die("Data booking tidak ditemukan!");
}
$bk = mysql_fetch_array($query_bk);

// Data admin & hotel (sama seperti di tambah.php)
$username = decrypt($_COOKIE['jenenge']);
$id_admin = baca_database("", "id_admin", "SELECT * FROM data_admin WHERE username='$username'");
if ($id_admin == null) {
    $id_admin = baca_database("", "id_pengelola", "SELECT * FROM data_pengelola WHERE username='$username'");
}
$nama_admin = baca_database("", "nama", "SELECT * FROM data_admin WHERE id_admin='$id_admin'");
if ($nama_admin == "") {
    $nama_admin = baca_database("", "nama", "SELECT * FROM data_pengelola WHERE id_pengelola='$id_admin'");
}
$id_hotel = $bk['id_hotel'];
$nama_hotel = $bk['nama_hotel'];

$jenis_transaksi = $bk['jenis_transaksi'];
$jenis_group = json_check($bk['id_kamar']) ? "group" : "non_group";


// Hitung ulang nilai untuk transaksi
$total_deposit = $deposit_tambahan;
$total_nominal_bayar =  $nominal_bayar_baru;
$sisa_sebelumnya = xss($_POST['sisa_sebelumnya']);



// Gunakan id_transaksi yang sama dengan booking
$id_transaksi = $id_booking;
$waktu_transaksi = date("Y-m-d H:i:s");
$waktu_checkin = date("Y-m-d");
$jam_checkin = date("H:i:s");

// 4. Insert deposit tambahan (jika ada)
if ($deposit_tambahan > 0) {
    $id_deposit = id_otomatis("data_deposit", "id_deposit", "10");
} else {
    $id_deposit = '-';
}

// Mulai transaksi
mysql_query("START TRANSACTION");

try {
    // 1. INSERT ke data_transaksi (pindah dari booking)
    // === PERBAIKAN KHUSUS UNTUK JSON (TANPA UBAH STRUKTUR KODE LAMA) ===
    $id_kamar_escaped       = ($bk['id_kamar']);
    $no_kamar_escaped       = ($bk['no_kamar']);
    $tipe_kamar_escaped     = ($bk['tipe_kamar']);
    $jumlah_dewasa_escaped  = ($bk['jumlah_dewasa']);
    $jumlah_anak_escaped    = ($bk['jumlah_anak_anak']);
    $harga_harian_escaped   = ($bk['harga_kamar_harian']);
    $harga_bulanan_escaped  = ($bk['harga_kamar_bulanan']);
    $alamat_escaped         = ($bk['alamat_pelanggan']);
    // =====================================================================

    // 1. INSERT ke data_transaksi (pindah dari booking)
    $sql_transaksi = "INSERT INTO data_transaksi VALUES (
        '$id_transaksi',
        '{$bk['id_pelanggan']}',
        '$id_kamar_escaped',                     /* DI-ESCAPE */
        '$waktu_checkin',
        '{$bk['waktu_checkout']}',
        '$no_rekening',
        '{$bk['total_harga_kamar']}',
        '$id_metode_pembayaran',
        '$metode_pembayaran',
        '$jumlah_dewasa_escaped',                /* DI-ESCAPE */
        '$jumlah_anak_escaped',                  /* DI-ESCAPE */
        '{$bk['discount']}',
        'Lunas',
        '{$bk['nama_pelanggan']}',
        '{$bk['no_hp_pelanggan']}',
        '$no_kamar_escaped',                     /* DI-ESCAPE */
        '$tipe_kamar_escaped',                   /* DI-ESCAPE */
        '$jam_checkin',
        '{$bk['jam_checkout']}',
        '{$bk['jumlah_hari']}',
        '{$bk['jenis_transaksi']}',
        '$id_admin',
        '$nama_admin',
        '$id_hotel',
        '$nama_hotel',
        '$waktu_transaksi',
        '$id_bank',
        '$nama_bank',
        '{$bk['biaya_tambahan_checkin']}',
        '{$bk['deskripsi_biaya_checkin']}',
        '{$bk['biaya_tambahan_checkout']}',
        '{$bk['deskripsi_biaya_checkout']}',
        '{$bk['catatan']}',
        '$harga_harian_escaped',                 /* DI-ESCAPE */
        '$harga_bulanan_escaped',                /* DI-ESCAPE */
        '{$bk['potongan_harga']}',
        '{$bk['persentase_pajak']}',
        '{$bk['pajak']}',
        '{$bk['harga_sebelum_pajak']}',
        '{$bk['total_bayar']}',
        '$total_nominal_bayar',
        '$kembalian',
        '0',
        '{$bk['id_channel']}',
        '{$bk['channel']}',
        '{$bk['identitas_pelanggan']}',
        '{$bk['no_identitas_pelanggan']}',
        '$alamat_escaped',                       /* DI-ESCAPE */
        '{$bk['jenis_kelamin_pelanggan']}',
        '$id_deposit',
        '$id_metode_deposit',
        '$no_rekening_deposit',
        '$metode_deposit',
        '$total_deposit'
    )";

    $query_transaksi = mysql_query($sql_transaksi) or die(mysql_error());


    // === TAMBAHAN: PINDAHKAN data_booking_list_kamar → data_transaksi_list_kamar ===
    $q_list = mysql_query("SELECT * FROM data_booking_list_kamar WHERE id_transaksi='$id_booking'");
    while ($list = mysql_fetch_array($q_list)) {
        $id_list_baru = id_otomatis("data_transaksi_list_kamar", "id_transaksi_list_kamar", "15"); // atau pakai prefix LIST-TRANS-...

        mysql_query("INSERT INTO data_transaksi_list_kamar VALUES (
            '$id_list_baru',
            '$id_transaksi',
            NOW(),
            '" . mysql_real_escape_string($list['id_kamar']) . "',
            '" . mysql_real_escape_string($list['no_kamar']) . "',
            '" . mysql_real_escape_string($list['jumlah_dewasa']) . "',
            '" . mysql_real_escape_string($list['jumlah_anak_anak']) . "',
            '" . mysql_real_escape_string($list['harga_kamar_harian']) . "',
            '" . mysql_real_escape_string($list['harga_kamar_bulanan']) . "',
            '{$list['total_harga_kamar']}',
            '{$list['jumlah_hari']}',
            '{$list['jenis_transaksi']}'
        )") or die("Gagal pindah list kamar: " . mysql_error());
    }
    // ===========================================================================

    // 2. Insert pajak (jika ada)
    if ($bk['persentase_pajak'] > 0) {
        $id_pajak = id_otomatis("data_pajak", "id_pajak", "10");
        mysql_query("INSERT INTO data_pajak VALUES (
            '$id_pajak','$waktu_transaksi','$id_transaksi','" . pengaturan_aplikasi('type_pajak') . "','{$bk['persentase_pajak']}','{$bk['pajak']}','$id_hotel'
        )") or die(mysql_error());
    }

    // 3. Insert pemasukan (hanya untuk pelunasan + deposit tambahan)
    $id_pemasukan = id_otomatis("data_pemasukan", "id_pemasukan", "10");
    $keterangan_pemasukan = "Pelunasan Booking Ke Transaksi A.n {$bk['nama_pelanggan']}, Kamar {$bk['no_kamar']} ({$bk['tipe_kamar']})";
    mysql_query("INSERT INTO data_pemasukan VALUES (
        '$id_pemasukan','$waktu_transaksi','$id_transaksi','$sisa_sebelumnya','$id_metode_pembayaran','$metode_pembayaran','$nama_bank','$no_rekening','{$bk['nama_pelanggan']}','$keterangan_pemasukan','$id_hotel'
    )") or die(mysql_error());


    // 4. Insert deposit tambahan (jika ada)
    if ($deposit_tambahan > 0) {
        mysql_query("INSERT INTO data_deposit VALUES (
            '$id_deposit','{$bk['id_pelanggan']}','$id_transaksi',NOW(),'$deposit_tambahan','$id_admin','$nama_admin','$id_metode_deposit','$no_rekening_deposit','$metode_deposit','$id_hotel'
        )") or die(mysql_error());

        // Update kolom id_deposit di transaksi (karena baru dibuat)
        mysql_query("UPDATE data_transaksi SET id_deposit='$id_deposit' WHERE id_transaksi='$id_transaksi'");
    }


    // Tambahan: Update semua kamar jika group booking
    if ($jenis_group == "group") {
        $daftar_kamar = json_decode($bk['id_kamar'], true);
        if (is_array($daftar_kamar)) {
            foreach ($daftar_kamar as $idk) {
                mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='$idk'");
            }
        }
    } else {
        mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='{$bk['id_kamar']}'");
    }

    // 6. Update status booking jadi Selesai (atau bisa di-delete jika tidak mau disimpan)
    mysql_query("UPDATE data_booking SET status_transaksi='Selesai' WHERE id_transaksi='$id_booking'") or die(mysql_error());
    // Jika ingin hapus: // mysql_query("DELETE FROM data_booking WHERE id_transaksi='$id_booking'");

    // 7. Simpan riwayat
    simpan_riwayat("data_transaksi", "id_transaksi", $id_transaksi, $sql_transaksi, $id_admin);
    simpan_riwayat("data_pemasukan", "id_pemasukan", $id_pemasukan, "", $id_admin);
    if ($deposit_tambahan > 0) {
        simpan_riwayat("data_deposit", "id_deposit", $id_deposit, "", $id_admin);
    }

    mysql_query("COMMIT");

    if ($jenis_transaksi == "harian" && $jenis_group == "non_group") {
        $link = "../checkout/notaA4.php";
    } elseif ($jenis_transaksi == "bulanan" && $jenis_group == "non_group") {
        $link = "../checkout/notaA4-bulanan.php";
    } elseif ($jenis_transaksi == "harian" && $jenis_group == "group") {
        $link = "../checkout/notaA4-group.php";
    } elseif ($jenis_transaksi == "bulanan" && $jenis_group == "group") {
        $link = "../checkout/notaA4-bulanan-group.php";
    }


    echo "<script>window.location.href = '" . $link . "?id_trx=$id_transaksi&status=checkin';</script>";
} catch (Exception $e) {
    mysql_query("ROLLBACK");
    echo "Terjadi kesalahan: " . $e->getMessage();
}
exit;
