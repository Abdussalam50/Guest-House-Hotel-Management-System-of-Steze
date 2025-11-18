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
                    <form method="GET" action="proses.php">
                        <div class="mb-4">
                            <div class="cardcheckin-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="room-badge">1</div>
                                    <h4 class="mb-0"><i class="fas fa-sign-in-alt text-success"></i> Check-in Sipin TAC</h4>
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
                                                <select class="form-select mb-2" name="channel">
                                                    <option value="Walk-In" selected>Walk-In guest</option>
                                                    <option value="gmaps">Google Maps</option>
                                                    <option value="Telephone">Telepon</option>
                                                    <option value="Website">Website</option>
                                                    <option value="Traveloka">Traveloka</option>
                                                    <option value="Agoda">Agoda</option>
                                                    <option value="Booking.com">Booking.com</option>
                                                    <option value="Tiket.com">Tiket.com</option>
                                                    <option value="Pegipegi">Pegipegi</option>
                                                    <option value="Corporate">Corporate</option>
                                                    <option value="Government">Government</option>
                                                    <option value="Agent">Travel Agent</option>
                                                    <option value="Group">Group / Event</option>
                                                </select>





                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label">Tipe Kamar</label>
                                                        <div class="input-group">
                                                            <input class="form-control mb-2" name="tipe_kamar" redonly value="DULUXE">

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Jenis Ranjang</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mb-2" name="jenis_ranjang" value="DOUBLE BED" readonly>

                                                        </div>
                                                    </div>
                                                </div>



                                                <label class="form-label">Tanggal Cek In</label>
                                                <input type="date" class="form-control mb-2" name="cek_in" value="<?php echo date('Y-m-d'); ?>">

                                                <label class="form-label">Tanggal Cek Out</label>
                                                <input type="date" class="form-control mb-2" name="cek_out">

                                                <label class="form-label">Jumlah Hari</label>
                                                <div class="input-group mb-2">
                                                    <button style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">-</button>
                                                    <input style="height: 38px;" type="number" class="form-control text-center" name="jumlah_hari" value="1">
                                                    <button style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informasi Pelanggan -->
                                    <div class="col-md-4">
                                        <div class="cardcheckin h-100">
                                            <div class="cardcheckin-body">
                                                <div class="card-group-title">Informasi Pelanggan</div>

                                                <label class="form-label">No. Identitas</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" style="height: 38px;" class="form-control" name="identitas">
                                                    <span style="height: 38px;padding-top: 9px;" class="btn btn-secondary">Pilih</span>
                                                </div>

                                                <label class="form-label">Identitas</label>
                                                <select class="form-select mb-2" name="tipe_kamar">
                                                    <option selected>KTP</option>
                                                    <option>SIM</option>
                                                    <option>LAINNYA</option>
                                                </select>

                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control mb-2" name="nama">

                                                <label class="form-label">Alamat</label>
                                                <input type="text" class="form-control mb-2" name="alamat">

                                                <label class="form-label">No. Telp</label>
                                                <input type="text" class="form-control mb-2" name="no_telp">

                                                <label class="form-label">Jumlah Tamu</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Dewasa</span>
                                                    <input type="number" class="form-control" name="dewasa">
                                                    <span class="input-group-text">Anak</span>
                                                    <input type="number" class="form-control" name="anak">
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
                                                    <input type="text" class="form-control" name="harga_hari" value="500.000">
                                                </div>

                                                <label class="form-label">Total Harga Sewa</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control" name="total_harga">
                                                </div>

                                                <div class="row g-2 mb-2">
                                                    <div class="col-6">
                                                        <label class="form-label">Diskon</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">%</span>
                                                            <input type="text" class="form-control" name="diskon">

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Potongan</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Rp</span>
                                                            <input type="text" class="form-control " name="pajak">

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tambahan Biaya -->
                                                <label class="form-label">Tambahan Biaya</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control" name="tambahan_biaya">

                                                    <!-- Tombol untuk Note -->
                                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#noteModal">
                                                        Note
                                                    </button>
                                                </div>

                                                <!-- Modal untuk Note -->
                                                <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="noteModalLabel">Catatan Tambahan Biaya</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="form-control" name="note_tambahan_biaya" rows="4" placeholder="Tulis catatan di sini..."></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Grandtotal -->
                                                <label class="form-label">Grandtotal</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="text" class="form-control fw-bold" name="grandtotal" readonly>
                                                </div>

                                                <!-- Pajak Checkbox -->
                                                <div class="form-check mt-2 mb-3">
                                                    <input class="form-check-input" type="checkbox" value="11" id="pajakCheck" name="pajak">
                                                    <label class="form-check-label" for="pajakCheck">
                                                        Pajak 11%
                                                    </label>
                                                </div>

                                                <div class="mt-auto d-flex justify-content-end">
                                                    <button class="btn btn-secondary me-2" type="reset">Batal</button>
                                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalPembayaran">Check-in</button>
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
                                            <input type="text" class="form-control" name="nominal_bayar">
                                        </div>


                                        <label class="form-label">Metode Pembayaran</label>
                                        <select class="form-select mb-3" name="metode_bayar">
                                            <option value="cash">Cash</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="qris">QRIS</option>
                                        </select>




                                        <label class="form-label">Nominal Bayar</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control" name="nominal_bayar">
                                        </div>

                                        <label class="form-label">Kembalian</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control" name="kembalian" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Proses Check-in</button>
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