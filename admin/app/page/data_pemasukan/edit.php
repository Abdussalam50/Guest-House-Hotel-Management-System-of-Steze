<div class="content-box">
<h5><i class="fa fa-database"></i> Edit Data pemasukan </h5>
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
                    $sql = mysql_query("SELECT * FROM data_pemasukan where id_pemasukan = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id pemasukan  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_pemasukan']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_pemasukan" value="<?php echo $data['id_pemasukan']; ?>" readonly  id="id_pemasukan" required="required">

                          
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
        <label>Jumlah bayar <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah bayar" value="<?php echo ($data['jumlah_bayar']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Metode <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="metode" id="metode" placeholder="Metode" value="<?php echo ($data['metode']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama bank <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama_bank" id="nama_bank" placeholder="Nama bank" value="<?php echo ($data['nama_bank']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Rekening <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="rekening" id="rekening" placeholder="Rekening" value="<?php echo ($data['rekening']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Atas nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="atas_nama" id="atas_nama" placeholder="Atas nama" value="<?php echo ($data['atas_nama']); ?>" required="required">
    </td>
</tr>
                                              <tr>
    <td width="25%" class="leftrowcms">
        <label>Keterangan <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <textarea class="form-control" style="width:50%" name="keterangan" id="keterangan" placeholder="Keterangan" required="required"><?php echo ($data['keterangan']); ?></textarea>
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
