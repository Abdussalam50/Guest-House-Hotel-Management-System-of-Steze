<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
<?php
    action_cetak("data_operasional");
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
    <table border="0" style="width: 100%;font-family:arial;">
        <?php
        if (isset($_GET['export'])) {
        } else {
            $idHotel = decrypt($_COOKIE['id_hotel']);
        ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>

                <td class="auto-style1">
                    <center>
                        <h2 class="auto-style1" style='color:#D92C09'><?php echo $judul; ?> Cabang <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'") ?></h2>
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
            <td class="auto-style2"><?php

                                    echo baca_database("", "alamat", "select * from data_hotel where id_hotel='$idHotel'"); ?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%" class="" style='font-family:arial;font-size:11pt'>
        <tr>
            <th class="th_border cell">No</th>
            <!--h <th class="th_border cell">Id Operasional </th> h-->
            <th align="center" class="th_border cell">Nama Hotel</th>
            <th align="center" class="th_border cell">Tanggal</th>
            <th align="center" class="th_border cell">Operasional </th>
            <th align="center" class="th_border cell">Jumlah </th>
            <th align="center" class="th_border cell">Keperluan </th>
            <th align="center" class="th_border cell">Biaya </th>
            <th align="center" class="th_border cell">Penanggung Jawab </th>


        </tr>

        <tbody>
            <?php
            $no = 0;
            $id_hotel = decrypt($_COOKIE['id_hotel']);
            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                $querytabel = "SELECT * FROM data_operasional where $Berdasarkan like '%$isi%' AND id_hotel='$id_hotel'";
            } else if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center>';
                $querytabel = "SELECT * FROM data_operasional where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2') AND id_hotel='$id_hotel'";
            } else {
                //SEMUA
                $querytabel = "SELECT * FROM data_operasional WHERE id_hotel='$id_hotel'";
            }
            $proses = mysql_query($querytabel);
            $Total_biaya=[];
            while ($data = mysql_fetch_array($proses)) {
                $Total_biaya[]=$data['biaya'];
            ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1;
                                                    echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_operasional']; ?></td> h-->
                    <td align="center"><?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
                    <td align="center"><?php echo format_indo($data['tanggal']); ?></td>
                    <td align="center"><?php echo $data['operasional']; ?></td>
                    <td align="center"><?php echo $data['jumlah']; ?></td>
                    <td align="center"><?php echo $data['keperluan']; ?></td>
                    <td align="center"><?php echo rupiah($data['biaya']); ?></td>
                    <td align="center"><?php echo baca_database("", "nama", "select * from data_admin where id_admin='$data[id_admin]'"); ?></td>




                </tr>
            <?php } ?>
            <tr style='font-weight:700'>
                <td colspan='6' style='text-align:center;'>Total Operasional Hotel</td>
                <td colspan="2"><?php echo rupiah(array_sum($Total_biaya))?></td>

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