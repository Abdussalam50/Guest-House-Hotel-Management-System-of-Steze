<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
<?php
    action_cetak("data_pajak");
} else {

    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_pajak");

    // Decrypt id_hotel from cookie
    $id_hotel = isset($_COOKIE['id_hotel']) ? decrypt($_COOKIE['id_hotel']) : null;
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php
        if (isset($_GET['export'])) {
        } else {
        ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>

                <td class="auto-style1">
                    <center>
                        <h2 class="auto-style1" style='color:#D92C09'><?php echo $judul; ?> Cabang <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$id_hotel'") ?></h2>
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
                        $tabelnya = "data_pajak";
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

                                    echo baca_database("", "alamat", "select * from data_hotel where id_hotel='$id_hotel'"); ?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%" class="" style='font-family:arial;font-size:11pt'>
        <tr>
            <th class="th_border cell">No</th>
            <!--h <th>Id pajak</th> -->
            <th align="center" class="th_border cell">Waktu</th>
            <th align="center" class="th_border cell">Id transaksi</th>
            <th align="center" class="th_border cell">Jenis pajak</th>
            <th align="center" class="th_border cell">Persentase pajak</th>
            <th align="center" class="th_border cell">Pajak</th>

            <th align="center" class="th_border cell">Hotel</th>
        </tr>

        <tbody>
            <?php
            $no = 0;
            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                $querytabel = "SELECT * FROM data_pajak WHERE $Berdasarkan LIKE '%$isi%'";
                if ($id_hotel) {
                    $querytabel .= " AND id_hotel = '" . mysql_real_escape_string($id_hotel) . "'";
                }
            } else if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center>';
                $querytabel = "SELECT * FROM data_pajak WHERE ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
                if ($id_hotel) {
                    $querytabel .= " AND id_hotel = '" . mysql_real_escape_string($id_hotel) . "'";
                }
            } else {
                //SEMUA
                $querytabel = "SELECT * FROM data_pajak";
                if ($id_hotel) {
                    $querytabel .= " WHERE id_hotel = '" . mysql_real_escape_string($id_hotel) . "'";
                }
            }
            $proses = mysql_query($querytabel);
            $total_pajak=[];
            while ($data = mysql_fetch_array($proses)) {
                $total_pajak[]=$data['pajak'];
            ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1;
                                                    echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data["id_pajak"]; ?></td> h-->
                    <td align="center"><?php 
                    $waktu=explode(" ",$data['waktu']);
                    $tanggal=format_indo($waktu[0]);
                    $jam=$waktu[1];
                    echo $tanggal." ".$jam; ?></td>
                    <td align="center"><?php echo baca_database("", "id_transaksi", "select * from data_transaksi where id_transaksi='$data[id_transaksi]'")  ?></td>
                    <td align="center"><?php echo $data["jenis_pajak"]; ?></td>
                    <td align="center"><?php echo $data["persentase_pajak"]; ?>%</td>
                    <td align="center"><?php echo rupiah($data["pajak"]); ?></td>

                    <td align="center"><?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
                </tr>
            <?php } ?>
            <tr style='font-weight:700'>
                <td colspan='5' style='text-align:center'>Total Pajak</td>
                <td colspan="2"><?php echo rupiah(array_sum($total_pajak))?></td>
            </tr>
        </tbody>
    </table>
    <!-- BODY -->

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?>
    </p>
    <p class="auto-style3"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
    <p class="auto-style3"></p>

<?php } ?>