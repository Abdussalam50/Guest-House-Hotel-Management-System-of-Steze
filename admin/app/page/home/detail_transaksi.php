<?php
include '../../../include/all_include.php';
$read = "detail";

$id_transaksi = mysql_escape_string($_GET['id_trx']);

$query = mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$id_transaksi'") or die(mysql_error());
$bk = mysql_fetch_array($query);
if (!$bk) die("Transaksi tidak ditemukan!");

// Nilai dari database
$grand_total        = (int)$bk['total_bayar'];
$jenis_transaksi        = $bk['jenis_transaksi'];
$status_transaksi        = $bk['status_transaksi'];
$dp_dibayar         = (int)$bk['nominal_bayar'];
$sisa_harus_dibayar = (int)$bk['sisa_pembayaran'];
$deposit_lama       = (int)$bk['nominal_deposit'];
$jenis_group = json_check($bk['id_kamar']) ? "group" : "non_group";



if ($jenis_transaksi == "harian" && $jenis_group == "non_group") {
    include "../checkout/notaA4.php";
    $link = "../checkout/notaA4.php";
} elseif ($jenis_transaksi == "bulanan" && $jenis_group == "non_group") {
    include "../checkout/notaA4-bulanan.php";
    $link = "../checkout/notaA4-bulanan.php";
} elseif ($jenis_transaksi == "harian" && $jenis_group == "group") {
    include "../checkout/notaA4-group.php";
    $link = "../checkout/notaA4-group.php";
} elseif ($jenis_transaksi == "bulanan" && $jenis_group == "group") {
    include "../checkout/notaA4-bulanan-group.php";
    $link = "../checkout/notaA4-bulanan-group.php";
}
