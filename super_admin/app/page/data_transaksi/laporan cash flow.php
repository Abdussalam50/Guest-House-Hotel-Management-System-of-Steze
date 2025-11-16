<?php

if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan Cash Flow</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    function action_cetak_cash_flow($tabel)
    {
    ?>

        <form name="formcari" id="formcari" action="laporan cash flow.php" method="get" target="_blank">

            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>CETAK KESELURUHAN</b></td>

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
        <form name="formcari" id="formcari" action="laporan cash flow.php" method="get" target="_blank">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>CETAK DENGAN FILTER</b></td>

                            <td>
                            </td>
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
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pilih Tahun:</td>
                            <td>
                                <select class="form-control selectpicker" name="tahun" id="tahun">
                                    <?php
                                    $query = mysql_query("SELECT DISTINCT YEAR(waktu_transaksi) AS tahun
FROM data_transaksi
ORDER BY tahun DESC;
");
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
        <form name="formcari" id="formcari" action="laporan cash flow.php" method="get" target="_blank">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>CETAK PERPERIODE</b></td>

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
                                    combo_database_v2("data_hotel", "id_hotel", "nama", "")
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
    action_cetak_cash_flow('data_operasional');
} else {

    include '../../../include/all_include.php';
    function bulan($bulan)
    {
        $month = [
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
        return $month[$bulan];
    }

    if (isset($_GET['tanggal1']) && isset($_GET['tanggal2']) && !empty($_GET['tanggal1']) && !empty($_GET['tanggal2'])) {
        $id_hotel = $_GET['hotel'];
        $dari = mysql_real_escape_string($_GET['tanggal1']);
        $sampai = mysql_real_escape_string($_GET['tanggal2']);
        $berdasarkan = $_GET['Berdasarkan'];
        $query_transaksi = "SELECT waktu AS tanggal, jumlah_bayar AS debit, keterangan AS deskripsi  FROM data_pemasukan WHERE id_hotel='$id_hotel' AND waktu BETWEEN '$dari' and '$sampai'";

        $alamat = baca_database("", "alamat", "select * from data_hotel where id_hotel='$id_hotel'");
        $query = "SELECT * FROM data_operasional WHERE id_hotel='$id_hotel' AND $berdasarkan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal";
    } elseif (isset($_GET['Berdasar'])) {
        $hotel = $_GET['hotel'];
        $bulan = $_GET['bulan'];

        $query_transaksi = "SELECT * FROM data_pemasukkan WHERE id_hotel='$hotel' AND MONTH(waktu)=$bulan";
        $query = "SELECT * FROM  data_operasional WHERE id_hotel ='$hotel' AND MONTH(tanggal)=$bulan";
    }


    ?>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }

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
            text-align: start;
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
        <table class="tableheader" id='tableheader'>
            <tr>
                <td width="10%">
                    <center><img src="../../../data/image/logo/steze-2.png" alt="" srcset="" width='100'></center>
                </td>
                <td width='80%'>
                    <center>
                        <h1 style='color:#E62600'>SteZe</h1>
                    </center>
                    <center>
                        <h1>LAPORAN CASHFLOW</h1>
                    </center>
                    <center>
                        <?php
                        if (isset($_GET['Berdasarkan'])) {
                            echo "<p style='background-color:#eaeaea;padding:5px'> Periode " . format_indo($dari) . " Sampai Dengan " . format_indo($sampai) . "</p> <small> Alamat :$alamat</small>";
                        } elseif (isset($_GET['bulan'])) {
                            $nama_hotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$_GET[hotel]'");
                            echo "<p style='background-color:#eaeaea; padding:5px;font-weight:700'>Cabang $nama_hotel  di Bulan " . bulan($_GET['bulan']) . " " . $_GET['tahun'] . " </p><small >  </small>";
                        } else {
                            echo "<p style='background-color:#eaeaea; padding:5px;font-weight:700'>Semua Hotel dan Jangka Waktu</p><small >   $alamat</small>";
                        }
                        ?>
                    </center>
                </td>
                <td width='10%'>
                    <center><img src="../../../data/image/logo/steze-2.png" alt="" srcset="" width='100'></center>
                </td>
            </tr>
        </table>
    </section>
    <section>
        <?php
        if (isset($_GET['Berdasarkan'])) {
        ?>
            <table class="table-content" id='table-content' style='font-family:arial;font-size:11pt'>
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Cash In</th>
                    <th>Cash Out</th>
                </thead>
                <tbody>
                    <?php
                    $cashflow = [];
                    $result_query = mysql_query($query);
                    $result_transaksi = mysql_query($query_transaksi);
                    while ($data1 = mysql_fetch_array($result_transaksi)) {
                        $cashflow[] = [
                            'tanggal' => $data1['tanggal'],
                            'deskripsi' => $data1['deskripsi'],
                            'debit' => $data1['debit'],
                            'kredit' => 0
                        ];
                    }

                    while ($data2 = mysql_fetch_array($result_query)) {
                        $cashflow[] = [
                            'tanggal' => $data2['tanggal'],
                            'deskripsi' => $data2['operasional'],
                            'debit' => 0,
                            'kredit' => $data2['biaya']
                        ];
                    }

                    usort($cashflow, function ($a, $b) {
                        return strtotime($a['tanggal']) - strtotime($b['tanggal']);
                    });
                    $no = 1;
                    $debit = [];
                    $kredit = [];
                    foreach ($cashflow as $data) {
                        $debit[] = $data['debit'];
                        $kredit[] = $data['kredit'];
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php
                                $waktu = explode(" ", $data['tanggal']);
                                $tanggal = $waktu[0];
                                $jam = $waktu[1];
                                echo format_indo($waktu[0]) . " " . $waktu[1] ?></td>
                            <td><?php echo $data['deskripsi'] ?></td>
                            <td>Rp <?php echo number_format($data['debit']) ?></td>
                            <td>Rp <?php echo number_format($data['kredit']) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>Rp <?php echo number_format(array_sum($debit)) ?></td>
                        <td>Rp <?php echo number_format(array_sum($kredit)) ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style='font-weight:700'>
                            Total Cashflow
                        </td>
                        <td style='font-weight:700'>Rp <?php
                                                        $debit = array_sum($debit);
                                                        $kredit = array_sum($kredit);
                                                        echo number_format($debit - $kredit);
                                                        ?></td>
                    </tr>
                </tbody>
            </table>
        <?php
        } else { ?>
            <table class="table" id="table-content" style='font-family:arial;font-size:11pt'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cabang Hotel</th>
                        <?php
                        if (isset($_GET['bulan'])) {
                        ?>
                            <th>Tanggal</th>
                        <?php
                        } else {
                        ?>
                            <th>Bulan</th>
                        <?php
                        }
                        ?>

                        <th>Pendapatan</th>
                        <th>Pengeluaran</th>
                        <th>Subtotal</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['hotel']) && $_GET['hotel'] !== 'semua') {
                        $idhotel = $_GET['hotel'];
                        $query_hotel = mysql_query("SELECT * FROM data_hotel WHERE id_hotel='$idhotel'");
                    } else {
                        $query_hotel = mysql_query("SELECT * FROM data_hotel");
                    }
                    $no = 1;
                    $laba_rugi_total = [];

                    while ($hotel = mysql_fetch_array($query_hotel)) {
                        $pendapatan_arr = [];
                        $pendapatan_arrtotal = [];
                        $pengeluaran_arr = [];
                        $pengeluaran_arrtotal = [];
                        $labaandrugi = [];

                        // Jika user pilih bulan (per hari)
                        if (isset($_GET['bulan'])) {
                            $bulan = $_GET['bulan'];
                            $tahun = $_GET['tahun'];
                            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

                            for ($j_hari = 1; $j_hari <= $jumlah_hari; $j_hari++) {
                                $q_pendapatan = mysql_query("
                SELECT SUM(COALESCE(jumlah_bayar,0)) AS total 
                FROM data_pemasukan 
                WHERE id_hotel='{$hotel['id_hotel']}' 
                  AND DAY(waktu)=$j_hari 
                  AND MONTH(waktu)=$bulan 
                  AND YEAR(waktu)=$tahun
            ");
                                $pendapatan = mysql_fetch_array($q_pendapatan);

                                $q_operasional = mysql_query("
                SELECT SUM(COALESCE(biaya,0)) AS total 
                FROM data_operasional 
                WHERE id_hotel='{$hotel['id_hotel']}' 
                  AND DAY(tanggal)=$j_hari 
                  AND MONTH(tanggal)=$bulan 
                  AND YEAR(tanggal)=$tahun
            ");
                                $operasional = mysql_fetch_array($q_operasional);

                                $n_pendapatan = $pendapatan['total'];
                                $n_operasional = $operasional['total'];
                                $pendapatan_arr[$j_hari] = $n_pendapatan;
                                $pengeluaran_arr[$j_hari] = $n_operasional;
                                $labaandrugi[$j_hari] = $n_pendapatan - $n_operasional;
                                $laba_rugi_total[] = $n_pendapatan - $n_operasional;
                            }

                            $total_all = array_sum($labaandrugi);

                            for ($j_hari = 1; $j_hari <= $jumlah_hari; $j_hari++) {
                                echo "<tr>";
                                if ($j_hari == 1) {
                                    echo "<td rowspan='{$jumlah_hari}'>{$no}</td>";
                                    echo "<td rowspan='{$jumlah_hari}'>{$hotel['nama']}</td>";
                                }
                                echo "<td>{$j_hari} " . bulan($_GET['bulan']) . " " . date('Y') . "</td>";
                                echo "<td>Rp " . number_format($pendapatan_arr[$j_hari], 0, ',', '.') . "</td>";
                                echo "<td>Rp " . number_format($pengeluaran_arr[$j_hari], 0, ',', '.') . "</td>";
                                echo "<td>Rp " . number_format($labaandrugi[$j_hari], 0, ',', '.') . "</td>";

                                echo "</tr>";
                            }
                        } else { // Default: tampil per bulan
                            for ($bulan = 1; $bulan <= 12; $bulan++) {
                                $q_pendapatan = mysql_query("
                SELECT SUM(COALESCE(jumlah_bayar,0)) AS total
                FROM data_pemasukan 
                WHERE id_hotel = '{$hotel['id_hotel']}'
                  AND MONTH(waktu) = $bulan
            ");
                                $pendapatan = mysql_fetch_array($q_pendapatan)['total'];

                                $q_pengeluaran = mysql_query("
                SELECT SUM(COALESCE(biaya,0)) AS total
                FROM data_operasional
                WHERE id_hotel = '{$hotel['id_hotel']}'
                  AND MONTH(tanggal) = $bulan 
            ");
                                $pengeluaran = mysql_fetch_array($q_pengeluaran)['total'];

                                $pendapatan_arr[$bulan] = $pendapatan;
                                $pendapatan_arrtotal[] = $pendapatan;
                                $pengeluaran_arr[$bulan] = $pengeluaran;
                                $pengeluaran_arrtotal[] = $pengeluaran;
                                $labaandrugi[$bulan] = $pendapatan - $pengeluaran;
                                $laba_rugi_total[] = $pendapatan - $pengeluaran;
                            }

                            $total_all = array_sum($labaandrugi);
                            $pendapatan_total = array_sum($pendapatan_arrtotal);
                            $pengeluaran_total = array_sum($pengeluaran_arrtotal);
                            for ($bulan = 1; $bulan <= 12; $bulan++) {
                                $nama_bulan_ind = [
                                    'January' => 'Januari',
                                    'February' => 'Februari',
                                    'March' => 'Maret',
                                    'April' => 'April',
                                    'May' => 'Mei',
                                    'June' => 'Juni',
                                    'July' => 'Juli',
                                    'August' => 'Agustus',
                                    'September' => 'September',
                                    'October' => 'Oktober',
                                    'November' => 'November',
                                    'December' => 'Desember'
                                ][date('F', mktime(0, 0, 0, $bulan, 10))];

                                echo "<tr>";
                                if ($bulan == 1) {
                                    echo "<td rowspan='12'>{$no}</td>";
                                    echo "<td rowspan='12'>{$hotel['nama']}</td>";
                                }
                                echo "<td>{$nama_bulan_ind}</td>";
                                echo "<td>Rp " . number_format($pendapatan_arr[$bulan], 0, ',', '.') . "</td>";
                                echo "<td>Rp " . number_format($pengeluaran_arr[$bulan], 0, ',', '.') . "</td>";
                                echo "<td>Rp " . number_format($labaandrugi[$bulan], 0, ',', '.') . "</td>";

                                echo "</tr>";
                            }
                            if (isset($_GET['hotel']) && $_GET['hotel'] == 'semua') {
                                echo "<tr style='font-weight:700'>";
                                echo "<td colspan='3' style='text-align:center'> Total </td>";
                                echo "<td>Rp " . number_format($pendapatan_total) . "</td>";
                                echo "<td>Rp" . number_format($pengeluaran_total) . "</td>";
                                echo "<td> Rp " . number_format($total_all) . "</td>
        </tr>";
                            }
                        }

                        $no++;
                    } // end while hotel

                    $total_all2 = array_sum($laba_rugi_total);
                    ?>
                    <tr style='text-align:center;font-weight:700;color:green'>
                        <td colspan='5' style='text-align:center'>Total Laba/Rugi</td>
                        <td><?php echo "Rp" . number_format($total_all2) ?></td>
                    </tr>
                </tbody>
            </table>
    </section>
    <div style='padding:20px'>
        <p style="text-align:right"><?php echo $formatwaktu ?></p>
        <p class="auto-style3" style="text-align:right"><?php echo $ttd; ?></p>
        <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
        <p style='text-align:right'><?php echo $siapa ?></p>
        <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>

        <p class="auto-style3"></p>
    </div>
<?php
        }
    } ?>