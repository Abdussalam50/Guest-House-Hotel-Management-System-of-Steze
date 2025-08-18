<?php
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$data=json_decode(file_get_contents('php://input'), true);
$id_transaksi=$data['id_transaksi'];
$status=$data['status'];
$nom_bayar=$data['nom_bayar'];
$kembalian=$data['kembalian'];
$query=mysql_query("UPDATE data_transaksi SET 
status_transaksi='$status',
 nominal_bayar='$nom_bayar',
 jumlah_kembalian='$kembalian'
 WHERE id_transaksi='$id_transaksi'");
 if($query){
    echo json_encode(['response'=>'yes']);
 }else{
    echo json_encode(['response'=>mysql_error()]);
 }
"tambahan=1000&tambahan_desc=Alasan+Tambahan+Biaya&total=20000&nama_hotel=Nusa+Indah+1&id_transaksi=TRA20250806090715972";