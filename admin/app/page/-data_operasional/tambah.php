<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KEHALAMAN SEBELUMNYA'); ?>
</a>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Operasional </strong>
        <hr class="message-inner-separator">
        <p>Silahkan input Data Operasional dibawah ini.</p>
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
                                <label >Id Operasional  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_operasional", "id_operasional", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_operasional", "id_operasional", "10"); ?>" name="id_operasional" placeholder="Id Operasional " id="id_operasional" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Hotel<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <?php
                                if ($_COOKIE['id_hotel'] == "") {
                                ?>
                                    <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                        <?php combo_database_v2('', 'id_hotel', 'nama', "select * from data_hotel"); ?>
                                    </select>
                                <?php
                                } else {
                                ?>
                                    <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel ">
                                        <option value='<?php echo $id_hotel ?>'><?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$id_hotel'") ?></option>
                                    </select>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>

                                <input class='form-control' type="datetime-local" min='<?php echo date('Y-m-d') ?>' name="tanggal" id="tanggal" required style='width:50%'>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kategori Operasional <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="operasional" id="operasional" placeholder="Operasional " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Item <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="jumlah" id="jumlah" placeholder="Jumlah " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Total Biaya <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="biaya" id="biaya" placeholder="Biaya " required="required">
                            </td>
                            <?php
                            $admin = decrypt($_COOKIE['jenenge']);
                            $id_admin = baca_database("", "id_admin", "select * from data_admin where username='$admin'");
                            if($id_admin==null){
                                $id_admin=baca_database("", "id_pengelola", "select * from data_pengelola where username='$admin'");
                            }
                            ?>
                            <input type="hidden" name="id_admin" value="<?php echo $id_admin ?>">
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Deskripsi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea name="keperluan" id="" class='form-control' style='width:50%'></textarea>
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