<?php
include '../../../include/koneksi/koneksi.php';
include '../../../include/function/all.php';
require __DIR__ . '/vendor/autoload.php';
date_default_timezone_set("Asia/Jakarta");

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;

$preview = true;

// Fungsi untuk preview di browser sekaligus tetap kirim ke printer
function printer_text($text, $newline = true)
{
    global $printer;
    global $preview;
    if ($newline) {
        $text .= "\n";
    }

    if ($preview == true) {
        echo nl2br(htmlspecialchars($text));
    }


    $printer->text($text);
}

try {
    // Inisialisasi konektor dan printer
    $connector = new WindowsPrintConnector('RP-58Printer');
    $printer = new Printer($connector);
    $printer->setTextSize(1, 1);
    $ukuran_kertas = 48; // Sesuaikan dengan jumlah karakter per baris pada printer 58mm
    // $image=EscposImage::load('../../../upload/'.baca_database("data_pengaturan_printer","gambar_logo",""));

    // Ambil data transaksi
    if (isset($_GET['id_trx'])) {
        $data = mysql_real_escape_string($_GET['id_trx']);
        $id_transaksi = $data;
    } else {
        $data = json_decode(file_get_contents('php://input'), true);
        $id_transaksi = $data['id_trx'];
    }

    $query = mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$id_transaksi'");
    $datas = mysql_fetch_array($query);

    // Ambil data pelanggan, kamar, tipe kamar
    $nama = ucwords(baca_database("", "nama", "select *from data_pelanggan where id_pelanggan='$datas[id_pelanggan]'"));
    $kamar = 'Kamar ' . baca_database("", "no_kamar", "select * from data_kamar where id_kamar='$datas[id_kamar]'");
    $id_tipe_kamar = baca_database("", "id_tipe_kamar", "select * from data_kamar where id_kamar='$datas[id_kamar]'");
    $tipe_kamar = baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$id_tipe_kamar'");

    // Format tanggal
    $waktu_checkin = format_indo($datas['waktu_checkin']);
    $waktu_checkout = format_indo($datas['waktu_checkout']); // perbaikan bagian ini

    // Admin
    $admin = isset($data['username']) ? baca_database("", "nama", "select * from data_admin where username='$data[username]'") : $datas['nama_admin'];

    // Data lain
    $metode_transaksi = $datas['metode_transaksi'];
    $jumlah_dewasa = $datas['jumlah_dewasa'];
    $jumlah_anak_anak = $datas['jumlah_anak_anak'];
    $discount = $datas['discount'];
    $tarif = number_format($datas['total_bayar']);
    $total = isset($data['total']) ? number_format($data['total']) : number_format($datas['nominal_bayar']);
    $kembalian = isset($data['kembalian1']) ? number_format($data['kembalian1']) : ($datas['kembalian_checkout'] !== null ? number_format($datas['kembalian_checkout']) : number_format($datas['jumlah_kembalian']));
    $biaya_tambahan_checkin = $datas['biaya_tambahan_checkin'] == null ? 0 : number_format($datas['biaya_tambahan_checkin']);
    $biaya_tambahan_checkout = $datas['biaya_tambahan_checkout'] == null ? 0 : number_format($datas['biaya_tambahan_checkout']);
    $tanggal = format_indo(date("Y-m-d"));
    $jumlah_hari = $datas['jumlah_hari'];
    $status_transaksi = $datas['status_transaksi'];
    $sisa_pembayaran = $datas['sisa_pembayaran'] == null ? number_format(0) : number_format($datas['sisa_pembayaran']);
    $harga_kamar = number_format(baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$datas[id_kamar]'"));

    // === Mulai cetak/preview ===
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->initialize();

    // Judul
    $printer->setTextSize(2, 2);
    printer_text("STeZe");

    // Logo jika ada
    // $printer->graphics($image);

    $printer->setTextSize(1, 1);
    printer_text("========================");

    // Tanggal & Admin
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    printer_text("Tanggal : $tanggal");
    printer_text("Admin   : $admin");
    printer_text("------------------------");

    // Data Tamu
    printer_text("Nama        : $nama");
    printer_text("No Kamar    : $kamar");
    printer_text("Tipe Kamar  : $tipe_kamar");
    printer_text("Check-in    : $waktu_checkin");
    printer_text("Check-out   : $waktu_checkout");
    printer_text("Jumlah Hari : $jumlah_hari");
    printer_text("Dewasa      : $jumlah_dewasa");
    printer_text("Anak-Anak   : $jumlah_anak_anak");

    printer_text("Harga Kamar : Rp $harga_kamar");
    printer_text("Discount    : $discount %");
    printer_text("Tambahan In : Rp $biaya_tambahan_checkin");
    printer_text("Tambahan Out: Rp $biaya_tambahan_checkout");
    printer_text("Status      : $status_transaksi");
    printer_text("------------------------");

    // Total Pembayaran
    printer_text("Total       : Rp $tarif");
    printer_text("Bayar       : Rp $total");
    if ($status_transaksi == 'Lunas') {
        printer_text("Kembalian   : Rp $kembalian");
    } else {
        printer_text("Sisa Bayar  : Rp $sisa_pembayaran");
    }

    printer_text("========================");

    // Footer Terima Kasih
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    printer_text("Terima Kasih");
    printer_text("========================");

    $printer->feed(3);
    $printer->cut();
    $printer->close();

    // Update status transaksi jika bukan GET
    if (!isset($_GET['id_trx'])) {
        $query_checkout = mysql_query("UPDATE data_kamar SET status_kamar='Kosong' WHERE id_kamar='$datas[id_kamar]'");
        $query_transaksi = mysql_query("UPDATE data_transaksi SET status_transaksi='Selesai' WHERE id_transaksi='$id_transaksi'");
        if ($query_checkout && $query_transaksi) {
            echo json_encode('true');
        } else {
            echo json_encode(mysql_error());
        }
    } else {

        if ($preview == false) { ?>
            <script>
                location.href = '../home/index.php'
            </script>
        <?php
        }
    }
} catch (Exception $e) {
    // Jika error
    if (!isset($_GET['id_trx'])) {
        $query_checkout = mysql_query("UPDATE data_kamar SET status_kamar='Kosong' WHERE id_kamar='$datas[id_kamar]'");
        $query_transaksi = mysql_query("UPDATE data_transaksi SET status_transaksi='Selesai' WHERE id_transaksi='$id_transaksi'");
        if ($query_checkout && $query_transaksi) {
            echo json_encode('true');
        }
    } else {
        //echo json_encode(['error' => $e->getMessage()]);

        if ($preview == false) { ?>
            <script>
                location.href = '../home/index.php'
            </script>
        <?php
        }

        ?>

<?php
    }
}
