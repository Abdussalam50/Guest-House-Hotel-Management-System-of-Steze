<style>
    .swal2-container {
        align-items: flex-start !important;
        /* agar popup muncul di atas, bukan di tengah */
        padding-top: 50px;
    }

    .custom-height {
        height: auto !important;
        max-height: 500px !important;
        overflow-y:scroll

    }

    .my-html {
        height: auto !important;
        max-height:500px !important;
       
    }
</style>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table class="table table-striped">
                    <tbody>
                        <tr>

                            <td colspan="3">
                                <center><img src="../../../data/image/logo/steze-2.png" alt="" srcset="" width='100'>
                                    <br>
                                    <br>
                                    <h2 style="color: #75cc68;"><i class='fas fa-sign-in-alt text-success'></i> Check-in</h2>

                                    <?php echo $alamat; ?>
                                </center>
                                <br>
                            </td>

                        </tr>
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_transaksi", "id_transaksi", "10"); ?>" name="id_transaksi" placeholder="Id Transaksi " id="id_transaksi" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <div class="input-group" style='width:80%'>
                                    <select class="form-control" type="text" name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan " required="required">
                                        <option value="">--Pilih Pelanggan--</option>

                                    </select>
                                    <?php
                                    $idHotel = baca_database("","id_hotel","select * from data_kamar where id_kamar='{$_GET["id"]}'");
                                    $namaHotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'");
                                    ?>

                                    <button class="btn btn-sm btn-secondary" onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")'><i class="fs fa-plus"></i>Tambah Pelanggan</button>


                                </div>

                            </td>

                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kamar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:80%" type="text" name="id_kamar" id="id_kamar" placeholder="Id kamar " required="required">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $idKamar = $_GET['id'];
                                        $noKamar = baca_database('', 'no_kamar', "select * from data_kamar where id_hotel='$id_hotel' and id_kamar='$_GET[id]'");
                                    } else {
                                        $idKamar = '';
                                        $noKamar = '';
                                    }
                                    ?>
                                    <option value="<?php echo $idKamar ?>"><?php echo $noKamar ?></option>
                                    <?php
                                    if (!isset($_GET['id'])) {
                                        combo_database_v2('', 'id_kamar', 'no_kamar', "select * from data_kamar where id_hotel='$id_hotel'");
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu Checkin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="date" name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Checkin " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Bulan<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                          
                                <input class="form-control" style="width:80%" type="varchar" name="jumlah_bulan" id="jumlah_bulan" placeholder="Jumlah Bulan" >
                                
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Hari <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                          
                                    <input class="form-control" style="width:80%" type="varchar" name="jumlah_hari" id="jumlah_hari" placeholder="Jumlah Hari " required="required">
                             
                           
                                
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu Check Out <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="date" name="waktu_check_out" id="waktu_check_out" placeholder="Waktu Check Out " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Dewasa <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:80%" type="varchar" name="jumlah_dewasa" id="jumlah_dewasa" placeholder="Jumlah Dewasa " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Anak Anak <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:80%" type="varchar" name="jumlah_anak_anak" id="jumlah_anak_anak" placeholder="Jumlah Anak Anak " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Metode Transaksi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <div class="input-group" style='width:80%'>
                                    <input type="hidden" name="id_metode_pembayaran" id="id_metode_pembayaran">
                                  <input type="text" class="form-control" name="metode_transaksi" id="metode_transaksi" placeholder="--Pilih Metode Transaksi--" required="required">  
                                    <button class="btn btn-secondary" onclick='pilih_metode_transaksi()'><i class="fa fa-dollar"></i> Pilih Metode Transaksi</button>
                                </div>
                                
                                <!-- <select name="metode_transaksi" id="metode_transaksi" class="form-control" style='width:80%'>
                                    <option value="">--Pilih Metode Transaksi--</option>

                                </select> -->

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No Rekening <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="varchar" name="no_rekening" id="no_rekening" placeholder="No Rekening " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Total Harga (Rp) <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:80%" type="varchar" name="harga" id="harga" placeholder="Harga " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Discount (%) <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:80%" type="int" name="discount" id="discount" placeholder="Discount " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Biaya Tambahan Checkin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <div class=""  style="width:80%">
                                    <input  class="form-control" type="varchar" name="tambahan" id="tambahan" placeholder="Biaya Tambahan " value='0' required="required">
                                    <p class="text-start" id='tambahan_nom'></p>
                                    <textarea name="deskripsi" id="deskripsi" class='form-control'>-</textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Total Harga (Rp) <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td  style="font-size: 1.2em;">
                                <input type="hidden" name="" id='adder'>
                                <input type="hidden" name="harga" id='harga_input'>
                                <p class="text-start" id='harga'>Rp 0</p>
                                
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nominal Bayar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td >
                                <input  class="form-control" style="width:80%" type="varchar" name="nominal_bayar" id="nominal_bayar" value="0" required="required">
                                <p class="text-start" id='nominal'></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Kembalian <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td >
                                <input type="hidden" name="kembalian" id='kembalian' value='0'>
                                <p class="text-start" id='kembalian_value' style='font-size:1.5em'>Rp 0</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Sisa Pembayaran <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td >
                                <input type="hidden" name="sisa" id='sisa' value='0'>
                                <p class="text-start" id='sisa_value' style='font-size:1.5em'>Rp 0</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Status Transaksi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:80%" name="status" id="status" placeholder="Status " required="required">
                                    <option value="">--Pilih Status Transaksi--</option>
                                    
                                    <option value="Belum Lunas">Belum Lunas</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                                <input type="hidden" name="id_admin" value='<?php 
                                    $username=decrypt($_COOKIE['jenenge']);
                                    $id_admin=baca_database("","id_admin","select * from data_admin where username='$username'");
                                    echo $id_admin;
                                ?>'>
                                <input type="hidden" name="id_hotel" value='<?php echo decrypt($_COOKIE['id_hotel'])?>'>
                            </td>
                        </tr>



                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <button class="btn btn-danger"><i class="fas fa-check"></i> Proses Checkin</button>
                        <!-- <?php 
                        // btn_simpan(' PROSES CHECKIN'); 
                        ?> -->
                    </center>
                </div>
            </div>
        </div>
    </form>
    <?php
    $harga_harian = baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$_GET[id]'");
    $harga_bulanan = baca_database("", "harga_bulanan", "select * from data_kamar where id_kamar='$_GET[id]'");

    ?>
    <script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js">

    </script>
    <script src='./js/main.js'></script>

    <script>
    
    document.addEventListener('DOMContentLoaded',()=>{
        const time_checkin = document.getElementById('waktu_checkin');
        const time_checkout = document.getElementById('waktu_check_out');
        const jumlah_hari= document.getElementById('jumlah_hari');
        const jumlah_bulan= document.getElementById('jumlah_bulan');
        const harga = document.getElementById('harga');
        const harga_input = document.getElementById('harga_input');
        const discount = document.getElementById('discount');
        const biaya_tambahan=document.getElementById('tambahan');
        const adder=document.getElementById('adder');
        function format_rupiah(value){
            return new Intl.NumberFormat('id-ID',{
                style:'currency',
                currency:'IDR',
                minimumFractionDigits:0
            }).format(value);
        }
        jumlah_bulan.addEventListener('change',()=>{
            var val_jumlah_bulan=jumlah_bulan.value;
            var  checkin=new Date(time_checkin.value);
            var checkout=new Date(checkin.getTime()+val_jumlah_bulan*30*24*60*60*1000);
            jumlah_hari.value=val_jumlah_bulan*30;
            time_checkout.value=checkout.toISOString().split('T')[0];
            var harga_bulanan=<?php echo intval($harga_bulanan)?>;
            harga.innerHTML=format_rupiah(val_jumlah_bulan*harga_bulanan);
            harga_input.value=val_jumlah_bulan*harga_bulanan;
            adder.value=val_jumlah_bulan*harga_bulanan;
        });
        jumlah_hari.addEventListener('change', () => {
            var val_jumlah_hari = jumlah_hari.value;
            var checkin = new Date(time_checkin.value);
            var checkout=new Date(checkin.getTime()+val_jumlah_hari*24*60*60*1000);
            time_checkout.value = checkout.toISOString().split('T')[0];
            var day=val_jumlah_hari;

            if (day < 30 || day > 30) {
                harga.innerHTML = format_rupiah(day * <?php echo intval($harga_harian) ?>);
                harga_input.value=day * <?php echo intval($harga_harian)?>;
                adder.value=day * <?php echo intval($harga_harian)?>;
            } else if (day == 30) {
                harga.innerHTML = format_rupiah(<?php echo intval($harga_bulanan) ?>);
                harga_input.value= <?php echo intval($harga_bulanan)?>;
                adder.value=<?php echo intval($harga_bulanan)?>;
            }
        
        });
        time_checkout.addEventListener('change',function (){

            var checkin=new Date(time_checkin.value);
            var checkout=new Date(time_checkout.value);
            var selisih=Math.floor((checkout-checkin)/(24*60*60*1000));
            jumlah_hari.value=selisih;
            if(selisih<30){
                harga.innerHTML=format_rupiah(selisih*<?php echo intval($harga_harian)?>);
                harga_input.value=selisih*<?php echo intval($harga_harian)?>;
                adder.value=selisih*<?php echo intval($harga_harian)?>;
            }else if(selisih%30==0){
                var jumlah_bulan=selisih/30;
                harga.innerHTML=format_rupiah(jumlah_bulan*<?php echo intval($harga_bulanan)?>);
                harga_input.value=jumlah_bulan*<?php echo intval($harga_bulanan)?>;
                adder.value=jumlah_bulan*<?php echo intval($harga_bulanan)?>;
            }
            console.log(time_checkout);

        });

        time_checkin.addEventListener('change',function(){
            var checkin=new Date(time_checkin.value);
            if(jumlah_hari!==null){
                val_jumlah_hari=jumlah_hari.value;

            }else if(jumlah_bulan!==null||jumlah_bulan==0){
                val_jumlah_hari=jumlah_bulan.value*30;
            }
            var checkout_time=new Date(checkin.getTime()+val_jumlah_hari*24*60*60*1000);
            time_checkout.value=checkout_time.toISOString().split('T')[0];
            if(val_jumlah_hari<30){
                harga.innerHTML=format_rupiah(val_jumlah_hari*<?php echo intval($harga_harian)?>);
                harga_input.value=val_jumlah_hari*<?php echo intval($harga_harian)?>;
                adder.value=val_jumlah_hari*<?php echo intval($harga_harian)?>;
            }else if(val_jumlah_hari>=30 && val_jumlah_hari%30==0){
                var jumlah_bulan=Math.floor(val_jumlah_hari/30);
                harga.innerHTML=format_rupiah(jumlah_bulan*<?php echo intval($harga_bulanan)?>);
                harga_input.value=jumlah_bulan*<?php echo intval($harga_bulanan)?>;
                adder.value=jumlah_bulan*<?php echo intval($harga_bulanan)?>;
            }
        })

        biaya_tambahan.addEventListener('input',function(){
           
            var val_tambahan=biaya_tambahan.value;
            document.getElementById('tambahan_nom').innerHTML = format_rupiah(val_tambahan);
            var value_discount=Number(discount.value);
            var total = Number(adder.value); // pastikan jadi angka
            var grand_total=Math.ceil(total-(value_discount/100)*(total) + Number(val_tambahan)); // tambah angka tambahan

            harga_input.value = grand_total; // simpan angka mentah untuk form
            harga.innerHTML = format_rupiah(grand_total); // tampilkan dalam format rupiah
        })
        discount.addEventListener('change', () => {
            var val_discount = discount.value;
            var potongan = (val_discount / 100) * harga_input.value;
            var harga_final = harga_input.value - potongan;
            harga_input.value = harga_final;
            harga.innerHTML=format_rupiah(harga_final);
        });
        const bayar=document.getElementById('nominal_bayar');
        const bayar1=document.getElementById('nominal');
        const kembalian=document.getElementById('kembalian');
        const kembalian_nom=document.getElementById('kembalian_value');
        const sisa=document.getElementById('sisa');
        const sisa_value=document.getElementById('sisa_value');
bayar.addEventListener('input', function() {
    var bayarVal = Number(bayar.value) || 0;  // pastikan angka
    var totalVal = Number(harga_input.value) || 0;

    bayar1.innerHTML = format_rupiah(bayarVal);

    if (bayarVal >= totalVal) {
        // Hitung kembalian
        var kembalianVal = bayarVal - totalVal;
        kembalian.value = kembalianVal;
        kembalian_nom.innerHTML = format_rupiah(kembalianVal);

        // Sisa = 0 kalau bayar cukup atau lebih
        sisa.value = 0;
        sisa_value.innerHTML = 'Rp 0';
    } 
    else if (bayarVal === 0) {
        // Kalau belum bayar sama sekali
        kembalian.value = 0;
        kembalian_nom.innerHTML = 'Rp 0';

        sisa.value = totalVal;
        sisa_value.innerHTML = format_rupiah(totalVal);
    } 
    else {
        // Kalau bayar kurang
        kembalian.value = 0;
        kembalian_nom.innerHTML = 'Rp 0';

        var sisaBayar = totalVal - bayarVal;
        sisa.value = sisaBayar;
        sisa_value.innerHTML = format_rupiah(sisaBayar);
    }

    console.log(totalVal);
});
 
    });
        function pilih_metode_transaksi() {
            Swal.fire({
                title:'Pilih Metode Transaksi',
                icon:'info',
                width:'850px',
                html:`
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Metode Transaksi</th>
                    <th>Bank</th>
                    <th>Rekening</th>
                    <th>Atas Nama</th>
                    <th>Hotel</th>
                    <th>Action</th>
                    
                </thead>
                <tbody>
                    <?php
                        $query_metode_bayar=mysql_query("SELECT * FROM data_metode_pembayaran LEFT JOIN data_bank ON data_metode_pembayaran.id_bank = data_bank.id_bank WHERE data_bank.id_hotel = '$idHotel'") or die(mysql_error());
                        $no = 0;
                        if(mysql_num_rows($query_metode_bayar) > 0) {
                            while($data=mysql_fetch_array($query_metode_bayar)){
                                $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo ucwords($data['metode_pembayaran']); ?></td>
                                    <td><?php echo ucwords($data['nama_bank']); ?></td>
                                    <td><?php echo $data['rekening']; ?></td>
                                    <td><?php echo ucwords($data['atas_nama']); ?></td>
                                    <td><?php echo baca_database("","nama","select * from data_hotel where id_hotel='{$data['id_hotel']}'"); ?></td>
                                    <td><button style='background-color:#6c757d;border-radius:10px;color:#fff;width:120px; height:30px;border:none;' id='pil_metode' data-id='<?php echo $data['id_metode_pembayaran']; ?>' data-name='<?php echo ucwords($data['metode_pembayaran']); ?>' data-rekening='<?php echo $data['rekening']?>'>Pilih</button></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div> `,
    
        didOpen:()=>{
            const pilih = document.querySelectorAll('#pil_metode');
            pilih.forEach((option)=>{
                option.addEventListener('click',()=>{
                    const id=option.getAttribute('data-id');
                    const name=option.getAttribute('data-name');
                    const rekening=option.getAttribute('data-rekening');
                    document.getElementById('id_metode_pembayaran').value = id;
                    document.getElementById('metode_transaksi').value = name;
                    document.getElementById('no_rekening').value=rekening;
                    Swal.close();
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Metode pembayaran berhasil dipilih',
                        icon: 'success',
                        duration:2000
                    })
                })
            })
        }
            })
        }


        document.getElementById('simpan_data').addEventListener('click',function(){
            document.getElementById('formini').submit();
        })
    
    </script>
