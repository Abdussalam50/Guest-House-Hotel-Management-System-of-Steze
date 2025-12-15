<?php

$read = "detail";
date_default_timezone_set("Asia/Jakarta");
$id_transaksi = mysql_escape_string($_GET['id_trx']);

$query = mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$id_transaksi'") or die(mysql_error());
$bk = mysql_fetch_array($query);
if (!$bk) die("Transaksi tidak ditemukan!");

// Nilai dari database
$grand_total        = (int)$bk['total_bayar'];
$jenis_transaksi        = $bk['jenis_transaksi'];
$status_transaksi        = $bk['status_transaksi'];
$dp_dibayar         = (int)$bk['nominal_bayar'];
$sisa_harus_dibayar = (int)$bk['sisa_pembayaran'];
$deposit_lama       = (int)$bk['nominal_deposit'];
$jenis_group = json_check($bk['id_kamar']) ? "group" : "non_group";





if ($jenis_transaksi == "harian" && $jenis_group == "non_group") {
    include "../checkout/notaA4.php";
    $link = "../checkout/notaA4.php";
} elseif ($jenis_transaksi == "bulanan" && $jenis_group == "non_group") {
    include "../checkout/notaA4-bulanan.php";
    $link = "../checkout/notaA4-bulanan.php";
} elseif ($jenis_transaksi == "harian" && $jenis_group == "group") {
    include "../checkout/notaA4-group.php";
    $link = "../checkout/notaA4-group.php";
} elseif ($jenis_transaksi == "bulanan" && $jenis_group == "group") {
    include "../checkout/notaA4-bulanan-group.php";
    $link = "../checkout/notaA4-bulanan-group.php";
}


?>

<?php if ($status_transaksi == "Booking") { ?>
    <div class="text-end mt-3">
        <button class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#modalBayarBooking<?= $id_transaksi ?>">
            Bayar & Check-in
        </button>
    </div>
<?php } ?>

