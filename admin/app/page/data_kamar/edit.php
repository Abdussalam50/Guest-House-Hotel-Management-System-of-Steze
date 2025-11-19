<a onclick="history.back()">
    <?php btn_kembali(' Kembali  '); ?>
</a>

<?php $id_hotel = decrypt($_COOKIE['id_hotel']); ?>


<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Kamar </strong>
        <hr class="message-inner-separator">
        <p>Silahkan Update Data Kamar dibawah ini.</p>
    </div>
</div>


<div class="content-box">
    <form action="proses_update.php" enctype="multipart/form-data" method="post">
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
                        $sql = mysql_query("SELECT * FROM data_kamar where id_kamar = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Kamar  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php
                            $id_hotel = decrypt($_COOKIE['id_hotel']);
                            echo $data['id_kamar']; ?>	
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_kamar" value="<?php echo $data['id_kamar']; ?>" readonly id="id_kamar" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Hotel<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                    <option value="">-- --</option>
                                    <option value="<?php echo ($data['id_hotel']); ?>"> <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$data[id_hotel]'"); ?> </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kapasitas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="kapasitas" id="kapasitas" placeholder="Kapasitas " required="required" value="<?php echo ($data['kapasitas']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Harga Harian <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="harga_harian" id="harga_harian" placeholder="Harga Harian " required="required" value="<?php echo ($data['harga_harian']); ?>">
                            </td>
                        </tr>



                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Harga Bulanan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="harga_bulanan" id="harga_bulanan" placeholder="Harga Bulanan " required="required" value="<?php echo ($data['harga_bulanan']); ?>">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="no_kamar" id="no_kamar" placeholder="No Kamar " required="required" value="<?php echo ($data['no_kamar']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Tipe Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_tipe_kamar" id="id_tipe_kamar" placeholder="Id Tipe Kamar " required="required">
                                    <option value="<?php echo ($data['id_tipe_kamar']); ?>">- <?php echo baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$data[id_tipe_kamar]' "); ?> -</option><?php combo_database_v2('data_tipe_kamar', 'id_tipe_kamar', 'tipe_kamar', "select * from data_tipe_kamar where id_hotel = '$id_hotel'"); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Status Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="status_kamar" id="status_kamar" placeholder="Status Kamar " required="required">
                                    <option value="<?php echo ($data['status_kamar']); ?>">- <?php echo ($data['status_kamar']); ?> -</option><?php combo_enum('data_kamar', 'status_kamar', ''); ?>
                                </select>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' PROSES UPDATE DATA'); ?>
                        <a href="index.php?input=hapus&proses=<?= encrypt($proses) ?>" class="btn btn-danger"><i class="fas fa-remove"></i> Hapus Data</a>
                    </center>
                </div>
            </div>
        </div>
    </form>