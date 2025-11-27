<?php

if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

    <?php
    function action_operasional($tabel)
    {
    ?>
        <!-- Laporan Tahunan -->
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
                                    <?php echo select_tahun(); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:40%">Pilih Hotel :</td>
                            <td>
                                <select class="form-control selectpicker" name="hotel" id="hotel">
                                    <?php combo_database_v2("data_hotel", "id_hotel", "nama", ""); ?>

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
        <!-- Laporan Bulanan -->
        <form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
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
                                    <?php combo_database_v2("data_hotel", "id_hotel", "nama", ""); ?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Bulan :</td>
                            <td>
                                <select class="form-control selectpicker" name="bulan" id="bulan">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
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
                                    <?php echo select_tahun(); ?>
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
        <!-- Laporan Perperiode -->
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
                            <td style='width:40%'>Di hotel :</td>
                            <td>
                                <select class='form-control selectpicker' name="hotel" id="hotel">
                                    <?php combo_database_v2("data_hotel", "id_hotel", "nama", ""); ?>

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
    action_operasional('data_operasional');
} else {
    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_operasional");
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

    <!-- HEADER -->
    <table border="0" style="width: 100%; font-family:arial">
        <?php
        if (isset($_GET['export'])) {
            // Skip images for export
        } else {
            $idHotel = isset($_GET['hotel']) ? mysql_real_escape_string($_GET['hotel']) : decrypt($_COOKIE['id_hotel']);
            $report_title = '';
            $hotel_name = ($idHotel == 'semua') ? 'Keseluruhan Hotel' : baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$idHotel'");
            $address = ($idHotel == 'semua') ? 'Seluruh  Hotel' : baca_database("", "alamat", "SELECT * FROM data_hotel WHERE id_hotel='$idHotel'");

            // Array to map month numbers to names
            $month_names = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];

            // Determine report title based on filter
            if (isset($_GET['type']) && $_GET['type'] == 'tahunan' && isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                $report_title = "Laporan Tahunan " . $_GET['tahun'];
            } elseif (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                $month_name = isset($month_names[$_GET['bulan']]) ? $_GET['bulan'] : 'Januari';
                $report_title = "Laporan Bulanan " . $_GET['tahun'] . " Bulan " . $month_name;
            } elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                $tanggal1_indo = format_indo($_GET['tanggal1']);
                $tanggal2_indo = format_indo($_GET['tanggal2']);
                $report_title = "Laporan Perperiode $tanggal1_indo s/d $tanggal2_indo";
            } else {
                $report_title = "Laporan Operasional Keseluruhan";
                $hotel_name = 'Keseluruhan Hotel';
                $address = 'Seluruh  Hotel';
            }
        ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>
                <td class="auto-style1">
                    <center>
                        <h1 class="auto-style1" style='font-size:25px;color:#D92C09'><?php echo $judul; ?> <?php echo $hotel_name; ?></h1>
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
                        $tabelnya = "data_operasional";
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

    <!-- BODY -->
    <table width="100%" class="" style='font-family:arial;font-size:11pt'>
        <tr>
            <th class="th_border cell">No</th>
            <th align="center" class="th_border cell">Nama Hotel</th>
            <th align="center" class="th_border cell">Tanggal</th>
            <th align="center" class="th_border cell">Operasional</th>
            <th align="center" class="th_border cell">Jumlah</th>

            <?php
            if ((isset($_GET['type']) && $_GET['type'] == 'tahunan' && $_GET['hotel'] == 'semua') ||
                (isset($_GET['bulan']) && $_GET['hotel'] == 'semua') ||
                (isset($_GET['tanggal1']) && $_GET['hotel'] == 'semua') ||
                (!isset($_GET['type']) && !isset($_GET['bulan']) && !isset($_GET['tanggal1']))
            ) {
            ?>
                <th align="center" class="th_border cell">Total</th>
            <?php
            } ?>
            <th align="center" class="th_border cell">Keperluan</th>
            <th align="center" class="th_border cell">Penanggung Jawab</th>
            <th align="center" class="th_border cell">Biaya</th>
        </tr>
        <tbody>
            <?php
            $no = 0;
            $total_biaya_all = 0;
            $month_names = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];

            // Initialize the base query
            $querytabel = "SELECT do.*, dh.nama AS nama_hotel, da.nama AS nama_admin 
                           FROM data_operasional do 
                           LEFT JOIN data_hotel dh ON do.id_hotel = dh.id_hotel 
                           LEFT JOIN data_pengelola da ON do.id_admin = da.id_pengelola 
                           WHERE 1=1";

            // Handle annual report
            if (isset($_GET['type']) && $_GET['type'] == 'tahunan' && isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $hotel = mysql_real_escape_string($_GET['hotel']);
                if ($hotel == 'semua') {
                    $querytabel .= " AND YEAR(do.tanggal)='$tahun'";
                    echo "<center>Cetak Laporan Tahunan <b>$tahun</b> untuk Semua Hotel</center><br>";
                } else {
                    $nama_hotel = baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$hotel'");
                    $querytabel .= " AND do.id_hotel='$hotel' AND YEAR(do.tanggal)='$tahun'";
                    echo "<center>Cetak Laporan Tahunan <b>$tahun</b> untuk Hotel <b>$nama_hotel</b></center><br>";
                }
            }
            // Handle monthly report
            elseif (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                $hotel = mysql_real_escape_string($_GET['hotel']);
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                $month_name = isset($month_names[$bulan]) ? $bulan : 'Januari';
                if ($hotel == 'semua') {
                    $querytabel .= " AND YEAR(do.tanggal)='$tahun' AND MONTH(do.tanggal)='$bulan'";
                    echo "<center>Cetak Laporan Bulanan <b>$tahun</b> Bulan <b>$month_name</b> untuk Semua Hotel</center><br>";
                } else {
                    $nama_hotel = baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$hotel'");
                    $querytabel .= " AND do.id_hotel='$hotel' AND YEAR(do.tanggal)='$tahun' AND MONTH(do.tanggal)='$bulan'";
                    echo "<center>Cetak Laporan Bulanan <b>$tahun</b> Bulan <b>$month_name</b> untuk Hotel <b>$nama_hotel</b></center><br>";
                }
            }
            // Handle per-period report
            elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                $hotel = mysql_real_escape_string($_GET['hotel']);
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                if ($hotel == 'semua') {
                    $querytabel .= " AND (do.$Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
                    echo "<center>Cetak Berdasarkan <b>$Berdasarkan</b> Dari Tanggal <b>$tanggal1_indo</b> s/d <b>$tanggal2_indo</b> untuk Semua Hotel</center><br>";
                } else {
                    $nama_hotel = baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$hotel'");
                    $querytabel .= " AND do.id_hotel='$hotel' AND (do.$Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
                    echo "<center>Cetak Berdasarkan <b>$Berdasarkan</b> Dari Tanggal <b>$tanggal1_indo</b> s/d <b>$tanggal2_indo</b> di Hotel <b>$nama_hotel</b></center><br>";
                }
            }
            // Default: Keseluruhan (all hotels, all data)
            else {
                $querytabel .= " ORDER BY do.id_hotel, do.tanggal";
                echo "<center>Cetak Semua Operasional Hotel</center><br>";
            }

            // Handle grouped output for 'semua' hotel cases
            if ((isset($_GET['type']) && $_GET['type'] == 'tahunan' && $_GET['hotel'] == 'semua') ||
                (isset($_GET['bulan']) && $_GET['hotel'] == 'semua') ||
                (isset($_GET['tanggal1']) && $_GET['hotel'] == 'semua') ||
                (!isset($_GET['type']) && !isset($_GET['bulan']) && !isset($_GET['tanggal1']))
            ) {
                $query_hotel = mysql_query("SELECT * FROM data_hotel");
                $no = 1;
                while ($hotel = mysql_fetch_array($query_hotel)) {
                    $sub_query = $querytabel . " AND do.id_hotel='$hotel[id_hotel]'";
                    $query_operasional = mysql_query($sub_query);
                    if (mysql_num_rows($query_operasional) == 0) {
            ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $hotel['nama']; ?></td>
                            <td align="center">-</td>
                            <td align="center">-</td>
                            <td align="center">-</td>
                            <td align="center">Rp 0</td>
                            <td align="center">Rp 0</td>
                            <td align="center">-</td>
                            <td align="center">-</td>
                        </tr>
                        <?php
                    } else {
                        $state = true;
                        $total_biaya = [];
                        $query_biaya = mysql_query("SELECT biaya FROM data_operasional WHERE id_hotel='$hotel[id_hotel]' AND " .
                            str_replace("SELECT do.*, dh.nama AS nama_hotel, da.nama AS nama_admin FROM data_operasional do LEFT JOIN data_hotel dh ON do.id_hotel = dh.id_hotel LEFT JOIN data_admin da ON do.id_admin = da.id_admin WHERE 1=1 AND ", "", $sub_query));
                        while ($biaya = mysql_fetch_array($query_biaya)) {
                            $total_biaya[] = $biaya['biaya'];
                        }
                        $jumlah_baris = count($total_biaya);
                        $total_biaya = array_sum($total_biaya);
                        $total_biaya_all += $total_biaya;
                        while ($operasional = mysql_fetch_array($query_operasional)) {
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $state ? $operasional['nama_hotel'] : '' ?></td>
                                <td><?php
                                    $waktu = explode(" ", $operasional['tanggal']);
                                    $tanggal = $waktu[0];
                                    $jam = isset($waktu[1]) ? $waktu[1] : '';
                                    echo $operasional['tanggal'] == null ? '-' : format_indo($tanggal) . ' ' . $jam ?></td>
                                <td><?php echo $operasional['operasional'] == null ? '-' : $operasional['operasional'] ?></td>
                                <td><?php echo $operasional['jumlah'] == null ? '-' : $operasional['jumlah'] ?></td>

                                <?php if ($state) { ?>
                                    <td rowspan="<?php echo $jumlah_baris; ?>"><?php echo rupiah($total_biaya); ?></td>
                                <?php } ?>
                                <td><?php echo $operasional['keperluan'] == null ? '-' : $operasional['keperluan'] ?></td>
                                <td><?php echo $operasional['nama_admin'] == null ? '-' : $operasional['nama_admin']; ?></td>
                                <td><?php echo $operasional['biaya'] == null ? 'Rp 0' : rupiah($operasional['biaya']) ?></td>
                            </tr>
                <?php
                            $state = false;
                        }
                    }
                    $no++;
                }
                ?>
                <tr>
                    <td colspan='6' style='text-align:center'>Total Operasional</td>
                    <td colspan="3"><?php echo rupiah($total_biaya_all) ?></td>
                </tr>
                <?php
            } else {
                $count_operasional = [];
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                    $count_operasional[] = $data['biaya'];
                ?>
                    <tr class="event2">
                        <td align="center" width="50"><?php $no = $no + 1;
                                                        echo $no; ?></td>
                        <td align="center"><?php echo $data['nama_hotel']; ?></td>
                        <td align="center"><?php
                                            $waktu = explode(" ", $data['tanggal']);
                                            $tanggal = $waktu[0];
                                            $jam = isset($waktu[1]) ? $waktu[1] : '';
                                            echo format_indo($tanggal) . ' ' . $jam ?></td>
                        <td align="center"><?php echo $data['operasional']; ?></td>
                        <td align="center"><?php echo $data['jumlah']; ?></td>

                        <td align="center"><?php echo $data['keperluan']; ?></td>
                        <td align="center"><?php echo $data['nama_admin']; ?></td>
                        <td align="center"><?php echo rupiah($data['biaya']); ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan='7' style='text-align:center;font-weight:700'>Total Operasional</td>
                    <td style='color:#D92C09;font-weight:700'><?php echo rupiah(array_sum($count_operasional)) ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <!-- BODY -->

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?></p>
    <p class="auto-style3"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3"></p>
<?php } ?>