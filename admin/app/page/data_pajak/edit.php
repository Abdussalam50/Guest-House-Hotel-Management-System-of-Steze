<div class="content-box">
<h5><i class="fa fa-database"></i> Edit Data pajak </h5>
<br>
    <form action="proses_update.php"  enctype="multipart/form-data"  method="post" id="update">
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
                    $sql = mysql_query("SELECT * FROM data_pajak where id_pajak = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id pajak  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_pajak']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_pajak" value="<?php echo $data['id_pajak']; ?>" readonly  id="id_pajak" required="required">

                          
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Waktu <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="datetime-local" name="waktu" id="waktu" placeholder="Waktu" value="<?php echo ($data['waktu']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Id pelanggan <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_transaksi" id="id_transaksi" placeholder="Id transaksi" required="required">
          <option value="<?php echo ($data['id_transaksi']); ?>">- <?php echo baca_database("","Id pelanggan","select * from data_transaksi where id_transaksi='$data[id_transaksi]'"); ?> -</option>
          <?php combo_database_v2("data_transaksi", "id_transaksi", "id_pelanggan", ""); ?>
        </select>
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Jenis pajak <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="jenis_pajak" id="jenis_pajak" placeholder="Jenis pajak" value="<?php echo ($data['jenis_pajak']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Persentase pajak <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="persentase_pajak" id="persentase_pajak" placeholder="Persentase pajak" value="<?php echo ($data['persentase_pajak']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Pajak <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="pajak" id="pajak" placeholder="Pajak" value="<?php echo ($data['pajak']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id hotel" required="required">
          <option value="<?php echo ($data['id_hotel']); ?>">- <?php echo baca_database("","Nama","select * from data_hotel where id_hotel='$data[id_hotel]'"); ?> -</option>
          <?php combo_database_v2("data_hotel", "id_hotel", "nama", ""); ?>
        </select>
    </td>
</tr>
                                              

                     </tbody>
                </table>
               </div>
			</div>
		</form>  
 <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
 <?php btn_update(' Proses Update  Data '); ?>
</div>
