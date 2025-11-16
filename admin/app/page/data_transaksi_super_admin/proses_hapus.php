<?php include '../../../include/all_include.php';

if (!isset($_GET['proses']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

date_default_timezone_set("Asia/Jakarta");
$proses =  (mysql_real_escape_string($_GET['proses']));
$admin=baca_database("","id_admin","select * from data_admin where username='".$_GET['admin']."'");
$query_del=mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$proses'");
$data_del=mysql_fetch_array($query_del);
$id_transaksi=$data_del['id_transaksi'];
$id_pelanggan=$data_del['id_pelanggan'];
$id_kamar=$data_del['id_kamar'];
$waktu_checkin=$data_del['waktu_checkin'];
$waktu_check_out=$data_del['waktu_checkout'];
$no_rekening=$data_del['no_rekening'];
$harga=$data_del['harga'];
$metode_transaksi=$data_del['metode_transaksi'];
$jumlah_dewasa=$data_del['jumlah_dewasa'];
$jumlah_anak_anak=$data_del['jumlah_anak_anak'];
$discount=$data_del['discount'];
$status_transaksi=$data_del['status_transaksi'];
$id_hotel=$data_del['id_hotel'];
$tanggal=date("Y-m-d H:i:s");

//insert ke riwayat delete
$id_hapus_transaksi=id_otomatis("data_hapus_transaksi","id_hapus_transaksi",10);
$query_riwayat=mysql_query("INSERT INTO data_hapus_transaksi (id_hapus_transaksi,id_transaksi,id_pelanggan,id_kamar,waktu_checkin,waktu_checkout,no_rekening,harga,metode_transaksi,jumlah_dewasa,jumlah_anak_anak,discount,status_transaksi,id_hotel,tanggal,id_admin) 
VALUES ('$id_hapus_transaksi','$id_transaksi','$id_pelanggan','$id_kamar','$waktu_checkin','$waktu_check_out','$no_rekening','$harga','$metode_transaksi','$jumlah_dewasa','$jumlah_anak_anak','$discount','$status_transaksi','$id_hotel','$tanggal','$admin')") or die(mysql_error());
if($query_riwayat){
$query=mysql_query("delete from data_transaksi where id_transaksi='$proses'");

if($query){
?>
<script>location.href = "<?php index(); ?>?input=popup_hapus"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";

}
}
?>
