
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Hotel </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Hotel  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_metode_pembayaran where id_metode_pembayaran = '$proses'");
                    $data = mysql_fetch_array($sql);
                    $idHotel = decrypt($_COOKIE['id_hotel']);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Hotel  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_metode_pembayaran']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_metode_pembayaran" value="<?php echo $data['id_metode_pembayaran']; ?>" readonly  id="id_metode_pembayaran" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select name="nama_hotel" style='width:50%' id="nama_hotel" class="form-control" required="required">
                                    <option value="<?php echo ($data['id_hotel']); ?>"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='{$data['id_hotel']}'"); ?></option>
                                    
                                </select>
                                
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Metode Pembayaran <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type='varchar' name="metode_pembayaran" id="metode_pembayaran" class="form-control" style='width:50%' placeholder="Metode Pembayaran" value="<?php echo $data['metode_pembayaran']?>" required>


                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Pilih Bank <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <div class="input-group" style='width:50%'>
                                   <input type="hidden" name='id_bank' id='id_bank'style='width:50%' required='required'>
                                   <input type="varchar" name='nama_bank' id='nama_bank' style='width:50%' class="form-control" required='required'>
                                   <button class="btn btn-secondary" onclick='pilih_bank()'><i class="fa fa-dollar"></i> Pilih Bank</button> 
                                </div>
                                
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
    <script>
        function pilih_bank() {
            Swal.fire({
                title: 'Pilih Bank',
                icon:'info',
                width:'700px',
                html:`
<div class="container-fluid p-0">
        <div class="table-responsive">
            <table class="table table-striped">

                <thead>
                    <th>Nama Hotel</th>
                    <th>Rekening</th>
                    <th>Atas Nama</th>
                    <th>Hotel</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        $query =mysql_query("SELECT * FROM data_bank WHERE id_hotel = '$idHotel'") or die(mysql_error());
                        $no = 0;
                        if(mysql_num_rows($query) > 0) {
                            while($data=mysql_fetch_array($query)){
                                $no++;
                                ?>
                            <tr>
                                <td><?php echo ucwords($data['nama_bank']); ?></td>
                                <td><?php echo $data['rekening']; ?></td>
                                <td><?php echo ucwords($data['atas_nama']); ?></td>
                                <td><?php echo ucwords(baca_database("","nama","select * from data_hotel where id_hotel = '$data[id_hotel]'")); ?></td>
                                <td>
                                    <button type="button" id='pilih' class="btn-sm m-0" data-id='<?php echo $data['id_bank']; ?>' data-nama='<?php echo $data['nama_bank']; ?>'  style='width:100px;height:23px;background-color:#D42200;border:none; border-radius:3em;color:#fff'>Pilih</button>
                                </td>
                            </tr>
                    <?php
                            }
                        }else{
                            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>               
                `,
            didOpen:()=>{
                document.querySelectorAll('#pilih').forEach((el)=>{
                    el.addEventListener('click',function(){
                        let id = this.getAttribute('data-id');  
                        let nama = this.getAttribute('data-nama');
                        document.getElementById('id_bank').value = id;
                        document.getElementById('nama_bank').value = nama;
                        Swal.close();
                        Swal.fire({
                            title:'Bank dan Rekening Telah Dipilih',
                            icon:'success',
                            showConfirmButton: false,
                            timer: 1500
                        })
            } ) 
            })
            
        }
    });
       
}
    </script>