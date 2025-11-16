<div class="container-fluid d-flex justify-content-end p-0 " style='margin-top:-50px'>
    <button type="button" class='btn btn-danger rounded btn-sm' onclick='search()'><i class="fas-fa-search"></i> Pencarian</button>
</div>
<div class="container-fluid my-5" style='overflow-x: scroll;'>
    <table class="table table-striped">
        <thead style='background-color:#eaeaea'>
            <th>No</th>
            <th>id_transaksi</th>
            <th>Hotel</th>
            <th>Waktu Hapus</th>
            <th>Pelanggan</th>
            <th>Kamar</th>
            <th>Waktu CheckIn</th>
            <th>Waktu Checkout</th>
            <th>Harga</th>
            <th>Hari</th>
            
            <th>Disc</th>
            <th>Total</th>
            <th>Status Transaksi</th>
            <th>Penanggung Jawab</th>
            
        </thead> 
        <tbody>
            <?php
                if(isset($_GET['isi']) && !empty($_GET['isi'])){
                    $Berdasarkan=$_GET['Berdasarkan'];
                    $isi=$_GET['isi'];
                    $querytabel="SELECT * FROM data_hapus_transaksi WHERE $Berdasarkan='$isi'";
                }elseif(isset($_GET['tanggal1']) && !empty($_GET['tanggal2'])){
                    $tanggal1=$_GET['tanggal1'];
                    $tanggal2=$_GET['tanggal2'];
                    $hotel=$_GET['hotel'];
                    $Berdasarkan=$_GET['Berdasarkan'];
                    $querytabel="SELECT * FROM data_hapus_transaksi WHERE ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2') AND id_hotel='$hotel' ";
                }else{
                    $querytabel="SELECT * FROM data_hapus_transaksi";

                }

                $result=mysql_query($querytabel);
                if(mysql_num_rows($result)>0){
                    while($data=mysql_fetch_array($result)){
                        ?>
                            <tr class="event2">

                                <td align="center" width="50">&nbsp;&nbsp;<?php $no = (($no + 1));
                                                                            echo $no; ?></td>
                                <td align="left"><a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_hapus_transaksi']); ?>" class='mx-2'><?php echo $data['id_transaksi']; ?></a></td>
                                <td align="left"><?php echo ucwords(baca_database("", "nama", "select * from data_pelanggan where id_pelanggan='$data[id_pelanggan]'"))  ?></td>
                                <td align="left"><?php echo $data['tanggal']  ?></td>
                                <td align="left"><?php echo baca_database("", "nama", "select * from data_pelanggan where id_pelanggan='$data[id_pelanggan]'")  ?></td>
                                <td align="left"><?php echo baca_database("", "no_kamar", "select * from data_kamar where id_kamar='$data[id_kamar]'")  ?></td>

                                <td align="left"><?php

                                                    echo format_indo($data['waktu_checkin']) ?></td>
                                <td align="left"><?php

                                                    echo format_indo($data['waktu_checkout']) ?></td>
                                <!-- <td align="left"><?php echo $data['no_rekening']; ?></td> -->
                                <td align="left"><?php
                                                    $tgl_checkin = new DateTime($data['waktu_checkin']);
                                                    $tgl_checkout = new DateTime($data['waktu_checkout']);
                                                    $selisih = $tgl_checkin->diff($tgl_checkout);
                                                    $jumlah_hari = $selisih->days;
                                 $id_kamar = $data['id_kamar'];
                                    $harga_harian = baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$id_kamar'");
                                    $harga_bulanan = baca_database("", "harga_bulanan", "select * from data_kamar where id_kamar='$id_kamar'");
                                    if($jumlah_hari >=30){
                                        $jumlah_bulan = floor($jumlah_hari/30);
                                        $harga_fix=$harga_bulanan;
                                    }else{
                                        $harga_fix=$harga_harian;
                                    }
                                 echo rupiah($harga_fix); ?></td>
           
                                <td align="left"><?php

                                                    echo $jumlah_hari; ?></td>
                                <td align="left"><?php echo $data['discount']; ?>%</td>
                                <td align="left">
                                    <?php if ($data['discount'] > 0) { ?>
                                        <strike><?php 
                                            if($jumlah_hari>=30){
                                                $jumlah_bulan=floor($jumlah_hari/30);
                                                $data_harga = $jumlah_bulan * $harga_bulanan;
                                            }else{
                                                $data_harga = $jumlah_hari * $harga_harian;
                                            }
                                            echo rupiah($data_harga); ?></strike>

                                    <?php } ?>
                                    <?php

                                    echo rupiah($data['harga']);                                ?>
                                </td>

                                <?php if ($data['status_transaksi'] == "Selesai") { ?>

                                    <td align="left" style="background-color: #f3ffe6;"><?php echo $data['status_transaksi']; ?></td>
                                <?php } else if ($data['status_transaksi'] == "Lunas") { ?>
                                    <td align="left" style="background-color: #fffee6;"><?php echo $data['status_transaksi']; ?></td>

                                <?php } else { ?>
                                    <td align="left" style="background-color: #ffe8e8;"><?php echo $data['status_transaksi']; ?></td>
                                <?php } ?>
                                    <td align="left"><?php echo baca_database("","nama","select * from data_admin_where id_admin='$data[id_admin]'")?></td>

                            </tr>
                        <?php } ?>
                <?php
                    }
                
                
            ?>
        </tbody>
    </table>
