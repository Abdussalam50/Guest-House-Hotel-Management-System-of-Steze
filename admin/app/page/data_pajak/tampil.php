<body>
<?php
if(isset($_COOKIE['operasional'])){
    
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu pelanggan\n');
        window.location.href='../../index.php'
    </script>
<?php
}
?>
    <a href="<?php index(); ?>?input=tambah">
        <?php btn_tambah("Tambah"); ?>
    </a>

    <a target="blank" href="cetak.php?berdasarkan=data_admin&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_export("Export Excel"); ?>
    </a>

    <a target="blank" href="cetak.php?berdasarkan=data_admin&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_cetak("Cetak"); ?>
    </a>

    <a href="<?php index(); ?>">
        <?php btn_refresh("Refresh"); ?>
    </a>

    <br><br>

    <form name="formcari" id="formcari" action="" method="get">
        <fieldset>
            <table>
                <tbody>
                    <tr>
                        <td>Berdasarkan</td>
                        <td>:</td>
                        <td>
                            <!-- <input value="" name="Berdasarkan" id="Berdasarkan" > -->
                            <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
                                <?php
                                $sql = "desc data_pajak";
                                $result = @mysql_query($sql);
                                while ($row = @mysql_fetch_array($result)) {
                                    echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Pencarian</td>
                        <td>:</td>
                        <td>
                            <!--<input class="form-control" type="text" name="isi" value="" >--> <input type="text" name="isi" value="">
                            <?php btn_cari("Cari"); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>

    <div style="overflow-x:auto;">
        <table <?php tabel(100, "%", 1, "left"); ?>>
            <tr>
                <th>Action</th>
                <th>No</th>
                <!--h <th>Id pajak</th> -->
                                <th align="left" class="th_border cell">Waktu</th>
                                <th align="left" class="th_border cell">Id pelanggan</th>
                                <th align="left" class="th_border cell">Jenis pajak</th>
                                <th align="left" class="th_border cell">Persentase pajak</th>
                                <th align="left" class="th_border cell">Pajak</th>
                                <th align="left" class="th_border cell">Nama</th>
                            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (
                    isset($_GET["Berdasarkan"]) &&
                    !empty($_GET["Berdasarkan"]) &&
                    isset($_GET["isi"]) &&
                    !empty($_GET["isi"])
                ) {
                    $berdasarkan = mysql_real_escape_string(
                        $_GET["Berdasarkan"]
                    );
                    $isi = mysql_real_escape_string($_GET["isi"]);
                    $querytabel = "SELECT * FROM data_pajak where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_pajak where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_pajak  LIMIT $startRow ,$dataPerPage";
                    $querypagination =
                        "SELECT COUNT(*) AS total FROM data_pajak";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) { ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a href="<?php index(); ?>?input=detail&proses=<?= encrypt(
                                                                                            $data["id_pajak"]
                                                                                        ) ?>">
                                            <?php btn_detail("Detail"); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt(
                                                                                            $data["id_pajak"]
                                                                                        ) ?>">
                                            <?php btn_edit("Edit"); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt(
                                                                                            $data["id_pajak"]
                                                                                        ) ?>">
                                            <?php btn_hapus("Hapus"); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td align="center" width="50"><?php $no = $no + 1;
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data["id_pajak"]; ?></td> h-->
                                                <td align="left"><?php echo format_indo($data["waktu"]); ?></td>
                                                <td align="left"><?php echo baca_database("","id_pelanggan","select * from data_transaksi where id_transaksi='$data[id_transaksi]'")  ?></td>
                                                <td align="left"><?php echo $data["jenis_pajak"]; ?></td>
                                                <td align="left"><?php echo $data["persentase_pajak"]; ?></td>
                                                <td align="left"><?php echo $data["pajak"]; ?></td>
                                                <td align="left"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
                                            </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>