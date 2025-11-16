<?php
// include '../../../include/all_include.php';
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';
$data=json_decode(file_get_contents('php://input'),true);
if(isset($data['name'])){
$name=$data['name'];
$id_hotel=$data['id_hotel'];
$query=mysql_query("SELECT * FROM data_pelanggan WHERE nama LIKE '%$name%' AND id_hotel='$id_hotel'");
if($query){
if(mysql_num_rows($query)>0){
    $names=[];
    while($data=mysql_fetch_array($query)){
        $names[]=[
            'nama'=>$data['nama'],
            'id'=>$data['id_pelanggan'],
            'jenis_kelamin'=>$data['jenis_kelamin'],
            'no_hp'=>$data['no_hp'],

        ];
        
    }
    echo json_encode($names);
 
}else{
    echo json_encode('null');
}
}else{ 
    echo json_encode([mysql_error()]);
}
}else{
    $id=$data['id'];
  
    $query=mysql_query("SELECT * FROM data_pelanggan WHERE id_pelanggan='$id'");
    $data=mysql_fetch_array($query);
    echo json_encode($data['nama']);
}