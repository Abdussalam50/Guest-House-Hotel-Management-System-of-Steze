<?php
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';

// generate id pelanggan
$id_pelanggan = id_otomatis("data_pelanggan", "id_pelanggan", 10);

// ambil data POST dan escape
$nama = mysql_real_escape_string($_POST['nama_baru']);
$jenis_kelamin = mysql_real_escape_string($_POST['jenis_kelamin']);
$id_hotel = mysql_real_escape_string($_POST['id_hotel']);
$hp_baru = mysql_real_escape_string($_POST['hp_baru']);
$identitas = mysql_real_escape_string($_POST['identitas_baru']);
$no_identitas = mysql_real_escape_string($_POST['no_identitas_baru']);
$alamat = mysql_real_escape_string($_POST['alamat_baru']);

// insert ke database
$query = mysql_query("INSERT INTO data_pelanggan 
    (id_pelanggan, nama, identitas, no_identitas, alamat, jenis_kelamin, id_hotel, no_hp) 
    VALUES ('$id_pelanggan','$nama','$identitas','$no_identitas','$alamat','$jenis_kelamin','$id_hotel','$hp_baru')");

if ($query) {
    // kirim JSON lengkap untuk JS
    $response = [
        "id" => $id_pelanggan,
        "nama" => $nama,
        "identitas" => $identitas,
        "no_identitas" => $no_identitas,
        "alamat" => $alamat,
        "no_hp" => $hp_baru,
        "jumlah_dewasa" => 1,
        "jumlah_anak_anak" => 0
    ];
    echo json_encode($response);
} else {
    echo json_encode(false);
}
