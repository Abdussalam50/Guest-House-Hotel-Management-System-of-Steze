<style>
    .swal2-container {
        align-items: flex-start !important;
        /* agar popup muncul di atas, bukan di tengah */
        padding-top: 50px;
    }

    .custom-height {
        height: auto !important;
        max-height: 500px !important;
        overflow-y: scroll
    }

    .my-html {
        height: auto !important;
        max-height: 500px !important;

    }
</style>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id='formini'>
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
                                    <select onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")' class="form-control" type="text" name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan " required="required">
                                        <option value="">--Pilih Pelanggan--</option>

                                    </select>
                                    <?php
                                    $idHotel = decrypt($_COOKIE["id_hotel"]);
                                    $namaHotel = baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'");
                                    ?>

                                    <button class="btn btn-sm btn-secondary" type='button' onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")'><i class="fs fa-plus"></i>Tambah Pelanggan</button>


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
                                <input class="form-control" value="<?php echo date("Y-m-d") ?>" style="width:80%" type="date" min='<?php echo date("Y-m-d") ?>' name="waktu_checkin" id="waktu_checkin" placeholder="Waktu Checkin " required="required">
                            </td>
                        </tr>

                        <?php if (pengaturan_aplikasi('transaksi_bulanan') == "aktif") { ?>
                            <tr>
                                <td width="25%" class="leftrowcms">
                                    <label>Jumlah Bulan<span class="highlight"></span></label>
                                </td>
                                <td width="2%">:</td>
                                <td>

                                    <input class="form-control" style="width:80%" type="number" name="jumlah_bulan" id="jumlah_bulan" placeholder="Jumlah Bulan">

                                </td>
                            </tr>
                        <?php } else {
                        ?>
                            <input class="form-control" style="width:80%" type="hidden" name="jumlah_bulan" id="jumlah_bulan" placeholder="Jumlah Bulan">
                        <?php

                        }
                        ?>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Hari <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>

                                <input class="form-control" style="width:80%" type="number" name="jumlah_hari" min="1" id="jumlah_hari" placeholder="Jumlah Hari " required="required">



                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Waktu Check Out <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="date" min='<?php echo date("Y-m-d") ?>' name="waktu_check_out" id="waktu_check_out" placeholder="Waktu Check Out " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Dewasa <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" min="1" value="1" type="number" name="jumlah_dewasa" id="jumlah_dewasa" placeholder="Jumlah Dewasa " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Anak Anak <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" value="0" min="0" style="width:80%" type="number" name="jumlah_anak_anak" id="jumlah_anak_anak" placeholder="Jumlah Anak Anak " required="required">
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
                                    <input type="text" class="form-control" name="metode_transaksi" id="metode_transaksi" value='-' required="required">
                                    <button class="btn btn-secondary" type='button' onclick='pilih_metode_transaksi()'><i class="fa fa-dollar"></i> Pilih Metode Transaksi</button>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No Rekening <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="varchar" name="no_rekening" id="no_rekening" placeholder="No Rekening " value='-' required="required">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Discount harga Kamar(%) <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="number" name="discount" id="discount" placeholder="Discount " value='0' required="required">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>potongan_harga <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="number" name="potongan_harga" id="potongan_harga" placeholder="potongan_harga " value='0' required="required">
                            </td>
                        </tr>







                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Biaya Tambahan Checkin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <div class="" style="width:80%">
                                    <input class="form-control" type="varchar" name="tambahan" id="tambahan" placeholder="Biaya Tambahan " value='0' required="required">
                                    <p class="text-start" id='tambahan_nom'></p>
                                    <textarea name="deskripsi" id="deskripsi" class='form-control'>-</textarea>
                                </div>
                            </td>
                        </tr>

                        <?php
                        if (pengaturan_aplikasi('persentase_pajak') == 0) { ?>

                            <input class="form-control" style="width:80%" type="hidden" name="persentase_pajak" id="persentase_pajak" placeholder="Persentase Pajak " value='0' required="required">


                        <?php } else { ?>
                            <tr>
                                <td width="25%" class="leftrowcms">
                                    <label>Persentase Pajak <span class="highlight"></span></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                    <input class="form-control" style="width:80%" type="number" name="persentase_pajak" id="persentase_pajak" placeholder="Persentase Pajak " value='<?php echo pengaturan_aplikasi('persentase_pajak'); ?>' required="required">
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Catatan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <div class="" style="width:80%">

                                    <textarea name="catatan" id="catatan" class='form-control'></textarea>
                                </div>
                            </td>
                        </tr>


                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Total Harga (Rp) <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td style="font-size: 1.2em;">


                                <div>Harga Kamar : <span id="total_harga_kamar">Rp 0</span></div>

                                <?php
                                if (pengaturan_aplikasi('persentase_pajak') == 0) { ?>
                                    <input type="hidden" name="total_harga_kamar" id='harga_kamar'>
                                    <input type="hidden" name="harga" id='harga_input'>
                                    <p class="text-start" id='harga'>Rp 0</p>
                                    <span id="harga_sebelum_pajak" style="visibility: hidden;">Rp 0</span>

                                <?php } else {  ?>
                                    <div>Harga Sebelum Pajak: <span id="harga_sebelum_pajak">Rp 0</span></div>
                                    <input type="text" name="total_harga_kamar" id='harga_kamar'>
                                    <input type="text" name="harga" id='harga_input'>
                                    <p class="text-start" id='harga'>Rp 0</p>

                                <?php } ?>




                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nominal Bayar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:80%" type="varchar" name="nominal_bayar" id="nominal_bayar" value="">
                                <p class="text-start" id='nominal'></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah Kembalian <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="hidden" name="kembalian" id='kembalian' value='0'>
                                <p class="text-start" id='kembalian_value' style='font-size:1.5em'>Rp 0</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Sisa Pembayaran <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
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
                                    <option value="Lunas">Lunas</option>

                                    <option value="Belum Lunas">Belum Lunas</option>

                                </select>
                                <input type="hidden" name="id_admin" value='<?php
                                                                            $username = decrypt($_COOKIE['jenenge']);
                                                                            $id_admin = baca_database("", "id_admin", "select * from data_admin where username='$username'");
                                                                            echo $id_admin;
                                                                            ?>'>
                                <input type="hidden" name="id_hotel" value='<?php echo decrypt($_COOKIE['id_hotel']) ?>'>
                            </td>
                        </tr>



                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <button type="button" class='btn btn-danger' id='simpan_data'><i class="fa fa-check"></i> Proses CheckIn</button>

                        <?php
                        // btn_simpan(' PROSES SIMPAN DATA'); 
                        ?>
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
        document.addEventListener('DOMContentLoaded', () => {
            // DOM Elements
            const elements = {
                checkin: document.getElementById('waktu_checkin'),
                checkout: document.getElementById('waktu_check_out'),
                days: document.getElementById('jumlah_hari'),
                months: document.getElementById('jumlah_bulan'),
                priceDisplay: document.getElementById('harga'),
                priceInput: document.getElementById('harga_input'),
                roomPrice: document.getElementById('total_harga_kamar'),
                discount: document.getElementById('discount'),
                additionalFee: document.getElementById('tambahan'),
                additionalFeeDisplay: document.getElementById('tambahan_nom'),
                taxPercent: document.getElementById('persentase_pajak'),
                preTaxPrice: document.getElementById('harga_sebelum_pajak'),
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
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);

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
                elements.roomPrice.innerHTML = formatRupiah(basePrice);
                elements.preTaxPrice.innerHTML = formatRupiah(subtotal);
                elements.priceInput.value = Math.floor(finalPrice);
                elements.priceDisplay.innerHTML = formatRupiah(Math.floor(finalPrice));

                updatePaymentCalculations();
            };

            // Update payment calculations
            const updatePaymentCalculations = () => {
                const payment = Number(elements.payment.value) || 0;
                const total = Number(elements.priceInput.value) || 0;

                elements.paymentDisplay.innerHTML = formatRupiah(payment);

                if (payment >= total) {
                    const change = payment - total;
                    elements.change.value = change;
                    elements.changeDisplay.innerHTML = formatRupiah(change);
                    elements.remaining.value = 0;
                    elements.remainingDisplay.innerHTML = 'Rp 0';
                } else {
                    const remaining = total - payment;
                    elements.change.value = 0;
                    elements.changeDisplay.innerHTML = 'Rp 0';
                    elements.remaining.value = remaining;
                    elements.remainingDisplay.innerHTML = formatRupiah(remaining);
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

            // Form submission
            elements.saveButton.addEventListener('click', () => {
                if (elements.form.checkValidity()) {
                    elements.form.submit();
                } else {
                    elements.form.reportValidity();
                }
            });

            // Payment method selection
            window.pilih_metode_transaksi = () => {
                Swal.fire({
                    title: 'Pilih Metode Transaksi',
                    icon: 'info',
                    width: '850px',
                    html: `
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Metode Transaksi</th>
                            <th>Bank</th>
                            <th>Rekening</th>
                            <th>Atas Nama</th>
                            <th>Hotel</th>
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
                                <td><?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='{$data['id_hotel']}'"); ?></td>
                                <td><button style='background-color:#6c757d;border-radius:10px;color:#fff;width:120px;height:30px;border:none;' class='pil_metode' data-id='<?php echo $data['id_metode_pembayaran']; ?>' data-name='<?php echo ucwords($data['metode_pembayaran']); ?>' data-rekening='<?php echo $data['rekening'] ?>'>Pilih</button></td>
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

            // Cek apakah semua field required valid
            if (form.checkValidity()) {
                form.submit(); // jika valid, submit form
            } else {
                form.reportValidity(); // tampilkan peringatan field yang belum diisi
            }
        });
    </script>