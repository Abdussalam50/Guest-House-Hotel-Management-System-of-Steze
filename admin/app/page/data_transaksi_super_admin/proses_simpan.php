<?php
include '../../../include/all_include.php';
date_default_timezone_set("Asia/Jakarta");
if (!isset($_POST['id_transaksi'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_transaksi = id_otomatis("data_transaksi", "id_transaksi", "10");
$waktu=date("Y-m-d H:i:s");
              $id_admin=xss($_POST['id_admin']);
              $nama_admin=baca_database("","nama","select * from data_admin where id_admin='$id_admin'");
              $id_hotel=xss($_POST['id_hotel']);
              $nama_hotel=baca_database("","nama","select * from data_hotel where id_hotel='$id_hotel'");
              $id_pelanggan=xss($_POST['id_pelanggan']);
              $nama_pelanggan=baca_database("","nama","select * from data_pelanggan where id_pelanggan='$id_pelanggan'");
              $no_hp_pelanggan=baca_database("","no_hp","select * from data_pelanggan where id_pelanggan='$id_pelanggan'");
              $id_kamar=xss($_POST['id_kamar']);
              $id_tipe_kamar=baca_database("","id_tipe_kamar","select * from data_kamar where id_kamar='$id_kamar'");
              $tipe_kamar=baca_database("","tipe_kamar","select * from data_tipe_kamar where id_tipe_kamar='$id_tipe_kamar'");
              $jumlah_hari=xss($_POST['jumlah_hari']);
              $nomor_kamar=baca_database("","no_kamar","select * from data_kamar where id_kamar='$id_kamar'");
              $waktu_checkin=xss($_POST['waktu_checkin']);
              $jam_checkin=date('H:i:s');
              $waktu_check_out=xss($_POST['waktu_check_out']);
              $jam_checkout=date("H:i:s");
              $no_rekening=xss($_POST['no_rekening']);
              $harga=xss($_POST['harga']);
              $metode_transaksi=xss($_POST['metode_transaksi']);
              $jumlah_dewasa=xss($_POST['jumlah_dewasa']);
              $jumlah_anak_anak=xss($_POST['jumlah_anak_anak']);
              $discount=xss($_POST['discount']);
              $status_transaksi=xss($_POST['status']);
              if(isset($_POST['jumlah_bulan']) && $_POST['jumlah_bulan']!==null && $_POST['jumlah_bulan']!==0){
                $jenis_transaksi='bulanan';
              }else{
                $jenis_transaksi='harian';
              }
              $id_bank=baca_database("","id_bank","select * from data_metode_pembayaran where id_metode_pembayaran='$metode_transaksi'");
              $nama_bank=baca_database("","nama_bank","select * from data_bank where id_bank='$id_bank'");


$query = mysql_query("insert into data_transaksi values (
'$id_transaksi'
 ,'$id_pelanggan'
 ,'$id_kamar'
 ,'$waktu_checkin'
 ,'$waktu_check_out'
 ,'$no_rekening'
 ,'$harga'
 ,'$metode_transaksi'
 ,'$jumlah_dewasa'
 ,'$jumlah_anak_anak'
 ,'$discount'
 ,'$status_transaksi'
 ,'$nama_pelanggan'
 ,'$no_hp_pelanggan'
 ,'$nomor_kamar'
 ,'$tipe_kamar'
 ,'$jam_checkin'
 ,'$jam_checkout'
 ,'$jumlah_hari'
 ,'$jenis_transaksi'
 ,'$id_admin'
 ,'$nama_admin'
 ,'$id_hotel'
 ,'$nama_hotel'
 ,'$waktu'
 ,'$id_bank'
 ,'$nama_bank'
)");
$query_status=mysql_query("UPDATE data_kamar SET status_kamar='Terisi' WHERE id_kamar='$id_kamar'");

if ($query && $query_status) {
    ?>
  <script>
    location.href="<?php index()?>?input=popup_tambah"
  </script>
  <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
