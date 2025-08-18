
<div class="content-box">
<h5><i class="fa fa-database"></i> Tambah Data pemasukan </h5>
<br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id pemasukan  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_pemasukan", "id_pemasukan", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_pemasukan", "id_pemasukan", "10"); ?>" name="id_pemasukan" placeholder="Id pemasukan" id="id_pemasukan" required="required">


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
        <label>Jumlah bayar <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah bayar" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Metode <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="metode" id="metode" placeholder="Metode" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama bank <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama_bank" id="nama_bank" placeholder="Nama bank" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Rekening <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="rekening" id="rekening" placeholder="Rekening" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Atas nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="atas_nama" id="atas_nama" placeholder="Atas nama" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Keterangan <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <textarea class="form-control" style="width:50%" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required="required"></textarea>
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
    