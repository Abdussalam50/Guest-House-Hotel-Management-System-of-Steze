<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KEHALAMAN SEBELUMNYA'); ?>
</a>


<?php $id_hotel = decrypt($_COOKIE['id_hotel']); ?>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Kamar </strong>
        <hr class="message-inner-separator">
        <p>Silahkan input Data Kamar dibawah ini.</p>
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
                                <label >Id Kamar  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_kamar", "id_kamar", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_kamar", "id_kamar", "10"); ?>" name="id_kamar" placeholder="Id Kamar " id="id_kamar" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                    <option value="">-- --</option>
                                    <option value='<?php echo $id_hotel ?>'><?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$id_hotel'") ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kapasitas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="kapasitas" id="kapasitas" placeholder="Kapasitas (orang)" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Harga Harian <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="harga_harian" id="harga_harian" placeholder="Harga Harian " required="required">
                            </td>
                        </tr>
                        <?php if (pengaturan_aplikasi('transaksi_bulanan') == "aktif") { ?>
                            <tr>
                                <td width="25%" class="leftrowcms">
                                    <label>Harga Bulanan <span class="highlight"></span></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                    <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="harga_bulanan" id="harga_bulanan" placeholder="Harga Bulanan " required="required">
                                </td>
                            </tr>
                        <?php } else { ?>
                            <input value="0" onkeypress='return a(event)' class="form-control" style="width:50%" type="hidden" name="harga_bulanan" id="harga_bulanan" placeholder="Harga Bulanan " required="required">

                        <?php } ?>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="no_kamar" id="no_kamar" placeholder="No Kamar " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Tipe Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_tipe_kamar" id="id_tipe_kamar" placeholder="Id Tipe Kamar " required="required">
                                    <option></option><?php combo_database_v2('data_tipe_kamar', 'id_tipe_kamar', 'tipe_kamar', "select * from data_tipe_kamar where id_hotel = '$id_hotel'"); ?>
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
                                    <option></option><?php combo_enum('data_kamar', 'status_kamar', ''); ?>
                                </select>
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