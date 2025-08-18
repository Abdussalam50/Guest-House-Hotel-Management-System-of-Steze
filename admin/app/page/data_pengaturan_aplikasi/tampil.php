<body>

    <div style="overflow-x:auto;">
        <table <?php tabel(100, "%", 1, "left"); ?>>
            <tr>

                <th></th>
                <!--h <th>Id pengaturan aplikasi</th> -->
                <th align="right" class="th_border cell">Nama pengaturan</th>
                <th align="left" class="th_border cell">Value</th>
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
                    $querytabel = "SELECT * FROM data_pengaturan_aplikasi where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_pengaturan_aplikasi where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_pengaturan_aplikasi  ";
                    $querypagination =
                        "SELECT COUNT(*) AS total FROM data_pengaturan_aplikasi";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) { ?>
                    <tr class="event2">



                        <td align="center" width="50"><?php $no = $no + 1;
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data["id_pengaturan_aplikasi"]; ?></td> h-->
                        <td align="left">

                            <a href="<?php index(); ?>?input=edit&proses=<?= encrypt(
                                                                                $data["id_pengaturan_aplikasi"]
                                                                            ) ?>">


                                <?php echo $data["nama_pengaturan"]; ?>
                            </a>
                        </td>
                        <td align="left"><?php echo readmore($data["value"]); ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <?php //Pagination($page, $dataPerPage, $querypagination); 
    ?>

</body>