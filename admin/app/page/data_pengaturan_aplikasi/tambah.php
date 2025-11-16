
<div class="content-box">
<h5><i class="fa fa-database"></i> Tambah Data pengaturan aplikasi </h5>
<br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id pengaturan aplikasi  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_pengaturan_aplikasi", "id_pengaturan_aplikasi", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_pengaturan_aplikasi", "id_pengaturan_aplikasi", "10"); ?>" name="id_pengaturan_aplikasi" placeholder="Id pengaturan aplikasi" id="id_pengaturan_aplikasi" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama pengaturan <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama_pengaturan" id="nama_pengaturan" placeholder="Nama pengaturan" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Value <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <textarea class="form-control" style="width:50%" type="text" name="value" id="value" placeholder="Value" required="required"></textarea>
    </td>
</tr>
                        
                    </tbody>
                </table>
               </div>
			</div>
             <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
 <?php btn_simpan(' Proses Simpan Data '); ?>
		</form>  

</div>
    