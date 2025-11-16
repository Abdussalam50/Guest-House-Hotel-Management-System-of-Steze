
    <div style='display:flex; justify-content:flex-end; gap:20px; padding-bottom:30px;margin-top:-59px'>

        <a href="<?php index()?>?input=tambah" class="btn btn-sm btn-secondary "><i class="fas fa-plus"></i> Tambah Hotel</a>
        <button class='btn btn-sm btn-danger'type="button"><i class="fas fa-search"></i>Pencarian</button>
    </div>

    <div style="overflow-x:auto;">
        <table <?php tabel(100, '%', 1, 'left'); ?>>
            <tr style='background-color:#eaeaea'>
                
                <th>No</th>
                <!--h <th>Id Hotel </th> h-->
                <th align="center" class="th_border cell">Nama </th>
                <th align="center" class="th_border cell">Alamat </th>
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
                    <tr class="event2">
<!-- 
                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_hotel']); ?>" class='mx-2'>
                                            <i class="fa fa-info text-primary"></i> Detail
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_hotel']); ?>" class='mx-2'>
                                            <i class="fa fa-edit text-primary"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_hotel']); ?>" class='mx-2'>
                                            <i class="fa fa-remove text-primary"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td> -->

                        <td align="center" width="50"><?php $no = (($no + 1));
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data['id_hotel']; ?></td> h-->
                        <td align="center"><a href="<?php index()?>?input=detail&proses=<?php echo encrypt($data['id_hotel'])?>"><?php echo $data['nama']; ?></a></td>
                        <td align="center"><?php echo $data['alamat']; ?></td>
                        <td align="left"><?php echo $data["no_telepon"]; ?></td>
                        <td align="left"><?php echo frame_maps($data["koordinat"]); ?></a></td>
                        <td align="left"><a target="_blank" href="../../../../admin/upload/<?php echo $data['gambar']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="50" height="30" src="../../../../admin/upload/<?php echo $data['gambar']; ?>"></a></td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

