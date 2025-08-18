
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Transaksi </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Transaksi  dibawah ini.</p>
        </div>
    </div>


<div class="content-box">
    <form action="proses_update.php"  enctype="multipart/form-data"  method="post">
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
                    $sql = mysql_query("SELECT * FROM data_transaksi where id_transaksi = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Transaksi  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php
                           $id_hotel=decrypt($_COOKIE['id_hotel']);
                           echo $data['id_transaksi']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>" readonly  id="id_transaksi" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan " required="required">
                                <option value="<?php echo ($data['id_pelanggan']); ?>">- <?php echo baca_database("","nama","select * from data_pelanggan where id_pelanggan='$data[id_pelanggan] and id_hotel='$id_hotel'"); ?> -</option><?php combo_database_v2('data_pelanggan','id_pelanggan','nama',''); ?>
                                </select>
                            </td>
                        </tr>

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_kamar" id="id_kamar" placeholder="Id Kamar " required="required">
                                <option value="<?php echo ($data['id_kamar']); ?>">- <?php echo baca_database("","no_kamar","select * from data_kamar where id_hotel='$id_hotel' and id_kamar='$data[id_kamar]'"); ?> -</option><?php combo_database_v2('','id_kamar','no_kamar',"select * from data_kamar where id_hotel='$id_hotel'"); ?>
                                </select>
                            </td>
                        </tr>
  
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Waktu Check In  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['waktu_checkin']); ?>" class="form-control" style="width:50%" type="text" name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Checkin " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Waktu Check Out  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['waktu_check_out']); ?>" class="form-control" style="width:50%" type="text" name="waktu_check_out" id="waktu_check_out" placeholder="Waktu Check Out " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >No Rekening  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="no_rekening" id="no_rekening" placeholder="No Rekening " required="required" value="<?php echo ($data['no_rekening']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Harga  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="harga" id="harga" placeholder="Harga " required="required" value="<?php echo ($data['harga']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Metode Transaksi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select name="metode_transaksi" id="metode_transaksi" style='width:80%' class="form-control">
                                    <option value="">--Pilih Metode Pembayaran--</option>
                                    <?php
                                    combo_database_v2("data_metode_pembayaran","id_metode_pembayaran","metode_pembayaran","");
                                    ?>
                                </select>
                                
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jumlah Dewasa  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="jumlah_dewasa" id="jumlah_dewasa" placeholder="Jumlah Dewasa " required="required" value="<?php echo ($data['jumlah_dewasa']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jumlah Anak Anak  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="jumlah_anak_anak" id="jumlah_anak_anak" placeholder="Jumlah Anak Anak " required="required" value="<?php echo ($data['jumlah_anak_anak']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Discount  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="discount" id="discount" placeholder="Discount " required="required" value="<?php echo ($data['discount']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Status Transaksi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select  class="form-control" style="width:50%"  name="status" id="status" placeholder="Status Transaksi" required="required" value="">
                                <option value="<?php echo ($data['status_transaksi']); ?>"><?php echo ($data['status_transaksi']); ?></option>
                                <?php combo_enum("data_transaksi","status_transaksi","");?>
                                </select>
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
