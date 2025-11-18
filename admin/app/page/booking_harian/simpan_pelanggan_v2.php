<?php
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';


// generate id pelanggan
$id_pelanggan = id_otomatis("data_pelanggan", "id_pelanggan", 10);

// ambil data POST dan escape
$nama = mysql_real_escape_string($_POST['nama_baru']);
$jenis_kelamin = mysql_real_escape_string($_POST['jenis_kelamin_baru']);
$id_hotel = mysql_real_escape_string($_POST['id_hotel']);
$hp_baru = mysql_real_escape_string($_POST['hp_baru']);
$identitas = mysql_real_escape_string($_POST['identitas_baru']);
$no_identitas = mysql_real_escape_string($_POST['no_identitas_baru']);
$alamat = mysql_real_escape_string($_POST['alamat_baru']);
$id_admin=mysql_real_escape_string($_POST['id_admin']);
// insert ke database
$query = mysql_query("INSERT INTO data_pelanggan 
    (id_pelanggan, nama, identitas, no_identitas, alamat, jenis_kelamin, id_hotel, no_hp) 
    VALUES ('$id_pelanggan','$nama','$identitas','$no_identitas','$alamat','$jenis_kelamin','$id_hotel','$hp_baru')");
$sql="INSERT INTO data_pelanggan 
    (id_pelanggan, nama, identitas, no_identitas, alamat, jenis_kelamin, id_hotel, no_hp) 
    VALUES ('$id_pelanggan','$nama','$identitas','$no_identitas','$alamat','$jenis_kelamin','$id_hotel','$hp_baru')";
if ($query) {
    // kirim JSON lengkap untuk JS
    $response = [
        "id" => $id_pelanggan,
        "nama" => $nama,
        "identitas" => $identitas,
        "no_identitas" => $no_identitas,
        "alamat" => $alamat,
        "jenis_kelamin" => $jenis_kelamin,
        "no_hp" => $hp_baru,
        "jumlah_dewasa" => 1,
        "jumlah_anak_anak" => 0
    ];
    
// if(isset($_COOKIE['id_hotel'])){
// 	$id_hotel=decrypt($_COOKIE['id_hotel']);
// 	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
// }else{
// 	$username=decrypt($_COOKIE['jenenge']);
// 	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username'");

simpan_riwayat("data_pelanggan","id_pelanggan",$id_pelanggan,$sql,$id_admin);
    
    echo json_encode($response);
} else {
    echo json_encode(false);
}
