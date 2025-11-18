<?php
$id_trx = decrypt($_GET['proses']);
$id_kamar = baca_database("", "id_kamar", "select * from data_booking where id_transaksi='$id_trx'");
$id_hotel = baca_database("", "id_hotel", "select * from data_hotel where id_transaksi='$id_trx'");
$no_kamar = baca_database("", "no_kamar", "select * from data_booking where id_transaksi='$id_trx'");
$id_pelanggan = baca_database("", "id_pelanggan", "select * from data_booking where id_transaksi='$id_trx'");
$nama_pelanggan = baca_database("", "nama", "select * from data_pelanggan where id_pelanggan='$id_pelanggan'");

?>
<div class="">
    <div id="kt_app_content" class="">
        <div id="kt_app_content_container" class="">

            <div class="card">
                <style>
                    /* ===== Custom Checkin Card Style (tidak ganggu bootstrap) ===== */
                    .cardcheckin {
                        background: #fff;
                        border-radius: 12px;
                        border: 1px solid #e0e0e0;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                        transition: all 0.2s ease-in-out;
                    }

                    .cardcheckin:hover {
                        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);

                    }

                    .cardcheckin-body {
                        padding: 18px;
                        display: flex;
                        flex-direction: column;
                        height: 100%;
                    }

                    .cardcheckin .card-group-title {
                        font-weight: bold;
                        background: #f8f9fa;
                        padding: 6px 10px;
                        border-radius: 6px;
                        margin-bottom: 12px;
                        border: 1px solid #dee2e6;
                    }

                    .room-badge {
                        background-color: #75cc68;
                        color: white;
                        font-size: 2rem;
                        font-weight: bold;
                        width: 70px;
                        height: 70px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 8px;
                        margin-right: 12px;
                    }

                    .cardcheckin .form-control,
                    .cardcheckin .form-select {
                        border-radius: 8px;
                        border: 1px solid #ced4da;
                        padding: 8px 12px;
                    }

                    .cardcheckin .form-control:focus,
                    .cardcheckin .form-select:focus {
                        border-color: #0d6efd;
                        box-shadow: 0 0 6px rgba(13, 110, 253, 0.25);
                    }

                    .input-group .btn,
                    .input-group .input-group-text {
                        border-radius: 8px;
                        border: 1px solid #ced4da;
                        padding: 8px 12px;
                    }

                    .btn-minus {
                        background: #bf2b27;
                        color: white;
                        border: none;
                    }

                    .btn-plus {
                        background: #28a745;
                        color: white;
                        border: none;
                    }

                    .btn-minus:hover {
                        background: #c82333;
                    }

                    .btn-plus:hover {
                        background: #218838;
                    }
                </style>

                <body class="bg-light p-4">
                    <form action="proses_update.php" enctype="multipart/form-data" method="post" id='formini'>

                        <?php
                        $idHotel = decrypt($_COOKIE["id_hotel"]);
                        $namaHotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'");

                        if (isset($_GET['id'])) {
                            $idKamar = $_GET['id'];
                            $noKamar = baca_database('', 'no_kamar', "select * from data_kamar where id_hotel='$id_hotel' and id_kamar='$id_kamar'");
                        } else {
                            $idKamar = '';
                            $noKamar = '';
                        }

                        $harga_harian = baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$id_kamar'");
                        $harga_bulanan = baca_database("", "harga_bulanan", "select * from data_kamar where id_kamar='$id_kamar'");
                        $kapasitas = baca_database("", "kapasitas", "select * from data_kamar where id_kamar='$id_kamar'");
                        $id_tipe_kamar = baca_database("", "id_tipe_kamar", "select * from data_kamar where id_kamar='$id_kamar'");
                        $tipe_kamar = baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$id_tipe_kamar'");
                        $query_transaksi = mysql_query("SELECT * FROM data_booking WHERE id_transaksi='$id_trx'");
                        $data = mysql_fetch_array($query_transaksi);
                        $query_pelanggan = mysql_query("SELECT * FROM data_pelanggan WHERE id_pelanggan='$id_pelanggan'");
                        $data_pelanggan = mysql_fetch_array($query_pelanggan);
                        ?>

                        <input type="hidden" value="<?php echo $id_trx; ?>" name="id_transaksi" placeholder="Id Transaksi " id="id_transaksi" required="required">
                        <input type="hidden" value="<?php echo  $id_kamar; ?>" style="width:80%" name="id_kamar" id="id_kamar" placeholder="Id kamar " required="required">
                        <input type="hidden" name="jumlah_bulan" id="jumlah_bulan" placeholder="Jumlah Bulan">
                        <input type="hidden" name="status" id="status" value="Lunas">
                        <input type="hidden" name="id_admin" value='<?php
                                                                    $username = decrypt($_COOKIE['jenenge']);
                                                                    $id_admin = baca_database("", "id_admin", "select * from data_admin where username='$username'");
                                                                    echo $id_admin;
                                                                    ?>'>
                        <input type="hidden" name="id_hotel" value='<?php echo decrypt($_COOKIE['id_hotel']) ?>'>
                        <div class="mb-4">
                            <div class="">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="room-badge"><?php echo $no_kamar ?></div>
                                    <h4 class="mb-0"><i class="fas fa-sign-in-alt text-success"></i> Edit Check-in <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$id_hotel'") ?></h4>
                                </div>

                                <div class="row g-3">
                                    <!-- Informasi Kamar -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Kamar</div>

                                                <label class="form-label">Tanggal</label>
                                                <input type="date" class="form-control mb-2" name="tanggal" value="<?php echo date('Y-m-d'); ?>">

                                                <label class="form-label">Channel</label>
                                                <select class="form-select mb-2" name="id_channel">
                                                    <option value="<?= $data['id_channel'] ?>"><?= $data['channel'] ?></option>
                                                    <?php combo_database_v2("data_channel", "id_channel", "channel", ""); ?>
                                                </select>





                                                <div class="row">

                                                    <label class="form-label">Tipe Kamar</label>
                                                    <div class="input-group">
                                                        <input class="form-control mb-2" readonly name="tipe_kamar" redonly value="<?php echo $tipe_kamar; ?>">

                                                    </div>


                                                </div>



                                                <label class="form-label">Tanggal Cek In</label>
                                                <input class="form-control mb-2" value="<?php echo date("Y-m-d") ?>" type="date" min='<?php echo date("Y-m-d") ?>' name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Checkin " required="required">

                                                <label class="form-label">Tanggal Cek Out</label>

                                                <input class="form-control mb-2"
                                                    type="date"
                                                    min="<?php echo date("Y-m-d"); ?>"
                                                    value="<?php echo date("Y-m-d", strtotime("+1 day")); ?>"
                                                    name="waktu_check_out"
                                                    id="waktu_check_out"
                                                    placeholder="Waktu Check Out"
                                                    required="required">


                                                <label class="form-label">Jumlah Hari</label>
                                                <div class="input-group mb-2">
                                                    <button id="btn-minus" style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">-</button>
                                                    <input class="form-control" style="height: 38px;text-align: center;" type="number" name="jumlah_hari" min="1" id="jumlah_hari" value="1" placeholder="Jumlah Hari" required>
                                                    <button id="btn-plus" style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Pelanggan -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Pelanggan</div>


                                                <label class="form-label">Nama</label>

                                                <!-- 
                                                <select onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")' class="form-select mb-2" type="text" name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan " required="required">
                                                    <option value="">Pilih Pelanggan</option>

                                                </select> -->


                                                <div class="input-group mb-2">

                                                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Pelanggan" value="<?php echo $nama_pelanggan ?>" required>
                                                    <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?= $id_pelanggan ?>">


                                                    <button type="button" class="btn btn-secondary" onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")'>
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>


                                                <div class="row g-2 mb-1">
                                                    <div class="col-4">
                                                        <label class="form-label">Identitas</label>
                                                        <input required class="form-control " name="identitas" id="identitas" value=<?= $data_pelanggan['identitas'] ?> placeholder="Identitas">

                                                    </div>
                                                    <div class="col-8">
                                                        <label class="form-label">No. Identitas</label>
                                                        <div class="input-group ">
                                                            <input required type="text" style="height: 38px;" class="form-control" name="no_identitas" id="no_identitas" value=<?= $data_pelanggan['no_identitas'] ?> placeholder="No Identitas">

                                                        </div>
                                                    </div>
                                                </div>

                                                <label class="form-label">Alamat</label>
                                                <input required type="text" class="form-control mb-1" name="alamat" id="alamat" value="<?= $data_pelanggan['alamat'] ?>" placeholder="Alamat">

                                                <label class="form-label">No. Telp</label>
                                                <input required type="text" class="form-control mb-2" name="no_telp" id="no_telp" placeholder="No Telp" value="<?= $data_pelanggan['no_hp'] ?>">

                                                <label class="form-label">Jenis Kelamin</label>
                                                <select required class="form-control mb-2" name="jenis_kelamin" id="jenis_kelamin">
                                                    <option value="<?= $data_pelanggan['jenis_kelamin'] ?>" disabled selected><?= $data_pelanggan['jenis_kelamin'] ?></option>
                                                    <option value="laki-laki">Laki-laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>





                                                <label class="form-label">Jumlah Tamu</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Dewasa</span>
                                                    <input class="form-control" min="1" value="1" style="text-align: center;" type="number" name="jumlah_dewasa" id="jumlah_dewasa" placeholder="Jumlah Dewasa" value="<?= $data['jumlah_dewasa'] ?>" required="required">

                                                    <span class="input-group-text">Anak</span>
                                                    <input class="form-control" value="0" min="0" style="text-align: center;" type="number" name="jumlah_anak_anak" id="jumlah_anak_anak" value="<?= $data['jumlah_anak_anak'] ?>" placeholder="Jumlah Anak Anak ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Informasi Transaksi -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Transaksi</div>

                                                <label class="form-label">Harga Sewa / Hari</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control" name="harga_hari" readonly value="<?php echo rupiah_format($harga_harian); ?>">
                                                </div>

                                                <label class="form-label">Total Harga Sewa</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="hidden" name="total_harga_kamar" id='harga_kamar'>
                                                    <input type="text" readonly class="form-control" id="total_harga_kamar">
                                                </div>

                                                <div class="row g-2 mb-1">
                                                    <div class="col-6">
                                                        <label class="form-label">Diskon</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">%</span>

                                                            <input class="form-control" type="number" name="discount" id="discount" placeholder="Discount " value='<?= $data['discount'] ?>'>

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Potongan</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rp</span>

                                                            <input class="form-control" type="number" name="potongan_harga" id="potongan_harga" placeholder="potongan_harga " value='<?= $data['potongan_harga'] ?>'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tambahan Biaya -->
                                                <label class="form-label">Tambahan Biaya</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>

                                                    <input class="form-control" type="varchar" name="tambahan" id="tambahan" placeholder="Biaya Tambahan" value='<?= $data['biaya_tambahan_checkin'] ?>'>



                                                    <!-- Tombol untuk Note -->
                                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#noteModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>

                                                <!-- Modal untuk Note -->
                                                <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="noteModalLabel">Catatan Tambahan Biaya Check-in</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" name="deskripsi" rows="4" placeholder="Tulis catatan di sini..."><?= $data['deskripsi_biaya_checkin'] ?></textarea>
                                                                <input type="hidden" name="catatan" id="catatan" class='form-control'>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Grandtotal -->
                                                <label class="form-label">Grandtotal</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="hidden" name="harga" id='harga_input' value='<?= $data['total_harga_kamar'] ?>'>
                                                    <input type="text" readonly class="form-control" id='harga' value='<?= $data['total_harga_kamar'] ?>'>





                                                </div>

                                                <!-- Pajak Checkbox -->
                                                <div class="form-check mt-2 mb-3">
                                                    <?php
                                                    $nilai_pajak = pengaturan_aplikasi('persentase_pajak');
                                                    $defaut_checklist = pengaturan_aplikasi('default_checklist_pajak');
                                                    if ($data['pajak'] > "0") {
                                                        $checked = "checked";
                                                    } else {
                                                        $checked =  "";
                                                    }

                                                    $nilai_input = ($nilai_pajak > 0) ? $nilai_pajak : 0;
                                                    ?>
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-check-input me-2" type="checkbox" value="<?= $data['pajak'] ?>" id="pajakCheck" name="pajak" <?= $checked; ?>>

                                                        <input class="form-control me-2" style="width:80%"
                                                            type="hidden" name="persentase_pajak"
                                                            id="persentase_pajak"
                                                            placeholder="Persentase Pajak"
                                                            value="<?= $nilai_input; ?>">

                                                        <label class="" for="pajakCheck">
                                                            Pajak (<?= $nilai_input; ?>%)
                                                        </label>
                                                    </div>



                                                </div>

                                                <div class="mt-auto d-flex justify-content-end">
                                                    <button class="btn btn-secondary me-2" type="reset">Batal</button>
                                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalPembayaran"><i class="fa fa-save"></i> Proses</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <!-- Modal Pembayaran -->
                        <div class="modal fade" id="modalPembayaran" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Proses Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">

                                        <label class="form-label">Grand Total</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>

                                            <input type="text" readonly class="form-control" id="grand_total" name="grand_total" value='<?= $data['total_bayar'] ?>'>
                                        </div>


                                        <label class="form-label">Metode Pembayaran</label>


                                        <input type="hidden" name="id_metode_pembayaran" id="id_metode_pembayaran" value='<?= $data['id_metode_pembayaran'] ?>'>
                                        <input type="hidden" name="no_rekening" id="no_rekening" value='<?= $data['no_rekening'] ?>'>
                                        <div class="input-group mb-2">

                                            <input type="text" onclick='pilih_metode_pembayaran()' class="form-control" name="metode_pembayaran" id="metode_pembayaran" value='<?= $data['metode_pembayaran'] ?>' required readonly>

                                            <button type="button" onclick='pilih_metode_pembayaran()' class="btn btn-secondary">
                                                Pilih
                                            </button>
                                        </div>



                                        <label class="form-label">Nominal Bayar</label>
                                        (<span class='text-start fw-bold text-danger'>Sebelumnya: <?= rupiah($data['total_bayar']) ?> </span>)
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" id="nominal" name="nominal" value="<?= $data['total_bayar'] ?>">
                                            <input class="form-control" type="varchar" name="nominal_bayar" id="nominal_bayar" value="<?= $data['total_bayar'] ?>">
                                        </div>


                                        <div class="mb-2">
                                            <small class="text-muted" style="font-size:0.7rem;">Estimasi Nominal Pembayaran:</small>

                                            <!-- Tombol Prediksi Bayar Kecil -->
                                            <div class="mb-2" id="prediksi_buttons" style="display:flex; gap:5px; flex-wrap:wrap;"></div>

                                        </div>





                                        <label class="form-label">Kembalian</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>

                                            <input type="hidden" class="form-control" name="kembalian" id='kembalian' value='<?= $data['jumlah_kembalian'] ?>'>
                                            <input type="text" class="form-control" name="kembalian_value" id='kembalian_value' value='<?= $data['jumlah_kembalian'] ?>'>

                                        </div>


                                        <input type="hidden" class="form-control" name="sisa" id='sisa' value='<?= $data['sisa_pembayaran'] ?>'>
                                        <input type="hidden" class="form-control" name="sisa_value" id='sisa_value' value='<?= $data['sisa_pembayaran'] ?>'>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" id='simpan_data'>Edit Check-in</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </body>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalPelanggan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="height:80vh;">
            <div class="modal-header py-2">
                <h5 class="modal-title"> <i class="fa fa-user fa-3x text-muted mb-2"></i> Pilih Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-5 mb-10 overflow-auto">

                <!-- Tab Nav -->
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="cari-tab" data-bs-toggle="tab" data-bs-target="#cari" type="button">Cari Pelanggan</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="form-tab" data-bs-toggle="tab" data-bs-target="#form" type="button">Tambah Baru</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Tab Cari -->
                    <div class="tab-pane fade show active" id="cari">
                        <div class="border border-secondary rounded p-2">
                            <table class="table table-sm mb-2">
                                <tr>
                                    <td style="max-width: 40px;">Pencarian Pelanggan </td>
                                    <td width="1%">:</td>
                                    <td><input type="text" id="search" class="form-control form-control-sm"></td>
                                    <td colspan="4"></td>
                                </tr>
                            </table>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Identitas</th>
                                            <th>No&nbsp;Identitas</th>
                                            <th>No&nbsp;Tlp</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>

                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody id="results"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Tambah Baru -->
                    <div class="tab-pane fade" id="form">
                        <div class="border border-secondary rounded p-2" style="max-width: 50%;">
                            <form id="simpan_baru">
                                <table class="table table-sm mb-2">
                                    <tr>
                                        <td>Nama</td>
                                        <td><input type="text" id="nama_baru" name="nama_baru" required class="form-control form-control-sm"></td>
                                    </tr>
                                    <tr>
                                        <td>Identitas</td>
                                        <td><input type="text" id="identitas_baru" name="identitas_baru" required class="form-control form-control-sm"></td>
                                    </tr>
                                    <tr>
                                        <td>No Identitas</td>
                                        <td><input type="text" id="no_identitas_baru" name="no_identitas_baru" required class="form-control form-control-sm"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><input type="text" id="alamat_baru" name="alamat_baru" required class="form-control form-control-sm"></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>
                                            <select name="jenis_kelamin_baru" id="jenis_kelamin_baru" required class="form-control form-control-sm">
                                                <option value="laki-laki">laki-laki</option>
                                                <option value="perempuan">perempuan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No HP</td>
                                        <td><input type="text" id="hp_baru" name="hp_baru" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="hidden" name="id_hotel" value='<?php echo decrypt($_COOKIE['id_hotel']) ?>'>
                                            <button type="button" id="btn_simpan" class="btn btn-danger btn-sm">
                                                <i class="fa fa-save"></i> Simpan Pelanggan
                                            </button>
                                        </td>
                                    </tr>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js">