<!-- MODAL (ID tetap + data-id untuk referensi) -->
<div class="modal fade" id="modalBayarBooking<?= $id_transaksi ?>" tabindex="-1" data-id-transaksi="<?= $id_transaksi ?>">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Proses Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="proses_simpan_booking_to_transaksi.php" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                    <input type="hidden" name="grand_total" value="<?= $grand_total ?>">
                    <input type="hidden" name="sisa_sebelumnya" value="<?= $sisa_harus_dibayar ?>">


                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Grand Total</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control  " readonly value="<?= number_format($grand_total, 0, ',', '.') ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Pembayaran DP</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" readonly value="<?= number_format($dp_dibayar, 0, ',', '.') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label small">Metode Bayar Deposit</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-secondary" onclick="pilihMetodeDeposit(this)">Metode</button>
                                <input type="text" class="form-control" id="metode_deposit" readonly placeholder="Belum dipilih">
                                <input type="hidden" name="metode_deposit_text" id="metode_deposit_text">
                                <input type="hidden" name="id_metode_deposit" id="id_metode_deposit">
                                <input type="hidden" name="no_rekening_deposit" id="no_rekening_deposit">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label small">Deposit</label>
                            <input type="number" class="form-control " name="deposit_tambahan" id="deposit_tambahan" value="0" min="0">
                        </div>
                    </div>


                    <!-- Deposit Tambahan -->
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label small">Metode Bayar Sisa</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-secondary" onclick="pilihMetodePembayaran(this)">Metode</button>
                                <input type="text" class="form-control" id="metode_pembayaran" readonly required placeholder="Belum dipilih">
                                <input type="hidden" name="metode_pembayaran_text" id="metode_pembayaran_text">
                                <input type="hidden" name="id_metode_pembayaran" id="id_metode_pembayaran">
                                <input type="hidden" name="no_rekening" id="no_rekening">
                                <input type="hidden" name="id_bank" id="id_bank">
                                <input type="hidden" name="nama_bank" id="nama_bank">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label" id="labelSisa">Sisa Pembayaran</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text"
                                    class="form-control fs-5"
                                    readonly
                                    id="sisaDisplay"
                                    value="<?= number_format($sisa_harus_dibayar, 0, ',', '.') ?>">
                                <input type="hidden" id="sisaAwal" value="<?= $sisa_harus_dibayar ?>">
                            </div>
                            <small class="text-muted mt-1" id="infoSisa" style="display:none;"></small>
                        </div>
                    </div>





                    <!-- Nominal Bayar + Prediksi -->
                    <div class="mb-3">
                        <label class="form-label">Nominal Bayar</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control fs-5 fw-bold" id="nominal_bayar" placeholder="0" required>
                            <input type="hidden" name="nominal_bayar" id="nominal_hidden">
                        </div>
                        <small class="text-muted" style="font-size:0.7rem;">Estimasi Nominal Transaksi:</small>
                        <div id="prediksi" class="d-flex gap-2 flex-wrap small"></div>
                    </div>

                    <!-- Kembalian -->
                    <div class="mb-3">
                        <label class="form-label ">Kembalian</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="kembalian" readonly value="0">
                            <input type="hidden" name="kembalian" id="kembalian_hidden">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="bayar_booking_lunas" id="btnProses" class="btn btn-danger" disabled>Proses Check-in</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi utama per modal (dipanggil saat modal ditampilkan)
    document.getElementById('modalBayarBooking<?= $id_transaksi ?>').addEventListener('shown.bs.modal', function() {
        const modal = this;
        const sisaAwal = parseInt(modal.querySelector('#sisaAwal').value) || 0;

        const nominalBayar = modal.querySelector('#nominal_bayar');
        const nominalHidden = modal.querySelector('#nominal_hidden');
        const depositTambahan = modal.querySelector('#deposit_tambahan');
        const kembalian = modal.querySelector('#kembalian');
        const kembalianHid = modal.querySelector('#kembalian_hidden');
        const btnProses = modal.querySelector('#btnProses');
        const prediksiDiv = modal.querySelector('#prediksi');
        const infoSisa = modal.querySelector('#infoSisa');
        const sisaDisplay = modal.querySelector('#sisaDisplay');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function hitung() {
            let depo = parseInt(depositTambahan.value) || 0;
            let bayar = parseInt(nominalBayar.value.replace(/\D/g, '')) || 0;
            let totalHarusDibayar = sisaAwal + depo;

            // Update nilai yang ditampilkan
            sisaDisplay.value = formatRupiah(totalHarusDibayar);
            nominalHidden.value = bayar;

            const labelSisa = modal.querySelector('#labelSisa');
            const infoSisa = modal.querySelector('#infoSisa');

            if (depo > 0) {
                // Ada deposit tambahan → tampilan besar + warna biru + info
                labelSisa.textContent = 'Sisa Pembayaran';
                labelSisa.className = 'form-label';

                sisaDisplay.className = 'form-control fs-5 f';

                infoSisa.style.display = 'block';
                infoSisa.innerHTML = ` 
                              + Deposit <strong>Rp ${formatRupiah(depo)}</strong> </strong>`;
            } else {
                // Deposit 0 → tampilan normal
                labelSisa.textContent = 'Sisa Pembayaran';
                labelSisa.className = 'form-label';

                sisaDisplay.className = 'form-control fs-5';

                infoSisa.style.display = 'none';
                infoSisa.innerHTML = '';
            }

            // Kembalian & tombol proses
            if (bayar >= totalHarusDibayar) {
                let kembali = bayar - totalHarusDibayar;
                kembalian.value = formatRupiah(kembali);
                kembalianHid.value = kembali;
                btnProses.disabled = false;
            } else {
                kembalian.value = '0';
                kembalianHid.value = '0';
                btnProses.disabled = true;
            }

            // === Prediksi pembayaran tetap sama ===
            prediksiDiv.innerHTML = '';
            const arr = [
                totalHarusDibayar,
                Math.ceil(totalHarusDibayar / 5000) * 5000,

            ];
            arr.forEach(v => {
                if (v >= totalHarusDibayar) {
                    let btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn btn-light btn-sm';
                    btn.textContent = formatRupiah(v); // tanpa "Rp " di sini karena akan ditambahkan di style
                    btn.style.cssText = `
            padding: 4px 12px;
            font-size: 0.75rem;
            opacity: 0.8;
            border-color: #ccc;
            margin: 2px;
        `;

                    // Hover effect: sedikit lebih terang
                    btn.addEventListener('mouseenter', () => btn.style.opacity = '1');
                    btn.addEventListener('mouseleave', () => btn.style.opacity = '0.8');

                    btn.onclick = () => {
                        nominalBayar.value = formatRupiah(v);
                        nominalHidden.value = v;
                        hitung();
                    };

                    prediksiDiv.appendChild(btn);
                }
            });
        }

        // Format input rupiah otomatis
        nominalBayar.addEventListener('input', function() {
            let v = this.value.replace(/\D/g, '');
            this.value = v ? formatRupiah(v) : '';
            hitung();
        });

        depositTambahan.addEventListener('input', hitung);

        // Reset & hitung pertama kali
        nominalBayar.value = '';
        depositTambahan.value = '0';
        hitung();
    });

    // Pilih Metode Pembayaran
    window.pilihMetodePembayaran = function(btn) {
        Swal.fire({
            title: 'Pilih Metode Pembayaran',
            width: '600px',
            showConfirmButton: false,
            html: `<div class="table-responsive">
            <table class="table table-sm table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Metode</th>
                        <th>Bank</th>
                        <th>Rekening</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q = mysql_query("SELECT mp.*, b.nama_bank,b.id_bank, b.rekening, b.atas_nama 
                                  FROM data_metode_pembayaran mp 
                                  LEFT JOIN data_bank b ON mp.id_bank = b.id_bank 
                                  WHERE b.id_hotel = '{$bk['id_hotel']}' 
                                  ORDER BY mp.metode_pembayaran ASC");

                while ($m = mysql_fetch_array($q)) {
                    $idmp     = $m['id_metode_pembayaran'];
                    $metode   = htmlspecialchars(ucwords($m['metode_pembayaran']), ENT_QUOTES);
                    $namaBank = $m['nama_bank'] ? htmlspecialchars(ucwords($m['nama_bank']), ENT_QUOTES) : '-';
                    $idBank = $m['id_bank'];
                    $rek      = htmlspecialchars(isset($m['rekening']) ? $m['rekening']:'-', ENT_QUOTES);
                    $atasNama = htmlspecialchars($m['atas_nama'] ? $m['atas_nama']:'', ENT_QUOTES);

                    // Tambahkan data-nama_bank di sini!
                    echo "<tr>
                        <td>{$metode}</td>
                        <td>{$namaBank}</td>
                        <td>{$rek}</td>
                        <td>
                            <button type='button' class='btn btn-sm btn-danger'
                                data-id='{$idmp}'
                                data-metode='{$metode}'
                                data-nama_bank='{$namaBank}'
                                data-id_bank='{$idBank}'
                                data-rekening='{$rek}'
                                onclick=\"pilihMetode(this, 'pembayaran')\">Pilih</button>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>`
        });
    };

    // Pilih Metode Deposit Tambahan (sama, tapi filter Tunai/Transfer)
    window.pilihMetodeDeposit = function(btn) {
        Swal.fire({
            title: 'Pilih Metode Deposit',
            width: '600px',
            showConfirmButton: false,
            html: `<div class="table-responsive">
            <table class="table table-sm table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Metode</th>
                        <th>Bank</th>
                        <th>Rekening</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q = mysql_query("SELECT mp.*, b.nama_bank,b.id_bank, b.rekening, b.atas_nama 
                                  FROM data_metode_pembayaran mp 
                                  LEFT JOIN data_bank b ON mp.id_bank = b.id_bank 
                                  WHERE b.id_hotel = '{$bk['id_hotel']}' 
                                    AND (mp.metode_pembayaran LIKE '%tunai%' 
                                         OR mp.metode_pembayaran LIKE '%transfer%' 
                                         OR mp.metode_pembayaran LIKE '%bank%')
                                  ORDER BY mp.metode_pembayaran ASC");

                while ($m = mysql_fetch_array($q)) {
                    $idmp     = $m['id_metode_pembayaran'];
                    $metode   = htmlspecialchars(ucwords($m['metode_pembayaran']), ENT_QUOTES);
                    $namaBank = $m['nama_bank'];
                    $idBank = $m['id_bank'];
                    $rek      = htmlspecialchars(isset($m['rekening']) ?$m['rekening'] :'-', ENT_QUOTES);
                    $atasNama = htmlspecialchars(isset($m['atas_nama']) ? $m['rekening']:'', ENT_QUOTES);

                    echo "<tr>
                        <td>{$metode}</td>
                        <td>{$namaBank}</td>
                        <td>{$rek}</td>
                        <td>
                            <button type='button' class='btn btn-sm btn-danger'
                                data-id='{$idmp}'
                                data-metode='{$metode}'
                                data-nama_bank='{$namaBank}'
                                data-id_bank='{$idBank}'
                                data-rekening='{$rek}'
                                onclick=\"pilihMetode(this, 'deposit')\">Pilih</button>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>`
        });
    };


    function pilihMetode(element, tipe) {
        const metode = element.dataset.metode;
        const idMetode = element.dataset.id;
        const namaBank = element.dataset.nama_bank || '-';
        const idBank = element.dataset.id_bank || '-';
        const rekening = element.dataset.rekening || '-';

        // Cari modal yang sedang aktif
        const modal = document.querySelector('.modal.show');
        if (!modal) {
            alert('Modal tidak ditemukan!');
            return;
        }

        if (tipe === 'pembayaran') {
            modal.querySelector('#metode_pembayaran').value = metode;
            modal.querySelector('#metode_pembayaran_text').value = metode;
            modal.querySelector('#id_metode_pembayaran').value = idMetode;
            modal.querySelector('#no_rekening').value = rekening;
            modal.querySelector('#nama_bank').value = namaBank;
            modal.querySelector('#id_bank').value = idBank;

            // Tampilkan juga nama bank di input tersembunyi (opsional, untuk proses PHP)
            if (modal.querySelector('#nama_bank_pembayaran')) {
                modal.querySelector('#nama_bank_pembayaran').value = namaBank;
            }

            Swal.fire('Dipilih!', `Metode: <strong>${metode}</strong><br>Bank: <strong>${namaBank}</strong>`, 'success');

        } else if (tipe === 'deposit') {
            modal.querySelector('#metode_deposit').value = metode;
            modal.querySelector('#metode_deposit_text').value = metode;
            modal.querySelector('#id_metode_deposit').value = idMetode;
            modal.querySelector('#no_rekening_deposit').value = rekening;

            Swal.fire('Deposit Dipilih!', `Via: <strong>${metode}</strong><br>Bank: <strong>${namaBank}</strong>`, 'success');
        }

        // Tutup SweetAlert
        Swal.close();
    }


