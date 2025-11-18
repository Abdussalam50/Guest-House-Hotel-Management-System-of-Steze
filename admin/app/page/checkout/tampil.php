<?php

$id_trx = decrypt($_GET['trx']);
$id_kamar = baca_database("", "id_kamar", "select * from data_transaksi WHERE id_transaksi='$id_trx'");
$jenis_group = json_check($id_kamar) ? "group" : "non_group";

if ($jenis_group == "group") {
    include 'tampil_group.php';
} else {
    include 'tampil_non_group.php';
}