</script>

<script src='js/main.js'></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        // DOM Elements
        const elements = {
            checkin: document.getElementById('waktu_checkin'),
            checkout: document.getElementById('waktu_check_out'),
            days: document.getElementById('jumlah_hari'),
            months: document.getElementById('jumlah_bulan'),
            priceDisplay: document.getElementById('harga'),
            grandtotal: document.getElementById('grand_total'),
            priceInput: document.getElementById('harga_input'),
            roomPrice: document.getElementById('total_harga_kamar'),
            discount: document.getElementById('discount'),
            additionalFee: document.getElementById('tambahan'),
            additionalFeeDisplay: document.getElementById('tambahan_nom'),
            taxPercent: document.getElementById('persentase_pajak'),
            payment: document.getElementById('nominal_bayar'),
            paymentDisplay: document.getElementById('nominal'),
            change: document.getElementById('kembalian'),
            changeDisplay: document.getElementById('kembalian_value'),
            remaining: document.getElementById('sisa'),
            remainingDisplay: document.getElementById('sisa_value'),
            harga_kamar: document.getElementById('harga_kamar'),
            priceCut: document.getElementById('potongan_harga'),
            form: document.getElementById('formini'),
            saveButton: document.getElementById('simpan_data')
        };



        // Constants
        const DAILY_RATE = <?php echo intval($harga_harian) ?>;
        const MONTHLY_RATE = <?php echo intval($harga_bulanan) ?>;
        const MS_PER_DAY = 24 * 60 * 60 * 1000;

        // Format number to Rupiah
        const formatRupiah = (value) => new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value)

        // Calculate base price based on days or months
        const calculateBasePrice = (days) => {
            days = parseInt(days) || 0;
            return days < 30 || days % 30 !== 0 ?
                days * DAILY_RATE :
                Math.floor(days / 30) * MONTHLY_RATE;
        };

        // Update final price with discount applied only to room price
        const updateFinalPrice = () => {
            const basePrice = Number(elements.harga_kamar.value) || 0;
            const additional = Number(elements.additionalFee.value) || 0;
            const discountPercent = Number(elements.discount.value) || 0;
            const priceCut = Number(elements.priceCut.value) || 0;
            const taxPercent = Number(elements.taxPercent.value) || 0;

            // Apply discount only to room price (basePrice)
            const discountedRoomPrice = basePrice * (1 - discountPercent / 100);

            // Calculate subtotal (discounted room price + additional - price cut)
            const subtotal = discountedRoomPrice + additional - priceCut;

            // Apply tax to the subtotal
            const finalPrice = subtotal * (1 + taxPercent / 100);

            // Update displays
            elements.roomPrice.value = formatRupiah(basePrice);

            elements.priceInput.value = Math.floor(finalPrice);
            elements.priceDisplay.value = formatRupiah(Math.floor(finalPrice));
            elements.grandtotal.value = formatRupiah(Math.floor(finalPrice));

            updatePaymentCalculations();

            createPrediksiButtons(Math.floor(finalPrice - <?= intval($data['total_bayar']) ?>));
            // Set default prediksi pertama
            document.getElementById('nominal_bayar').value = "";
            document.getElementById('nominal').value = "";

        };



        function createPrediksiButtons(total) {
            var container = document.getElementById('prediksi_buttons');
            container.innerHTML = '';

            // Prediksi: total asli, bulat 5.000 terdekat, bulat 200.000
            var nearest5k = Math.ceil(total / 5000) * 5000;
            var round200k = Math.ceil(total / 200000) * 200000;

            var prediksiArr = [total];
            if (nearest5k !== total) prediksiArr.push(nearest5k);
            if (round200k !== total && round200k !== nearest5k) prediksiArr.push(round200k);

            prediksiArr.forEach(function(val) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-light btn-sm'; // tombol lebih kecil dan soft
                btn.style.padding = '4px 12px'; // memperkecil ukuran tombol
                btn.style.fontSize = '0.75rem'; // font lebih kecil
                btn.style.opacity = '0.8'; // membuat tombol lebih samar
                btn.style.borderColor = '#ccc'; // border lebih halus

                btn.innerText = val.toLocaleString('id-ID');
                btn.addEventListener('click', function() {
                    document.getElementById('nominal_bayar').value = val;
                    document.getElementById('nominal').value = val;

                    updatePaymentCalculations();
                });
                container.appendChild(btn);
            });
        }



        // Update payment calculations
        const updatePaymentCalculations = () => {

            const payment = Number(elements.payment.value) || 0;
            const total = Number(elements.priceInput.value) || 0;

            elements.paymentDisplay.value = formatRupiah(payment);

            if (payment >= total) {
                const change = payment - total;
                elements.change.value = change;
                elements.changeDisplay.value = formatRupiah(change);
                elements.remaining.value = 0;
                elements.remainingDisplay.value = '0';
            } else {
                const remaining = total - payment;
                elements.change.value = 0;
                elements.changeDisplay.value = '0';
                elements.remaining.value = remaining;
                elements.remainingDisplay.value = formatRupiah(remaining);
            }
        };

        // Update checkout date based on checkin and days
        const updateCheckoutDate = () => {
            const checkin = new Date(elements.checkin.value);
            const days = parseInt(elements.days.value) || 0;
            const checkout = new Date(checkin.getTime() + days * MS_PER_DAY);
            elements.checkout.value = checkout.toISOString().split('T')[0];

            elements.harga_kamar.value = calculateBasePrice(days);
            updateFinalPrice();
        };

        // Update days based on checkin and checkout
        const updateDays = () => {
            const checkin = new Date(elements.checkin.value);
            const checkout = new Date(elements.checkout.value);
            const days = Math.floor((checkout - checkin) / MS_PER_DAY);
            elements.days.value = days;

            elements.harga_kamar.value = calculateBasePrice(days);
            updateFinalPrice();
        };

        // Update based on months
        const updateByMonths = () => {
            const months = parseInt(elements.months.value) || 0;
            const days = months * 30;
            elements.days.value = days;
            updateCheckoutDate();
        };

        // Event Listeners
        elements.months.addEventListener('change', updateByMonths);
        elements.days.addEventListener('input', updateCheckoutDate);
        elements.checkin.addEventListener('change', updateCheckoutDate);
        elements.checkout.addEventListener('change', updateDays);
        [elements.additionalFee, elements.discount, elements.priceCut, elements.taxPercent]
        .forEach(el => el.addEventListener('input', updateFinalPrice));
        elements.payment.addEventListener('input', updatePaymentCalculations);
        elements.additionalFee.addEventListener('input', () => {
            elements.additionalFeeDisplay.innerHTML = formatRupiah(Number(elements.additionalFee.value) || 0);
        });


        const checkbox = document.getElementById("pajakCheck");
        const inputPajak = document.getElementById("persentase_pajak");
        const defaultValue = <?= (int)$nilai_pajak; ?>;

        function togglePajak() {
            if (checkbox.checked) {
                inputPajak.value = defaultValue > 0 ? defaultValue : 0;

            } else {
                inputPajak.value = 0;
            }
            updateCheckoutDate();

        }

        checkbox.addEventListener("change", togglePajak);

        // Jalankan sekali saat load
        togglePajak();


        const inputHari = document.getElementById('jumlah_hari');
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus = document.getElementById('btn-plus');

        btnPlus.addEventListener('click', () => {
            inputHari.value = parseInt(inputHari.value) + 1;
            updateCheckoutDate();
        });

        btnMinus.addEventListener('click', () => {
            let current = parseInt(inputHari.value);
            if (current > 1) {
                inputHari.value = current - 1;
            }
            updateCheckoutDate();
        });





        // Form submission
        elements.saveButton.addEventListener('click', () => {
            if (elements.form.checkValidity()) {
                elements.form.submit();
            } else {
                elements.form.reportValidity();
            }
        });

        // Payment method selection
        window.pilih_metode_pembayaran = () => {
            Swal.fire({
                title: 'Pilih Metode Transaksi',

                showConfirmButton: false,
                showCancelButton: false,
                width: '850px',
                html: `
        <div class="container-fluid">
            <div class="table-responsive">
               <table class="table text-start">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Metode Transaksi</th>
                            <th>Bank</th>
                            <th>Rekening</th>
                            <th>Atas Nama</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_metode_bayar = mysql_query("SELECT * FROM data_metode_pembayaran LEFT JOIN data_bank ON data_metode_pembayaran.id_bank = data_bank.id_bank WHERE data_bank.id_hotel = '$idHotel'") or die(mysql_error());
                        $no = 0;
                        while ($data = mysql_fetch_array($query_metode_bayar)) {
                            $no++;
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo ucwords($data['metode_pembayaran']); ?></td>
                                <td><?php echo ucwords($data['nama_bank']); ?></td>
                                <td><?php echo $data['rekening']; ?></td>
                                <td><?php echo ucwords($data['atas_nama']); ?></td>
                              
                                <td>
    <button style="background-color:#bf2b27;border-radius:10px;color:#fff;width:120px;height:30px;border:none;display:flex;align-items:center;justify-content:center;gap:6px;" 
        class="pil_metode" 
        data-id="<?php echo $data['id_metode_pembayaran']; ?>" 
        data-name="<?php echo ucwords($data['metode_pembayaran']); ?>" 
        data-rekening="<?php echo $data['rekening'] ?>">
        <i style="color:white" class="fa fa-credit-card"></i> Pilih
    </button>
</td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>`,
                didOpen: () => {
                    document.querySelectorAll('.pil_metode').forEach(button => {
                        button.addEventListener('click', () => {
                            document.getElementById('id_metode_pembayaran').value = button.dataset.id;
                            document.getElementById('metode_pembayaran').value = button.dataset.name;
                            document.getElementById('no_rekening').value = button.dataset.rekening;
                            Swal.close();
                        });
                    });
                }
            });
        };
    });


    document.getElementById('simpan_data').addEventListener('click', function() {
        var form = document.getElementById('formini');
        var inputs = form.querySelectorAll('[required]');
        var invalidFields = [];

        inputs.forEach(function(input) {
            if (!input.value.trim()) {
                var fieldName = input.name || input.id;

                // jika ada prefix "id_", hapus
                if (fieldName.startsWith("id_")) {
                    fieldName = fieldName.replace("id_", "");
                }

                invalidFields.push(fieldName);
            }
        });

        if (invalidFields.length > 0) {
            alert("Kolom berikut harus diisi:\n- " + invalidFields.join("\n- "));
        } else {
            form.submit();
        }
    });


    function cari_pelanggan(idHotel) {
        const modal = new bootstrap.Modal(document.getElementById('modalPelanggan'));
        modal.show();

        const input = document.getElementById("search");
        const results = document.getElementById("results");
        const simpan_baru = document.getElementById("simpan_baru");
        const btn_simpan = document.getElementById("btn_simpan");
        const id_pelanggan = document.getElementById("id_pelanggan");

        function renderResults(result) {
            if (result == "null") {
                results.innerHTML = `
<tr>
  <td colspan="7" class="text-center p-4">
    <i class="fa fa-search-minus fa-3x text-muted mb-2"></i>
    <div class="fw-bold text-muted">Data Tidak Ditemukan</div>
  </td>
</tr>
`;

            } else {
                results.innerHTML = "";
                result.forEach((element) => {
                    const jsonData = JSON.stringify({
                        id: element.id,
                        nama: element.nama,
                        identitas: element.identitas,
                        no_identitas: element.no_identitas,
                        alamat: element.alamat,
                        no_hp: element.no_hp,
                        jenis_kelamin: element.jenis_kelamin,
                        jumlah_dewasa: element.jumlah_dewasa,
                        jumlah_anak_anak: element.jumlah_anak_anak
                    });

                    results.innerHTML += `
      <tr>
        <td><a href='../data_pelanggan/index.php?input=edit&proses=${element.id}'>&nbsp;&nbsp;${element.nama}</a></td>
        <td>${element.identitas}</td>
        <td>${element.no_identitas}</td>
        <td>${element.no_hp}</td>
        <td>${element.jenis_kelamin}</td>
        <td>${element.alamat}</td>
        <td>
          <button class="btn btn-sm btn-danger pil_pelanggan" 
                  data-json='${jsonData}'>
            Pilih
          </button>
        </td>
      </tr>`;
                });


            }
        }

        // load 10 pelanggan terbaru
        fetch("find_pelanggan.php", {
                method: "POST",
                body: JSON.stringify({
                    name: "",
                    id_hotel: idHotel
                }),
            })
            .then((res) => res.json())
            .then((data) => renderResults(data));

        // pencarian realtime
        input.addEventListener("keyup", () => {
            fetch("find_pelanggan.php", {
                    method: "POST",
                    body: JSON.stringify({
                        name: input.value,
                        id_hotel: idHotel
                    }),
                })
                .then((res) => res.json())
                .then((data) => renderResults(data));
        });

        // pilih pelanggan
        results.addEventListener("click", function(e) {
            if (e.target && e.target.classList.contains("pil_pelanggan")) {
                const element = JSON.parse(e.target.getAttribute("data-json")); // ambil data lengkap

                // set field lain
                document.getElementById("id_pelanggan").value = element.id || '';
                document.getElementById("nama").value = element.nama || '';
                document.getElementById("identitas").value = element.identitas || '';
                document.getElementById("no_identitas").value = element.no_identitas || '';
                document.getElementById("alamat").value = element.alamat || '';
                document.getElementById("no_telp").value = element.no_hp || '';
                document.getElementById("jumlah_dewasa").value = element.jumlah_dewasa || 1;
                document.getElementById("jumlah_anak_anak").value = element.jumlah_anak_anak || 0;
                document.getElementById("jenis_kelamin").value = element.jenis_kelamin || 'laki-laki';


                modal.hide();
            }
        });

        // simpan pelanggan baru
        btn_simpan.addEventListener("click", function() {

            var form = document.getElementById('simpan_baru');
            var inputs = form.querySelectorAll('[required]');
            var invalidFields = [];

            inputs.forEach(function(input) {
                if (!input.value.trim()) {
                    var fieldName = input.name || input.id;

                    // jika ada prefix "id_", hapus
                    if (fieldName.startsWith("id_")) {
                        fieldName = fieldName.replace("id_", "");
                    }

                    invalidFields.push(fieldName);
                }
            });

            if (invalidFields.length > 0) {
                alert("Kolom berikut harus diisi:\n- " + invalidFields.join("\n- "));
            } else {



                const dataform = new FormData(simpan_baru);
                fetch("simpan_pelanggan_v2.php", {
                        method: "POST",
                        body: dataform
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        if (data !== "false") {
                            // set value select dan input lain
                            document.getElementById("id_pelanggan").value = data.id || '';
                            document.getElementById("nama").value = data.nama || '';
                            document.getElementById("identitas").value = data.identitas || '';
                            document.getElementById("no_identitas").value = data.no_identitas || '';
                            document.getElementById("alamat").value = data.alamat || '';
                            document.getElementById("no_telp").value = data.no_hp || '';
                            document.getElementById("jumlah_dewasa").value = data.jumlah_dewasa || 1;
                            document.getElementById("jumlah_anak_anak").value = data.jumlah_anak_anak || 0;
                            document.getElementById("jenis_kelamin").value = data.jenis_kelamin || 'laki-laki';

                            // reset form input tambah baru
                            simpan_baru.reset();

                            // tutup modal
                            modal.hide();

                            // SweetAlert notifikasi sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pelanggan baru berhasil ditambahkan',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    })
                    .catch((err) => console.error(err));
            }
        });


    }
</script>