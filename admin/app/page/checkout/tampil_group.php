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
                        background-color: #bf2b27;
                        cursor: pointer;
                        padding: 10px;
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

                    <?php
                    require_once '../../../include/all_include.php';

                    $id_kamar = decrypt($_GET['id']);
                    $id_trx = decrypt($_GET['trx']);
                    $id_hotel = decrypt($_COOKIE['id_hotel']);
                    $username = decrypt($_COOKIE['jenenge']);
                    $nama_hotel = baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'");
                    $alamat = baca_database("", "alamat", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'");



                    // Fetch transaction details
                    $query = mysql_query("SELECT dt.*, dp.nama 
                                             FROM data_transaksi dt
                                             LEFT JOIN data_pelanggan dp ON dt.id_pelanggan = dp.id_pelanggan
                                             WHERE dt.id_transaksi='$id_trx' AND dt.status_transaksi != 'Selesai'");
                    if (!$query) {
                        echo "<script>alert('Error: " . mysql_error() . "');history.back();</script>";
                        die();
                    }
                    $data = mysql_fetch_array($query);

                    if (!$data) {
                        echo "<script>alert('Data transaksi tidak ditemukan atau sudah selesai');history.back();</script>";
                        die();
                    }

                    // Calculate pricing based on transaction type
                    $harga_per_hari = $data['harga_kamar_harian'];
                    $harga_per_bulan = $data['harga_kamar_bulanan'];
                    $jumlah_hari = $data['jumlah_hari'];



                    $biaya_tambahan_checkin = $data['biaya_tambahan_checkin'];
                    $deskripsi_biaya_checkin = $data['deskripsi_biaya_checkin'];
                    if ($deskripsi_biaya_checkin == "") {
                        $deskripsi_biaya_checkin = "tidak ada catatan tambahan biaya check-in";
                    }
                    $tambahan_out = $data['biaya_tambahan_checkout'];
                    $potongan_harga = $data['potongan_harga'];
                    $pajak = $data['pajak'];
                    $persentase_pajak = $data['persentase_pajak'];
                    $total_bayar = $data['total_bayar'];

                    $id_pelanggan = $data['id_pelanggan'];
                    $sqlpelanggan = mysql_query("SELECT * FROM data_pelanggan where id_pelanggan = '$id_pelanggan'");
                    $data_pelanggan = mysql_fetch_array($sqlpelanggan);

                    ?>



                    <div class="mb-4">
                        <div class="cardcheckin-body">
                            <div class="d-flex align-items-center mb-3">


                                <div class="room-badge">
                                    Checkout
                                </div>



                                <h4 class="mb-0"><i class="fas fa-sign-out-alt text-danger"></i> Check-out <?php echo $nama_hotel; ?></h4>
                            </div>

                            <div class="row g-3">
                                <!-- Informasi Kamar -->
                                <div class="col-md-4">
                                    <div class="cardcheckin h-100">
                                        <div class="cardcheckin-body">
                                            <div class="card-group-title">Informasi Pemesan</div>
                                            <label class="form-label">Nama </label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" readonly value="<?php echo ucwords($data_pelanggan['nama']); ?>">

                                            </div>
                                            <label class="form-label">Tanggal</label>
                                            <input type="text" class="form-control mb-2" readonly value="20/05/2013">

                                            <label class="form-label">Channel</label>
                                            <input type="text" class="form-control mb-2" readonly value="Walk-In Guest">


                                            <label class="form-label">Tanggal Cek In</label>
                                            <input type="text" class="form-control mb-2" readonly value="<?php echo format_indo($data['waktu_checkin']); ?>">

                                            <label class="form-label">Tanggal Cek Out <b><?php
                                                                                            $today = strtotime(date('Y-m-d'));
                                                                                            $checkout = strtotime($data['waktu_checkout']);
                                                                                            $hari_tersisa = ($checkout - $today) / (60 * 60 * 24);
                                                                                            if ($hari_tersisa > 0) {
                                                                                                $hari_tersisa = ceil($hari_tersisa);
                                                                                                echo "<span class='text-danger'>{$hari_tersisa}&nbsp;hari&nbsp;lagi</span>";
                                                                                            } elseif ($hari_tersisa == 0) {
                                                                                                echo "<span class='text-success'>Hari ini</span>";
                                                                                            } else {
                                                                                            }
                                                                                            ?></b></label>
                                            <input type="text" class="form-control mb-2" readonly value="<?php echo str_replace(' ', '&nbsp;', format_indo($data['waktu_checkout'])) ?>">


                                            <?php if ($data['jenis_transaksi'] === 'bulanan') { ?>
                                                <label class="form-label">Jumlah Bulan</label>
                                                <div class="input-group mb-2">

                                                    <input type="text" class="form-control" readonly value="<?php echo $j_hari = $data['jumlah_hari']; ?>">

                                                    <span class="input-group-text">Bulan</span>
                                                </div>
                                            <?php } else { ?>
                                                <label class="form-label">Jumlah Hari</label>
                                                <div class="input-group mb-2">

                                                    <input type="text" class="form-control" readonly value="<?php echo $j_hari = $data['jumlah_hari']; ?>">

                                                    <span class="input-group-text">Hari</span>
                                                </div>
                                            <?php } ?>



                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Pelanggan -->
                                <div class="col-md-4">
                                    <div class="cardcheckin h-100">
                                        <div class="cardcheckin-body">
                                            <div class="card-group-title">Informasi kamar</div>

                                            <label class="form-label">List Kamar</label>

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

                                            <?php
                                            $harga_kamar_total = 0;
                                            $query_kamar = mysql_query("
                                            SELECT * FROM data_transaksi_list_kamar 
                                            WHERE id_transaksi = '$id_trx' 
                                            ORDER BY waktu DESC
                                        ");

                                            $ada_kamar = mysql_num_rows($query_kamar) > 0;
                                            ?>

                                            <div class="table-scroll">
                                                <table class="room-table table align-middle">
                                                    <thead>
                                                        <tr style="background-color: #f9f9f9;">
                                                            <th scope="col">Kamar</th>
                                                            <th scope="col" class="text-center">Dewasa</th>
                                                            <th scope="col" class="text-center">Anak</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php if ($data['jenis_transaksi'] == 'bulanan') { ?>

                                                            <?php if ($ada_kamar): ?>
                                                                <?php while ($k = mysql_fetch_assoc($query_kamar)): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="#"
                                                                                class="hapus-kamar"
                                                                                style="color:#007BFF; font-weight:bold; text-decoration:none;">
                                                                                <?php echo htmlspecialchars($k['no_kamar']); ?>
                                                                            </a>
                                                                            <br>
                                                                            <?php echo number_format((int)$k['harga_kamar_bulanan'], 0, ',', '.'); ?>
                                                                            @ <?php echo (int)$k['jumlah_hari']; ?>
                                                                            <?php echo ($k['jumlah_hari'] > 1) ? 'Months' : 'Month'; ?>
                                                                        </td>
                                                                        <td class="text-center"><?php echo htmlspecialchars($k['jumlah_dewasa']); ?></td>
                                                                        <td class="text-center"><?php echo htmlspecialchars($k['jumlah_anak_anak']); ?></td>
                                                                    </tr>
                                                                <?php
                                                                    $harga_kamar_total = $harga_kamar_total + ($k['harga_kamar_bulanan'] * $k['jumlah_hari']);

                                                                endwhile; ?>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td colspan="3" class="text-center py-4">
                                                                        <img src="https://media.baamboozle.com/uploads/images/113260/1638441135_66175_gif-url.gif"
                                                                            width="60" class="mb-2 opacity-75">
                                                                        <div class="fw-semibold text-muted">Belum ada kamar yang dipilih</div>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>

                                                        <?php } else { ?>

                                                            <?php if ($ada_kamar): ?>
                                                                <?php while ($k = mysql_fetch_assoc($query_kamar)): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="#"
                                                                                class="hapus-kamar"
                                                                                style="color:#007BFF; font-weight:bold; text-decoration:none;">
                                                                                <?php echo htmlspecialchars($k['no_kamar']); ?>
                                                                            </a>
                                                                            <br>
                                                                            <?php echo number_format((int)$k['harga_kamar_harian'], 0, ',', '.'); ?>
                                                                            @ <?php echo (int)$k['jumlah_hari']; ?>
                                                                            <?php echo ($k['jumlah_hari'] > 1) ? 'Days' : 'Day'; ?>
                                                                        </td>
                                                                        <td class="text-center"><?php echo htmlspecialchars($k['jumlah_dewasa']); ?></td>
                                                                        <td class="text-center"><?php echo htmlspecialchars($k['jumlah_anak_anak']); ?></td>
                                                                    </tr>
                                                                <?php
                                                                    $harga_kamar_total = $harga_kamar_total + ($k['harga_kamar_harian'] * $k['jumlah_hari']);

                                                                endwhile; ?>
                                                            <?php else: ?>
                                                                <tr>
                                                                    <td colspan="3" class="text-center py-4">
                                                                        <img src="https://media.baamboozle.com/uploads/images/113260/1638441135_66175_gif-url.gif"
                                                                            width="60" class="mb-2 opacity-75">
                                                                        <div class="fw-semibold text-muted">Belum ada kamar yang dipilih</div>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>

                                                        <?php } ?>
                                                    </tbody>
                                                </table>
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
                                                <input type="text" class="form-control" readonly value="<?php echo rupiah_format($harga_kamar_total); ?>">
                                            </div>



                                            <div class="row g-2 mb-2">
                                                <div class="col-6">
                                                    <label class="form-label">Diskon</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">%</span>
                                                        <input type="text" class="form-control" readonly value="<?php echo $data['discount']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Potongan</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="text" class="form-control" readonly value="<?php echo rupiah_format($potongan_harga); ?>">
                                                    </div>
                                                </div>
                                            </div>


                                            <p class="form-label mb-1">Grandtotal ( <label class="form-label" onclick="Swal.fire({
                                                                                title: 'Tambahan Biaya Check-in',
                                                                                text: 'Catatan : <?php echo addslashes($deskripsi_biaya_checkin); ?>',
                                                                                confirmButtonText: 'Tutup'
                                                                        })">
                                                    Tambahan <i style="color:#bf2b2763" class="fa fa-info-circle"></i> : <?php echo rupiah_format($biaya_tambahan_checkin); ?>

                                                </label>)</p>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" class="form-control" readonly id="total_bayar" value="<?php echo rupiah_format($total_bayar); ?>">
                                                <span class="input-group-text">Status : Lunas</span>
                                            </div>

                                            <div class="form-check mt-2 mb-0">
                                                <?php if ($data['persentase_pajak'] > 0) { ?>
                                                    <input class="form-check-input me-2" type="checkbox" id="pajakCheck" disabled checked>
                                                    <label class="form-label" for="pajakCheck">Pajak (<?php echo $data['persentase_pajak']; ?>%)</label>
                                                <?php } else { ?>
                                                    <input class="form-check-input me-2" type="checkbox" id="pajakCheck" disabled>
                                                    <label class="form-label" for="pajakCheck">Pajak (<?php echo $data['persentase_pajak']; ?>%)</label>
                                                <?php } ?>
                                            </div>






                                            <hr class="mb-6">
                                            <label class="form-label">Tambahan Biaya Checkout</label>
                                            <div class="input-group mb-4">
                                                <span class="input-group-text">Rp</span>

                                                <input type="number" name="tambahan" id="tambahan" class="form-control" placeholder="Biaya Tambahan" value="" required>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#noteModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                            </div>








                                            <input type="hidden" class="form-control <?php echo $data['status_transaksi'] == 'Lunas' ? 'text-success' : 'text-danger'; ?>" readonly value="<?php echo $data['status_transaksi']; ?>">



                                            <div class="mt-auto d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">Batal</button>
                                                <?php if ($data['status_transaksi'] != 'Selesai') { ?>
                                                    <button type="button" class="btn btn-danger" id="open_checkout"><i class="fa fa-save"></i> Checkout</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <form action="proses_simpan_checkout_group.php" method="get" id='formini' enctype="multipart/form-data">
                        <input type="hidden" name="id_hotel" id="id_hotel" value="<?php echo $id_hotel; ?>">
                        <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
                        <input type="hidden" name="total_bayar_hidden" id="total_bayar_hidden" value="<?php echo $total_bayar; ?>">
                        <input type="hidden" name="persentase_pajak" id="persentase_pajak" value="<?php echo $persentase_pajak; ?>">
                        <input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo $total_bayar; ?>">">

                        <div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPembayaranLabel">Proses Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <label class="form-label">Informasi Deposit</label>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <input type="hidden" name="id_metode_deposit" id="id_metode_deposit">
                                            <div class="input-group mb-2">
                                                <span class='input-group-text'>Metode</span>
                                                <input type="text" class="form-control" readonly id="metode_deposit" value='<?= $data['metode_deposit'] ?>' readonly>

                                            </div>


                                            <div class="input-group mb-2 ms-2">
                                                <span class="input-group-text">Rp</span>
                                                <input type="hidden" id="nominal_deposit">
                                                <input type="number" class="form-control" id="nominal_deposit" value="<?= $data['nominal_deposit'] ?>" min="0" readonly>
                                            </div>
                                        </div>

                                        <label id="labelTambahan" class="form-label">
                                            Tambahan Biaya Checkout
                                            <span id="infoPajak" style="cursor:pointer; display:none; color:#0d6efd; margin-left:5px;"
                                                onclick="showInfoPajak()">
                                                <i style="color:#bf2b27" class="fa fa-info-circle"></i>
                                            </span>
                                        </label>


                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" readonly class="form-control" id="total_tambahan_non_pajak" name="total_tambahan_non_pajak">
                                            <input type="hidden" readonly class="form-control" id="total_tambahan" name="total_tambahan">
                                            <input type="text" readonly class="form-control" id="total_tambahan_display">
                                        </div>
                                        <label class="form-label">Metode Pembayaran</label>
                                        <input type="hidden" name="id_metode_pembayaran" id="id_metode_pembayaran_modal">
                                        <div class="input-group mb-2">

                                            <button type="button" class="btn btn-secondary" onclick="pilih_metode_pembayaran()"> Metode</button>
                                            <input type="text" onclick="pilih_metode_pembayaran()" class="form-control" readonly id="metode_pembayaran" name="metode_pembayaran">
                                        </div>

                                        <label class="form-label">Nominal Bayar</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" name="nominal" id="nominal">
                                            <input type="number" class="form-control" id="nominal_bayar_modal" value="0" min="0">
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted" style="font-size:0.7rem;">Estimasi Nominal Pembayaran:</small>
                                            <div class="mb-2" id="prediksi_buttons_modal" style="display:flex; gap:5px; flex-wrap:wrap;"></div>
                                        </div>
                                        <label class="form-label">Kembalian</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" name="kembalian" id="kembalian" value="0">
                                            <input type="text" class="form-control" readonly id="kembalian_value_modal" value="0">
                                        </div>
                                        <input type="hidden" name="sisa" id="sisa" value="0">
                                        <input type="hidden" id="sisa_value_modal" value="0">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-danger" id="simpan_data">Proses Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="modalKonfirmasiCheckout" tabindex="-1" aria-labelledby="modalKonfirmasiCheckoutLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalKonfirmasiCheckoutLabel">Konfirmasi Checkout</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Checkout Tanpa Biaya Tambahan,
                                        Tekan tombol <b>Proses Checkout</b> untuk melanjutkan proses checkout. Pastikan tidak ada biaya tambahan atau deposit yang belum tercatat.
                                        </p>
                                        <?php
                                        if ($data['nominal_deposit'] > 0) {
                                        ?>
                                            <p class="text-start fw-bold">Informasi Deposit</p>
                                            <div class="d-flex p-2 justify-between align-items-center">
                                                <div class="input-group me-3">

                                                    <span class="input-group-text">Metode</span>
                                                    <input type="text" class="form-control" value="<?= $data['metode_deposit'] ?>" readonly>
                                                </div>
                                                <div class="input-group">

                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control" value="<?= rupiah($data['nominal_deposit']) ?>" readonly>
                                                </div>


                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Proses Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Modal untuk Note -->
                        <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="noteModalLabel">Catatan Biaya Tambahan Check-out</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="form-control" name="tambahan_desc" id="desc_tambahan" rows="4" placeholder="Tulis catatan di sini..."></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Simpan</button>
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

<script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    window.pilih_metode_pembayaran = () => {
        Swal.fire({
            title: 'Pilih Metode Transaksi',
            showConfirmButton: false,
            showCancelButton: true,
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
                                $query_metode_bayar = mysql_query("SELECT * FROM data_metode_pembayaran LEFT JOIN data_bank ON data_metode_pembayaran.id_bank = data_bank.id_bank WHERE data_bank.id_hotel = '$id_hotel'") or die(mysql_error());
                                $no = 0;
                                while ($data_metode = mysql_fetch_array($query_metode_bayar)) {
                                    $no++;
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo ucwords($data_metode['metode_pembayaran']); ?></td>
                                        <td><?php echo ucwords($data_metode['nama_bank']); ?></td>
                                        <td><?php echo $data_metode['rekening']; ?></td>
                                        <td><?php echo ucwords($data_metode['atas_nama']); ?></td>
                                        <td>
                                            <button style="background-color:#bf2b27;border-radius:10px;color:#fff;width:120px;height:30px;border:none;display:flex;align-items:center;justify-content:center;gap:6px;" 
                                                    class="pil_metode" 
                                                    data-id="<?php echo $data_metode['id_metode_pembayaran']; ?>" 
                                                    data-name="<?php echo ucwords($data_metode['metode_pembayaran']); ?>">
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
                        document.getElementById('id_metode_pembayaran_modal').value = button.dataset.id;
                        document.getElementById('metode_pembayaran').value = button.dataset.name;
                        Swal.close();
                    });
                });
            }
        });
    };


    const persentase_pajak = <?= (int)$persentase_pajak ?>; // ambil dari PHP

    function showInfoPajak() {
        Swal.fire({
            title: 'Informasi Pajak',
            html: `Tambahan biaya checkout dikenakan PPN sebesar <b>${persentase_pajak}%</b>, 
               sesuai dengan ketentuan yang berlaku karena transaksi check-in telah dikenakan pajak.`,
            icon: 'info',
            confirmButtonText: 'Mengerti'
        });
    }


    const id_transaksi = document.getElementById('id_transaksi');
    const tambahan = document.getElementById('tambahan');
    const total_tambahan = document.getElementById('total_tambahan');
    const total_tambahan_non_pajak = document.getElementById('total_tambahan_non_pajak');
    const total_tambahan_display = document.getElementById('total_tambahan_display');
    const payment_nominal = document.getElementById('nominal');
    const payment_nominal_modal = document.getElementById('nominal_bayar_modal');
    const open_checkout = document.getElementById('open_checkout');
    if (open_checkout) {
        open_checkout.addEventListener('click', () => {
            const tambahan_value = Number(tambahan.value) || 0;






            if (tambahan_value > 0) {
                const modal = new bootstrap.Modal(document.getElementById('modalPembayaran'));

                let tambahan_final = Number(tambahan_value);
                let pajak_tambahan = 0;

                // kalau ada pajak
                if (persentase_pajak > 0) {
                    pajak_tambahan = Math.round(tambahan_value * persentase_pajak / 100);
                    tambahan_final = tambahan_value + pajak_tambahan;


                    document.querySelector('#labelTambahan').innerHTML =
                        `Tambahan Biaya Checkout + PPN(${persentase_pajak}%) 
             <span id="infoPajak" style="cursor:pointer; color:#0d6efd; margin-left:5px;"
                   onclick="showInfoPajak()">
                <i style="color:#bf2b2763" class="fa fa-info-circle"></i>
             </span>`;
                } else {
                    document.querySelector('#labelTambahan').innerHTML =
                        'Tambahan Biaya Checkout';
                }

                total_tambahan_non_pajak.value = tambahan_value;
                total_tambahan.value = tambahan_final;
                total_tambahan_display.value = formatRupiah(tambahan_final);
                payment_nominal.value = tambahan_final;
                payment_nominal_modal.value = tambahan_final;
                createPrediksiButtons(tambahan_final, 'prediksi_buttons_modal');
                modal.show();

            } else {
                const modal = new bootstrap.Modal(document.getElementById('modalKonfirmasiCheckout'));
                modal.show();
            }





        });
    }



    const elements = {


        payment: document.getElementById('nominal_bayar'),
        paymentModal: document.getElementById('nominal_bayar_modal'),
        paymentDisplay: document.getElementById('nominal'),
        paymentDisplayModal: document.getElementById('nominal'),
        change: document.getElementById('kembalian'),
        changeModal: document.getElementById('kembalian'),
        changeDisplay: document.getElementById('kembalian_value'),
        changeDisplayModal: document.getElementById('kembalian_value_modal'),
        remaining: document.getElementById('sisa'),
        remainingModal: document.getElementById('sisa'),
        remainingDisplay: document.getElementById('sisa_value'),
        remainingDisplayModal: document.getElementById('sisa_value_modal'),
        form: document.getElementById('formini'),
        proses_checkout: document.getElementById('simpan_data')


    };

    const formatRupiah = (value) =>
        new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0
        }).format(value);





    function createPrediksiButtons(total, containerId = 'prediksi_buttons') {
        const container = document.getElementById(containerId);
        if (!container) return;
        container.innerHTML = '';

        const nearest5k = Math.ceil(total / 5000) * 5000;
        const round200k = Math.ceil(total / 200000) * 200000;

        const prediksiArr = [total];
        if (nearest5k !== total) prediksiArr.push(nearest5k);
        if (round200k !== total && round200k !== nearest5k) prediksiArr.push(round200k);

        prediksiArr.forEach(val => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-light btn-sm';
            btn.style.padding = '4px 12px';
            btn.style.fontSize = '0.75rem';
            btn.style.opacity = '0.8';
            btn.style.borderColor = '#ccc';
            btn.innerText = val.toLocaleString('id-ID');
            btn.addEventListener('click', () => {
                if (containerId === 'prediksi_buttons') {
                    elements.payment.value = val;
                    elements.paymentDisplay.value = val;
                } else {
                    elements.paymentModal.value = val;
                    elements.paymentDisplayModal.value = val;
                }
                updatePaymentCalculations(containerId);
            });
            container.appendChild(btn);
        });
    }
    const updatePaymentCalculations = (containerId = 'prediksi_buttons') => {
        const total = Number(total_tambahan.value) || 0; // ambil dari hidden total_tambahan

        let payment = 0;
        if (containerId === 'prediksi_buttons') {
            payment = Number(elements.payment.value) || 0;
            elements.paymentDisplay.value = formatRupiah(payment);
        } else {
            payment = Number(elements.paymentModal.value) || 0;
            elements.paymentDisplayModal.value = formatRupiah(payment);

            // sinkronkan ke nominal hidden
            elements.paymentDisplay.value = payment;
            // elements.tambahan.value=formatRupiah(payment);
        }

        if (payment >= total) {
            const change = payment - total;
            elements.changeModal.value = change; // angka asli
            elements.changeDisplayModal.value = formatRupiah(change); // rupiah
            elements.remainingModal.value = 0;
            elements.remainingDisplayModal.value = '0';
        } else {
            const remaining = total - payment;
            elements.changeModal.value = 0;
            elements.changeDisplayModal.value = '0';
            elements.remainingModal.value = remaining; // angka asli
            elements.remainingDisplayModal.value = formatRupiah(remaining); // rupiah
        }
    };

    const validation_payment = () => {
        const payment_value = document.getElementById('nominal').value;
        if (Number(payment_value) - Number(total_tambahan.value) < 0) {
            alert('Maaf Nominal Pembayaran yang Diberikan Tidak Mencukupi, Silahkan Input Ulang Nominal yang Sesuai');
        } else {
            elements.form.submit();

        }
    }


    if (elements.additionalFee) {
        elements.additionalFee.addEventListener('input', updateFinalPrice);
    }
    if (elements.payment) {
        elements.payment.addEventListener('input', () => updatePaymentCalculations('prediksi_buttons'));
    }
    if (elements.paymentModal) {
        elements.paymentModal.addEventListener('input', () => updatePaymentCalculations('prediksi_buttons_modal'));
    }
    elements.proses_checkout.addEventListener('click', validation_payment)
</script>