</div>
<script src='../../../../node_modules/sweetalert2/dist/sweetalert2.min.js'></script>
 <script>
    const html=`

    <form id="formCariSweet" style="text-align:left;font-size:14px">
        <div class='d-flex align-items-center' style='margin-bottom:10px;gap:10px'>
            <label style="flex: 0 0 100px; text-align: right;">Berdasarkan</label>
            <select name='Berdasarkan' id='Berdasarkan' style='flex: 1; height: 32px; padding: 4px; font-size: 13px; border-radius: 4px; border: 1px solid #ccc;' >
                <option value='waktu_checkin'>Waktu CheckIn</option>
                <option value='waktu_checkout'>Waktu Check Out</option>
            </select>
        </div>
        <div class='d-flex align-items-center ' style='margin-bottom:10px;gap:20px'>
            <label style="flex: 0 0 100px; text-align: right;">Dari Tanggal</label>
            <input type='date' name='tanggal1' id='tanggal1' style='flex: 1; height: 32px; padding: 4px; font-size: 13px; border-radius: 4px; border: 1px solid #ccc;'>
        </div>
        <div class='d-flex align-items-center ' style='margin-bottom:10px;gap:20px'>
            <label style="flex: 0 0 100px; text-align: right;">Sampai Tanggal</label>
            <input type='date' name='tanggal2' id='tanggal2' style='flex: 1; height: 32px; padding: 4px; font-size: 13px; border-radius: 4px; border: 1px solid #ccc;'>
        </div>
        <div class='d-flex align-items-center ' style='gap:10px'>
            <label style="flex: 0 0 100px; text-align: right;">Hotel</label>
            <select name='hotel' id='hotel' style='flex: 1; height: 32px; padding: 4px; font-size: 13px; border-radius: 4px; border: 1px solid #ccc;' >
                <?php
                    combo_database_v2("data_hotel","id_hotel","nama","");
                ?>
            </select>
        </div>
    </form>
    `
    function search(){
       Swal.fire({
            title: '<b style="font-size:16px;">Pencarian Data</b>',
            html: html,
            width: 400,
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: 'Pencarian',
            cancelButtonText: 'Cancel',
            denyButtonText: 'Reset Pencarian',
            focusConfirm: false,
            customClass: {
                cancelButton: 'swal-cancel-btn',
                denyButton: 'swal-cancel-btn' // sama class dengan cancel agar sama warna
            },
            preConfirm: () => {
                const berdasarkan = document.getElementById('Berdasarkan').value;
                const tanggal1= document.getElementById('tanggal1').value;
                const tanggal2= document.getElementById('tanggal2').value;
                const hotel= document.getElementById('hotel').value;

                if (!berdasarkan || !tanggal1|| !tanggal2|| !hotel) {
                    Swal.showValidationMessage('Semua field wajib diisi');
                    return false;
                }

                window.location.href = `?Berdasarkan=${encodeURIComponent(berdasarkan)}&tanggal1=${encodeURIComponent(tanggal1)}&tanggal2=${encodeURIComponent(tanggal2)}&hotel=${encodeURIComponent(hotel)}`;
            },
            preDeny: () => {
                window.location.href = 'index.php';
            }
        });
    }
 </script>
<div class="container">

</div>