<a href="<?php index(); ?>">
    <?php btn_kembali('Semua Data Booking'); ?>
</a>


<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Booking </strong>
        <hr class="message-inner-separator">
        <p>Silahkan Update Data Booking dibawah ini.</p>
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
                        $sql = mysql_query("SELECT * FROM data_booking where id_booking = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Booking  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_booking']; ?>	
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_booking" value="<?php echo $data['id_booking']; ?>" readonly id="id_booking" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu Booking <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['waktu_booking']); ?>" class="form-control" style="width:50%" type="text" name="waktu_booking" id="waktu_booking" placeholder="Waktu Booking " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_admin" id="id_admin" placeholder="Id Admin " required="required">
                                    <option value="<?php echo ($data['id_admin']); ?>">- <?php echo baca_database("", "id_hotel", "select * from data_admin where id_admin='$data[id_admin]'"); ?> -</option><?php combo_database_v2('data_admin', 'id_admin', 'id_hotel', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
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
                                <label>No Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_kamar" id="id_kamar" placeholder="Id Kamar " required="required">
                                    <option value="<?php echo ($data['id_kamar']); ?>">- <?php echo baca_database("", "no_kamar", "select * from data_kamar where id_kamar='$data[id_kamar]'"); ?> -</option><?php combo_database_v2('data_kamar', 'id_kamar', 'no_kamar', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu Checkin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['waktu_checkin']); ?>" class="form-control" style="width:50%" type="text" name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Checkin " required="required">
                            </td>
                        </tr>
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
                                <label>No Telepon <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="no_telepon" id="no_telepon" placeholder="No Telepon " required="required" value="<?php echo ($data['no_telepon']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Catatan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" type="text" name="catatan" id="catatan" placeholder="Catatan " required="required"><?php echo ($data['catatan']); ?></textarea>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' PROSES UPDATE DATA'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>