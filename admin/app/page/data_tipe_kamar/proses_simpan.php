<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_tipe_kamar'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_tipe_kamar = id_otomatis("data_tipe_kamar", "id_tipe_kamar", "10");
              $tipe_kamar=xss($_POST['tipe_kamar']);
              $id_hotel=xss($_POST['id_hotel']);


$query = mysql_query("insert into data_tipe_kamar values (
'$id_tipe_kamar'
 ,'$tipe_kamar'
 ,'$id_hotel'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
