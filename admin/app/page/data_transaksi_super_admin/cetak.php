<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    function action_cetak_transaksi($tabel)
    {
    ?>
        <form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
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
                                    $query = mysql_query("SELECT  YEAR(waktu_transaksi) AS tahun FROM data_transaksi group by tahun ORDER BY tahun DESC");
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
        <form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>LAPORAN BULANAN</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width:40%">Berdasarkan :</td>
                            <td>
                                <select class="form-control selectpicker" data-live-search="true" name="Berdasar" id="Berdasarkan">
                                    <option value="Berdasarkan1">Hotel</option>
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
                                    $query = mysql_query("SELECT  YEAR(waktu_transaksi) AS tahun FROM data_transaksi group by tahun ORDER BY tahun DESC");
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
        <form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>LAPORAN PERPERIODE</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width:40%">Berdasarkan :</td>
                            <td>
                                <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
                                    <?php
                                    $sql = "desc $tabel";
                                    $result = @mysql_query($sql);
                                    while ($row = @mysql_fetch_array($result)) {
                                        $typedata = $row[1];
                                        $kalimat = $typedata;
                                        if (preg_match("/date/i", $kalimat)) {
                                            echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
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
    }
    action_cetak_transaksi('data_transaksi');
} else {
    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php
        if (isset($_GET['export'])) {
            // Skip images for export
        } else {
            $idHotel = isset($_GET['hotel']) ? mysql_real_escape_string($_GET['hotel']) : decrypt($_COOKIE['id_hotel']);
            $report_title = '';
            $hotel_name = ($idHotel == 'semua') ? 'Keseluruhan Hotel' : baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$idHotel'");
            $address = ($idHotel == 'semua') ? 'Seluruh Hotel' : baca_database("", "alamat", "SELECT * FROM data_hotel WHERE id_hotel='$idHotel'");

            // Determine report title based on filter
            if (isset($_GET['type']) && $_GET['type'] == 'tahunan' && isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                $report_title = "Laporan Tahunan " . $_GET['tahun'];
            } elseif (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                $report_title = "Laporan Bulanan " . $_GET['tahun'] . " Bulan " . $_GET['bulan'];
            } elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                $tanggal1_indo = format_indo($_GET['tanggal1']);
                $tanggal2_indo = format_indo($_GET['tanggal2']);
                $report_title = "Laporan Perperiode " . $tanggal1_indo . " s/d " . $tanggal2_indo;
            } else {
                $report_title = "Laporan Transaksi";
            }
        ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>
                <td class="auto-style1">
                    <center>
                        <h2 class="auto-style1" style='color:#D92C09'><?php echo $judul . " - " . $report_title; ?> <?php echo $hotel_name; ?></h2>
                    </center>
                </td>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100">
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="auto-style2">
                <center>
                    <strong>LAPORAN
                        <?php
                        $tabelnya = "data_transaksi";
                        $tabelnya = str_replace("_", " ", $tabelnya);
                        $tabelnya = str_replace("data", "", $tabelnya);
                        $tabelnya = strtoupper($tabelnya);
                        echo $tabelnya;
                        ?>
                    </strong>
                </center>
            </td>
        </tr>
        <tr>
            <td class="auto-style2"><?php echo isset($address) ? $address : ''; ?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <div>
        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; font-family: arial; font-size:9pt;">
            <thead>
                <tr style="background-color: #f9f9f9; text-align:center;">
                    <th>No</th>
                    <th>Kode&nbsp;Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Kamar</th>
                    <th>Jenis&nbsp;Trx</th>
                    <th>Check&nbsp;In</th>
                    <th>Check&nbsp;Out</th>
                    <th>Harga</th>
                    <th>Jumlah&nbsp;</th>
                    <th>Harga&nbsp;Kamar&nbsp;Total</th>
                    <th>Diskon</th>
                    <th>Potongan</th>
                    <th>Tambahan&nbsp;In</th>
                    <th>Tambahan&nbsp;Out</th>
                    <th>Dp&nbsp;Booking</th>
                    <th>Deposit</th>
                    <th>Pajak</th>
                    <th>Grand&nbsp;Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $id_hotel = decrypt($_COOKIE['id_hotel']);
                $no = 0;

                // Initialize the base query
                $querytabel = "SELECT dt.*, dp.nama 
                   FROM data_transaksi dt
                   JOIN data_pelanggan dp ON dt.id_pelanggan = dp.id_pelanggan
                   WHERE 1=1";

                // Add id_hotel filter only if it is not empty
                if (!empty($id_hotel)) {
                    $querytabel .= " AND dt.id_hotel='$id_hotel'";
                }

                // Handle annual report (type=tahunan)
                if (isset($_GET['type']) && $_GET['type'] == 'tahunan' && isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                    $tahun = mysql_real_escape_string($_GET['tahun']);
                    $hotel = mysql_real_escape_string($_GET['hotel']);
                    if ($hotel == 'semua') {
                        // If "Semua" is selected, do not filter by hotel
                        $querytabel .= " AND YEAR(dt.waktu_transaksi)='$tahun'";
                        echo "<center>Cetak Laporan Tahunan <b>$tahun</b> untuk Semua Hotel</center>";
                    } else {
                        $nama_hotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$hotel'");
                        $querytabel .= " AND dt.id_hotel='$hotel' AND YEAR(dt.waktu_transaksi)='$tahun'";
                        echo "<center>Cetak Laporan Tahunan <b>$tahun</b> untuk Hotel <b>$nama_hotel</b></center>";
                    }
                }
                // Handle monthly report
                elseif (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                    $hotel = mysql_real_escape_string($_GET['hotel']);
                    $nama_hotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$hotel'");
                    $tahun = mysql_real_escape_string($_GET['tahun']);
                    $bulan = mysql_real_escape_string($_GET['bulan']);
                    $querytabel .= " AND dt.id_hotel='$hotel' AND YEAR(dt.waktu_transaksi)='$tahun' AND MONTH(dt.waktu_transaksi)='$bulan'";
                    echo "<center>Cetak Berdasarkan <b>Hotel $nama_hotel</b> di Tahun <b>$tahun</b> Bulan <b>$bulan</b></center>";
                }
                // Handle per-period report
                elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                    $hotel = mysql_real_escape_string($_GET['hotel']);
                    $nama = baca_database("", "nama", "select * from data_hotel where id_hotel='$hotel'");
                    $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                    $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                    $tanggal1_indo = format_indo($tanggal1);
                    $tanggal2_indo = format_indo($tanggal2);
                    echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b> di Hotel ' . $nama . '</center>';
                    $querytabel .= " AND dt.id_hotel='$hotel' AND (dt.$Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2') ";
                }
                // Handle specific filter (if applicable)
                elseif (isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                    $querytabel .= " AND $Berdasarkan LIKE '%$isi%'";
                }

                // Add the ORDER BY clause
                $querytabel .= " ORDER BY id_transaksi ASC";

                $proses = mysql_query($querytabel);

                // Total semua kolom yang ingin dijumlahkan
                $total_disc_nominal = 0;
                $total_tambahan_in = 0;
                $total_tambahan_out = 0;
                $total_potongan_harga = 0;
                $total_pajak = 0;
                $total_bayar_all = 0;

                while ($data = mysql_fetch_array($proses)) {
                    $no++;

                    $id_transaksi = $data['id_transaksi'];

                    $jenis_group = "non_group";
                    if (json_check($data['no_kamar'])) {
                        $jenis_group = "group";
                    }

                    $jenis_transaksi = $data['jenis_transaksi'];
                    $harga_per_hari = $data['harga_kamar_harian'];
                    $harga_per_bulan = $data['harga_kamar_bulanan'];
                    $tgl_checkin = new DateTime($data['waktu_checkin']);
                    $tgl_checkout = new DateTime($data['waktu_checkout']);
                    $jumlah_hari = $data['jumlah_hari'];
                    $harga_kamar_total = 0;


                    if ($jenis_group == "group") {
                        $query_kamar = " SELECT * FROM data_transaksi_list_kamar 
                                            WHERE id_transaksi = '$id_transaksi' 
                                            ORDER BY waktu DESC ";

                        $proses_kamar = mysql_query($query_kamar);
                        while ($datakamar = mysql_fetch_array($proses_kamar)) {

                            if ($jenis_transaksi == "harian") {
                                $harga_kamar_total =  $harga_kamar_total + ($datakamar['harga_kamar_harian'] * $jumlah_hari);
                            } else {
                                $harga_kamar_total =  $harga_kamar_total +  ($datakamar['harga_kamar_bulanan'] * $jumlah_hari);
                            }
                        }
                    } else {

                        if ($jenis_transaksi == "harian") {
                            $harga_kamar_total = $harga_per_hari * $jumlah_hari;
                        } else {
                            $harga_kamar_total = $harga_per_bulan * $jumlah_hari;
                        }
                    }



                ?>
                    <tr class="event2" style="text-align:left;">
                        <td><?= $no ?></td>
                        <td align="left"><a href="<?php index(); ?>?input=detail&id_trx=<?= ($data['id_transaksi']); ?>">
                                <?= $data['id_transaksi']; ?></a>


                        </td>
                        <td align="left"><?= ucwords($data['nama']); ?></td>
                        <td align="left"><?= json_preview_br($data['no_kamar']); ?></td>
                        <td align="left"><b><?= ucwords($jenis_transaksi); ?> <?php
                        
                        if ($jenis_group == "group") {
                                                                                    echo "(Group)";
                                                                                }
                                                                                ?></b></td>
                        <td><?= str_replace(" ", "&nbsp;", format_indo($data['waktu_checkin'])); ?></td>
                        <td><?php
                            $today = strtotime(date('Y-m-d'));
                            $checkout = strtotime($data['waktu_checkout']);
                            $hari_tersisa = ($checkout - $today) / (60 * 60 * 24);

                            if ($hari_tersisa > 0) {
                                $hari_tersisa = ceil($hari_tersisa);
                                if ($data['status_transaksi'] == 'Selesai') {
                                    echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
                                } else {
                                    echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']))
                                        . "<b style='color:red'>&nbsp;{$hari_tersisa}&nbsp;hari&nbsp;lagi</b>";
                                }
                            } elseif ($hari_tersisa == 0) {
                                if ($data['status_transaksi'] == 'Selesai') {
                                    echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
                                } else {
                                    // Hari ini
                                    echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']))
                                        . "<b style='color:green'>&nbsp;Hari ini</b>";
                                }
                            } else {
                                // Lewat
                                echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
                            }
                            ?>
                        </td>
                        <td><?php
                            if ($jenis_transaksi == "harian") {
                                echo  json_preview_rupiah_br($harga_per_hari);
                            } else {
                                echo  json_preview_rupiah_br($harga_per_bulan);
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($jenis_transaksi == "harian") {
                                echo  $jumlah_hari . " Hari";
                            } else {
                                echo  $jumlah_hari . " Bulan";
                            }
                            ?>

                        </td>
                        <td><?= rupiah($harga_kamar_total); ?></td>
                        <td><?= $data['discount']; ?>%</td>
                        <td><?= rupiah($data['potongan_harga']); ?></td>
                        <td><?= rupiah($data['biaya_tambahan_checkin']); ?></td>
                        <td><?= rupiah($data['biaya_tambahan_checkout']); ?></td>
                        <td>

                            <?php if (substr($id_transaksi, 0, 2) === "BO") { ?>
                                <font color="blue">
                                    Rp<?php echo rupiah_format(baca_database("", "nominal_bayar", "select * from data_booking where id_transaksi='$id_transaksi'")); ?>
                                </font>
                            <?php } else {
                                echo "Rp0";
                            } ?>


                        </td>
                        <td>
                            <font color="red">
                                <?= rupiah($data['nominal_deposit']); ?>
                            </font>
                        </td>
                        <td><?= ($data['persentase_pajak']); ?>%</td>
                        <td><?= rupiah($data['total_bayar']);

                            $total_bayar_all += $data['total_bayar'];
                            ?></td>



                        <td style="background-color: <?php
                                                        if ($data['status_transaksi'] == 'Selesai') {
                                                            echo '#f3ffe6';
                                                        } elseif ($data['status_transaksi'] == 'Lunas') {
                                                            echo '#fffee6';
                                                        } else {
                                                            echo '#ffe8e8';
                                                        } ?>">
                            <?= $data['status_transaksi']; ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr style="background-color:#f1f1f1; font-weight:bold; text-align:center;">
                    <td colspan="17">Total Keseluruhan</td>

                    <td><b><?= rupiah($total_bayar_all); ?></b></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?></p>
    <p class="auto-style3"><?php echo $ttd; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3"></p>
<?php } ?>