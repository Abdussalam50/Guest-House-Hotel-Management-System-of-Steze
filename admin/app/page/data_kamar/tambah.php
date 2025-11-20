<a onclick="history.back()">
    <?php btn_kembali('Kembali'); ?>
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

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Harga Bulanan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="harga_bulanan" id="harga_bulanan" placeholder="Harga Bulanan " required="required">
                            </td>
                        </tr>

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
                                    <option></option><?php
                                                        if (isset($_COOKIE['id_hotel'])) {
                                                            combo_database_v2('data_tipe_kamar', 'id_tipe_kamar', 'tipe_kamar', "select * from data_tipe_kamar where id_hotel = '$id_hotel' ");
                                                        } else {

                                                            combo_database_v2('data_tipe_kamar', 'id_tipe_kamar', 'tipe_kamar', "select * from data_tipe_kamar group by tipe_kamar");
                                                        } ?>
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

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Urutan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <?php

                                $qJumlah = mysql_query("SELECT COUNT(*) as total FROM data_kamar WHERE id_hotel = '$id_hotel'");
                                $dJumlah = mysql_fetch_assoc($qJumlah);
                                $totalKamar = (int)$dJumlah['total'];
                                if ($totalKamar == 0) {
                                    $totalKamar = 100;
                                }
                                ?>

                                <select style="width:50%" name="urutan" id="urutan" class="form-control" required>
                                    <option value="">-- Pilih Urutan --</option>

                                    <?php
                                    for ($i = 1; $i <= $totalKamar; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
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