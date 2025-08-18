<?php
include '../../../include/all_include.php';
date_default_timezone_set("Asia/Jakarta");
if (isset($_GET['proses'])) {
    $proses = $_GET['proses'];
    detail_transaksi($proses); // Fungsi PHP asli kamu
} else {
    echo "<p>Transaksi tidak ditemukan.</p>";
}
