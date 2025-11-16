<?php
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';
$data=json_decode(file_get_contents('php://input'), true);
$id_metode_bayar=$data['id_metode'];
$id_transaksi=$data['id_transaksi'];

$query_update=mysql_query("UPDATE data_transaksi SET metode_transaksi='$id_metode_bayar' WHERE id_transaksi='$id_transaksi'") or die(mysql_error());
if($query_update){
    echo json_encode(['response'=>'success']);
}else{
    echo json_encode(['response'=>mysql_error()]);
}