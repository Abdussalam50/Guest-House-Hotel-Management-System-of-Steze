<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
<?php
    action_cetak("data_booking");
} else {

    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_booking");
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php
        $idHotel = decrypt($_COOKIE['id_hotel']);
        if (isset($_GET['export'])) {
        } else {

        ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>

                <td class="auto-style1">
                    <center>
                        <h2 class="auto-style1 " style='color:#D92C09'><?php echo $judul; ?> Cabang <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'") ?></h2>
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
                        $tabelnya = "data_booking";
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

                                    echo baca_database("", "alamat", "select * from data_hotel where id_hotel='$idHotel'"); ?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <div>
        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; font-family: arial; font-size:9pt;">
            <thead>
                <tr style="background-color: #f9f9f9; text-align:center;">
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Harga/Hari</th>
                    <th>jml Hari</th>
                    <th>Harga Kamar</th>
                    <th>Disc %</th>
                    <th>Total Disc</th>
                    <th>Setelah Disc</th>
                    <th>Tambahan In</th>
                    <th>Tambahan Out</th>
                    <th>Potongan Harga</th>
                    <th>Sub<br>Total</th>
                    <th>Total<br>Pajak</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id_hotel = decrypt($_COOKIE['id_hotel']);
                $no = 0;

                // Initialize the base query
                $querytabel = "SELECT dt.*, dp.nama, dk.no_kamar 
                   FROM data_booking dt
                   JOIN data_pelanggan dp ON dt.id_pelanggan = dp.id_pelanggan
                   JOIN data_kamar dk ON dt.id_kamar = dk.id_kamar
                   WHERE 1=1"; // Start with a true condition for dynamic WHERE clause

                // Add id_hotel filter only if it is not empty
                if (!empty($id_hotel)) {
                    $querytabel .= " AND dt.id_hotel='$id_hotel'";
                }

                if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                    $querytabel .= " AND $Berdasarkan LIKE '%$isi%'";
                } else if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                    $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                    $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                    $tanggal1_indo = format_indo($tanggal1);
                    $tanggal2_indo = format_indo($tanggal2);
                    echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center>';
                    $querytabel .= " AND ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
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
                    $harga_per_hari = $data['harga_kamar_harian'];
                    $jumlah_hari = $data['jumlah_hari'];

                    // Harga kamar total
                    if ($data['jenis_transaksi'] == 'bulanan') {
                        $harga_kamar_total = $data['harga_kamar_bulanan'] * ($jumlah_hari / 30);
                    } else {
                        $harga_kamar_total = $harga_per_hari * $jumlah_hari;
                    }

                    // Diskon
                    $disc_nominal = ($harga_kamar_total * $data['discount']) / 100;
                    $harga_setelah_disc = $harga_kamar_total - $disc_nominal;

                    // Biaya tambahan & potongan
                    $tambahan_in = $data['biaya_tambahan_checkin'];
                    $tambahan_out = $data['biaya_tambahan_checkout'];
                    $potongan_harga = $data['potongan_harga'];

                    // Subtotal
                    $sub_total = $harga_setelah_disc + $tambahan_in + $tambahan_out - $potongan_harga;

                    // Pajak & total bayar
                    $pajak = ($sub_total * $data['persentase_pajak']) / 100;
                    $total_bayar = $sub_total + $pajak;

                    // Akumulasi total
                    $total_disc_nominal += $disc_nominal;
                    $total_tambahan_in += $tambahan_in;
                    $total_tambahan_out += $tambahan_out;
                    $total_potongan_harga += $potongan_harga;
                    $total_pajak += $pajak;
                    $total_bayar_all += $total_bayar;
                ?>
                    <tr style="text-align:center;">
                        <td><?= $no ?></td>
                        <td><?= $data['id_transaksi']; ?></td>
                        <td><?= ucwords($data['nama']); ?></td>
                        <td><?= $data['no_kamar']; ?></td>
                        <td><?= format_indo($data['waktu_checkin']); ?></td>
                        <td><?php

                            $today = strtotime(date('Y-m-d'));
                            $checkout = strtotime($data['waktu_checkout']);
                            $hari_tersisa = ($checkout - $today) / (60 * 60 * 24);

                            if ($hari_tersisa > 0) {
                                $hari_tersisa = ceil($hari_tersisa);
                                if ($data['status_transaksi'] == 'Selesai') {
                                    echo str_replace(" ", " ", format_indo($data['waktu_checkout']));
                                } else {
                                    echo str_replace(" ", " ", format_indo($data['waktu_checkout']))
                                        . "<br><b style='color:red'> {$hari_tersisa} hari lagi</b>";
                                }
                            } elseif ($hari_tersisa == 0) {

                                if ($data['status_transaksi'] == 'Selesai') {
                                    echo str_replace(" ", " ", format_indo($data['waktu_checkout']));
                                } else {
                                    // Hari ini
                                    echo str_replace(" ", " ", format_indo($data['waktu_checkout']))
                                        . "<br><b style='color:green'> Hari ini</b>";
                                }
                            } else {
                                // Lewat
                                echo str_replace(" ", " ", format_indo($data['waktu_checkout']));
                            }




                            ?>
                        </td>
                        <td><?= rupiah($harga_per_hari); ?></td>
                        <td><?= $jumlah_hari; ?></td>
                        <td><?= rupiah($harga_kamar_total); ?></td>
                        <td><?= $data['discount']; ?>%</td>
                        <td><?= rupiah($disc_nominal); ?></td>
                        <td><?= rupiah($harga_setelah_disc); ?></td>
                        <td><?= rupiah($tambahan_in); ?></td>
                        <td><?= rupiah($tambahan_out); ?></td>
                        <td><?= rupiah($potongan_harga); ?></td>
                        <td><?= rupiah($sub_total); ?></td>
                        <td><?= rupiah($pajak); ?></td>
                        <td><b><?= rupiah($total_bayar); ?></b></td>
                        <td><?= $data['status_transaksi']; ?></td>
                    </tr>
                <?php } ?>
                <tr style="background-color:#f1f1f1; font-weight:bold; text-align:center;">
                    <td colspan="10">Total Keseluruhan</td>
                    <td><?= rupiah($total_disc_nominal); ?></td>
                    <td></td>
                    <td><?= rupiah($total_tambahan_in); ?></td>
                    <td><?= rupiah($total_tambahan_out); ?></td>
                    <td><?= rupiah($total_potongan_harga); ?></td>
                    <td></td>
                    <td><?= rupiah($total_pajak); ?></td>
                    <td><b><?= rupiah($total_bayar_all); ?></b></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?>
    </p>
    <p class="auto-style3"><?php echo $ttd; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
    <p class="auto-style3"></p>

<?php } ?>