<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_operasional'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_operasional = id_otomatis("data_operasional", "id_operasional", "10");
              $id_hotel=xss($_POST['id_hotel']);
              $tanggal=xss($_POST['tanggal']);
              $operasional=xss($_POST['operasional']);
              $jumlah=xss($_POST['jumlah']);
              $biaya=xss($_POST['biaya']);
              $id_admin=xss($_POST['id_admin']);
              $keperluan=xss($_POST['keperluan']);


$query = mysql_query("insert into data_operasional values (
'$id_operasional'
 ,'$id_hotel'
 ,'$tanggal'
 ,'$operasional'
 ,'$jumlah'
 ,'$keperluan'
 ,'$biaya'
 ,'$id_admin'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo mysql_error();
}
?>
