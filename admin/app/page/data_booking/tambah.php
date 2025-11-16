<a href="<?php index(); ?>">
    <?php btn_kembali('Semua Data Booking'); ?>
</a>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Booking </strong>
        <hr class="message-inner-separator">
        <p>Silahkan input Data Booking dibawah ini.</p>
    </div>
</div>

<?php $id_kamar = $_GET['id_kamar']; ?>
<?php $nama_admin = decrypt($_COOKIE['jenenge']);
$id_admin = baca_database("", "id_admin", "select * from data_admin where username='$nama_admin'")
?>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id Booking  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_booking", "id_booking", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_booking", "id_booking", "10"); ?>" name="id_booking" placeholder="Id Booking " id="id_booking" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu Booking <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="datetime-local" name="waktu_booking" id="waktu_booking" placeholder="Waktu Booking " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>ID Admin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_admin" id="id_admin" placeholder="Id Admin " required="required">
                                    <option><?php echo $id_admin; ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>ID Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                    <?php combo_database_v2('data_hotel', 'id_hotel', 'id_hotel', "select * from data_kamar where id_kamar='$id_kamar'"); ?>
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
                                    <?php combo_database_v2('data_kamar', 'id_kamar', 'no_kamar', "select * from data_kamar where id_kamar='$id_kamar'"); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu Checkin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="datetime-local" name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Checkin " required="required">
                            </td>
                        </tr>
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
                                <label>No Telepon <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="no_telepon" id="no_telepon" placeholder="No Telepon " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Catatan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" type="text" name="catatan" id="catatan" placeholder="Catatan " required="required"></textarea>
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