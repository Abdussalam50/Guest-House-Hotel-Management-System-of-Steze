<body>
    <!-- <div style='display:flex; justify-content:right;margin-bottom:10px'>
        <a href="index.php?input=tambah"  class="btn btn-danger btn-sm"><i class="fas fa-plus"></i> Input Pengelola</a>
    </div> -->
    <?php
if(isset($_COOKIE['operasional'])){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu pengelola\nTerima Kasih');
        window.location.href='../../index.php'
    </script>
<?php
}
?>

    <div style="overflow-x:auto;">

        <table <?php tabel(100, "%", 1, "left"); ?>>
            <tr>

                <th></th>
                <!--h <th>Id pengelola</th> -->
                <th align="left" class="th_border cell">Nama</th>
                <th align="left" class="th_border cell">Username</th>
                <th align="left" class="th_border cell">Password</th>
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
                    $querytabel = "SELECT * FROM data_pengelola where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_pengelola where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_pengelola  LIMIT $startRow ,$dataPerPage";
                    $querypagination =
                        "SELECT COUNT(*) AS total FROM data_pengelola";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) { ?>
                    <tr class="event2">


                        <td align="center" width="50"><?php $no = $no + 1;
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data["id_pengelola"]; ?></td> h-->
                        <td align="left">

                            <a href="<?php index(); ?>?input=edit&proses=<?= encrypt(
                                                                                $data["id_pengelola"]
                                                                            ) ?>">
                                <?php echo $data["nama"]; ?>
                            </a>

                        </td>
                        <td align="left"><?php echo $data["username"]; ?></td>
                        <td align="left"><?php echo $data["password"]; ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <?php //Pagination($page, $dataPerPage, $querypagination); 
    ?>

</body>