<?php $id_transaksi =  id_otomatis("data_booking", "id_transaksi", "10"); ?>

<script>
    var idTransaksi = "<?php echo $id_transaksi; ?>";
</script>


<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

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
                        cursor: pointer;
                        padding: 10px;
                        background-color: #2196f3;
                        color: white;
                        font-size: 1rem;
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
                    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id='formini'>

                        <?php
                        if (isset($_COOKIE['id_hotel'])) {
                            $idHotel = decrypt($_COOKIE["id_hotel"]);
                        } else {
                            $idHotel = $_GET['id_hotel'];
                        }
                        $namaHotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'");
                        ?>

                        <input type="hidden" value="<?php echo $id_transaksi; ?>" name="id_transaksi" placeholder="Id Transaksi " id="id_transaksi" required="required">

                        <input type="hidden" name="status" id="status" value="Lunas">
                        <input type="hidden" name="id_admin" value='<?php
                                                                    $username = decrypt($_COOKIE['jenenge']);
                                                                    $id_admin = baca_database("", "id_admin", "select * from data_admin where username='$username'");
                                                                    if ($id_admin == null) {
                                                                        $username = decrypt($_COOKIE['jenenge']);
                                                                        $id_admin = baca_database("", "id_pengelola", "select * from data_pengelola where username='$username'");
                                                                    }
                                                                    echo $id_admin;
                                                                    ?>'>
                        <input type="hidden" name="id_hotel" value='<?php echo decrypt($_COOKIE['id_hotel']) ?>'>
                        <div class="mb-4">
                            <div class="cardcheckin-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <div class="d-flex align-items-center gap-3">
                                        <div class="room-badge" data-full="">
                                            Booking
                                        </div>
                                        <h4 class="mb-0">
                                            <i class="fas fa-sign-in-alt text-primary"></i>
                                            Booking <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'") ?>
                                        </h4>
                                    </div>

                                    <h4 class="mb-0 fw-bold text-primary    ">
                                        Booking harian
                                    </h4>
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        document.querySelectorAll('.room-badge').forEach(function(el) {
                                            el.addEventListener('click', function() {
                                                const fullName = this.getAttribute('data-full');

                                                Swal.fire({
                                                    title: "No. Kamar",
                                                    text: fullName,
                                                    icon: "info",
                                                    confirmButtonText: "OK"
                                                });
                                            });
                                        });
                                    });
                                </script>


                                <div class="row g-3">
                                    <!-- Informasi Kamar -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Pemesan</div>


                                                <label class="form-label">Nama</label>

                                                <!-- 
                                                <select onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")' class="form-select mb-2" type="text" name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan " required="required">
                                                    <option value="">Pilih Pelanggan</option>

                                                </select> -->


                                                <div class="input-group mb-2">

                                                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Pelanggan" required>
                                                    <input type="hidden" name="id_pelanggan" id="id_pelanggan">


                                                    <button type="button" class="btn btn-secondary" onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")'>
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>



                                                <input required type="hidden" class="form-control" name="identitas" id="identitas" placeholder="Identitas">
                                                <input required type="hidden" class="form-control" name="no_identitas" id="no_identitas" placeholder="No Identitas">
                                                <input required type="hidden" class="form-control" name="alamat" id="alamat" placeholder="Alamat">
                                                <input required type="hidden" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp">
                                                <input required type="hidden" class="form-control" name="jenis_kelamin" id="jenis_kelamin">




                                                <label class="form-label">Tanggal</label>
                                                <input type="date" class="form-control mb-2" name="tanggal" value="<?php echo date('Y-m-d'); ?>">

                                                <label class="form-label">Channel</label>
                                                <select class="form-select mb-2" name="id_channel">
                                                    <?php combo_database_v2("data_channel", "id_channel", "channel", ""); ?>
                                                </select>


















                                                <label class="form-label">Tanggal Cek In</label>
                                                <input class="form-control mb-2" value="<?php echo date("Y-m-d") ?>" type="date" name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Checkin " required="required">

                                                <label class="form-label">Tanggal Cek Out</label>

                                                <input class="form-control mb-2"
                                                    type="date"

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
                                                <div class="card-group-title">Informasi kamar</div>





                                                <label class="form-label">Pilih Kamar</label>
                                                <div class="input-group mb-2">

                                                    <input class="form-control" type="text" id="pilih_kamar" placeholder="Pilih Kamar" readonly>
                                                    <button type="button" id="btn_pilih_kamar" class="btn btn-secondary">
                                                        <i class="fas fa-search"></i>
                                                    </button>

                                                </div>


                                                <style>
                                                    .kamar-card {
                                                        --bs-card-box-shadow: 0px 0px 20px 0px rgb(72 85 127 / 55%);
                                                        box-shadow: var(--bs-card-box-shadow);
                                                        cursor: pointer;
                                                        background-position: right top;
                                                        background-size: 30%;
                                                        background-repeat: no-repeat;
                                                        background-image: url('../../../upload/1747180187-26415-1698105518-17748-abstract-1.svg');
                                                        border-radius: 12px;
                                                        transition: 0.2s;
                                                    }

                                                    .kamar-card:hover {
                                                        transform: scale(1.05);
                                                    }
                                                </style>

                                                <style>
                                                    .room-table {
                                                        width: 100%;
                                                        border-collapse: separate;

                                                        border-spacing: 0;
                                                        border: 2px dashed rgba(99, 102, 241, 0.18);
                                                        border-radius: 10px;
                                                        overflow: hidden;
                                                        background: #fff;
                                                    }

                                                    .room-table td:first-child,
                                                    .room-table th:first-child {
                                                        padding-left: 5px !important;
                                                    }

                                                    .room-table td:last-child,
                                                    .room-table th:last-child {
                                                        padding-right: 5px !important;
                                                    }

                                                    .table-scroll {
                                                        max-height: 330px;
                                                        /* bebas ubah tinggi */
                                                        overflow-y: auto;
                                                        overflow-x: hidden;
                                                        border-radius: 10px;
                                                        /* biar tetap rapi */
                                                    }

                                                    .room-table tbody tr {
                                                        border-bottom: 2px dashed rgba(99, 102, 241, 0.18) !important;

                                                    }
                                                </style>


                                                <div class="modal fade" id="modalKamar" tabindex="-1">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Pilih Kamar</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <?php

                                                                    $tanggal_check = date('Y-m-d');
                                                                    $query = "SELECT * FROM data_kamar WHERE id_hotel = '$idHotel' ORDER BY no_kamar ASC";
                                                                    $result = mysql_query($query) or die('Query Error: ' . mysql_error());

                                                                    while ($kamar = mysql_fetch_assoc($result)) {
                                                                        $idKamar = $kamar['id_kamar'];
                                                                        $noKamar = $kamar['no_kamar'];

                                                                        // Cek apakah kamar ini sedang dibooking hari ini (overlap dengan hari ini)
                                                                        $qBooking = "SELECT id_transaksi FROM data_booking 
                                                                        WHERE id_hotel = '$idHotel'
                                                                        AND ('$tanggal_check' BETWEEN waktu_checkin AND DATE_SUB(waktu_checkout, INTERVAL 1 DAY))
                                                                        AND (id_kamar LIKE '%" . $idKamar . "%') 
                                                                        AND status_transaksi = 'Booking'";

                                                                        $resBooking = mysql_query($qBooking);
                                                                        $sedangDibooking = mysql_num_rows($resBooking) > 0;
                                                                        $statusAwal = $kamar['status_kamar']; // Kosong atau Terisi

                                                                        // Prioritas status: Booking > Terisi > Kosong
                                                                        if ($sedangDibooking) {
                                                                            $badgeClass = 'bg-primary';      // biru
                                                                            $statusText = 'Booking';
                                                                            $bgcolor    = 'background-color: #f6f7f9;';
                                                                        } elseif ($statusAwal == 'Terisi') {
                                                                            $badgeClass = 'bg-danger';
                                                                            $statusText = 'Terisi';
                                                                            $bgcolor    = 'background-color: #f6f7f9;';
                                                                        } else {
                                                                            $badgeClass = 'bg-success';
                                                                            $statusText = 'Tersedia';
                                                                            $bgcolor    = 'background-color: #ffffff;';
                                                                        }
                                                                    ?>
                                                                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                                                                            <div class="card kamar-card p-2 pilih-kamar-item"
                                                                                data-kamar="<?= htmlspecialchars($noKamar) ?>"
                                                                                style="height: 150px; <?= $bgcolor ?> display: flex; flex-direction: column; justify-content: space-between;">

                                                                                <div style="margin-top: 10px;">
                                                                                    <div class="fw-bold text-primary" style="font-size: 13px;">
                                                                                        Kamar <?= htmlspecialchars($noKamar) ?>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="mt-auto" style="margin-bottom: 10px;">
                                                                                    <div class="text-left small mb-2">
                                                                                        <?= ucwords(baca_database("", "tipe_kamar", "SELECT * FROM data_tipe_kamar WHERE id_tipe_kamar='" . $kamar['id_tipe_kamar'] . "'")) ?>
                                                                                        <br>
                                                                                        <span class="text-dark"><?= rupiah($kamar['harga_harian']) ?> @ 1 Days</span>
                                                                                    </div>
                                                                                    <span style="color: white;" class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>





                                                <label class="form-label">List Kamar</label>



                                                <div class="table-scroll" id="list_kamar">

                                                </div>



                                            </div>
                                        </div>
                                    </div>


                                    <!-- Informasi Transaksi -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Transaksi</div>



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

                                                            <input class="form-control" type="number" name="discount" id="discount" placeholder="Discount " value='0'>

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Potongan</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rp</span>

                                                            <input class="form-control" type="number" name="potongan_harga" id="potongan_harga" placeholder="potongan_harga " value='0'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tambahan Biaya -->
                                                <label class="form-label">Tambahan Biaya</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>

                                                    <input class="form-control" type="varchar" name="tambahan" id="tambahan" placeholder="Biaya Tambahan " value='0'>



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
                                                                <h5 class="modal-title" id="noteModalLabel">Catatan Tambahan Biaya Booking</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" name="deskripsi" rows="4" placeholder="Tulis catatan di sini..."></textarea>
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
                                                    <input type="hidden" name="harga" id='harga_input'>
                                                    <input type="text" readonly class="form-control" id='harga'>





                                                </div>

                                                <!-- Pajak Checkbox -->
                                                <div class="form-check mt-2 mb-3">
                                                    <?php
                                                    $nilai_pajak = pengaturan_aplikasi('persentase_pajak');
                                                    $defaut_checklist = pengaturan_aplikasi('default_checklist_pajak');
                                                    if ($defaut_checklist == "1") {
                                                        $checked = ($nilai_pajak > 0) ? "checked" : "";
                                                    } else {
                                                        $checked =  "";
                                                    }

                                                    $nilai_input = ($nilai_pajak > 0) ? $nilai_pajak : 0;
                                                    ?>
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-check-input me-2" type="checkbox" value="1" id="pajakCheck" name="pajak" <?= $checked; ?>>

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
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalPembayaran"><i class="fa fa-save"></i> Booking</button>
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
                                        <h5 class="modal-title">Proses Pembayaran DP</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">

                                        <input type="hidden" name="id_metode_pembayaran_deposit" id="id_metode_pembayaran_deposit">
                                        <input type="hidden" name="no_rekening_deposit" id="no_rekening_deposit" value='-'>
                                        <input type="hidden" onclick='pilih_metode_deposit()' class="form-control" name="metode_pembayaran_deposit" id="metode_pembayaran_deposit" value='' readonly>
                                        <input type="hidden" class="form-control" id="nominal_deposit" name="nominal_deposit">
                                        <input class="form-control" type="hidden" name="deposit" id="deposit" value="0">
                                        <input type="hidden" name="" id='grandtotal_ndepo_hidden'>
                                        <input type="hidden" readonly class="form-control" id="grand_total_plus_depo" name="grand_total_plus_depo">




                                        <div class="d-flex justify-content-between align-items-center">


                                            <div class='d-flex align-items-center'>

                                                <label class="form-label">Grand Total</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>

                                            <input type="text" readonly class="form-control" id="grand_total" name="grand_total">
                                        </div>




                                        <label class="form-label">Metode Pembayaran </label>
                                        <input type="hidden" name="id_metode_pembayaran" id="id_metode_pembayaran">
                                        <input type="hidden" name="no_rekening" id="no_rekening" value='-'>

                                        <div class="input-group mb-2">
                                            <button type="button" onclick='pilih_metode_pembayaran()' class="btn btn-secondary">
                                                Metode
                                            </button>
                                            <input type="text" onclick='pilih_metode_pembayaran()' class="form-control" name="metode_pembayaran" id="metode_pembayaran" value='' required readonly>
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center">

                                            <label class="form-label" onclick="Swal.fire({
                                                title: 'Informasi Downpayment',
                                                text: 'Catatan : Jumlah nominal Dp minimal sebesar 10% dari total transaksi yang dilakukan oleh pelanggan.',
                                                confirmButtonText: 'Mengerti'
                                                })">
                                                Nominal DP (Down Payment) <i style="color:#bf2b2763" class="fa fa-info-circle"></i>

                                            </label>
                                            <div class='d-flex align-items-center'>

                                                <label for="" class="form-check-label text-dark"></label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" class="form-control" id="nominal" name="nominal">
                                            <input class="form-control" type="text" name="nominal_bayar" id="nominal_bayar" value="">
                                        </div>








                                        <label class="form-label">Sisa Pembayaran</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>

                                            <input type="hidden" class="form-control" name="kembalian" id='kembalian' value='0'>
                                            <input type="hidden" class="form-control" name="kembalian_value" id='kembalian_value' value='0'>
                                            <input type="hidden" class="form-control" name="sisa" id='sisa' value='0'>
                                            <input type="text" class="form-control" name="sisa_value" id='sisa_value' value='0'>
                                        </div>




                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id='simpan_data'>Proses Booking</button>
                                        </div>

                                        <div class="mb-2" id="prediksi_buttons" style="display:flex;gap:5px;flex-wrap:wrap;visibility: hidden;"></div>


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
                                            <th>Jml Transaksi (<?= $namaHotel ?>)</th>
                                            <th>Total Transaksi</th>

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
                                            <input type="hidden" name="id_admin" value='<?php
                                                                                        $username = decrypt($_COOKIE['jenenge']);
                                                                                        echo baca_database("", "id_admin", "select * from data_admin where username='$username'") ?>'>
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
            paymentDeposit: document.getElementById('nominal_deposit'),
            displayDeposit: document.getElementById('deposit'),
            change: document.getElementById('kembalian'),
            changeDisplay: document.getElementById('kembalian_value'),
            remaining: document.getElementById('sisa'),
            remainingDisplay: document.getElementById('sisa_value'),
            harga_kamar: document.getElementById('harga_kamar'),
            priceCut: document.getElementById('potongan_harga'),
            form: document.getElementById('formini'),
            saveButton: document.getElementById('simpan_data'),
            grandplusdepo: document.getElementById('grand_total_plus_depo'),
            grandplusdepohidden: document.getElementById('grandtotal_ndepo_hidden')
        };



        // Constants


        const MS_PER_DAY = 24 * 60 * 60 * 1000;

        // Format number to Rupiah
        const formatRupiah = (value) => new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value)



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
            const finalPrice = subtotal * (1 + taxPercent / 100)

            // Update displays
            elements.roomPrice.value = formatRupiah(basePrice);

            elements.priceInput.value = Math.floor(finalPrice);
            elements.priceDisplay.value = formatRupiah(Math.floor(finalPrice));
            elements.grandtotal.value = formatRupiah(Math.floor(finalPrice));

            updatePaymentCalculations();

            createPrediksiButtons(Math.floor(finalPrice));
            // Set default prediksi pertama
            document.getElementById('nominal_bayar').value = "";
            document.getElementById('nominal').value = "";

        };



        function refreshListKamar() {

            $.post('ajax_load_list_kamar.php', {
                id_transaksi: idTransaksi
            }, function(data) {
                $('#list_kamar').html(data);
                refreshTotalHarga();
            });
        }

        function refreshTotalHarga() {
            $.post('total_harga.php', {
                id_transaksi: idTransaksi
            }, function(res) {

                $('#harga_kamar').val(res.total);
                $('#total_harga_kamar').val(res.format);
                updateFinalPrice();


            }, 'json');
        }


        // Jalankan pertama kali saat halaman dibuka
        $(document).ready(function() {
            refreshListKamar();

            // Buka modal pilih kamar
            $('#pilih_kamar, #btn_pilih_kamar').on('click', function() {
                new bootstrap.Modal(document.getElementById('modalKamar')).show();
            });
        });

        // Event klik card kamar (pakai event delegation karena card di-generate PHP)
        $(document).on('click', '.pilih-kamar-item', function() {
            var badge = $(this).find('.badge').text().trim();
            if (badge === 'Terisi') {
                Swal.fire({
                    icon: 'error',
                    title: 'Kamar Sedang Digunakan',
                    text: 'Anda tidak dapat melakukan transaksi untuk kamar ini.',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (badge === 'Booking') {
                Swal.fire({
                    icon: 'info',
                    title: 'Kamar Sudah Dibooking',
                    text: 'Anda tidak dapat melakukan transaksi untuk kamar ini.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            var kamar = $(this).data('kamar');

            // Tutup modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalKamar'));
            modal.hide();

            // Tampilkan input jumlah tamu
            setTimeout(function() {
                showJumlahTamu(kamar);
            }, 300);
        });

        function showJumlahTamu(kamarDipilih) {
            Swal.fire({
                title: "Jumlah Tamu - Kamar " + kamarDipilih,
                width: 500,
                html: `
                                                                            <style>
                                                                                .tamu-wrapper {border:1px solid #cdd2dd;border-radius:10px;display:flex;overflow:hidden;width:100%;margin-top:10px;}
                                                                                .tamu-label {background:#f8f9fa;color:#3a3f4b;padding:12px;width:100px;text-align:center;border-right:1px solid #cdd2dd;display:flex;align-items:center;justify-content:center;font-weight:500;}
                                                                                .tamu-input {width:80px;padding:12px;text-align:center;border:none;outline:none;font-size:16px;border-right:1px solid #cdd2dd;}
                                                                                .tamu-input:last-child {border-right:none !important;}
                                                                            </style>
                                                                            <div class="tamu-wrapper">
                                                                                <div class="tamu-label">Dewasa</div>
                                                                                <input id="dewasaVal" type="number" min="1" value="1" class="tamu-input">
                                                                                <div class="tamu-label">Anak</div>
                                                                                <input id="anakVal" type="number" min="0" value="0" class="tamu-input">
                                                                            </div>
                                                                        `,
                confirmButtonText: "Simpan",
                preConfirm: () => {
                    const dewasa = document.getElementById("dewasaVal").value;
                    const anak = document.getElementById("anakVal").value;
                    if (dewasa < 1) {
                        Swal.showValidationMessage('Minimal 1 dewasa');
                        return false;
                    }
                    return {
                        dewasa: dewasa,
                        anak: anak
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post('proses_simpan_list.php', {
                        id_transaksi: idTransaksi,
                        jumlah_hari: document.getElementById('jumlah_hari').value,
                        no_kamar: kamarDipilih,
                        jumlah_dewasa: result.value.dewasa,
                        jumlah_anak_anak: result.value.anak
                    }, function(res) {
                        if (res.status === 'success') {
                            // Update field yang terlihat
                            $('#pilih_kamar').val(kamarDipilih);
                            $('#jumlah_dewasa').val(result.value.dewasa);
                            $('#jumlah_anak_anak').val(result.value.anak);

                            // Refresh tabel list kamar
                            refreshListKamar();

                            Swal.fire('Berhasil!', 'Kamar ' + kamarDipilih + ' ditambahkan ke daftar', 'success');

                        } else {
                            Swal.fire('Gagal', res.msg || 'Terjadi kesalahan saat menyimpan', 'error');
                        }
                    }, 'json').fail(function() {
                        Swal.fire('Error', 'Tidak dapat terhubung ke server', 'error');
                    });
                }
            });
        }

        $(document).on("click", ".hapus-kamar", function(e) {
            e.preventDefault();

            const idKamar = $(this).data("id");

            Swal.fire({
                title: "Hapus Kamar?",
                text: "Data kamar ini akan dihapus dari transaksi.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.post("ajax_hapus_list_kamar.php", {
                            id: idKamar
                        }, function(response) {

                            // =======================
                            // HANDLE SUCCESS / ERROR
                            // =======================

                            if (response.status === "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: response.message,
                                    timer: 1300,
                                    showConfirmButton: false
                                });

                                refreshListKamar(); // refresh tabel
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal",
                                    text: response.message
                                });
                            }

                        }, "json")
                        .fail(function() {
                            Swal.fire({
                                icon: "error",
                                title: "Kesalahan",
                                text: "Tidak dapat terhubung ke server."
                            });
                        });

                }
            });
        });





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
            const grandplusdeposit = Number(elements.grandplusdepohidden.value) || 0;
            const deposit = Number(elements.paymentDeposit.value) || 0;

            elements.paymentDisplay.value = formatRupiah(payment);

            if (payment >= total) {
                let change = 0;
                if (deposit > 0) {
                    change = payment - (grandplusdeposit);
                } else {
                    change = payment - (total);
                }

                if (change < 0) {
                    elements.change.value = 0;
                    elements.changeDisplay.value = formatRupiah(0);
                } else {
                    elements.change.value = change;
                    elements.changeDisplay.value = formatRupiah(change);
                }
                elements.remaining.value = 0;
                elements.remainingDisplay.value = '0';
            } else {
                let remaining = 0;
                if (deposit > 0) {
                    remaining = (grandplusdeposit) - payment;
                } else {
                    remaining = (total) - payment;
                }

                elements.change.value = 0;
                elements.changeDisplay.value = '0';
                elements.remaining.value = remaining;
                elements.remainingDisplay.value = formatRupiah(remaining);
            }

        };
        const updateGrandTotal = () => {

            const grand_total = Number(elements.priceInput.value) || 0;
            const nominal_deposit = Number(elements.displayDeposit.value) || 0;
            elements.grandplusdepo.value = formatRupiah(Number(grand_total + nominal_deposit));
            elements.grandplusdepohidden.value = grand_total + nominal_deposit;
            elements.paymentDeposit.value = nominal_deposit;
            elements.change.value = 0;
            elements.changeDisplay.value = formatRupiah(0);
            createPrediksiButtons(Math.floor(grand_total + nominal_deposit));

        };



        // Update checkout date based on checkin and days
        const updateCheckoutDate = () => {
            const checkin = new Date(elements.checkin.value);
            const days = parseInt(elements.days.value) || 0;
            const checkout = new Date(checkin.getTime() + days * MS_PER_DAY);
            elements.checkout.value = checkout.toISOString().split('T')[0];


            updateFinalPrice();
            updateJumlahHariTransaksi(idTransaksi, days);
        };


        const updateJumlahHariTransaksi = (idTransaksi, jumlahHari) => {
            const formData = new FormData();
            formData.append('id_transaksi', idTransaksi);
            formData.append('jumlah_hari', jumlahHari);

            fetch("update_jumlah_hari.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "success") {

                        refreshListKamar();

                    } else {
                        console.error("Gagal update jumlah hari:", data.msg);
                    }
                })
                .catch(err => console.error("Fetch error:", err));
        };



        // Update days based on checkin and checkout
        const updateDays = () => {
            const checkin = new Date(elements.checkin.value);
            const checkout = new Date(elements.checkout.value);
            const days = Math.floor((checkout - checkin) / MS_PER_DAY);
            days == 0 ? elements.days.value = 1 : elements.days.value = days;


            updateFinalPrice();
        };



        // Event Listeners
        elements.days.addEventListener('input', updateCheckoutDate);
        elements.checkin.addEventListener('change', updateCheckoutDate);
        elements.checkout.addEventListener('change', updateDays);
        [elements.additionalFee, elements.discount, elements.priceCut, elements.taxPercent]
        .forEach(el => el.addEventListener('input', updateFinalPrice));
        elements.payment.addEventListener('input', updatePaymentCalculations);
        elements.displayDeposit.addEventListener('input', updateGrandTotal);
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
                if (elements.grandplusdepohidden.value > elements.payment.value) {
                    Swal.fire({
                        title: 'Peringatan!',
                        icon: 'info',
                        text: 'Nominal Bayar yang digunakan tidak cukup, silahkan input ulang',

                    });
                } else {
                    elements.form.submit();

                }
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
                              
    <?php
                            if (strpos(strtolower($data['metode_pembayaran']), 'qris') !== false || strpos(strtolower($data['metode_pembayaran']), 'transfer') !== false) {
    ?>
                         <td>
                            <button style="background-color:#bf2b27;border-radius:10px;color:#fff;width:120px;height:30px;border:none;display:flex;align-items:center;justify-content:center;gap:6px;" 
                                class="pil_metode" 
                                data-id="<?php echo $data['id_metode_pembayaran']; ?>" 
                                data-name="<?php echo ucwords($data['metode_pembayaran']); ?>" 
                                data-rekening="<?php echo $data['rekening'] ?>"
                                data-nominal="${ elements.grandplusdepohidden.value}">
                                <i style="color:white" class="fa fa-credit-card"></i> Pilih
                            </button>
                        </td>
    <?php
                            } else {
    ?>
                         <td>
                            <button style="background-color:#bf2b27;border-radius:10px;color:#fff;width:120px;height:30px;border:none;display:flex;align-items:center;justify-content:center;gap:6px;" 
                                class="pil_metode" 
                                data-id="<?php echo $data['id_metode_pembayaran']; ?>" 
                                data-name="<?php echo ucwords($data['metode_pembayaran']); ?>" 
                                data-rekening="<?php echo $data['rekening'] ?>"
                                data-nominal="0">
                                <i style="color:white" class="fa fa-credit-card"></i> Pilih
                            </button>
                        </td>
<?php
                            } ?>

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
                            document.getElementById('nominal').value = button.dataset.nominal;


                            document.getElementById('nominal_bayar').value = button.dataset.nominal;
                            document.getElementById('nominal').value = button.dataset.nominal;


                            Swal.close();
                        });
                    });

                }
            });

        };
    });
    window.pilih_metode_deposit = () => {
        const grand_total = document.getElementById('grand_total');
        Swal.fire({
            title: 'Pilih Metode Deposit',

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
                            <th>Metode Deposit</th>
                            <th>Bank</th>
                            <th>Rekening</th>
                            <th>Atas Nama</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_metode_bayar = mysql_query("SELECT mp.*, b.* 
FROM data_metode_pembayaran mp
LEFT JOIN data_bank b ON mp.id_bank = b.id_bank
WHERE b.id_hotel = '$idHotel'
  AND (
      LOWER(mp.metode_pembayaran) LIKE '%tunai%' 
      OR LOWER(mp.metode_pembayaran) LIKE '%transfer%'
  )") or die(mysql_error());
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
        data-rekening="<?php echo $data['rekening'] ?>"
        >
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

                        document.getElementById('id_metode_pembayaran_deposit').value = button.dataset.id;
                        document.getElementById('metode_pembayaran_deposit').value = button.dataset.name;
                        document.getElementById('no_rekening_deposit').value = button.dataset.rekening;

                        Swal.close();
                    });
                });

            }
        });
    }

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
            if (elements.grandplusdepohidden.value > elements.payment.value) {
                Swal.fire({
                    title: 'Peringatan!',
                    icon: 'info',
                    text: 'Nominal Bayar yang digunakan tidak cukup, silahkan input ulang',

                });
            } else {
                elements.form.submit();

            }
        }
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
            if (elements.grandplusdepohidden.value > elements.payment.value) {
                Swal.fire({
                    title: 'Peringatan!',
                    icon: 'info',
                    text: 'Nominal Bayar yang digunakan tidak cukup, silahkan input ulang'

                });
            } else {
                elements.form.submit();

            }
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
                        frekuensi_member: element.member_cabang_ini,
                        frekuensi_lain: element.member_lain
                    });

                    results.innerHTML += `
      <tr>
        <td><a href='../data_pelanggan/index.php?input=edit&proses=${element.id}'>&nbsp;&nbsp;${element.nama}</a></td>
        <td>${element.identitas}</td>
        <td>${element.no_identitas}</td>
        <td>${element.no_hp}</td>
        <td>${element.jenis_kelamin}</td>
        <td>${element.alamat}</td>
        <td>${element.member_cabang_ini} Transaksi</td>
        <td>${element.member_lain} Transaksi</td>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


</script>