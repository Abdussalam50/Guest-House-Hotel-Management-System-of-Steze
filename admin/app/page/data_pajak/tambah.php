
<div class="content-box">
<h5><i class="fa fa-database"></i> Tambah Data pajak </h5>
<br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id pajak  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_pajak", "id_pajak", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_pajak", "id_pajak", "10"); ?>" name="id_pajak" placeholder="Id pajak" id="id_pajak" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Waktu <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="datetime-local" name="waktu" id="waktu" placeholder="Waktu" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Id pelanggan <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_transaksi" id="id_transaksi" placeholder="Id transaksi" required="required">
            <option value=''></option>  
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
        <input class="form-control" style="width:50%" type="text" name="jenis_pajak" id="jenis_pajak" placeholder="Jenis pajak" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Persentase pajak <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="persentase_pajak" id="persentase_pajak" placeholder="Persentase pajak" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Pajak <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="pajak" id="pajak" placeholder="Pajak" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_hotel" id="id_hotel" placeholder="Id hotel" required="required">
            <option value=''></option>  
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
 <?php btn_simpan(' Proses Simpan Data '); ?>
</div>
    