<?php
require_once '../../../include/all_include.php';

if (isset($_GET['input'])) {
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <h3>Cetak Laporan Deposit</h3>
        <form name="formcari" id="formcari" action="laporan deposit.php" method="get" target="_blank">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>LAPORAN TAHUNAN</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Pilih Tahun :</td>
                            <td>
                                <select name="tahun" id="tahun" class="form-control">
                                    <?php
                                    $query = mysql_query("SELECT DISTINCT YEAR(waktu_transaksi) AS tahun FROM data_transaksi ORDER BY waktu_transaksi DESC");
                                    if (mysql_num_rows($query)) {
                                        while ($data = mysql_fetch_array($query)) {
                                    ?>
                                            <option value="<?php echo $data['tahun'] ?>"><?php echo $data['tahun'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:40%">Pilih Hotel :</td>
                            <td>
                                <select class="form-control selectpicker" name="hotel" id="hotel">
                                    <?php
                                    combo_database_v2("data_hotel", "id_hotel", "nama", "");
                                    ?>
                                    <option value='semua'>Semua</option>
                                </select>
                                <input type="hidden" name="type" value="tahunan">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:40%"></td>
                            <td>
                                <?php btn_preview_laporan('Print Preview'); ?>
                                <?php btn_cetak_laporan('Print'); ?>
                                <?php btn_export_laporan('Export Excel'); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
        <br>
        <form name="formcari" id="formcari" action="laporan deposit.php" method="get" target="_blank">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>LAPORAN BULANAN</b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td style="width:40%">Pilih Hotel :</td>
                            <td>
                                <select class="form-control selectpicker" name="hotel" id="hotel">
                                    <?php
                                    combo_database_v2("data_hotel", "id_hotel", "nama", "");
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Bulan :</td>
                            <td>
                                <select class="form-control selectpicker" name="bulan" id="bulan">
                                    <option value="1">Januari</option>
                                    <option value="2">Februaru</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Tahun:</td>
                            <td>
                                <select class="form-control selectpicker" name="tahun" id="tahun">
                                    <?php
                                    $query = mysql_query("SELECT DISTINCT YEAR(waktu_transaksi) AS tahun FROM data_deposit ORDER BY waktu_transaksi DESC");
                                    if (mysql_num_rows($query)) {
                                        while ($data = mysql_fetch_array($query)) {
                                    ?>
                                            <option value="<?php echo $data['tahun'] ?>"><?php echo $data['tahun'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?php btn_preview_laporan('Print Preview'); ?>
                                <?php btn_cetak_laporan('Print'); ?>
                                <?php btn_export_laporan('Export Excel'); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
        <br>
        <form name="formcari" id="formcari" action="laporan deposit.php" method="get" target="_blank">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>LAPORAN PERPERIODE</b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td style="width:40%">Dari Tanggal :</b></td>
                            <td><input type="date" name="tanggal1"></td>
                        </tr>
                        <tr>
                            <td style="width:40%">Sampai Tanggal :</b></td>
                            <td><input type="date" name="tanggal2"></td>
                        </tr>
                        <tr>
                            <td style="width:40%">Pilih Hotel :</b></td>
                            <td>
                                <select name="hotel" id="hotel" class="form-control select-picker">
                                    <?php
                                    combo_database_v2("data_hotel", "id_hotel", "nama", "");
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?php btn_preview_laporan('Print Preview'); ?>
                                <?php btn_cetak_laporan('Print'); ?>
                                <?php btn_export_laporan('Export Excel'); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
<?php
}else{
    $id_hotel=$_GET['hotel'];
     $query="SELECT * FROM data_deposit";
     $no=1;
    if(!empty($id_hotel)){
      if(isset($_GET['tanggal1']) && !empty($_GET['tanggal1']) && isset($_GET['tanggal2'])&& !empty($_GET['tanggal2'])){
        $tanggal1=$_GET['tanggal1'];
        $tanggal2=$_GET['tanggal2'];
        
        $query.= " WHERE waktu_transaksi BETWEEN '$tanggal1' AND '$tanggal2' AND id_hotel = '$id_hotel'";
      }elseif(isset($_GET['bulan']) && isset($_GET['tahun'])){
        $bulan=$_GET['bulan'];
        $tahun=$_GET['tahun'];
        $query.=" WHERE YEAR(waktu_transaksi)=$tahun AND MONTH(waktu_transaksi)=$bulan AND id_hotel='$id_hotel'";
      }else{
        $tahun=$_GET['tahun'];
        $query.=" WHERE id_hotel='$id_hotel' AND YEAR(waktu_transaksi)=$tahun ";
      }

      $result=mysql_query($query);

      ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <style>
        #tableheader {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #tableheader td {
            border: none;
            padding: 10px;
            vertical-align: middle;
        }

        h1,
        h4 {
            margin: 0;
            padding: 0;
            color: #222;
        }

        .container {
            width: 100%;
            padding: 0 15px;
            box-sizing: border-box;
        }

        #table-content {
            width: 100%;
            border-collapse: collapse;
        }

        #table-content th,
        #table-content td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
            vertical-align: middle;
        }

        #table-content thead th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        #table-content tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        #table-content tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    <section>
        <?php
        $months = [
    '1'  => 'Januari',
    '2'  => 'Februari',
    '3'  => 'Maret',
    '4'  => 'April',
    '5'  => 'Mei',
    '6'  => 'Juni',
    '7'  => 'Juli',
    '8'  => 'Agustus',
    '9'  => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
];
        ?>
        <table class="tableheader" id='tableheader'>
            <tr>
                <td width="10%">
                    <center><img src="../../../data/image/logo/steze-2.png" alt="" width='100'></center>
                </td>
                <td width='80%'>
                    <center>
                        <h2 class='text-danger' style='color:#D92C09'>
                            <?php echo $objek; ?>
                            Cabang <?php echo !empty($id_hotel) ? baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'") : "Semua Cabang"; ?>
                        </h2>
                    </center>
                    <center>
                        <h4 style='background-color:#eaeaea;padding:5px'>LAPORAN DEPOSIT</h4>
                        <?php
                        echo "<p  style='margin: 0px;'>Alamat: " . (!empty($id_hotel) ? baca_database("", "alamat", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'") : "Semua Cabang") . "</p>";
                        ?>

                        <?php
                        if ( isset($tanggal1) && isset($tanggal2)) {
                            echo "<h4 >Cetak Periode " . format_indo($tanggal1) . " Sampai Dengan " . format_indo($tanggal2) . "</h4>";
                        }elseif(isset($_GET['bulan'])){
                            echo "<h4 >Cetak diBulan ".$months[$_GET['bulan']]." $_GET[tahun]</h4>";
                        } else {
                            echo "<h4>Semua Jangka Waktu</h4>";
                        }
                        ?>
                    </center>
                </td>

                <td width='10%'>
                    <center><img src="../../../data/image/logo/steze-2.png" alt="" width='100'></center>
                </td>
            </tr>
        </table>
    </section>
    <section>
        <table class="table-content" id='table-content'>
            <thead>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Kamar</th>
                <th>Pelanggan</th>
                <th>Waktu Transaksi</th>
                <th>Metode Pembayaran</th>
                <th>Rekening</th>
                <th>Nominal Deposit</th>
                <th>Penanggung Jawab</th>
            </thead>
            <tbody>
                <?php
                $total_deposit=[];
                while($data=mysql_fetch_array($result)){
                    $total_deposit[]=$data['nominal_deposit'];
                    $id_kamar=baca_database("","id_kamar","select * from data_transaksi where id_transaksi='$data[id_transaksi]'")
                ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $data['id_transaksi']?></td>
                        <td>Kamar <?= baca_database("","no_kamar","select * from data_transaksi where id_transaksi='$data[id_transaksi]'")?></td>
                        <td><?= baca_database("","nama","select * from data_pelanggan where id_pelanggan='$data[id_pelanggan]'")?></td>
                        <td><?php 
                        $waktu=explode(" ",$data['waktu_transaksi']);
                        $tanggal=$waktu[0];
                        $jam=$waktu[1];
                        echo format_indo($tanggal)." ".$jam;
                        ?></td>
                        <td>
                            <?= $data['metode_pembayaran']?>
                        </td>
                        <td><?= $data['no_rekening_deposit']?></td>
                        <td><?= rupiah($data['nominal_deposit'])?></td>
                        <td><?= $data['nama_admin']?></td>
                    </tr>
                <?php
                }
                ?>
                <tr style='font-weight:700;color:#D92C09'>
                    <td colspan="7" style='text-align:center;'> Total Deposit</td>
                    <td colspan="2"><?= rupiah(array_sum($total_deposit))?></td>
                </tr>
            </tbody>
        </table>   
        <p class="auto-style3"><?php echo $formatwaktu; ?></p>
        <p class="auto-style3"><?php echo $ttd; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p class="auto-style3"></p>
    </section>   
    <?php

    }else{
        $query=$query;
    }
}
