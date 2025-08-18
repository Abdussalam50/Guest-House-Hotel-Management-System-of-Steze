<?php
require '/printerpos6/autoload.php';

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

$nama_printer_nota = "RP-58Printer";

try {
    $connector = new WindowsPrintConnector($nama_printer_nota);
    $printer = new Printer($connector);

    $logo_path = "printerpos6/logo.png"; 
    if (file_exists($logo_path)) {
        $logo = EscposImage::load($logo_path, false);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->graphics($logo);
    }

    // Judul
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(2, 2);
    $printer->text("Steeze\n");
    $printer->setTextSize(1, 1);
    $printer->text("========================\n");

    // Tanggal & Admin
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Tanggal : 01 Jul 2025 17:00\n");
    $printer->text("Admin   : Fajar\n");
    $printer->text("------------------------\n");

    // Data Tamu
    $printer->text("Nama       : Agus Mawarno\n");
    $printer->text("No Kamar   : Kamar 001\n");
    $printer->text("Tipe Kamar : Dulux\n");
    $printer->text("Check-in   : 01 Jul 2025\n");
    $printer->text("Check-out  : 03 Jul 2025\n");
    $printer->text("Jumlah Hari: 3 Hari\n");
    $printer->text("Harga Kamar: Rp 150,000\n");
    $printer->text("------------------------\n");

    // Total Pembayaran
    $printer->text("Total      : Rp 450,000\n");
    $printer->text("Bayar      : Rp 500,000\n");
    $printer->text("Kembalian  : Rp 50,000\n");

    $printer->text("========================\n");

    // Footer Terima Kasih
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("Terima Kasih\n");
    $printer->text("========================\n");

    $printer->feed(3);
    $printer->cut();
    $printer->close();

} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>

<script>
    location.href="../";
</script>