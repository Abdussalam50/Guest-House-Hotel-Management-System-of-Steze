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
$nama = xss($_POST['nama']);
$identitas = xss($_POST['identitas']);
$no_identitas = xss($_POST['no_identitas']);
$alamat = xss($_POST['alamat']);
$jenis_kelamin = xss($_POST['jenis_kelamin']);
$id_hotel = xss($_POST['id_hotel']);
$no_hp = xss($_POST['no_hp']);
$id_admin=xss($_POST['id_admin']);
$sql = "insert into data_pelanggan values (
'$id_pelanggan'
 ,'$nama'
 ,'$identitas'
 ,'$no_identitas'
 ,'$alamat'
 ,'$jenis_kelamin'
 ,'$id_hotel'
 ,'$no_hp'
)";

$query = mysql_query($sql);

$action = "insert";
$nama_tabel = "data_pelanggan";
$nama_kolom = "id_pelanggan";
$id_kolom = $id_pelanggan;
$id_admin = $id_admin;
$proses_query = $sql;

if(isset($_COOKIE['id_hotel'])){
	$id_hotel=decrypt($_COOKIE['id_hotel']);
	$id_handler=baca_database("","id_admin","select * from data_admin where id_hotel='$id_hotel'");
}else{
	$username=decrypt($_COOKIE['jenenge']);
	$id_handler=baca_database("","id_pengelola","select * from data_pengelola where username='$username'");
}
simpan_riwayat($nama_tabel, $nama_kolom, $id_kolom, $sql,$id_handler);

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_tambah";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>