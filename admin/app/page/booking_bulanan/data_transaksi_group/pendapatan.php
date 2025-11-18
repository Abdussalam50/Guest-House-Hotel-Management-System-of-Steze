<?php
require_once '../../../include/all_include.php';

if (isset($_GET['input'])) {
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <h3>Cetak Laporan Pendapatan</h3>
    <form name="formcari" id="formcari" action="pendapatan.php" method="get" target="_blank">
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
    <form name="formcari" id="formcari" action="pendapatan.php" method="get" target="_blank">
        <fieldset>
            <table>
                <tbody>
                    <tr>
                        <td><b>CETAK PERPERIODE</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width:40%">Dari Tanggal :</td>
                        <td><input type="date" name="tanggal1"></td>
                    </tr>
                    <tr>
                        <td style="width:40%">Sampai Tanggal :</td>
                        <td><input type="date" name="tanggal2"></td>
                    </tr>
                    <input type="hidden" name="id_hotel" value='<?php echo $_GET['id_hotel'] ?>'>
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
} else {
    $id_hotel = $_GET['id_hotel'];
    $nama_hotel = ucwords(baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'"));

    // Initialize base queries
    $query_pemasukan = "SELECT * FROM data_pemasukan WHERE 1=1";
    $query_operasional = "SELECT * FROM data_operasional WHERE 1=1";

    // Add id_hotel filter if not empty
    if (!empty($id_hotel)) {
        $query_pemasukan .= " AND id_hotel='$id_hotel'";
        $query_operasional .= " AND id_hotel='$id_hotel'";
    }

    // Handle date range filtering
    if (isset($_GET['tanggal1']) && isset($_GET['tanggal2']) && !empty($_GET['tanggal1']) && !empty($_GET['tanggal2'])) {
        $dari = mysql_real_escape_string($_GET['tanggal1']);
        $sampai = mysql_real_escape_string($_GET['tanggal2']);
        $text = "Hasil Laporan Pendapatan dari " . format_indo($dari) . " Sampai " . format_indo($sampai) . " Hotel Stezee Cabang $nama_hotel";
        $query_pemasukan .= " AND waktu BETWEEN '$dari' AND '$sampai'";
        $query_operasional .= " AND tanggal BETWEEN '$dari' AND '$sampai'";
    } else {
        $text = "Semua Jangka Waktu di $nama_hotel";
    }

    // Execute queries
    $result_pemasukan = mysql_query($query_pemasukan);
    $result_operasional = mysql_query($query_operasional);

    // Calculate totals
    $total_pemasukan = 0;
    while ($data = mysql_fetch_array($result_pemasukan)) {
        $total_pemasukan += $data['jumlah_bayar'];
    }

    $total_operasional = 0;
    while ($data = mysql_fetch_array($result_operasional)) {
        $total_operasional += $data['biaya'];
    }

    $total_pendapatan = $total_pemasukan - $total_operasional;
?>
    <style>
        body {
            font-family: 'Arial', sans-serif !important;
            font-size: 12px !important;
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
    <table id='tableheader'>
        <tr>
            <td width='10%'>
                <center><img src="../../../data/image/logo/steze-2.png" alt="" width='100'></center>
            </td>
            <td width='80%'>
                <center>
                    <h2 style='color:#D92C09'>SteZe Cabang <?php echo $nama_hotel ?></h2>
                </center>
                <center>
                    <h1>LAPORAN PENDAPATAN</h1>
                </center>
                <center>
                    <h4 style='padding:5px; background-color:#eaeaea'><?php echo $text; ?></h4>
                </center>
                <center>
                    <p style='font-size:11pt'><?php echo baca_database("", "alamat", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'") ?></p>
                </center>
            </td>
            <td width='10%'>
                <center><img src="../../../data/image/logo/steze-2.png" alt="" width='100'></center>
            </td>
        </tr>
    </table>
    <div class="container">
        <table class="table" id="table-content" width='100%' style='font-family:arial;font-size:11pt'>
            <thead>
                <th>Kategori</th>
                <th>Jumlah (Rp)</th>
            </thead>
            <tbody>
                <tr>
                    <td>Total Pemasukan</td>
                    <td>Rp <?php echo number_format($total_pemasukan) ?></td>
                </tr>
                <tr>
                    <td>Total Pengeluaran Operasional</td>
                    <td>Rp <?php echo number_format($total_operasional) ?></td>
                </tr>
                <tr>
                    <td style='font-weight:700'>Total Pendapatan</td>
                    <td style='font-weight:700'>Rp <?php echo number_format($total_pendapatan) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style='padding:20px'>
        <p style="text-align:right"><?php echo $formatwaktu ?></p>
        <br>
        <p style='text-align:right'><?php echo $siapa ?></p>
    </div>
<?php
}
?>