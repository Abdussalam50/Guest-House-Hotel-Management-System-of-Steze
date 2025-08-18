
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Bank </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Bank  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_bank where id_bank = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Hotel  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_bank']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_bank" value="<?php echo $data['id_bank']; ?>" readonly  id="id_bank" required="required">
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Bank <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type='varchar' name="nama_bank" id="nama_bank" class="form-control" style='width:50%' placeholder="Nama Bank" value="<?php echo $data['nama_bank']; ?>" required>


                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Rekening <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="varchar" name='rekening' style='width:50%' class="form-control" required='required' value="<?php echo $data['rekening']?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Atas Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="varchar" name='atas_nama' style='width:50%' class="form-control" required='required' value="<?php echo $data['atas_nama']?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select name="nama_hotel" style='width:50%' id="nama_hotel" class="form-control" required="required" value='<?php echo ($data['id_hotel']); ?>'>
                                    <option value="<?php echo ($data['id_hotel']); ?>"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='{$data['id_hotel']}'"); ?></option>
                                    
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
