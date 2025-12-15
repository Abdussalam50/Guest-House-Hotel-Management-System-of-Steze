<?php
include '../../../include/koneksi/koneksi.php';
include '../../../include/function/all.php';
$id_transaksi=mysql_real_escape_string($_POST['id_transaksi']);
$password=md5($_POST['password']);
$status=mysql_real_escape_string($_POST['status_transaksi']);
$q_validasi=mysql_query("SELECT * FROM data_developer WHERE password='$password'");
if($q_validasi==false ){
    echo json_encode(['response'=>'false']);
    exit;
}elseif(mysql_num_rows($q_validasi)!==1){
        echo json_encode(['response'=>'false']);
    exit;
}
if(mysql_num_rows($q_validasi)==1){
$q_ubah_status=mysql_query("UPDATE data_transaksi SET status_transaksi='$status' WHERE id_transaksi='$id_transaksi'");

if($q_ubah_status){
    echo json_encode(['response'=>'true']);
}else{
    echo json_encode(['response'=>'false']);
}
}


?>