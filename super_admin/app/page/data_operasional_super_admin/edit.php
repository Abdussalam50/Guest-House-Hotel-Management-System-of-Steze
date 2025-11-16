
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Operasional </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Operasional  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_operasional where id_operasional = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Operasional  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php 
                           $id_hotel=decrypt($_COOKIE['id_hotel']);
                           echo $data['id_operasional']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_operasional" value="<?php echo $data['id_operasional']; ?>" readonly  id="id_operasional" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama  Hotel<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id Hotel " required="required">
                                <option value="<?php echo ($data['id_hotel']); ?>">- <?php echo baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'"); ?> -</option><?php combo_database_v2('data_hotel','id_hotel','nama',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tanggal  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="date" name="tanggal" id="tanggal" placeholder="tanggal " required="required" value="<?php echo ($data['tanggal']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Operasional  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="operasional" id="operasional" placeholder="Operasional " required="required" value="<?php echo ($data['operasional']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jumlah  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="jumlah" id="jumlah" placeholder="Jumlah " required="required" value="<?php echo ($data['jumlah']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Biaya  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="biaya" id="biaya" placeholder="Biaya " required="required" value="<?php echo ($data['biaya']); ?>">
                            </td>
                            <input type="hidden" name="id_admin" value='<?php echo ($data['id_admin']); ?>'>
                        </tr>


                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' PROSES UPDATE DATA'); ?>
                        <a href="<?php index()?>?input=hapus&proses=<?php echo encrypt($data['id_operasional']); ?>" class='btn btn-danger'><i class="fa fa-remove"></i> Hapus Data</a>
                    </center>
                </div>		
            </div>
        </div>
    </form>
