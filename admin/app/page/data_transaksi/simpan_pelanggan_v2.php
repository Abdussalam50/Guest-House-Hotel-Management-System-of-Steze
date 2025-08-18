<?php
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';
$id_pelanggan=id_otomatis("data_pelanggan","id_pelanggan",10);
$nama=$_POST['nama_baru'];
$jenis_kelamin=$_POST['jenis_kelamin'];
$id_hotel=$_POST['id_hotel'];
$hp_baru=$_POST['hp_baru'];

$query=mysql_query("INSERT INTO data_pelanggan VALUES('$id_pelanggan','$nama','$jenis_kelamin','$id_hotel','$hp_baru')");
if($query){
    echo json_encode([$id_pelanggan,ucwords($nama)]);
}else{
    echo json_encode('false');
}