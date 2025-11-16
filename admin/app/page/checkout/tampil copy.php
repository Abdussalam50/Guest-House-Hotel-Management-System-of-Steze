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
                    <form action="proses_checkout.php" method="post" enctype="multipart/form-data">
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
                        $harga_kamar_total = ($data['jenis_transaksi'] == 'bulanan')
                            ? $harga_per_bulan * ($jumlah_hari / 30)
                            : $harga_per_hari * $jumlah_hari;

                        // Discount
                        $disc_nominal = ($harga_kamar_total * $data['discount']) / 100;
                        $harga_setelah_disc = $harga_kamar_total - $disc_nominal;

                        // Additional costs and deductions
                        $biaya_tambahan_checkin = $data['biaya_tambahan_checkin'];
                        $deskripsi_biaya_checkin = $data['deskripsi_biaya_checkin'];
                        $tambahan_out = $data['biaya_tambahan_checkout'];
                        $potongan_harga = $data['potongan_harga'];

                        // Subtotal (including biaya_tambahan_checkout)
                        $sub_total = $harga_setelah_disc + $tambahan_in + $tambahan_out - $potongan_harga;
                        $pajak = ($sub_total * $data['persentase_pajak']) / 100;
                        $total_bayar = $sub_total + $pajak;

                        $id_pelanggan = $data['id_pelanggan'];
                        $sqlpelanggan = mysql_query("SELECT * FROM data_pelanggan where id_pelanggan = '$id_pelanggan'");
                        $data_pelanggan = mysql_fetch_array($sqlpelanggan);

                        ?>

                        <input type="hidden" name="nama_hotel" id="nama_hotel" value="<?php echo $nama_hotel; ?>">
                        <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
                        <input type="hidden" name="total_bayar_hidden" id="total_bayar_hidden" value="<?php echo $total_bayar; ?>">

                        <div class="mb-4">
                            <div class="cardcheckin-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="room-badge"><?php echo $data['no_kamar']; ?></div>
                                    <h4 class="mb-0"><i class="fas fa-sign-out-alt text-danger"></i> Check-out <?php echo $nama_hotel; ?></h4>
                                </div>

                                <div class="row g-3">
                                    <!-- Informasi Kamar -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Kamar</div>
                                                <label class="form-label">Tanggal</label>
                                                <input type="text" class="form-control mb-2" readonly value="20/05/2013">

                                                <label class="form-label">Channel</label>
                                                <input type="text" class="form-control mb-2" readonly value="Walk-In Guest">

                                                <label class="form-label">Tipe Kamar</label>
                                                <input type="text" class="form-control mb-2" readonly value="<?php echo $data['tipe_kamar']; ?>">

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

                                                <label class="form-label">Jumlah Hari</label>
                                                <input type="text" class="form-control mb-2" readonly value="<?php
                                                                                                                if ($data['jenis_transaksi'] == 'bulanan') {
                                                                                                                    $j_hari = ($data['jumlah_hari'] / 30);
                                                                                                                    echo $j_hari . ' Bulan';
                                                                                                                } else {
                                                                                                                    $j_hari = $data['jumlah_hari'];
                                                                                                                    echo $j_hari . ' Hari';
                                                                                                                }
                                                                                                                ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Pelanggan -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Pelanggan</div>
                                                <label class="form-label">Nama</label>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" readonly value="<?php echo ucwords($data_pelanggan['nama']); ?>">

                                                </div>


                                                <div class="row g-2 ">
                                                    <div class="col-4">
                                                        <label class="form-label">Identitas</label>
                                                        <input required class="form-control mb-2" name="identitas" id="identitas" value="<?php echo $data_pelanggan['identitas']; ?>" placeholder="Identitas">

                                                    </div>
                                                    <div class="col-8">
                                                        <label class="form-label">No. Identitas</label>
                                                        <div class="input-group mb-2">
                                                            <input required type="text" style="height: 38px;" class="form-control" name="no_identitas" value="<?php echo $data_pelanggan['no_identitas']; ?>" id="no_identitas" placeholder="No Identitas">

                                                        </div>
                                                    </div>
                                                </div>


                                                <label class="form-label">Alamat</label>
                                                <input type="text" class="form-control mb-2" readonly value="<?php echo $data_pelanggan['alamat']; ?>">
                                                <label class="form-label">No. Telp</label>
                                                <input type="text" class="form-control mb-2" readonly value="<?php echo $data_pelanggan['no_hp']; ?>">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <input type="text" class="form-control mb-2" readonly value="<?php echo ucfirst($data_pelanggan['jenis_kelamin']); ?>">
                                                <label class="form-label">Jumlah Tamu</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Dewasa</span>
                                                    <input type="number" class="form-control" readonly value="<?php echo $data_pelanggan['jumlah_dewasa']; ?>">
                                                    <span class="input-group-text">Anak</span>
                                                    <input type="number" class="form-control" readonly value="<?php echo $data_pelanggan['jumlah_anak_anak']; ?>">
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
                                                    <input type="text" class="form-control" readonly value="<?php echo rupiah_format($harga_per_hari) ?>">
                                                </div>

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
                                                        Tambahan <i class="fa fa-info-circle"></i> : <?php echo rupiah_format($biaya_tambahan_checkin); ?>

                                                    </label>)</p>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control" readonly id="total_bayar" value="<?php echo rupiah_format($total_bayar); ?>">
                                                    <span class="input-group-text">Status : Lunas</span>
                                                </div>

                                                <div class="form-check mt-2 mb-0">
                                                    <input class="form-check-input me-2" type="checkbox" id="pajakCheck" disabled checked>
                                                    <label class="form-label" for="pajakCheck">Pajak (<?php echo $data['persentase_pajak']; ?>%)</label>


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






                                                <!-- Modal untuk Note -->
                                                <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="noteModalLabel">Catatan Biaya Tambahan Check-out</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" name="tambahan_desc" id="desc_tambahan" rows="4" placeholder="Tulis catatan di sini..." required></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
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




                        <div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPembayaranLabel">Proses Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">Grand Total</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" readonly class="form-control" id="grand_total" name="grand_total">
                                        </div>

                                        <label class="form-label">Metode Pembayaran</label>
                                        <div class="input-group mb-2">
                                            <input type="hidden" name="id_metode_pembayaran" id="id_metode_pembayaran_modal">
                                            <input type="text" class="form-control" readonly id="metode_transaksi_modal" name="metode_transaksi_modal">
                                            <button type="button" class="btn btn-secondary" onclick="pilih_metode_transaksi_modal()"><i class="fa fa-dollar"></i> Pilih</button>
                                        </div>

                                        <label class="form-label">Nominal Bayar</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" name="nominal" id="nominal">
                                            <input type="number" class="form-control" name="nominal_bayar_modal" id="nominal_bayar_modal" value="0" min="0">
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted" style="font-size:0.7rem;">Estimasi Nominal Pembayaran:</small>
                                            <div class="mb-2" id="prediksi_buttons_modal" style="display:flex; gap:5px; flex-wrap:wrap;"></div>
                                        </div>
                                        <label class="form-label">Kembalian</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" name="kembalian_modal" id="kembalian_modal" value="0">
                                            <input type="text" class="form-control" readonly id="kembalian_value_modal" value="0">
                                        </div>
                                        <input type="hidden" name="sisa_modal" id="sisa_modal" value="0">
                                        <input type="hidden" name="sisa_value_modal" id="sisa_value_modal" value="0">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-danger" id="simpan_data">Proses Checkout</button>
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
    const elements = {
        priceDisplay: document.getElementById('harga'),
        grandtotal: document.getElementById('grand_total'),
        priceInput: document.getElementById('total_bayar_hidden'),
        additionalFee: document.getElementById('tambahan'),
        payment: document.getElementById('nominal_bayar'),
        paymentModal: document.getElementById('nominal_bayar_modal'),
        paymentDisplay: document.getElementById('nominal'),
        paymentDisplayModal: document.getElementById('nominal'),
        change: document.getElementById('kembalian'),
        changeModal: document.getElementById('kembalian_modal'),
        changeDisplay: document.getElementById('kembalian_value'),
        changeDisplayModal: document.getElementById('kembalian_value_modal'),
        remaining: document.getElementById('sisa'),
        remainingModal: document.getElementById('sisa_modal'),
        remainingDisplay: document.getElementById('sisa_value'),
        remainingDisplayModal: document.getElementById('sisa_value_modal'),
        form: document.getElementById('formini')
    };

    const formatRupiah = (value) => new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value);

    const updateFinalPrice = () => {

        const additional = Number(elements.additionalFee.value) || 0;


        // elements.priceDisplay.value = formatRupiah(Math.floor(finalPrice));
        // elements.priceInput.value = Math.floor(finalPrice);
        // elements.grandtotal.value = formatRupiah(Math.floor(finalPrice));

        createPrediksiButtons(additional);
    };

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
        const payment = containerId === 'prediksi_buttons' ?
            (Number(elements.payment.value) || 0) :
            (Number(elements.paymentModal.value) || 0);
        const total = Number(elements.priceInput.value) || 0;

        if (containerId === 'prediksi_buttons') {
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
        } else {
            elements.paymentDisplayModal.value = formatRupiah(payment);
            if (payment >= total) {
                const change = payment - total;
                elements.changeModal.value = change;
                elements.changeDisplayModal.value = formatRupiah(change);
                elements.remainingModal.value = 0;
                elements.remainingDisplayModal.value = '0';
            } else {
                const remaining = total - payment;
                elements.changeModal.value = 0;
                elements.changeDisplayModal.value = '0';
                elements.remainingModal.value = remaining;
                elements.remainingDisplayModal.value = formatRupiah(remaining);
            }
        }
    };

    if (elements.additionalFee) {
        elements.additionalFee.addEventListener('input', updateFinalPrice);
    }
    if (elements.payment) {
        elements.payment.addEventListener('input', () => updatePaymentCalculations('prediksi_buttons'));
    }
    if (elements.paymentModal) {
        elements.paymentModal.addEventListener('input', () => updatePaymentCalculations('prediksi_buttons_modal'));
    }

    window.pilih_metode_transaksi = () => {
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
                        document.getElementById('id_metode_pembayaran').value = button.dataset.id;
                        document.getElementById('metode_transaksi').value = button.dataset.name;
                        Swal.close();
                    });
                });
            }
        });
    };

    window.pilih_metode_transaksi_modal = () => {
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
                        document.getElementById('metode_transaksi_modal').value = button.dataset.name;
                        Swal.close();
                    });
                });
            }
        });
    };

    const id_transaksi = document.getElementById('id_transaksi');
    const nama_hotel = document.getElementById('nama_hotel');
    const tambahan_biaya = document.getElementById('tambahan');
    const deskripsi = document.getElementById('desc_tambahan');

    const open_checkout = document.getElementById('open_checkout');
    if (open_checkout) {
        open_checkout.addEventListener('click', () => {
            const additional = Number(tambahan_biaya.value) || 0;

            updateFinalPrice();

            const modal = new bootstrap.Modal(document.getElementById('modalPembayaran'));
            elements.grandtotal.value = formatRupiah(Number(elements.priceInput.value));
            createPrediksiButtons(Number(elements.priceInput.value), 'prediksi_buttons_modal');
            modal.show();

        });
    }

    const simpan_data = document.getElementById('simpan_data');
    if (simpan_data) {
        simpan_data.addEventListener('click', () => {
            const nom_bayar = Number(elements.paymentModal.value) || 0;
            const total_harga = Number(elements.priceInput.value);
            const metode_pembayaran = document.getElementById('id_metode_pembayaran_modal')?.value || '';
            const biaya_tambahan = Number(tambahan_biaya.value) || 0;
            const deskripsi_tambahan = deskripsi?.value || '';


            if (!metode_pembayaran) {
                Swal.fire({
                    title: 'Error',
                    text: 'Pilih metode pembayaran terlebih dahulu',
                    icon: 'error'
                });
                return;
            }

            if (nom_bayar <= 0) {
                Swal.fire({
                    title: 'Error',
                    text: 'Masukkan jumlah uang yang valid',
                    icon: 'error'
                });
                return;
            }

            const status_transaksi = nom_bayar >= total_harga ? 'Lunas' : 'Belum Lunas';
            const kembalian_val = nom_bayar >= total_harga ? nom_bayar - total_harga : 0;

            const processCheckout = () => {
                fetch('update_bayar.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            nom_bayar: nom_bayar,
                            id_transaksi: id_transaksi.value,
                            status: status_transaksi,
                            kembalian: kembalian_val
                        })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.response === 'yes') {
                            return fetch('proses_checkout.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    total: nom_bayar,
                                    kembalian1: kembalian_val,
                                    id_trx: id_transaksi.value,
                                    nama_hotel: nama_hotel.value,
                                    username: "<?php echo $username; ?>",
                                    status: 'checkout'
                                })
                            });
                        } else {
                            throw new Error(data.message || 'Pembayaran gagal');
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data === 'true') {
                            Swal.fire({
                                title: 'Proses Selesai',
                                icon: 'success',
                                text: 'Checkout Berhasil',
                                timer: 1500
                            }).then(() => {
                                window.location.href = '../index.php';
                            });
                        } else {
                            throw new Error(data.message || 'Proses gagal');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Proses Gagal',
                            icon: 'error',
                            text: error.message || 'Terjadi Kesalahan'
                        });
                        console.error('Checkout Error:', error);
                    });
            };

            if (biaya_tambahan > 0) {
                fetch('update_biaya_tambah.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            tambahan: biaya_tambahan,
                            deskripsi: deskripsi_tambahan,
                            id_trx: id_transaksi.value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.response === 'yes') {
                            processCheckout();
                        } else {
                            Swal.fire({
                                title: 'Proses Gagal',
                                icon: 'error',
                                text: data.message || 'Gagal menambahkan biaya tambahan'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: 'Terjadi kesalahan saat menambahkan biaya tambahan',
                            timer: 1500
                        });
                        console.error('Error:', error);
                    });
            } else {
                processCheckout();
            }
        });
    }

    updateFinalPrice();
</script>