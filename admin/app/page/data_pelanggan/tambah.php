<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KEHALAMAN SEBELUMNYA'); ?>
</a>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Pelanggan </strong>
        <hr class="message-inner-separator">
        <p>Silahkan input Data Pelanggan dibawah ini.</p>
    </div>
</div>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php
                        $id_hotel = decrypt($_COOKIE['id_hotel']);
                        tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id Pelanggan  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_pelanggan", "id_pelanggan", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" name="id_admin" value="<?php
                           $username = decrypt($_COOKIE['jenenge']);
                            $id_admin = baca_database("", "id_admin", "select * from data_admin where username='$username'");
                            if($id_admin==null){
                                $id_admin = baca_database("", "id_pengelola", "select * from data_pengelola where username='$username'");
                            }
                            echo $id_admin;
                        ?>">
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_pelanggan", "id_pelanggan", "10"); ?>" name="id_pelanggan" placeholder="Id Pelanggan " id="id_pelanggan" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="nama" id="nama" placeholder="Nama " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Identitas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="identitas" id="identitas" placeholder="Identitas" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No identitas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="no_identitas" id="no_identitas" placeholder="No identitas" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Alamat <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" type="text" name="alamat" id="alamat" placeholder="Alamat" required="required"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jenis kelamin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis kelamin" required="required">
                                    <option value=''></option>
                                    <?php combo_enum("data_pelanggan", "jenis_kelamin", ""); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>

                                <?php
                                if ($_COOKIE['id_hotel'] == "") {
                                ?>
                                    <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                        <option></option><?php combo_database_v2('', 'id_hotel', 'nama', "select * from data_hotel"); ?>
                                    </select>
                                <?php
                                } else {
                                ?>
                                    <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                        <option></option><?php combo_database_v2('', 'id_hotel', 'nama', "select * from data_hotel where id_hotel='$id_hotel'"); ?>
                                    </select>
                                <?php

                                }
                                ?>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No Hp <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="no_hp" id="no_hp" placeholder="No Hp " required="required">
                            </td>
                        </tr>




                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_simpan(' PROSES SIMPAN DATA'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>