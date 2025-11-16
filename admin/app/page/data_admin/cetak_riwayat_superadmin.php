<?php

if(isset($_COOKIE['operasional'])){
     $akses=baca_database("","value","select * from data_pengaturan_aplikasi where nama_pengaturan='akses_riwayat_superadmin'");
     if($akses==0){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses riwayat super admin\n');
        window.location.href='../../index.php'
    </script>
<?php
     }
}
if (isset($_GET['input'])) {
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Riwayat</title>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        .form-section, .report-section {
            margin-bottom: 30px;
        }
        .form-section table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
        }
        .form-section td {
            padding: 10px;
            vertical-align: middle;
        }
        .form-section select, .form-section button {
            padding: 8px;
            width: 100%;
            max-width: 300px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .report-table th, .report-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .report-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .report-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .view-more-btn {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
        .view-more-btn:hover {
            color: #0056b3;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 100px;
        }
        .header-text {
            text-align: center;
            flex-grow: 1;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
            }
            .header img {
                margin-bottom: 10px;
            }
            .form-section table {
                width: 100%;
            }
            .report-table th, .report-table td {
                padding: 8px;
                font-size: 14px;
            }
        }
        .swal-table {
            width: 100%;
            border-collapse: collapse;
        }
        .swal-table th, .swal-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .swal-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h3>Cetak Laporan Riwayat Super Admin</h3>
            <?php
            function action_cetak_riwayat($tabel) {
            ?>
            <form name="formcari" id="formcari" action="cetak_riwayat_superadmin.php" method="get" target="_blank">
                <fieldset>
                    
                    <table>
                        <tbody>
                            <tr>
                                <td>Pilih Bulan:</td>
                                <td>
                                    <select name="bulan" id="bulan" class="form-control">
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
                                    <select name="tahun" id="tahun" class="form-control">
                                        <?php
                                        $query = mysql_query("SELECT DISTINCT YEAR(waktu) AS tahun FROM data_riwayat_admin ORDER BY waktu DESC") or die(mysql_error());
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
                                <td>Pilih Data:</td>
                                <td>
                                    <select class="form-control selectpicker" name="data" id="data">
                                        <?php
                                        $query = mysql_query("SELECT DISTINCT nama_tabel AS tabel FROM data_riwayat_superadmin ");
                                        while ($data = mysql_fetch_array($query)) {
                                        ?>
                                            <option value="<?= htmlspecialchars($data['tabel']) ?>"><?= htmlspecialchars($data['tabel']) ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="semua">Semua</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Pilih Aksi:</td>
                                <td>
                                    <select class="form-control selectpicker" name="aksi" id="aksi">
                                        <option value="INSERT">Tambah Data</option>
                                        <option value="UPDATE">Update Data</option>
                                        <option value="DELETE">Hapus Data</option>
                                        <option value="semua">Semua</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php btn_preview_laporan('Print Preview'); ?>
                                    <?php
                                    if ($tabel == 'data_pelanggan') {
                                        btn_export_laporan('Export Excel');
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </form>
            <?php
            }
            action_cetak_riwayat("data_riwayat_admin");
            ?>
        </div>
    </div>
<?php
} else {
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Riwayat Admin</title>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border:1px solid #D1D5DB;
            padding:5px;
        }
        .header img {
            max-height: 100px;
        }
        .header-text {
            text-align: center;
            flex-grow: 1;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .report-table th, .report-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .report-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .report-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .view-more-btn {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
        .view-more-btn:hover {
            color: #0056b3;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .swal-table {
            width: 100%;
            border-collapse: collapse;
        }
        .swal-table th, .swal-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .swal-table th {
            background-color: #f2f2f2;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
            }
            .header img {
                margin-bottom: 10px;
            }
            .report-table th, .report-table td {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        function location() {
            return "cetak";
        }
        include '../../../include/all_include.php';
        proses_action_cetak("data_riwayat_admin");
        ?>
        <!-- HEADER -->
        <div class="header">
            <?php if (!isset($_GET['export'])) { ?>
                <img alt="Logo" src="<?php echo $logo_laporan1; ?>" height="100">
                <div class="header-text">
                    <h1 style='color:#DC3545'><?php echo $judul . (isset($_GET['hotel']) ? ' Cabang ' . ucwords(baca_database("", "nama", "select * from data_hotel where id_hotel='$_GET[hotel]'")) : ''); ?></h1>
                    <h3 style='background-color:#D1D5DB;margin-left:5px;margin-right:5px'>LAPORAN <?php
                        $tabelnya = strtoupper(str_replace(["_", "data"], [" ", ""], "data_riwayat_superadmin"));
                        echo $tabelnya;
                    ?></h3>

                </div>
                <img alt="Logo" src="<?php echo $logo_laporan2; ?>" height="100">
            <?php } ?>
        </div>
        <!-- HEADER -->

        <!-- BODY -->
        <div class="report-section">
            <?php
            $month = [
                '1'  => 'Januari', '2'  => 'Februari', '3'  => 'Maret', '4'  => 'April',
                '5'  => 'Mei', '6'  => 'Juni', '7'  => 'Juli', '8'  => 'Agustus',
                '9'  => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
            ];
            $no = 1;
            if ($_GET['data'] == 'semua' && $_GET['aksi'] == 'semua') {
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                echo '<center><h4 class="text-center">Cetak <b>Semua Riwayat Super Admin Dibulan ' . $month[$bulan] . ' dan Tahun ' . $tahun . '</b></h4></center>';
                $querytabel = "SELECT * FROM data_riwayat_superadmin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan";
            } elseif ($_GET['aksi'] == 'semua' && $_GET['data'] !== 'semua') {
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                $data = mysql_real_escape_string($_GET['data']);
                $aksi = mysql_real_escape_string($_GET['aksi']);
              
                echo '<center><h4 class="text-center">Cetak <b>Semua Riwayat Super Admin Dibulan ' . $month[$bulan] . ' dan Tahun ' . $tahun . '</b></h4></center>';
                $querytabel = "SELECT * FROM data_riwayat_superadmin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan ";
            } elseif ($_GET['aksi'] !== 'semua' && $_GET['data'] == 'semua') {
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                $data = mysql_real_escape_string($_GET['data']);
                $aksi = mysql_real_escape_string($_GET['aksi']);
                echo '<center><h4 class="text-center">Cetak <b>Semua Riwayat Super Admin Pada Data ' . $data . ' Dibulan ' . $month[$bulan] . ' dan Tahun ' . $tahun . '</b></h4></center>';
                $querytabel = "SELECT * FROM data_riwayat_superadmin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan AND action='$aksi' ";
            } else {
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                $data = mysql_real_escape_string($_GET['data']);
                $aksi = mysql_real_escape_string($_GET['aksi']);
              
                echo '<center><h4 class="text-center">Cetak <b>Semua Riwayat Super Admin Pada Data ' . $data . ' Dibulan ' . $month[$bulan] . ' dan Tahun ' . $tahun . '</b></h4></center>';
                $querytabel = "SELECT * FROM data_riwayat_superadmin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan AND action='$aksi' AND nama_tabel='$data'";
            }
            $proses = mysql_query($querytabel);
            $rows = [];
            while ($data = mysql_fetch_array($proses)) {
                $rows[] = [
                    'action'     => $data['action'],
                    'waktu_buat' => format_indo($data['waktu']),
                    'pelaku'     => $data['id_admin'],
                    'lain'       => $data['data_json']
                ];
            }
            ?>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Tanggal</th>
                        <th>Nama Super Admin</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $content) {
                        echo "<tr id='row-$index'>";
                        echo "<td>$no</td>";
                        echo "<td>" . htmlspecialchars($content['action']) . "</td>";
                        echo "<td>" . htmlspecialchars($content['waktu_buat']) . "</td>";
                        if (cek_database("", "", "", "select * from data_admin where id_admin='$content[pelaku]'") == 'ada') {
                            echo "<td>" . htmlspecialchars(ucwords(baca_database("", "nama", "select * from data_admin where id_admin='$content[pelaku]'"))) . "</td>";
                        } else {
                            echo "<td>" . htmlspecialchars(ucwords(baca_database("", "nama", "select * from data_pengelola where id_pengelola='$content[pelaku]'"))) . "</td>";
                        }
                        echo "<td>";
                        if ($content['lain']) {
                            $decode = json_decode($content['lain'], true);
                            if ($decode) {
                                $column_count = count($decode);
                                $col_index = 0;
                                $hidden_data = [];
                                echo "<table border='1' cellpadding='3' cellspacing='0' style='width: 100%;'>";
                                echo "<thead><tr>";
                                foreach ($decode as $key => $val) {
                                    if ($col_index < 4) {
                                        echo "<th>" . htmlspecialchars($key) . "</th>";
                                    } else {
                                        $hidden_data[$key] = $val;
                                    }
                                    $col_index++;
                                }
                                if ($column_count > 4) {
                                    echo "<th>Action</th>";
                                }
                                echo "</tr></thead>";
                                echo "<tbody><tr>";
                                $col_index = 0;
                                foreach ($decode as $key => $val) {
                                    if ($col_index < 4) {
                                        echo "<td>" . htmlspecialchars($val) . "</td>";
                                    }
                                    $col_index++;
                                }
                                if ($column_count > 4) {
                                    $json_hidden_data = json_encode($hidden_data, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG);
                                    $escaped_json = addslashes($json_hidden_data);
                                    echo "<td><span class='view-more-btn' onclick='showMoreData($index, \"$escaped_json\")'>View More</span></td>";
                                }
                                echo "</tr></tbody>";
                                echo "</table>";
                            } else {
                                echo "Data JSON tidak valid";
                            }
                        } else {
                            echo "-";
                        }
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- BODY -->

        <!-- FOOTER -->
        <div class="footer">
            <p><?php echo htmlspecialchars($formatwaktu); ?></p>
            <p><?php echo ($ttd); ?></p>
            <p>&nbsp;</p>
            <p><?php echo htmlspecialchars($siapa); ?></p>
        </div>
        <!-- FOOTER -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showMoreData(rowId, hiddenData) {
            try {
                const data = JSON.parse(hiddenData);
                const currencyFields = [
                    'total_bayar', 'nominal_bayar', 'biaya', 'pajak', 'nominal_deposit',
                    'total_harga_kamar', 'biaya_tambahan_checkin', 'biaya_tambahan_checkout',
                    'potongan_harga', 'harga_sebelum_pajak', 'jumlah_bayar', 'jumlah_kembalian',
                    'sisa_pembayaran', 'harga_kamar_harian', 'harga_kamar_bulanan'
                ];

                function formatRupiah(value) {
                    const numericValue = parseFloat(value) || 0;
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(numericValue);
                }

                let htmlContent = '<table class="swal-table"><thead><tr><th>Informasi</th><th>Data</th></tr></thead><tbody>';
                for (const [key, value] of Object.entries(data)) {
                    const formattedValue = currencyFields.includes(key) ? formatRupiah(value) : value;
                    htmlContent += `<tr><td>${key}</td><td>${formattedValue}</td></tr>`;
                }
                htmlContent += '</tbody></table>';

                Swal.fire({
                    title: 'Detail Data',
                    html: htmlContent,
                    confirmButtonText: 'Tutup',
                    width: '600px',
                    customClass: {
                        popup: 'swal2-custom'
                    }
                });
            } catch (e) {
                Swal.fire({
                    title: 'Error',
                    text: 'Gagal memproses data tambahan: ' + e.message,
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        }
    </script>
</body>
</html>
<?php
}
?>