<?php

include '../../../include/koneksi/koneksi.php';
include '../../../include/function/all.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$id_transaksi = mysql_real_escape_string($data->request);

// Hapus data yang bergantung terlebih dahulu
//validasi data
function checking($tabel,$id){
    $q=mysql_query("SELECT * FROM $tabel WHERE id_transaksi='$id'");
    $value="";
    if(mysql_num_rows($q)>0){
        $value="true";
    }else{
        $value="false";
    }
    return $value;
}
if(checking("data_booking_list_kamar",$id_transaksi)=="true"){
 $delete_list_booking = mysql_query("
    DELETE FROM data_booking_list_kamar 
    WHERE id_transaksi = '$id_transaksi'
");   
}


$delete_pajak = mysql_query("
    DELETE FROM data_pajak 
    WHERE id_transaksi = '$id_transaksi'
");
$delete_pemasukan = mysql_query("
    DELETE FROM data_pemasukan 
    WHERE id_transaksi = '$id_transaksi'
");

$delete_deposit = mysql_query("
    DELETE FROM data_deposit 
    WHERE id_transaksi = '$id_transaksi'
");


$delete_transaksi = mysql_query("
    DELETE FROM data_transaksi 
    WHERE id_transaksi = '$id_transaksi'
");
$delete_transaksi_list_kamar = mysql_query("
    DELETE FROM data_transaksi_list_kamar 
    WHERE id_transaksi = '$id_transaksi'
");


// Hapus data utama
if(checking("data_booking",$id_transaksi)=="true"){
$delete_booking = mysql_query("
    DELETE FROM data_booking 
    WHERE id_transaksi = '$id_transaksi'
");
}
// Validasi seluruh proses
if ($delete_list_booking && $delete_pajak && $delete_booking && $delete_pemasukan && $delete_deposit) {
    echo json_encode([
        'response' => 'true'
    ]);
} else {
    echo json_encode([
        'response' => 'false'
    ]);
}
