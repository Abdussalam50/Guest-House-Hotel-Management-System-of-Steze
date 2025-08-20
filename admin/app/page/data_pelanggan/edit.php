<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Pelanggan </strong>
        <hr class="message-inner-separator">
        <p>Silahkan Update Data Pelanggan dibawah ini.</p>
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
                        $sql = mysql_query("SELECT * FROM data_pelanggan where id_pelanggan = '$proses'");
                        $data = mysql_fetch_array($sql);
                        $id = $data['id_pelanggan'];
                        if ($id == "") {
                            $proses = (mysql_real_escape_string($_GET['proses']));
                            $sql = mysql_query("SELECT * FROM data_pelanggan where id_pelanggan = '$proses'");
                            $data = mysql_fetch_array($sql);
                        }
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Pelanggan  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_pelanggan']; ?>	
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>" readonly id="id_pelanggan" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="nama" id="nama" placeholder="Nama " required="required" value="<?php echo ($data['nama']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Identitas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="identitas" id="identitas" placeholder="Identitas" value="<?php echo ($data['identitas']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No identitas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="no_identitas" id="no_identitas" placeholder="No identitas" value="<?php echo ($data['no_identitas']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Alamat <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" name="alamat" id="alamat" placeholder="Alamat" required="required"><?php echo ($data['alamat']); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jenis Kelamin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin " required="required">
                                    <option value="<?php echo ($data['jenis_kelamin']); ?>">- <?php echo ($data['jenis_kelamin']); ?> -</option><?php combo_enum('data_pelanggan', 'jenis_kelamin', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                    <option value="<?php echo ($data['id_hotel']); ?>">- <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$data[id_hotel]'"); ?> -</option><?php combo_database_v2('data_hotel', 'id_hotel', 'nama', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No Hp <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="no_hp" id="no_hp" placeholder="No Hp " required="required" value="<?php echo ($data['no_hp']); ?>">
                            </td>
                        </tr>



                    </tbody>
                </table>
                <div class="container-fluid d-flex justify-content-center">
                    <center>
                        <?php btn_update(' PROSES UPDATE DATA'); ?>
                    </center>
                    <a href="<?php index() ?>?input=hapus&proses=<?php echo  encrypt($data['id_pelanggan']); ?>" class="btn btn-danger ms-5"><i class="fas fa-remove"></i> Hapus Pelanggan</a>
                </div>
            </div>
        </div>
    </form>