<?php
include '../../../include/koneksi/koneksi.php';
include '../../../include/function/all.php';
require __DIR__ . '/vendor/autoload.php';
date_default_timezone_set("Asia/Jakarta");

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

?>
    <script>
        location.href = '../home/index.php'
    </script>
<?php

}
