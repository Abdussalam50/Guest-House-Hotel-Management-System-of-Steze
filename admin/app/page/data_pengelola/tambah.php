
<div class="content-box">
<h5><i class="fa fa-database"></i> Tambah Data pengelola </h5>
<br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id pengelola  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_pengelola", "id_pengelola", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_pengelola", "id_pengelola", "10"); ?>" name="id_pengelola" placeholder="Id pengelola" id="id_pengelola" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama" id="nama" placeholder="Nama" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Username <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="username" id="username" placeholder="Username" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Password <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="password" id="password" placeholder="Password" required="required">
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
    