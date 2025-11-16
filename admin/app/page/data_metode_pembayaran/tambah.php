<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KEHALAMAN SEBELUMNYA'); ?>
</a>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Metode Pembayaran </strong>
        <hr class="message-inner-separator">
        <p>Silahkan input Data Metode Pembayaran dibawah ini.</p>
    </div>
</div>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id Hotel  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_metode_pembayaran", "id_bank", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_metode_pembayaran", "id_bank", "10"); ?>" name="id_metode_pembayaran" placeholder="Id Metode Pembayaran " id="id_metode_pembayaran" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Hotel <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>


                                <?php
                                if ($_COOKIE['id_hotel'] == "") {
                                ?>
                                    <select class="form-control" style="width:50%" type="text" name="nama_hotel" id="nama_hotel" placeholder="Id Hotel " required="required">
                                        <option></option><?php combo_database_v2('', 'id_hotel', 'nama', "select * from data_hotel"); ?>
                                    </select>
                                <?php
                                } else {
                                ?>

                                    <select name="nama_hotel" id="nama_hotel" style="width:50%" class="form-control" readonly>
                                        <option value="<?php
                                                        $idHotel = decrypt($_COOKIE['id_hotel']);
                                                        echo $idHotel ?>"><?php
                                                                            echo baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'");
                                                                            ?></option>
                                    </select>
                                <?php

                                }
                                ?>



                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Metode Pembayaran<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="metode_pembayaran" id="metode_pembayaran" placeholder="Metode Pembayaran" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Bank<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <div class="input-group" style="width:50%">
                                    <input type="hidden" name="id_bank" id="id_bank" placeholder="Bank " required="required">
                                    <input class="form-control" type="text" name="nama_bank" id="nama_bank" placeholder="Bank " required="required">
                                    <button type="button" class='btn btn-secondary' onclick='pilih_bank()'><i class="fa fa-dollar"></i> Pilih Bank</button>
                                </div>
                            </td>
                        </tr>



                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_simpan(' PROSES SIMPAN DATA'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>
    <script src='../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
    <script>
        function pilih_bank() {
            Swal.fire({
                title: 'Pilih Bank',
                icon: 'info',
                width: '700px',
                html: `
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


                    if ($_COOKIE['id_hotel'] == "") {

                        $query = mysql_query("SELECT * FROM data_bank ") or die(mysql_error());
                    } else {
                        $query = mysql_query("SELECT * FROM data_bank WHERE id_hotel = '$idHotel'") or die(mysql_error());
                    }
                    $no = 0;
                    if (mysql_num_rows($query) > 0) {
                        while ($data = mysql_fetch_array($query)) {
                            $no++;
                    ?>
                            <tr>
                                <td><?php echo ucwords($data['nama_bank']); ?></td>
                                <td><?php echo $data['rekening']; ?></td>
                                <td><?php echo ucwords($data['atas_nama']); ?></td>
                                <td><?php echo ucwords(baca_database("", "nama", "select * from data_hotel where id_hotel = '$data[id_hotel]'")); ?></td>
                                <td>
                                    <button type="button" id='pilih' class="btn-sm m-0" data-id='<?php echo $data['id_bank']; ?>' data-nama='<?php echo $data['nama_bank']; ?>'  style='width:100px;height:23px;background-color:#D42200;border:none; border-radius:3em;color:#fff'>Pilih</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
                `,
                showCancelButton: true,
                cancelButtonText: 'Batal',

            });

            document.querySelectorAll('#pilih').forEach(button => {
                button.addEventListener('click', function() {
                    const id_bank = this.getAttribute('data-id');
                    const nama_bank = this.getAttribute('data-nama');
                    console.log(nama_bank);
                    document.getElementById('id_bank').value = id_bank;
                    document.getElementById('nama_bank').value = nama_bank;
                    Swal.close();
                    Swal.fire({
                        title: "Bank dan Rekening  Berhasil Dipilih",
                        icon: "success",
                        durration: 1500

                    })
                });
            });
        }
    </script>