<?php
include '../../../include/koneksi/koneksi.php';
include '../../../include/function/all.php';
date_default_timezone_set("Asia/Jakarta");
$data=json_decode(file_get_contents('php://input'),true);
if(isset($data['check_in'])){
    $id=$data['check_in'];
    $updateKamar=mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='$id'");
    if($updateKamar){
        $id_transaksi=id_otomatis("data_transaksi","id_transaksi","10");
        $waktu=date('Y-m-d H:i:s');
        $id_pelanggan=$data['pelanggan'];
        $queryInsertTransaksi=mysql_query("INSERT INTO data_transaksi(id_transaksi,id_pelanggan,waktu_checkin) VALUES('$id_transaksi','$id_pelanggan','$waktu')");
        if($queryInsertTransaksi){
            $selectName=baca_database("","nama","select * from data_pelanggan where id_pelanggan='$id_pelanggan'");
            $selectWaktu=$waktu;
            $selectHarga=baca_database("","harga_harian","select * from data_kamar where id_kamar='$id'");
            echo json_encode([
                'nama'=>$selectName,
                'waktu'=>$selectWaktu,
                'harga'=>$selectHarga
            ]);
        }else{
        echo json_encode([
            'response'=>mysql_error()
        ]);
    }
    }else{
        echo json_encode([
            'response'=>mysql_error()
        ]);
    }
}