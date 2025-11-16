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

if(isset($_COOKIE['id_hotel'])){
	$id_hotel=decrypt($_COOKIE['id_hotel']);
	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
}else{
	$username=decrypt($_COOKIE['jenenge']);
	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username'");
}
$id_bank = id_otomatis("data_bank", "id_bank", "10");
              $id_hotel=xss($_POST['id_hotel']);
              $nama_bank=xss($_POST['nama_bank']);
              $atas_nama=xss($_POST['atas_nama']);
              $rekening=xss($_POST['rekening']);


$query = mysql_query("insert into data_bank values (
'$id_bank'
 ,'$nama_bank'
 ,'$rekening'
 ,'$atas_nama'
 ,'$id_hotel'

)");
$sql="insert into data_bank values (
'$id_bank'
 ,'$nama_bank'
 ,'$rekening'
 ,'$atas_nama'
 ,'$id_hotel'

)";
simpan_riwayat("data_bank","id_bank",$id_bank,$sql,$id_handler);
if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
