<?php
include '../../../include/koneksi/koneksi.php';
include '../../../include/function/all.php';
require __DIR__ . '/vendor/autoload.php';
date_default_timezone_set("Asia/Jakarta");

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;

try {
    $connector = new WindowsPrintConnector('RP-58Printer');
    $printer = new Printer($connector);
    $printer->setTextSize(1, 1);
    $ukuran_kertas = 48; // Sesuaikan dengan jumlah karakter per baris pada printer 58mm
    $image=EscposImage::load('../../../upload/'.baca_database("data_pengaturan_printer","gambar_logo",""));
    $data = json_decode(file_get_contents('php://input'), true);
    $id_transaksi = $data['id_trx'];

    $query = mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$id_transaksi'");
    $datas = mysql_fetch_array($query);

    $nama = ucwords(baca_database("", "nama", "select *from data_pelanggan where id_pelanggan='$datas[id_pelanggan]'"));
    $kamar = 'Kamar ' . baca_database("", "no_kamar", "select * from data_kamar where id_kamar='$datas[id_kamar]'");
    $id_tipe_kamar = baca_database("", "id_tipe_kamar", "select * from data_kamar where id_kamar='$datas[id_kamar]'");
    $tipe_kamar = baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$id_tipe_kamar'");
    $waktu_checkin = format_indo($datas['waktu_checkin']);
    $waktu_checkout = format_indo($datas['waktu_checkout']); // perbaikan bagian ini
    $admin = baca_database("", "nama", "select * from data_admin where username='$data[username]'");
    $metode_transaksi = $datas['metode_transaksi'];
    $jumlah_dewasa = $datas['jumlah_dewasa'];
    $jumlah_anak_anak = $datas['jumlah_anak_anak'];
    $discount = $datas['discount'];
    $tarif = number_format($datas['harga']);
    $total = number_format($data['total']);
    $kembalian = $data['kembalian1'];
    $tanggal = format_indo(date("Y-m-d"));
    $checkin = new DateTime($datas['waktu_checkin']);
    $checkout = new DateTime($datas['waktu_checkout']);
    $interval = $checkin->diff($checkout);
    $jumlah_hari = $interval->days;
    $harga_kamar = number_format(baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$datas[id_kamar]'"));
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->initialize();

    // Judul
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(2, 2);
    $printer->text("Steeze\n");
    $printer->graphics($image);
    $printer->setTextSize(1, 1);
    $printer->text("========================\n");

    // Tanggal & Admin
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Tanggal : $tanggal\n");
    $printer->text("Admin   : $admin\n");
    $printer->text("------------------------\n");

    // Data Tamu
    $printer->text("Nama       : $nama\n");
    $printer->text("No Kamar   : $kamar\n");
    $printer->text("Tipe Kamar : $tipe_kamar\n");
    $printer->text("Check-in   : $waktu_checkin\n");
    $printer->text("Check-out  : $waktu_checkout\n");
    $printer->text("Jumlah Hari: $jumlah_hari\n");
    $printer->text("Jumlah Dewasa : $jumlah_dewasa\n");
    $printer->text("Jumlah Anak-Anak : $jumlah_anak_anak\n");

    $printer->text("Harga Kamar: Rp $harga_kamar\n");
    $printer->text("Discount   : $discount %\n");
    $printer->text("------------------------\n");

    // Total Pembayaran
    $printer->text("Total      : Rp $tarif\n");
    $printer->text("Bayar      : Rp $total\n");
    $printer->text("Kembalian  : $kembalian\n");

    $printer->text("========================\n");

    // Footer Terima Kasih
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("Terima Kasih\n");
    $printer->text("========================\n");

    $printer->feed(3);
    $printer->cut();
    
    $printer->close();
    
        $query_checkout=mysql_query("UPDATE data_kamar SET status_kamar='Kosong' WHERE id_kamar='$datas[id_kamar]'");
        $query_transaksi=mysql_query("UPDATE data_transaksi SET status_transaksi='Selesai' WHERE id_transaksi='$id_transaksi'");
        if($query_checkout && $query_transaksi){
            
            echo json_encode('true');
        }else{
            echo json_encode(mysql_error());
        }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
