<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_bank'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_bank = xss($_POST['id_bank']);
              $id_hotel=xss($_POST['id_hotel']);
              $nama_bank=xss($_POST['nama_bank']);
              $atas_nama=xss($_POST['atas_nama']);
              $rekening=xss($_POST['rekening']);


$query = mysql_query("update data_bank set 
nama_bank='$nama_bank',
atas_nama='$atas_nama',
rekening='$rekening'

where id_bank='$id_bank' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
