<div class="container-md">
    <div class="table">
        <table class="table table-striped">
            <tr>
                <td colspan="3">
                    <center>
                        <img src="../../../data/image/logo/steze-2.png" alt="" width='100'>
                        <br><br>
                        <h2 style="color: #c12c27;"><i class='fas fa-sign-in-alt text-danger'></i> Check-out</h2>
                        <?php echo $alamat; ?>
                    </center>
                    <br>
                </td>
            </tr>

            <?php
            require_once '../../../include/all_include.php';

            $id_kamar = decrypt($_GET['id']);
            $id_trx = decrypt($_GET['trx']);
            $id_hotel = decrypt($_COOKIE['id_hotel']);
            $username = decrypt($_COOKIE['jenenge']);

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
            $tambahan_in = $data['biaya_tambahan_checkin'];
            $tambahan_out = $data['biaya_tambahan_checkout'];
            $potongan_harga = $data['potongan_harga'];

            // Subtotal (including biaya_tambahan_checkout)
            $sub_total = $harga_setelah_disc + $tambahan_in + $tambahan_out - $potongan_harga;
            $pajak = ($sub_total * $data['persentase_pajak']) / 100;
            $total_bayar = $sub_total + $pajak;

            ?>
            <tr>
                <th>Nama Pelanggan</th>
                <td width='1%'>:</td>
                <td>
                    <?php echo ucwords($data['nama']); ?>
                    <span class="<?php echo $data['status_transaksi'] == 'Belum Lunas' ? 'text-danger' : 'text-success'; ?>">
                        (<?php echo $data['status_transaksi']; ?>)
                    </span>
                </td>
            </tr>
            <tr>
                <th>Kamar</th>
                <td width='1%'>:</td>
                <td>Kamar <?php echo $data['no_kamar']; ?> (<?php echo $data['tipe_kamar']; ?>)</td>
            </tr>
            <tr>
                <th>Waktu Checkin</th>
                <td width='1%'>:</td>
                <td><?php echo format_indo($data['waktu_checkin']) . " " . $data['jam_checkin']; ?></td>
            </tr>
            <tr>
                <th>Waktu Checkout</th>
                <td width='1%'>:</td>
                <td>
                    <?php
                    $today = strtotime(date('Y-m-d'));
                    $checkout = strtotime($data['waktu_checkout']);
                    $hari_tersisa = ($checkout - $today) / (60 * 60 * 24);

                    if ($hari_tersisa > 0) {
                        $hari_tersisa = ceil($hari_tersisa);
                        echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']) . " " . $data['jam_checkout'])
                            . "<b style='color:red'>&nbsp;{$hari_tersisa}&nbsp;hari&nbsp;lagi</b>";
                    } elseif ($hari_tersisa == 0) {
                        echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']) . " " . $data['jam_checkout'])
                            . "<b style='color:green'>&nbsp;Hari ini</b>";
                    } else {
                        echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']) . " " . $data['jam_checkout']);
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Jumlah Hari</th>
                <td width='1%'>:</td>
                <td>
                    <?php
                    if ($data['jenis_transaksi'] == 'bulanan') {
                        $j_hari = ($data['jumlah_hari'] / 30);
                        echo $j_hari . ' Bulan';
                    } else {
                        $j_hari = $data['jumlah_hari'];
                        echo $j_hari . ' Hari';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Harga Kamar</th>
                <td width='1%'>:</td>
                <td>
                    <?php
                    if ($data['jenis_transaksi'] == 'bulanan') {
                        echo rupiah($harga_per_bulan) . '/Bulan';
                    } else {
                        echo rupiah($harga_per_hari) . '/Hari';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Harga Kamar Total</th>
                <td width='1%'>:</td>
                <td><?php echo rupiah($harga_kamar_total); ?></td>
            </tr>
            <tr>
                <th>Diskon (<?php echo $data['discount']; ?>%)</th>
                <td width='1%'>:</td>
                <td><?php echo rupiah($disc_nominal); ?> → <span class="text-success"><?php echo rupiah($harga_setelah_disc); ?></span></td>
            </tr>
            <tr>
                <th>Jumlah Dewasa</th>
                <td width='1%'>:</td>
                <td><?php echo $data['jumlah_dewasa']; ?></td>
            </tr>
            <tr>
                <th>Jumlah Anak-anak</th>
                <td width='1%'>:</td>
                <td><?php echo $data['jumlah_anak_anak']; ?></td>
            </tr>
            <tr>
                <th>Metode Transaksi</th>
                <td width='1%'>:</td>
                <td>
                    <?php if ($data['status_transaksi'] == 'Belum Lunas') { ?>
                        <div class="input-group" style='width:60%'>
                            <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" value='<?php echo $data['metode_transaksi']; ?>'>
                            <input type="text" name="metode_bayar" id="metode_bayar" placeholder='Pilih Metode Bayar' class='form-control'
                                value="<?php echo baca_database("", "metode_pembayaran", "SELECT * FROM data_metode_pembayaran WHERE id_metode_pembayaran='{$data['metode_transaksi']}'") ?: '-'; ?>">
                            <button type="button" id='metode' class='btn btn-secondary'><i class="fa fa-dollar"></i> Pilih Metode Pembayaran</button>
                        </div>
                    <?php } else {
                        echo baca_database("", "metode_pembayaran", "SELECT * FROM data_metode_pembayaran WHERE id_metode_pembayaran='{$data['metode_transaksi']}'") ?: '-';
                    } ?>
                </td>
            </tr>
            <tr>
                <th>Biaya Tambahan Checkin</th>
                <td width='1%'>:</td>
                <td>
                    <?php echo rupiah($tambahan_in); ?>
                    <?php if (!empty($data['deskripsi_biaya_checkin']) && $tambahan_in > 0) { ?>
                        <span class='text-danger'>(<?php echo $data['deskripsi_biaya_checkin']; ?>)</span>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>Biaya Tambahan Checkout</th>
                <td width='1%'>:</td>
                <td>
                    <?php if ($tambahan_out > 0) { ?>
                        <?php echo rupiah($tambahan_out); ?>
                        <?php if (!empty($data['deskripsi_biaya_checkout'])) { ?>
                            <span class='text-danger'>(<?php echo $data['deskripsi_biaya_checkout']; ?>)</span>
                        <?php } ?>
                    <?php } else { ?>
                        <div style='width:60%'>
                            <input type="number" name="tambahan" id="tambahan" class='form-control mb-1' placeholder="Jumlah Biaya Tambahan" value='0' min='0' required='required'>
                            <textarea class='form-control' name='tambahan_desc' id='desc_tambahan' placeholder="Deskripsi Biaya Tambahan" required="required">-</textarea>
                        </div>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>Subtotal</th>
                <td width='1%'>:</td>
                <td id='sub_total'><?php echo rupiah($sub_total); ?></td>
            </tr>
            <tr>
                <th>Pajak (<?php echo $data['persentase_pajak']; ?>%)</th>
                <td width='1%'>:</td>
                <td id='pajak'><?php echo rupiah($pajak); ?></td>
            </tr>
            <tr>
                <th>Total Bayar</th>
                <td width='1%'>:</td>
                <td id='total_bayar'><?php echo rupiah($total_bayar); ?></td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td width='1%'>:</td>
                <td class='<?php echo $data['status_transaksi'] == 'Lunas' ? 'text-success' : 'text-danger'; ?>'>
                    <?php echo $data['status_transaksi']; ?>
                </td>
            </tr>
            <?php if ($data['status_transaksi'] == 'Belum Lunas') { ?>
                <tr>
                    <th>Sisa Pembayaran</th>
                    <td width='1%'>:</td>
                    <td id='sisa'><?php echo rupiah($data['sisa_pembayaran']); ?></td>
                </tr>
                <tr>
                    <th>Jumlah Uang</th>
                    <td width='1%'>:</td>
                    <td>
                        <div class='input-group' style='width:60%'>
                            <input type="number" name="total" id="total" class='form-control' value='0' placeholder="Jumlah Uang" min='0' required='required'>
                        </div>
                        <p id='total_display' style='font-size:18px'></p>
                    </td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td width='1%'>:</td>
                    <td id='kembalian'>
                        <input type="hidden" name="kembalian" id='kembalian2' value='0'>
                        Rp 0
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <input type="hidden" name="nama_hotel" id='nama_hotel' value="<?php echo !empty($id_hotel) ? baca_database("", "nama", "SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'") : 'Semua Cabang'; ?>">
    <input type="hidden" name="id_transaksi" id='id_transaksi' value="<?php echo $data['id_transaksi']; ?>">
    <input type="hidden" name="total_bayar_hidden" id='total_bayar_hidden' value='<?php echo $total_bayar; ?>'>
    <?php if ($data['status_transaksi'] != 'Selesai') { ?>
        <button class='btn btn-danger' id='cetak'><i class="fa fa-print"></i> Proses Checkout</button>
    <?php } ?>
</div>

<script src="../../../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    <?php if ($data['status_transaksi'] == 'Belum Lunas') { ?>
        const metode = document.getElementById('metode');
        metode.addEventListener('click', function() {
            Swal.fire({
                title: 'Pilih Metode Pembayaran',
                icon: 'info',
                width: '700px',
                html: `
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
                                $query_met_bayar = mysql_query("SELECT * FROM data_metode_pembayaran LEFT JOIN data_bank ON data_metode_pembayaran.id_bank=data_bank.id_bank WHERE data_metode_pembayaran.id_hotel='$id_hotel'");
                                $no = 1;
                                if (mysql_num_rows($query_met_bayar) > 0) {
                                    while ($data_met_bayar = mysql_fetch_array($query_met_bayar)) {
                                ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data_met_bayar['metode_pembayaran']; ?></td>
                                            <td><?php echo $data_met_bayar['nama_bank']; ?></td>
                                            <td><?php echo $data_met_bayar['rekening']; ?></td>
                                            <td><?php echo $data_met_bayar['atas_nama']; ?></td>
                                            <td>
                                                <button style='width:120px; height:22px; color:#fff; background-color: #c92d22ff; border: none; border-radius: 4px;' id='pilih' data-id='<?php echo $data_met_bayar['id_metode_pembayaran']; ?>' data-name='<?php echo $data_met_bayar['metode_pembayaran']; ?>'>Pilih</button>
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
                didOpen: () => {
                    const pilih = document.getElementById('row_metode');
                    pilih.addEventListener('click', function(e) {
                        const id_transaksi = document.getElementById('id_transaksi').value;
                        const target = e.target;
                        if (target.id == 'pilih') {
                            const id_metode = target.getAttribute('data-id');
                            const nama_metode = target.getAttribute('data-name');
                            document.getElementById('metode_pembayaran').value = id_metode;
                            document.getElementById('metode_bayar').value = nama_metode;
                            fetch('update_metode_pembayaran.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        id_metode: id_metode,
                                        id_transaksi: id_transaksi
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.response == 'success') {
                                        Swal.close();
                                        Swal.fire({
                                            title: 'Berhasil',
                                            text: 'Metode pembayaran berhasil diupdate',
                                            icon: 'success',
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Gagal mengupdate metode pembayaran: ' + (data.message || 'Unknown error'),
                                            icon: 'error'
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Terjadi kesalahan saat mengupdate metode pembayaran',
                                        icon: 'error'
                                    });
                                    console.error('Error:', error);
                                });
                        }
                    });
                }
            });
        });
    <?php } ?>

    const total = document.getElementById('total');
    const total_display = document.getElementById('total_display');
    const kembalian = document.getElementById('kembalian');
    const kembalian2 = document.getElementById('kembalian2');
    const cetak = document.getElementById('cetak');
    const id_transaksi = document.getElementById('id_transaksi');
    const nama_hotel = document.getElementById('nama_hotel');
    const tambahan_biaya = document.getElementById('tambahan');
    const deskripsi = document.getElementById('desc_tambahan');
    const sub_total_elem = document.getElementById('sub_total');
    const pajak_elem = document.getElementById('pajak');
    const total_bayar_elem = document.getElementById('total_bayar');
    const sisa = document.getElementById('sisa');
    const total_bayar_hidden = document.getElementById('total_bayar_hidden');

    function rupiahFormat(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
    }

    if (total) {
        total.addEventListener('input', function() {
            const nom_bayar = Number(this.value);
            const total_harga = Number(total_bayar_hidden.value);
            let kembalian_val = nom_bayar - total_harga;
            total_display.innerHTML = rupiahFormat(nom_bayar);
            kembalian2.value = kembalian_val;
            if (kembalian_val >= 0) {
                kembalian.innerHTML = rupiahFormat(kembalian_val);
                if (sisa) sisa.innerHTML = rupiahFormat(0);
            } else {
                kembalian.innerHTML = rupiahFormat(0);
                if (sisa) sisa.innerHTML = rupiahFormat(-kembalian_val);
            }
        });
    }

    if (tambahan_biaya) {
        tambahan_biaya.addEventListener('input', () => {
            const biaya_tambahan = Number(tambahan_biaya.value);
            const biaya_checkin = <?php echo intval($tambahan_in); ?>;
            const harga_kamar = <?php echo intval($harga_setelah_disc); ?>;
            const potongan = <?php echo intval($potongan_harga); ?>;
            const persentase_pajak = <?php echo intval($data['persentase_pajak']); ?>;

            const sub_total = harga_kamar + biaya_checkin + biaya_tambahan - potongan;
            const pajak = (sub_total * persentase_pajak) / 100;
            const total_bayar = sub_total + pajak;

            sub_total_elem.innerHTML = rupiahFormat(sub_total);
            pajak_elem.innerHTML = rupiahFormat(pajak);
            total_bayar_elem.innerHTML = rupiahFormat(total_bayar);
            total_bayar_hidden.value = total_bayar;
            if (sisa) sisa.innerHTML = rupiahFormat(total_bayar - <?php echo intval($data['nominal_bayar']); ?>);
        });
    }

    if (cetak) {
        cetak.addEventListener('click', function() {
            // Validate inputs
            const nom_bayar = total ? Number(total.value) : 0;
            const total_harga = Number(total_bayar_hidden.value);
            const metode_pembayaran = document.getElementById('metode_pembayaran') ? document.getElementById('metode_pembayaran').value : '';
            const biaya_tambahan = tambahan_biaya ? Number(tambahan_biaya.value) : 0;
            const deskripsi_tambahan = deskripsi ? deskripsi.value : '';

            if (nom_bayar <= 0 && <?php echo $data['status_transaksi'] == 'Belum Lunas' ? 'true' : 'false'; ?>) {
                Swal.fire({
                    title: 'Error',
                    text: 'Masukkan jumlah uang yang valid',
                    icon: 'error'
                });
                return;
            }

            if (!metode_pembayaran && <?php echo $data['status_transaksi'] == 'Belum Lunas' ? 'true' : 'false'; ?>) {
                Swal.fire({
                    title: 'Error',
                    text: 'Pilih metode pembayaran terlebih dahulu',
                    icon: 'error'
                });
                return;
            }

            const status_transaksi = nom_bayar >= total_harga ? 'Lunas' : 'Belum Lunas';
            const kembalian_val = nom_bayar >= total_harga ? nom_bayar - total_harga : 0;

            // Function to process checkout
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
                        if (!response.ok) throw new Error('Network response was not ok: ' + response.statusText);
                        return response.json();
                    })
                    .then(data => {
                        if (data.response == 'yes') {
                            return fetch('cetak_nota.php', {
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
                        if (!response.ok) throw new Error('Network response was not ok: ' + response.statusText);
                        return response.json();
                    })
                    .then(data => {
                        if (data == 'true') {
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

            // If additional cost exists, update it first
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
                        if (data.response == 'yes') {
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
    } else {
        console.error('Cetak button not found in DOM');
    }
</script>