</script>
<hr>
<?php
$jam = floor($selisih / 3600);

$jam_default = baca_database("", "value", "select * from data_pengaturan_aplikasi where nama_pengaturan='jam_batal_transaksi'");
if ($jam < $jam_default && $data['status_transaksi'] !== 'Selesai') {
?>
    <p class="text-start text-danger">
        <span style='font-weight:700'>Information!:</span> Fitur batal transaksi hanya dapat digunakan <?= $jam_default ?> jam dari waktu checkin.
    </p>
<?php
} ?>


<?php if (isset($_COOKIE['id_hotel']) && $id_hotel == decrypt($_COOKIE['id_hotel'])) { ?>
    <?php if ($data['status_transaksi'] == "Selesai") {
    } else {

        if (pengaturan_printer("ukuran_kertas", $id_hotel) == "A4") {
    ?>
            <button class="btn btn-light-danger btn-sm" onclick="window.location.href='<?php echo $link; ?>?id_trx=<?php echo $id_transaksi; ?>&status=checkin'">Cetak Ulang Nota</button>
        <?php
        } else {
        ?>
            <button class="btn btn-light-danger btn-sm" onclick="window.location.href='<?php echo $link; ?>?id_trx=<?php echo $id_transaksi; ?>'">Cetak Ulang Nota</button>
        <?php
        }

        if((time()-strtotime($bk['waktu_transaksi']))/3600<=$jam_default ){
        ?>

        <button class="btn btn-danger btn-sm" onclick="modal_hapus('<?= $id_transaksi ?>','<?= baca_database('','nama_pelanggan',"select * from data_transaksi where id_transaksi='$id_transaksi'") ?>')"> Batalkan Transaksi</button>

        <!-- <button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/index.php?input=tampil&id=<?php echo $id_kamar ?>&trx=<?php echo encrypt($id_transaksi) ?>'">Check Out</button>
 -->
        <?php
        }
        
    }
} elseif (isset($_COOKIE['operasional'])) {
    echo "";
} else {
    if ($data['status_transaksi'] == "Selesai") {
    } else {

        if (pengaturan_printer("ukuran_kertas", $id_hotel) == "A4") {
        ?>
            <button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/notaA4.php?id_trx=<?php echo $id_transaksi; ?>&status=checkin'">Cetak Ulang Nota</button>
        <?php
        } else {
        ?>
            <button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/cetak_nota.php?id_trx=<?php echo $id_transaksi; ?>'">Cetak Ulang Nota</button>
        <?php
        }



        ?>


        <!-- 
        <button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/index.php?input=tampil&id=<?php echo $data['id_kamar'] ?>&trx=<?php echo encrypt($data['id_transaksi']) ?>'">Check Out</button> -->



<?php
    }
} ?>

