<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_pelanggan'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_pelanggan = id_otomatis("data_pelanggan", "id_pelanggan", "10");
              $nama=xss($_POST['nama']);
              $jenis_kelamin=xss($_POST['jenis_kelamin']);
              $id_hotel=xss($_POST['id_hotel']);
              $no_hp=xss($_POST['no_hp']);
             


$query = mysql_query("insert into data_pelanggan values (
'$id_pelanggan'
 ,'$nama'
 ,'$jenis_kelamin'
 ,'$id_hotel'
 ,'$no_hp'


)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
