<?php
if(isset($_COOKIE['operasional'])){
     $akses=baca_database("","value","select * from data_pengaturan_aplikasi where nama_pengaturan='akses_riwayat_admin'");
     if($akses==0){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses riwayat admin\n');
        window.location.href='../../index.php'
    </script>
<?php
     }
}

if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan Riwayat ";
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    function action_cetak_riwayat($tabel)
    {
    ?>
    <form name="formcari" id="formcari" action="cetak_riwayat.php" method="get" target="_blank">
        <fieldset>
            <table>
                <tbody>
                    <tr>
                        <td><b>CETAK RIWAYAT</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Pilih Bulan :</td>
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
                        <td>Pilih Tahun :</td>
                        <td>
                            <select name="tahun" id="tahun" class="form-control">
                                <?php
                                $query = mysql_query("SELECT DISTINCT YEAR(waktu) AS tahun FROM data_riwayat_admin ORDER BY waktu DESC")or die(mysql_error());

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
                        <td style="width:40%">Pilih Aksi :</td>
                        <td>
                            <select class="form-control selectpicker" name="aksi" id="aksi">
                                <option value="INSERT">Tambah Data</option>
                                <option value="UPDATE">Update Data</option>
                                <option value="DELETE">Hapus Data</option>
                                <option value='semua'>Semua</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40%"></td>
                        <td>
                            <?php btn_preview_laporan('Print Preview'); ?>
                            <?php
                            if($tabel=='data_pelanggan'){
                                btn_export_laporan('Export Excel');
                            } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>
    <br>
    <?php
    }
    action_cetak_riwayat("data_riwayat_admin");
} else {
    function location() {
        return "cetak";
    }
    include '../../../include/all_include.php';
    proses_action_cetak("data_riwayat_admin");
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .view-more-btn { cursor: pointer; color: blue; text-decoration: underline; }
        .swal-table { width: 100%; border-collapse: collapse; }
        .swal-table th, .swal-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .swal-table th { background-color: #f2f2f2; }
    </style>

    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php
        if (isset($_GET['export'])) {
        } else {
            ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100"></td>
                <td class="auto-style1">
                    <center>
                        <?php
                            if(isset($_GET['hotel'])){
                                $hotel="Cabang ".ucwords(baca_database("","nama","select * from data_hotel where id_hotel='$_GET[hotel]'"));
                            }else{
                                $hotel='';
                            }
                        ?>
                        <h2 class="auto-style1"><?php echo $judul." ".$hotel; ?></h2>
                    </center>
                </td>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100"></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="auto-style2">
                <center>
                    <strong>LAPORAN
                        <?php
                        $tabelnya = "data_riwayat_admin";
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
            <td class="auto-style2"><?php
            if(!isset($_COOKIE['id_hotel'])){
                echo "";
            }else{
                $idHotel=decrypt($_COOKIE['id_hotel']);
                echo baca_database("","alamat","select * from data_hotel where id_hotel='$idHotel'"); 
            }?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%" class="">
        <tr>
            <th class="th_border cell">No</th>
            <th align="center" class="th_border cell">Action</th>
            <th align="center" class="th_border cell">Tanggal</th>
            <th align="center" class="th_border cell">Nama Admin</th>
            <th align="center" class="th_border cell">Data</th>
        </tr>
        <tbody>
            <?php
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
            $no = 1;
            if ($_GET['hotel']=='semua' && $_GET['aksi']=='semua') {
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                echo '<center> Cetak <b>Semua Riwayat di Seluruh Hotel Dibulan '.$month[$bulan].' dan Tahun '.$tahun.'</b></center>';
                $querytabel = "SELECT * FROM data_riwayat_admin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan";
            }elseif($_GET['aksi']=='semua' && $_GET['hotel']!=='semua'){
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                $hotel= mysql_real_escape_string($_GET['hotel']);
                $aksi=mysql_real_escape_string($_GET['aksi']);
                echo '<center> Cetak <b>Semua Riwayat di Hotel '.baca_database("","nama","select * from data_hotel where id_hotel='$hotel'").' Dibulan '.$month[$bulan].' dan Tahun '.$tahun.'</b></center>';
               
                $querytabel="SELECT * FROM data_riwayat_admin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan AND id_hotel='$hotel'";
                
            }elseif($_GET['aksi']!=='semua' && $_GET['hotel']=='semua'){
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                $hotel= mysql_real_escape_string($_GET['hotel']);
                $aksi=mysql_real_escape_string($_GET['aksi']);
                echo '<center> Cetak <b>Semua Riwayat di Seluruh Hotel Dibulan '.$month[$bulan].' dan Tahun '.$tahun.'</b></center>';
               
                $querytabel="SELECT * FROM data_riwayat_admin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan AND action='$aksi'";
            }else{
                $tahun = mysql_real_escape_string($_GET['tahun']);
                $bulan = mysql_real_escape_string($_GET['bulan']);
                $hotel= mysql_real_escape_string($_GET['hotel']);
                $aksi=mysql_real_escape_string($_GET['aksi']);
                echo '<center> Cetak <b>Semua Riwayat di Hotel '. baca_database("","nama","select * from data_hotel where id_hotel='$hotel'").' Dibulan '.$month[$bulan].' dan Tahun '.$tahun.'</b></center>';
               
                $querytabel="SELECT * FROM data_riwayat_admin WHERE YEAR(waktu)=$tahun AND MONTH(waktu)=$bulan AND action='$aksi' AND id_hotel='$hotel'"; 
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
            foreach($rows as $index => $content){
                echo "<tr id='row-$index'>";
                echo "<td>".$no++."</td>";
                echo "<td>".$content['action']."</td>";
                echo "<td>".($content['waktu_buat'])."</td>";
                if(cek_database("","","","select * from data_admin where id_admin='$content[pelaku]'")=='ada'){
                    echo "<td>".ucwords(baca_database("","nama","select * from data_admin where id_admin='$content[pelaku]'"))."</td>";
                }else{
                     echo "<td>".ucwords(baca_database("","nama","select * from data_pengelola where id_pengelola='$content[pelaku]'"))."</td>";
                }
                echo "<td>";
                if($content['lain']){
                    $decode = json_decode($content['lain'], true);
                    if ($decode) {
                        $column_count = count($decode);
                        $col_index = 0;
                        $hidden_data = [];
                        echo "<table border='1' cellpadding='3' cellspacing='0' style='width: 100%;'>";
                        echo "<thead><tr>";
                        foreach($decode as $key => $val){
                            if ($col_index < 4) {
                                echo "<th>".htmlspecialchars($key)."</th>";
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
                        foreach($decode as $key => $val){
                            if ($col_index < 4) {
                                echo "<td>".htmlspecialchars($val)."</td>";
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
            }
            ?>
        </tbody>
    </table>
    <!-- BODY -->

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?></p>
    <p class="auto-style3"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3"></p>

    <script>
        function showMoreData(rowId, hiddenData) {
            try {
                const data = JSON.parse(hiddenData);
                function format_rupiah(value) {
                    // Convert value to a number, default to 0 if not a valid number
                    const numericValue = parseFloat(value) || 0;
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(numericValue);
                }
                const currencyFields = [
                    'total_bayar',
                    'nominal_bayar',
                    'biaya',
                    'pajak',
                    'nominal_deposit',
                    'total_harga_kamar',
                    'biaya_tambahan_checkin',
                    'biaya_tambahan_checkout',
                    'potongan_harga',
                    'harga_sebelum_pajak',
                    'jumlah_bayar',
                    'jumlah_kembalian',
                    'sisa_pembayaran',
                    'harga_kamar_harian',
                    'harga_kamar_bulanan'
                ];
                let htmlContent = '<table class="swal-table"><thead><tr><th>Informasi</th><th>Data</th></tr></thead><tbody>';
                for (const [key, value] of Object.entries(data)) {
                    if (currencyFields.includes(key)) {
                        htmlContent += `<tr><td>${key}</td><td>${format_rupiah(value)}</td></tr>`;
                    } else {
                        htmlContent += `<tr><td>${key}</td><td>${value}</td></tr>`;
                    }
                }
                htmlContent += '</tbody></table>';
                Swal.fire({
                    title: 'Additional Data',
                    html: htmlContent,
                    confirmButtonText: 'Close',
                    width: '600px'
                });
            } catch (e) {
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to parse additional data: ' + e.message,
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        }
    </script>
<?php } ?>