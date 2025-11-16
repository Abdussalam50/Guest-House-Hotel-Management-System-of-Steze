<body>
    <?php

if(isset($_COOKIE['operasional'])){
     $akses=baca_database("","value","select * from data_pengaturan_aplikasi where nama_pengaturan='pengaturan_oleh_operasional'");
     if($akses==0){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu hotel\n');
        window.location.href='../../index.php'
    </script>
<?php
     }
}
    $id_hotel = decrypt($_COOKIE['id_hotel']);
    ?>




    <div style="overflow-x:auto;">
        <table <?php tabel(100, '%', 1, 'left'); ?>>
            <tr>

                <th></th>
                <th>Id Hotel </th>
                <th align="left" class="th_border cell">Nama </th>
                <th align="left" class="th_border cell">Alamat </th>
                <th align="left" class="th_border cell">No telepon</th>
                <th align="left" class="th_border cell">Koordinat</th>
                <th align="left" class="th_border cell">Gambar</th>

            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    $querytabel = "SELECT * FROM data_hotel where $berdasarkan like '%$isi%' AND id_hotel = '$id_hotel' LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_hotel where $berdasarkan like '%$isi%' AND id_hotel = '$id_hotel'";
                } else {
                    $querytabel = "SELECT * FROM data_hotel ";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_hotel WHERE id_hotel = '$id_hotel'";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                ?>



                    <td align="center" width="50"><?php $no = (($no + 1));
                                                    echo $no; ?></td>
                    <td align="left">

                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_hotel']); ?>" class='mx-2'>

                            <?php echo $data['id_hotel']; ?>

                        </a>
                    </td>
                    <td align="left">



                        <?php echo $data['nama']; ?>

                    </td>
                    <td align="left"><?php echo $data['alamat']; ?></td>
                    <td align="left"><?php echo $data["no_telepon"]; ?></td>
                    <td align="left"><?php echo frame_maps($data["koordinat"]); ?></a></td>
                    <td align="left"><a target="_blank" href="../../../../admin/upload/<?php echo $data['gambar']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="50" height="30" src="../../../../admin/upload/<?php echo $data['gambar']; ?>"></a></td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php //Pagination($page, $dataPerPage, $querypagination); 
    ?>

</body>