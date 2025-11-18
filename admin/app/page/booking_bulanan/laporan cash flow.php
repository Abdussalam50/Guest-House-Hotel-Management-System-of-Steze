<?php
if(isset($_COOKIE['operasional'])){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu pelanggan\n');
        window.location.href='../../index.php'
    </script>
<?php
}
if (isset($_GET['input'])) {
    echo "<h3>Cetak Laporan Cash Flow</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    function action_cetak_cash_flow($tabel)
    {
    ?>
        <form name="formcari" id="formcari" action="laporan cash flow.php" method="get" target="_blank">
            <input type="hidden" name="id_hotel" value="<?php echo $_GET['id_hotel'] ?>">
            <fieldset>
                <table>
                    <tbody>
                        <tr>
                            <td><b>CETAK KESELURUHAN</b></td>
                            <td></td>
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
                                        if (preg_match("/date/i", $typedata)) {
                                            echo "<option name='berdasarkan' value='$row[0]'>$row[0]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <input type="hidden" name="id_hotel" value='<?php echo $_GET['id_hotel'] ?>'>
                        <tr>
                            <td style="width:40%">Dari Tanggal :</b></td>
                            <td><input type="date" name="tanggal1"></td>
                        </tr>
                        <tr>
                            <td style="width:40%">Sampai Tanggal :</b></td>
                            <td><input type="date" name="tanggal2"></td>
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
    action_cetak_cash_flow('data_pemasukan');
} else {
    require_once '../../../include/all_include.php';

    $id_hotel = $_GET['id_hotel'];
    $base_query_pemasukan = "SELECT waktu AS tanggal, keterangan AS deskripsi, jumlah_bayar AS debit 
                            FROM data_pemasukan 
                            WHERE 1=1";
    $base_query_operasional = "SELECT tanggal, operasional AS deskripsi, biaya AS kredit 
                             FROM data_operasional 
                             WHERE 1=1";

    // Conditionally add id_hotel filter
    if (!empty($id_hotel)) {
        $base_query_pemasukan .= " AND id_hotel='$id_hotel'";
        $base_query_operasional .= " AND id_hotel='$id_hotel'";
    }

    if (isset($_GET['tanggal1']) && isset($_GET['tanggal2']) && !empty($_GET['tanggal1']) && !empty($_GET['tanggal2'])) {
        $dari = mysql_real_escape_string($_GET['tanggal1']);
        $sampai = mysql_real_escape_string($_GET['tanggal2']);
        $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
        $query_pemasukan = $base_query_pemasukan . " AND $berdasarkan BETWEEN '$dari' AND '$sampai' ORDER BY waktu ASC";
        $query_operasional = $base_query_operasional . " AND $berdasarkan BETWEEN '$dari' AND '$sampai' ORDER BY tanggal ASC";
    } else {
        $query_pemasukan = $base_query_pemasukan . " ORDER BY waktu ASC";
        $query_operasional = $base_query_operasional . " ORDER BY tanggal ASC";
    }
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
                        <h4 style='background-color:#eaeaea;padding:5px'>LAPORAN CASHFLOW</h4>
                        <?php
                        echo "<p  style='margin: 0px;'>Alamat: " . (!empty($id_hotel) ? baca_database("", "alamat", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'") : "Semua Cabang") . "</p>";
                        ?>

                        <?php
                        if (isset($_GET['Berdasarkan']) && isset($dari) && isset($sampai)) {
                            echo "<h4 >Periode " . format_indo($dari) . " Sampai Dengan " . format_indo($sampai) . "</h4>";
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
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Cash In</th>
                <th>Cash Out</th>
            </thead>
            <tbody>
                <?php
                $cashflow = [];
                $result_pemasukan = mysql_query($query_pemasukan);
                while ($data1 = mysql_fetch_array($result_pemasukan)) {
                    $cashflow[] = [
                        'tanggal' => $data1['tanggal'],
                        'deskripsi' => $data1['deskripsi'],
                        'debit' => $data1['debit'],
                        'kredit' => 0
                    ];
                }

                $result_operasional = mysql_query($query_operasional);
                while ($data2 = mysql_fetch_array($result_operasional)) {
                    $cashflow[] = [
                        'tanggal' => $data2['tanggal'],
                        'deskripsi' => $data2['deskripsi'],
                        'debit' => 0,
                        'kredit' => $data2['kredit']
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
                        <td><?php echo format_indo($data['tanggal']) ?></td>
                        <td><?php echo $data['deskripsi'] ?> <?php echo $data['metode_pembayaran'] ?> </td>
                        <td>Rp <?php echo number_format($data['debit']) ?></td>
                        <td>Rp <?php echo number_format($data['kredit']) ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr style='font-weight:700'>
                    <td colspan="3">Total Cash In dan Cash Out</td>
                    <td>Rp <?php
                            $tot_debit = array_sum($debit);
                            echo number_format($tot_debit) ?></td>
                    <td>
                        Rp <?php
                            $tot_kredit = array_sum($kredit);
                            echo number_format($tot_kredit) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style='font-weight:700;'>
                        Total Cashflow
                    </td>
                    <td style='font-weight:700'>Rp <?php
                                                    $total_debit = array_sum($debit);
                                                    $total_kredit = array_sum($kredit);
                                                    echo number_format($total_debit - $total_kredit);
                                                    ?></td>
                </tr>
            </tbody>
        </table>

        <!-- FOOTER -->
        <p class="auto-style3"><?php echo $formatwaktu; ?></p>
        <p class="auto-style3"><?php echo $ttd; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p class="auto-style3"></p>
    </section>
<?php
} ?>