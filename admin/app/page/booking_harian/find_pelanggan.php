<?php
// include '../../../include/all_include.php';
include '../../../include/function/all.php';
include '../../../include/koneksi/koneksi.php';
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['name'])) {
    $name = $data['name'];
    $id_hotel = $data['id_hotel'];

    if ($name == '') {
        $query = mysql_query("SELECT * FROM data_pelanggan  order by id_pelanggan desc limit 10 ");
    } else {
        $query = mysql_query("SELECT * FROM data_pelanggan WHERE nama LIKE '%$name%' OR no_hp LIKE '%$name%' OR no_identitas LIKE '%$name%' OR alamat LIKE '%$name%' order by nama asc limit 30");
    }

    if ($query) {
        if (mysql_num_rows($query) > 0) {
            $names = [];
            while ($data = mysql_fetch_array($query)) {
                $query_frekuensi_inhotel = mysql_query("SELECT COUNT(*) AS member FROM data_transaksi WHERE id_hotel='$id_hotel' AND id_pelanggan='$data[id_pelanggan]'");
                $frekuensi1 = mysql_fetch_array($query_frekuensi_inhotel);
                $query_frekuensi = mysql_query("SELECT COUNT(*) AS another FROM data_transaksi WHERE id_pelanggan='$data[id_pelanggan]'");
                $frekuensi2 = mysql_fetch_array($query_frekuensi);
                $names[] = [
                    'nama' => $data['nama'],
                    'id' => $data['id_pelanggan'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'no_hp' => $data['no_hp'],
                    'identitas' => $data['identitas'],
                    'no_identitas' => $data['no_identitas'],
                    'alamat' => $data['alamat'],
                    'member_cabang_ini' => $frekuensi1['member'],
                    'member_lain' => $frekuensi2['another']
                ];
            }
            echo json_encode($names);
        } else {
            echo json_encode('null');
        }
    } else {
        echo json_encode([mysql_error()]);
    }
} else {
    $id = $data['id'];

    $query = mysql_query("SELECT * FROM data_pelanggan WHERE id_pelanggan='$id'");
    $data = mysql_fetch_array($query);
    echo json_encode($data['nama']);
}
