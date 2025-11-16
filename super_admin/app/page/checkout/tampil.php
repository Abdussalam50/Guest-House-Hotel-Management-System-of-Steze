<body>

    <div class="container-md">
        <div class="table">
            <table class="table table-striped">
                <tr>
                    <td colspan="3">
                        <center><img src="../../../data/image/logo/steze-2.png" alt="" srcset="" width='100'>
                            <br>
                            <br>
                            <h2 style="color: #c12c27;"><i class='fas fa-sign-in-alt text-danger'></i> Check-out</h2>

                            <?php echo $alamat; ?>
                        </center>
                        <br>
                    </td>
                </tr>

                <?php
                $id_kamar = decrypt($_GET['id']);
                $id_trx = decrypt($_GET['trx']);

                $query = mysql_query("SELECT * FROM data_transaksi LEFT JOIN data_kamar ON data_transaksi.id_kamar=data_kamar.id_kamar WHERE data_kamar.status_kamar='Terisi' AND id_transaksi='$id_trx'");
                if (!$query) {
                    echo mysql_error();
                }
                $data = mysql_fetch_array($query);

                ?>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td width='1%'>:</td>
                    <td><?php echo ucwords(baca_database("", "nama", "select * from data_pelanggan where id_pelanggan='{$data['id_pelanggan']}'")) ?></td>
                </tr>
                <tr>
                    <th>Kamar</th>
                    <td width='1%'>:</td>
                    <td>Kamar <?php echo $data['no_kamar'] ?></td>
                </tr>
                <tr>
                    <th>Waktu Checkin</th>
                    <td width='1%'>:</td>
                    <td> <?php

                            echo format_indo($data['waktu_checkin']);
                            ?></td>
                </tr>
                <tr>
                    <th>Waktu Checkout</th>
                    <td width='1%'>:</td>
                    <td> <?php

                            echo format_indo($data['waktu_checkout']);
                            ?></td>
                </tr>
            <tr>
                <td class="clleft" width="25%">Jumlah Hari </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php 
                $waktu_checkin =new DateTime($data['waktu_checkin']);
                $waktu_checkout = new DateTime($data['waktu_checkout']);
                $selisih=$waktu_checkin->diff($waktu_checkout);
                echo $selisih->d; ?> Hari</td>
            </tr>
                <tr>
                    <th>Harga Kamar</th>
                    <td width='1%'>:</td>
                    <td> <?php
                        $harga_kamar_harian=baca_database("", "harga_harian", "select * from data_kamar where id_kamar='{$data['id_kamar']}'");
                        $harga_kamar_bulanan=baca_database("", "harga_bulanan", "select * from data_kamar where id_kamar='{$data['id_kamar']}'");
                        if($selisih->d>=30){
                            echo rupiah($harga_kamar_bulanan);

                        }else{
                            echo rupiah($harga_kamar_harian);
                        }
                          
                            ?></td>
                </tr>
                <tr>
                    <th>Jumlah Dewasa</th>
                    <td width='1%'>:</td>
                    <td> <?php
                            echo $data['jumlah_dewasa'];
                            ?></td>
                </tr>
                <tr>
                    <th>Jumlah anak-anak</th>
                    <td width='1%'>:</td>
                    <td> <?php
                            echo $data['jumlah_anak_anak'];
                            ?></td>
                </tr>
                <tr>
                    <th>Metode transaksi</th>
                    <td width='1%'>:</td>
                    <td> 
                        <div class="input-group" style='width:60%'>
                          <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" >
                          <input type="text" name="metode_bayar" id="metode_bayar" placeholder='Pilih Metode Bayar' class='form-control' value="<?php echo baca_database("", "metode_pembayaran", "select * from data_metode_pembayaran where id_metode_pembayaran='{$data['metode_transaksi']}'");?>">
                          <button type="button" id='metode' class='btn btn-secondary'><i class="fa fa-dollar"></i> Pilih Metode Pembayaran</button>  
                        </div>
                        
                   </td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td width='1%'>:</td>
                    <td> <?php
                            echo $data['discount']
                            ?>%</td>
                </tr>
                
                <tr>
                    <th>Total</th>
                    <td width='1%'>:</td>
                    <td> <?php
                            echo rupiah($data['harga']);
                            ?></td>
                </tr>
                <tr>
                    <th>Total Bayar </th>
                    <td width='1%'>:</td>
                    <td class='d-flex align-items-center'>
                        <input type="text" name="total" id="total" class='form-control' style='width:60%' placeholder="Jumlah Nominal Bayar" required>
                    </td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td width='1%'>:</td>
                    <td id='kembalian'>
                        <input type="hidden" name="kembalian" id='kembalian2'>
                    </td>
                </tr>


            </table>
        </div>
        <?php
        $idHotel = decrypt($_COOKIE['id_hotel']);
        $username = decrypt($_COOKIE['jenenge']);
        ?>
        <input type="hidden" name="nama_hotel" id='nama_hotel' value="<?php echo baca_database(" ", "nama", "select * from data_hotel where id_hotel='$idHotel'") ?>">
        <input type="hidden" name="id_transaksi" id='id_transaksi' value="<?php echo $data['id_transaksi'] ?>">
        <button class='btn btn-danger' id='cetak'> <i class="fa fa-print"></i> Cetak Nota</button>
    </div>
    <script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script>
        const metode= document.getElementById('metode');
        metode.addEventListener('click',function(){
            Swal.fire({
                title: 'Pilih Metode Pembayaran',
                icon:'info',
                width:'700px',
                html:`
                        <div class="container-xl">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>No</th>
                    <th>Metode Pembayaran</th>
                    <th>Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Atas Nama</th>
                    <th>Aksi</th>
                </thead>
                <tbody id='row_metode'>
                    <?php
                        $query_met_bayar=mysql_query("SELECT * FROM data_metode_pembayaran LEFT JOIN data_bank ON data_metode_pembayaran.id_bank=data_bank.id_bank WHERE data_metode_pembayaran.id_hotel='$idHotel'");
                        $no=1;
                        if(mysql_num_rows($query_met_bayar)>0){
                            while($data_met_bayar=mysql_fetch_array($query_met_bayar)){
                                ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data_met_bayar['metode_pembayaran']; ?></td>
                            <td><?php echo $data_met_bayar['nama_bank']; ?></td>
                            <td><?php echo $data_met_bayar['rekening']; ?></td>
                            <td><?php echo $data_met_bayar['atas_nama']; ?></td>
                            <td>
                                <button style='width:120px; height:22px; color:#fff; background-color: #c92d22ff; border: none; border-radius: 4px;' id='pilih' data-id='<?php echo $data_met_bayar['id_metode_pembayaran']; ?>' data-name='<?php echo $data_met_bayar['metode_pembayaran']?>'>Pilih</button>
                            </td>
                        </tr>
                    <?php
                            }
                        }
                        
                    ?>

                </tbody>
            </table>
        </div>
    </div>
                `,
        
            showCancelButton: true,
            didOpen:()=>{
                const pilih = document.getElementById('row_metode');
                pilih.addEventListener('click',function(e){
                    const id_transaksi= document.getElementById('id_transaksi').value;
                    const target=e.target;
                    if(target.id=='pilih'){
                    const id_metode = target.getAttribute('data-id');
                    const nama_metode = target.getAttribute('data-name');
                    document.getElementById('metode_pembayaran').value = id_metode;
                    document.getElementById('metode_bayar').value = nama_metode;
                    fetch('update_metode_pembayaran.php',{
                        method: 'POST',
                        body:JSON.stringify({
                            id_metode: id_metode,
                            id_transaksi: id_transaksi
                        })
                    })
                    .then(response=>response.json())
                    .then(data=>{
                        if(data.response=='success'){
                            Swal.close();
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Metode pembayaran berhasil diupdate',
                                icon: 'success',
                            })
                        }
                    })
                    }
                });
            }
                })
        })
    </script>

    <script>
        const total = document.getElementById('total');
        const kembalian = document.getElementById('kembalian');
        const kembalian2 = document.getElementById('kembalian2');
        const cetak = document.getElementById('cetak');
        const id_transaksi = document.getElementById('id_transaksi');
        const nama_hotel = document.getElementById('nama_hotel');
        total.addEventListener('change', function() {
            var harga = this.value - <?php echo intval($data['harga']) ?>;
            console.log(harga);
            const formatRupiah = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(harga);

            kembalian.innerHTML = formatRupiah;
            kembalian2.value = formatRupiah;
        });

        cetak.addEventListener('click', function() {
            fetch('cetak_nota.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        total: total.value,
                        kembalian1: kembalian2.value,
                        id_trx: id_transaksi.value,
                        nama_hotel: nama_hotel.value,
                        username: "<?php echo $username ?>",
                        status: 'checkout'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data == 'true') {
                        window.location.href = '../index.php';
                    } else {
                        alert(data);
                    }
                    console.log(data)
                })
                .catch(error => console.log(error));
        })
    </script>

</body>