<?php
include '../../../include/all_include.php';
$jenis_paket = "Transaksi Paket Umrah";
$id_transaksi_umrah = mysql_real_escape_string(decrypt($_GET['id']));

if (decrypt($_GET['k']) <= 0) {
$kekurangan = '-';
}else{
$kekurangan = mysql_real_escape_string(decrypt($_GET['k']));
}
// $kekurangan = mysql_real_escape_string(decrypt($_GET['k']));
$grandtotal = mysql_real_escape_string(decrypt($_GET['g']));
$id_jamaah = baca_database("","id_jamaah","SELECT id_jamaah FROM data_transaksi_umrah WHERE id_transaksi_umrah = '$id_transaksi_umrah'");
$nama_jamaah = baca_database("","nama_lengkap","SELECT nama_lengkap FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$jalan = baca_database("","jalan","SELECT jalan FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$lrg = baca_database("","lrg_atau_gg_atau_perum","SELECT lrg_atau_gg_atau_perum FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$rt = baca_database("","rt","SELECT rt FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$nomor = baca_database("","nomor","SELECT nomor FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$kelurahan = baca_database("","kelurahan","SELECT kelurahan FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$kecamatan = baca_database("","kecamatan","SELECT kecamatan FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$kota_atau_kabupaten = baca_database("","kota_atau_kabupaten","SELECT kota_atau_kabupaten FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$provinsi = baca_database("","provinsi","SELECT provinsi FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
$hp_atau_telepon = baca_database("","hp_atau_telepon","SELECT hp_atau_telepon FROM data_jamaah WHERE id_jamaah = '$id_jamaah'");
?>
<!DOCTYPE html>

<html id="print-page" class="display"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Rekap Pembayaran Transaksi </title>
    <link rel="stylesheet" href="./Rekap Pembayaran Transaksi_files/admin.css">
    <link rel="stylesheet" href="./Rekap Pembayaran Transaksi_files/style.css">
    <link rel="stylesheet" href="./Rekap Pembayaran Transaksi_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Rekap Pembayaran Transaksi_files/style.min.css">
    <link rel="stylesheet" href="./Rekap Pembayaran Transaksi_files/font-awesome.min.css">
    <style>  </style>
    
    <link rel="icon" href="../../../data/image/logo/logo.png" type="image/x-icon">
    <script src="./Rekap Pembayaran Transaksi_files/jquery-1.10.2.min.js.download"></script>
    <script src="./Rekap Pembayaran Transaksi_files/bootstrap.min.js.download"></script>
    <script src="./Rekap Pembayaran Transaksi_files/accounting.min.js.download"></script>
    <script src="./Rekap Pembayaran Transaksi_files/cssmenu.js.download"></script>
    <script src="./Rekap Pembayaran Transaksi_files/main-script.js.download"></script>
    <style>
    @media  print {
    .no-print, .no-print * {
    display: none !important;
    }
    body {
    padding: 0 !important;
    border: 0 none !important;
    }
    }
    img {
    z-index: 100;
    position: relative;
    }
    </style>
</head>
<body id="form-rekap-pembayaran" style="">
    <div id="rekap-pembayaran-logo">
        <img style="z-index: 100 !important; position: relative;" src="../../../data/image/logo/logo.png">
    </div>
    <div id="rekap-pembayaran-judul" style="margin-top: 10px !important;">
        REKAP PEMBAYARAN TRANSAKSI
    </div>
    <table id="rekap-pembayaran-header">
        <tbody>
            <tr>
                <td id="left-side" style="font-size: 14px;">
                    <table>
                        <tbody  style="font-size: 14px;"><tr>
                            <td class="left">Transaksi : </td>
                            <td><?php echo $jenis_paket ?></td>
                        </tr>
                        <tr>
                            <td class="left">User : </td>
                            <td><?php echo $nama_jamaah ?></td>
                        </tr>
                        <tr>
                            <td class="left">Kode Reg : </td>
                            <td><?php echo $id_jamaah ?></td>
                        </tr>
                        <tr>
                            <td class="left">Alamat : </td>
                            <td>
                                <?=  ucfirst($jalan) ?>,
                                <?=  ucfirst($lrg) ?><br>
                                RT. <?=  ucfirst($rt) ?>
                                No. <?=  ucfirst($nomor) ?>,
                                Kel. <?=  ucfirst($kelurahan) ?>,
                                Kec. <?=  ucfirst($kecamatan) ?>,
                                Kota <?=  ucfirst($kota_atau_kabupaten) ?>,
                                <?=  ucfirst($provinsi) ?>
                            </td>
                        </tr>
                        <!--  <tr>
                            <td class="left">Email : </td>
                            <td>namajamaah@almabrur.com</td>
                        </tr> -->
                        <tr>
                            <td class="left">Telepon  : </td>
                            <td><?=  $hp_atau_telepon ?></td>
                        </tr>
                    </tbody></table>
                </td>
                <td id="right-side">
                    <div id="invoice-title" style="font-size: 18px;"><?php echo $id_transaksi_umrah ?></div>
                    <div style="font-size: 14px;">
                        <?php   
                            $query = "SELECT * FROM data_profil";
                            $proses = mysql_query($query);
                            $data = mysql_fetch_array($proses);

                            echo $data['nama'];
                            echo "<br>";
                            echo $data['alamat'];
                            echo "<br> <strong>Email</strong> : ";
                            echo $data['email'];
                            echo " - <strong>Telepon </strong> : ";
                            echo $data['no_telepon'];




                         ?>
                </div>
                </td>
            </tr>
        </tbody></table>
        <div>
            <div style="font-weight: bold; font-size: 15px; margin: 0 0 5px 0;">Yang terhormat Bapak/Ibu <?= $nama_jamaah ?>,</div>
            <div>
                Terima kasih telah melakukan <?php echo $jenis_paket ?>
                <?php echo $judul;?>.<br>
                <!-- Pesanan Anda dengan kode transaksi <?php echo $id_transaksi_umrah ?>
                telah mencapai jatuh tempo pada tanggal <b>24 September 2019</b>. Harap segera melakukan pelunasan pembayaran transaksi Anda untuk menghindari pembatalan transaksi Anda. -->
                <br>Berikut adalah rincian pembayaran Anda :
            </div>
        </div>
        <table style="margin-bottom: 10px;" class="table table-cetak-form-transaksi bordered" >
            <thead style="font-size: 14px;">
                <tr>
                    <th class="active-background-color">Kode</th>
                    <th class="active-background-color">Tujuan</th>
                    <th class="active-background-color">Jumlah</th>
                    <th class="active-background-color">Waktu Pembayaran</th>
                    <th class="active-background-color">Metode Pembayaran</th>
                    <th class="active-background-color">Status</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
                <?php
                $query = "SELECT * FROM data_pembayaran_umrah WHERE id_transaksi_umrah = '$id_transaksi_umrah'";
                $proses = mysql_query($query);
                while ($data = mysql_fetch_array($proses))
                {
                ?>
                <tr class="odd">
                    <td><?php echo $data['id_pembayaran_umrah']; ?></td>
                    <td class="center"><?php echo ucfirst($data['jenis_pembayaran']); ?></td>
                    <td class="center"><?php echo rupiah($data['jumlah_pembayaran']); ?></td>
                    <td class="center"><?php echo format_indo($data['tanggal_transaksi']); ?></td>
                    <td class="center"><?php echo ucfirst($data['sistem_pembayaran']); ?></td>
                    <td class="center"><?php echo ucfirst($data['status']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <table style="margin-bottom: 20px;" class="table table-cetak-form-transaksi bordered">
            <thead style="font-size: 14px;">
                <tr>
                    <th class="active-background-color">Tagihan Pembayaran</th>
                    <th class="active-background-color">Pembayaran Diterima</th>
                    <th class="active-background-color">Kekurangan Pembayaran</th>
                    <th class="active-background-color">Persentase</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
                <tr>
                    <td class="center">
                        <?php echo rupiah($grandtotal) ?>
                    </td>
                    <td class="center">
                        <?php echo $total_pembayaran = rupiah($grandtotal - $kekurangan); ?>
                    </td>
                    <td class="center">
                        <?php echo rupiah($kekurangan) ?>
                    </td>
                    <td class="center">
                        <?php echo round(($grandtotal - $kekurangan) / ($grandtotal/100),2); ?>%
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="margin-bottom: 20px;">
            <b>Untuk pembayaran melalui transfer dapat ditujukan ke :</b>
            <ul style="padding-left: 20px;">
                <?php
                $query = "SELECT * FROM data_rekening";
                $proses = mysql_query($query);
                while ($data = mysql_fetch_array($proses)) {
                ?>
                <li><?=  $data['nama_bank'] ?>, No.Rek : <?= $data['no_rekening'] ?>, A/N : <?= $data['atas_nama'] ?></li>
                <?php } ?>
            </ul>
        </div>
        <div>
            Hormat Kami,<br>
            <?php echo $judul;?>
        </div>
        <style>
        * {text-transform: none !important;}
        </style>
        <div id="print-area-btn" class="no-print">
            <hr>
            
        </div>
        <textarea class="hidden" name="script_map" cols="50" rows="10">W10=</textarea>
    </body></html>