<?php

if ($jam <= $jam_default && $data['status_transaksi'] == 'Lunas') {
    $jenenge = decrypt($_COOKIE['jenenge']);

    $id_admin = baca_database("", "id_admin", "select * from data_admin where username='$jenenge'");
    if ($id_admin == null) {
        $id_admin = baca_database("", "id_pengelola", "select * from data_pengelola where username='$jenenge'");
    }
?>
    <button class="btn btn-light-danger btn-sm" onclick="window.location.href='../data_transaksi/index.php?input=hapus&proses=<?php echo encrypt($data['id_transaksi']) ?>&admin=<?= $id_admin ?>'"> Hapus Transaksi</button>
<?php
}
?>
<script>
    function modal_hapus(id, nama_pelanggan){
    Swal.fire({
        title: 'Perhatian!',
        text: `Apakah Anda yakin menghapus transaksi an. ${nama_pelanggan}?`,
        showConfirmButton: true,
        showCancelButton: true,
        icon: 'warning',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {

        // Jika user menekan tombol confirm
        if (result.isConfirmed) {
            fetch("hapus_transaksi.php", {
                method: 'POST',
                body: JSON.stringify({
                    request: id
                })
            })
            .then(res => res.json())
            .then(data => {

                if (data.response === true) {
                    Swal.fire({
                        title: 'Proses Hapus Berhasil',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'index.php';
                    });

                } else {
                    Swal.fire({
                        title: 'Proses Hapus Gagal',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }

            })
            .catch(error => {
                console.error(error);
                Swal.fire({
                    title: 'Terjadi Kesalahan Server',
                    icon: 'error'
                });
            });
        }
    });
}
</script>