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
        $query = mysql_query("SELECT * FROM data_pelanggan WHERE nama LIKE '%$name%' OR no_hp LIKE '%$name%' order by nama asc limit 30");
    }

    if ($query) {
        if (mysql_num_rows($query) > 0) {
            $names = [];
            while ($data = mysql_fetch_array($query)) {
                $names[] = [
                    'nama' => $data['nama'],
                    'id' => $data['id_pelanggan'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'no_hp' => $data['no_hp'],
                    'identitas' => $data['identitas'],
                    'no_identitas' => $data['no_identitas'],
                    'alamat' => $data['alamat'],

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
