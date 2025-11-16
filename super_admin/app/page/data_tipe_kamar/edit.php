
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Tipe Kamar </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Tipe Kamar  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_tipe_kamar where id_tipe_kamar = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Tipe Kamar  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php 
                           $id_hotel=decrypt($_COOKIE['id_hotel']);
                           echo $data['id_tipe_kamar']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_tipe_kamar" value="<?php echo $data['id_tipe_kamar']; ?>" readonly  id="id_tipe_kamar" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tipe Kamar  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="tipe_kamar" id="tipe_kamar" placeholder="Tipe Kamar " required="required" value="<?php echo ($data['tipe_kamar']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama  Hotel<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                <option value="<?php echo ($data['id_hotel']); ?>">- <?php echo baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'"); ?> -</option><?php combo_database_v2('','id_hotel','nama',"select * from data_hotel where id_hotel='$id_hotel'"); ?>
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
