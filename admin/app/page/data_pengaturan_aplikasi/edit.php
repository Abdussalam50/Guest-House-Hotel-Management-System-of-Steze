<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data pengaturan aplikasi </h5>
    <br>
    <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>

    <form action="proses_update.php" enctype="multipart/form-data" method="post" id="update">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <?php
                        if (!isset($_GET['proses'])) {
                                
                        ?>
                            <script>
                                alert("AKSES DITOLAK");
                                location.href = "index.php";
                            </script>
                        <?php
                            die();
                        }
                        $proses = decrypt(mysql_real_escape_string($_GET['proses']));
                        $sql = mysql_query("SELECT * FROM data_pengaturan_aplikasi where id_pengaturan_aplikasi = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id pengaturan aplikasi  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_pengaturan_aplikasi']; ?>	
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_pengaturan_aplikasi" value="<?php echo $data['id_pengaturan_aplikasi']; ?>" readonly id="id_pengaturan_aplikasi" required="required">


                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama pengaturan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="nama_pengaturan" id="nama_pengaturan" placeholder="Nama pengaturan" value="<?php echo ($data['nama_pengaturan']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Value <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" name="value" id="value" placeholder="Value" required="required"><?php echo ($data['value']); ?></textarea>
                                <br>
                                Note : <?php echo ($data['catatan']); ?>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>


        <?php btn_update(' Proses Update  Data '); ?>

    </form>

</div>