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
                        background-color: #75cc68;
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

                        if (isset($_GET['id'])) {
                            $idKamar = $_GET['id'];
                            $noKamar = baca_database('', 'no_kamar', "select * from data_kamar where id_hotel='$id_hotel' and id_kamar='$_GET[id]'");
                        } else {
                            $idKamar = '';
                            $noKamar = '';
                        }

                        $harga_harian = baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$_GET[id]'");
                        $kapasitas = baca_database("", "kapasitas", "select * from data_kamar where id_kamar='$_GET[id]'");
                        $id_tipe_kamar = baca_database("", "id_tipe_kamar", "select * from data_kamar where id_kamar='$_GET[id]'");
                        $tipe_kamar = baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$id_tipe_kamar'");


                        ?>

                        <input type="hidden" value="<?php echo id_otomatis("data_transaksi", "id_transaksi", "10"); ?>" name="id_transaksi" placeholder="Id Transaksi " id="id_transaksi" required="required">
                        <input type="hidden" value="<?php echo  $idKamar; ?>" style="width:80%" name="id_kamar" id="id_kamar" placeholder="Id kamar " required="required">
                        <input type="hidden" name="jumlah_bulan" id="jumlah_bulan" placeholder="Jumlah Bulan">
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
                                    <!-- KIRI: Badge + Judul Check-in (satu grup rata kiri) -->
                                    <div class="d-flex align-items-center gap-3">
                                        <?php
                                        $displayKamar = strlen($noKamar) > 5 ? substr($noKamar, 0, 18) . "..." : $noKamar;
                                        ?>
                                        <div class="room-badge" data-full="<?php echo htmlspecialchars($noKamar); ?>">
                                            <?php echo htmlspecialchars($displayKamar); ?>
                                        </div>

                                        <h4 class="mb-0">
                                            <i class="fas fa-sign-in-alt text-success"></i>
                                            Check-in <?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$idHotel'") ?>
                                        </h4>
                                    </div>

                                    <!-- KANAN: Sendirian di ujung kanan -->
                                    <h4 class="mb-0 fw-bold text-success">
                                        Transaksi harian
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
                                                <div class="card-group-title">Informasi Kamar</div>

                                                <label class="form-label">Tanggal</label>
                                                <input type="date" class="form-control mb-2" name="tanggal" value="<?php echo date('Y-m-d'); ?>">

                                                <label class="form-label">Channel</label>
                                                <select class="form-select mb-2" name="id_channel">
                                                    <?php combo_database_v2("data_channel", "id_channel", "channel", ""); ?>
                                                </select>





                                                <div class="row">

                                                    <label class="form-label">Tipe Kamar</label>
                                                    <div class="input-group">
                                                        <input class="form-control mb-2" readonly name="tipe_kamar" redonly value="<?php echo $tipe_kamar; ?>">

                                                    </div>


                                                </div>



                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                                                <style>
                                                    /* ======= WARNA TANGGAL ======= */
                                                    .booking-end {
                                                        background: #d8eaff !important;
                                                        color: #003f8c !important;
                                                        border-radius: 10px !important;
                                                        font-weight: 600;
                                                    }

                                                    .transaksi-end {
                                                        background: #ffd8d6 !important;
                                                        color: #8c0000 !important;
                                                        border-radius: 10px !important;
                                                        font-weight: 600;
                                                    }

                                                    .booking-date {
                                                        background: #d8eaff !important;
                                                        color: #003f8c !important;
                                                        border-radius: 10px !important;
                                                        font-weight: 600;
                                                    }

                                                    .transaksi-date {
                                                        background: #ffd8d6 !important;
                                                        color: #8c0000 !important;
                                                        border-radius: 10px !important;
                                                        font-weight: 600;
                                                    }

                                                    .today-date {
                                                        background: #eaf7d8 !important;
                                                        color: #3f6b00 !important;
                                                        border: 2px solid #9bd354 !important;
                                                        border-radius: 10px !important;
                                                        font-weight: 700;
                                                    }

                                                    .overlap-checkin {
                                                        background: #90c4fffa !important;
                                                        color: #030303 !important;
                                                        border-radius: 10px !important;
                                                        font-weight: 600;
                                                        cursor: not-allowed !important;
                                                        opacity: 0.9;
                                                    }

                                                    .flatpickr-day.selected,
                                                    .flatpickr-day.startRange,
                                                    .flatpickr-day.endRange {
                                                        border-radius: 10px !important;
                                                    }

                                                    .flatpickr-day:hover {
                                                        border-radius: 10px !important;
                                                        background: #e5e5e5 !important;
                                                    }

                                                    .btn-day {
                                                        width: 40px;
                                                        height: 38px;
                                                        padding: 0;
                                                        text-align: center;
                                                        font-weight: bold;
                                                    }

                                                    .swal2-container {
                                                        z-index: 99999 !important;
                                                    }
                                                </style>
                                                <label class="form-label">Tanggal Cek In</label>
                                                <input id="waktu_checkin_preview" class="form-control mb-2" placeholder="Pilih tanggal..." required>
                                                <input id="waktu_checkin" name="waktu_checkin" type="hidden" required>

                                                <label class="form-label">Tanggal Cek Out</label>
                                                <input id="waktu_check_out_preview" class="form-control" placeholder="Pilih Check-in..." readonly>
                                                <input id="waktu_check_out" name="waktu_check_out" type="hidden" required>

                                                <label class="form-label">Jumlah Hari</label>
                                                <div class="input-group mb-2">
                                                    <button id="btn-minus" style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">-</button>
                                                    <input class="form-control" style="height: 38px;text-align: center;" type="number" name="jumlah_hari" min="1" id="jumlah_hari" value="1" placeholder="Jumlah Hari" required>
                                                    <button id="btn-plus" style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">+</button>
                                                </div>


                                                <script>
                                                    // ======== FORMAT TANGGAL ========
                                                    function toLocalDateString(date) {
                                                        const d = String(date.getDate()).padStart(2, '0');
                                                        const m = String(date.getMonth() + 1).padStart(2, '0');
                                                        const y = date.getFullYear();
                                                        return `${d}/${m}/${y}`;
                                                    }

                                                    function toDateInputString(date) {
                                                        const d = String(date.getDate()).padStart(2, '0');
                                                        const m = String(date.getMonth() + 1).padStart(2, '0');
                                                        const y = date.getFullYear();
                                                        return `${y}-${m}-${d}`;
                                                    }

                                                    // ======== GLOBAL ========
                                                    let dateMap = {};
                                                    let fpCheckIn;
                                                    let mode = "checkin";

                                                    // ======== AMBIL DATA SCHEDULE ========
                                                    fetch('schedule.php', {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json'
                                                            },
                                                            body: JSON.stringify({
                                                                id_kamar: "<?php echo $_GET['id']; ?>"
                                                            })
                                                        })
                                                        .then(res => res.json())
                                                        .then(data => {
                                                            data.forEach(i => {
                                                                let cur = new Date(i.checkin);
                                                                const last = new Date(i.checkout);

                                                                while (cur <= last) {
                                                                    const str = toLocalDateString(cur);
                                                                    const isEnd = cur.getTime() === last.getTime();

                                                                    if (!dateMap[str] || i.type === "transaksi") {
                                                                        dateMap[str] = {
                                                                            type: i.type,
                                                                            info: i.info,
                                                                            end: isEnd,
                                                                            checkin: i.checkin
                                                                        };
                                                                    }

                                                                    cur.setDate(cur.getDate() + 1);
                                                                }
                                                            });

                                                            initFlatpickr();
                                                        });


                                                    // ======== FLATPICKR ========
                                                    function initFlatpickr() {
                                                        const today = new Date();
                                                        today.setDate(today.getDate()-1);
                                                        today.setHours(0, 0, 0, 0);
                                                        const todayStr = toLocalDateString(today);

                                                        fpCheckIn = flatpickr("#waktu_checkin_preview", {
                                                            dateFormat: "d/m/Y",
                                                            disable: [d => {
                                                                d.setHours(0, 0, 0, 0);
                                                                return d < today;
                                                            }],

                                                            onChange: function(_, dateStr) {
                                                                if (!dateStr) return;
                                                                mode = "checkout";

                                                                const parts = dateStr.split('/');
                                                                const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
                                                                document.getElementById("waktu_checkin").value = toDateInputString(checkin);

                                                                const maxHari = getMaxDays(dateStr);
                                                                document.getElementById("jumlah_hari").max = maxHari;

                                                                const checkout = new Date(checkin);
                                                                checkout.setDate(checkin.getDate() + 1);
                                                                document.getElementById("waktu_check_out_preview").value = toLocalDateString(checkout);
                                                                document.getElementById("waktu_check_out").value = toDateInputString(checkout);

                                                                hitungCheckout();
                                                            },

                                                            onDayCreate: function(_, __, ___, dayElem) {
                                                                const dateStr = toLocalDateString(dayElem.dateObj);

                                                                if (dateMap[dateStr]) {
                                                                    const {
                                                                        type,
                                                                        info,
                                                                        end,
                                                                        checkin
                                                                    } = dateMap[dateStr];
                                                                    dayElem.dataset.end = end ? "true" : "false";
                                                                    dayElem.dataset.info = info || "";
                                                                    dayElem.dataset.type = type;

                                                                    // === DETEKSI OVERLAP (hari checkout + ada orang lain yang akan check-in di hari ini) ===
                                                                    let isOverlap = false;
                                                                    if (end) {
                                                                        for (const key in dateMap) {
                                                                            if (dateMap[key].checkin && toLocalDateString(new Date(dateMap[key].checkin)) === dateStr) {
                                                                                isOverlap = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }

                                                                    // Styling
                                                                    if (isOverlap) {
                                                                        dayElem.classList.add("overlap-checkin");
                                                                    } else if (end) {
                                                                        dayElem.classList.add(type === "booking" ? "booking-end" : "transaksi-end");
                                                                    } else {
                                                                        dayElem.classList.add(type === "booking" ? "booking-date" : "transaksi-date");
                                                                    }
                                                                }

                                                                if (dateStr === todayStr) dayElem.classList.add("today-date");
                                                                if (dayElem.dataset.info) dayElem.title = dayElem.dataset.info;

                                                                // === KLIK HARI ===
                                                                dayElem.addEventListener("click", function(e) {
                                                                    const item = dateMap[dateStr];

                                                                    // 1. Hari di tengah booking (bukan end) → blokir
                                                                    if (item && !item.end) {
                                                                        e.preventDefault();
                                                                        e.stopPropagation();
                                                                        Swal.fire({
                                                                            title: "Tidak Dapat dipilih",
                                                                            html: `Dalam hari dari tanggal <b>${dateStr}</b>  terdapat <b>${item.info || 'Transaksi'}</b>, sehingga kamar di tanggal tersebut tidak dapat digunakan. `,
                                                                            icon: "info"
                                                                        });
                                                                        return;
                                                                    }

                                                                    // 2. Hari overlap-checkin (ada orang lain yang akan check-in) → blokir juga
                                                                    if (dayElem.classList.contains("overlap-checkin")) {
                                                                        e.preventDefault();
                                                                        e.stopPropagation();
                                                                        Swal.fire({
                                                                            title: "Tidak Dapat dipilih",
                                                                            html: `Dalam hari dari tanggal <b>${dateStr}</b>  terdapat Booking/Transaksi, sehingga tanggal kamar di tanggal tersebut tidak dapat digunakan. `,
                                                                            icon: "warning"
                                                                        });
                                                                        return;
                                                                    }

                                                                    // Selain itu → boleh dipilih
                                                                });
                                                            }
                                                        });
                                                    }

                                                    // === MAX DAYS (hanya sampai ketemu hari yang DI TENGAH booking) ===
                                                    function getMaxDays(checkinStr) {
                                                        if (!checkinStr) return 1;
                                                        const parts = checkinStr.split('/');
                                                        const start = new Date(parts[2], parts[1] - 1, parts[0]);
                                                        for (let i = 1; i <= 365; i++) {
                                                            const temp = new Date(start);
                                                            temp.setDate(start.getDate() + i);
                                                            const key = toLocalDateString(temp);
                                                            if (dateMap[key] && !dateMap[key].end) return i;
                                                        }
                                                        return 365;
                                                    }

                                                    // === HITUNG CHECKOUT ===
                                                    function hitungCheckout() {
                                                        const checkinStr = document.getElementById("waktu_checkin_preview").value;
                                                        if (!checkinStr) return;
                                                        const hari = parseInt(document.getElementById("jumlah_hari").value || 1);
                                                        const parts = checkinStr.split('/');
                                                        const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
                                                        const checkout = new Date(checkin);
                                                        checkout.setDate(checkin.getDate() + hari);
                                                        document.getElementById("waktu_check_out_preview").value = toLocalDateString(checkout);
                                                        document.getElementById("waktu_check_out").value = toDateInputString(checkout);
                                                    }

                                                    // === BATASI INPUT JUMLAH HARI AGAR TIDAK MELEBIHI MAX ===
                                                    document.getElementById("jumlah_hari").addEventListener("input", function(e) {
                                                        const input = this;
                                                        const value = parseInt(input.value);
                                                        const max = parseInt(input.max) || 365;

                                                        // Jika kosong atau bukan angka
                                                        if (isNaN(value)) {
                                                            input.value = 1;
                                                            hitungCheckout();
                                                            return;
                                                        }

                                                        // Jika melebihi max
                                                        if (value > max) {
                                                            input.value = max;
                                                            hitungCheckout();

                                                            Swal.fire({
                                                                title: "Batas Maksimal!",
                                                                html: `Maksimal booking adalah <b>${max} hari</b> dari tanggal check-in yang dipilih karena ada jadwal lain setelahnya.`,
                                                                icon: "warning",
                                                                timer: 4000,
                                                                timerProgressBar: true
                                                            });
                                                        }

                                                        // Jika kurang dari 1
                                                        if (value < 1) {
                                                            input.value = 1;
                                                        }

                                                        hitungCheckout();
                                                    });

                                                    // === PLUS MINUS ===
                                                    document.getElementById("jumlah_hari").addEventListener("input", hitungCheckout);
                                                    // document.getElementById("btn-plus").addEventListener("click", () => {
                                                    //     const input = document.getElementById("jumlah_hari");
                                                    //     const max = parseInt(input.max || 365);
                                                    //     if (parseInt(input.value) < max) {
                                                    //         input.value = parseInt(input.value) + 1;
                                                    //         hitungCheckout();
                                                    //     }
                                                    // });
                                                    // document.getElementById("btn-minus").addEventListener("click", () => {
                                                    //     const input = document.getElementById("jumlah_hari");
                                                    //     if (parseInt(input.value) > 1) {
                                                    //         input.value = parseInt(input.value) - 1;
                                                    //         hitungCheckout();
                                                    //     }
                                                    // });
                                                </script>

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

                                                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Pelanggan" required>
                                                    <input type="hidden" name="id_pelanggan" id="id_pelanggan">


                                                    <button type="button" class="btn btn-secondary" onclick='cari_pelanggan("<?php echo $idHotel ?>","<?php echo $namaHotel ?>")'>
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>


                                                <div class="row g-2 mb-1">
                                                    <div class="col-4">
                                                        <label class="form-label">Identitas</label>
                                                        <input required class="form-control " name="identitas" id="identitas" placeholder="Identitas">

                                                    </div>
                                                    <div class="col-8">
                                                        <label class="form-label">No. Identitas</label>
                                                        <div class="input-group ">
                                                            <input required type="text" style="height: 38px;" class="form-control" name="no_identitas" id="no_identitas" placeholder="No Identitas">

                                                        </div>
                                                    </div>
                                                </div>

                                                <label class="form-label">Alamat</label>
                                                <input required type="text" class="form-control mb-1" name="alamat" id="alamat" placeholder="Alamat">

                                                <label class="form-label">No. Telp</label>
                                                <input required type="text" class="form-control mb-2" name="no_telp" id="no_telp" placeholder="No Telp">

                                                <label class="form-label">Jenis Kelamin</label>
                                                <select required class="form-control mb-2" name="jenis_kelamin" id="jenis_kelamin">
                                                    <option value="" disabled selected>Jenis Kelamin</option>
                                                    <option value="laki-laki">Laki-laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>





                                                <label class="form-label">Jumlah Tamu</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Dewasa</span>
                                                    <input class="form-control" min="1" value="1" style="text-align: center;" type="number" name="jumlah_dewasa" id="jumlah_dewasa" placeholder="Jumlah Dewasa " required="required">

                                                    <span class="input-group-text">Anak</span>
                                                    <input class="form-control" value="0" min="0" style="text-align: center;" type="number" name="jumlah_anak_anak" id="jumlah_anak_anak" placeholder="Jumlah Anak Anak ">
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
                                                                <h5 class="modal-title" id="noteModalLabel">Catatan Tambahan Biaya Check-in</h5>
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
                                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalPembayaran"><i class="fa fa-save"></i> Check-in</button>
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



                                        <label class="form-label">Informasi Deposit <label class="form-label" onclick="Swal.fire({
                                                                                title: 'Informasi Deposit',
                                                                                text: 'Catatan : Jumlah nominal deposit tidak dihitung dalam total transaksi yang dilakukan oleh pelanggan, melainkan hanya dicatat sebagai informasi tambahan.',
                                                                                confirmButtonText: 'Mengerti'
                                                                        })">
                                                <i style="color:#bf2b2763" class="fa fa-info-circle"></i>

                                            </label></label>

                                        <div class="d-flex justify-content-evenly align-items-center">
                                            <input type="hidden" name="id_metode_pembayaran_deposit" id="id_metode_pembayaran_deposit">
                                            <input type="hidden" name="no_rekening_deposit" id="no_rekening_deposit" value='-'>
                                            <div class="input-group mb-2 me-3">


                                                <button type="button" onclick='pilih_metode_deposit()' class="btn btn-secondary">
                                                    Metode
                                                </button>
                                                <input type="text" onclick='pilih_metode_deposit()' class="form-control" name="metode_pembayaran_deposit" id="metode_pembayaran_deposit" value='' readonly>
                                            </div>


                                            <div class="input-group mb-2">
                                                <span class="input-group-text">Rp</span>
                                                <input type="hidden" class="form-control" id="nominal_deposit" name="nominal_deposit">
                                                <input class="form-control" type="text" name="deposit" id="deposit" value="0">
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class='me-3'>
                                                <label class="form-label">Grand Total</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rp</span>

                                                    <input type="text" readonly class="form-control" id="grand_total" name="grand_total">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="form-label">Grand Total + Deposit</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="hidden" name="" id='grandtotal_ndepo_hidden'>
                                                    <input type="text" readonly class="form-control" id="grand_total_plus_depo" name="grand_total_plus_depo">
                                                </div>
                                            </div>
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
                                            <label class="form-label">Nominal Pembayaran</label>
                                            <div class='d-flex align-items-center'>
                                                <input type="checkbox" class="form-check-input me-2" id='totalplusdepo'>
                                                <label for="" class="form-check-label text-dark">Nominal + Deposit</label>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>
                                            <input type="hidden" class="form-control" id="nominal" name="nominal">
                                            <input class="form-control" type="text" name="nominal_bayar" id="nominal_bayar" value="">
                                        </div>


                                        <div class="mb-2">
                                            <small class="text-muted" style="font-size:0.7rem;">Estimasi Nominal Transaksi:</small>

                                            <!-- Tombol Prediksi Bayar Kecil -->
                                            <div class="mb-2" id="prediksi_buttons" style="display:flex; gap:5px; flex-wrap:wrap;"></div>

                                        </div>





                                        <label class="form-label">Kembalian</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp</span>

                                            <input type="hidden" class="form-control" name="kembalian" id='kembalian' value='0'>
                                            <input type="text" class="form-control" name="kembalian_value" id='kembalian_value' value='0'>

                                        </div>


                                        <input type="hidden" class="form-control" name="sisa" id='sisa' value='0'>
                                        <input type="hidden" class="form-control" name="sisa_value" id='sisa_value' value='0'>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" id='simpan_data'>Proses Check-in</button>
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
            totalplusdepo: document.getElementById('totalplusdepo'),
            grandplusdepohidden: document.getElementById('grandtotal_ndepo_hidden')
        };



        // Constants
        const DAILY_RATE = <?php echo intval($harga_harian) ?>;
        const MS_PER_DAY = 24 * 60 * 60 * 1000;

        // Format number to Rupiah
        const formatRupiah = (value) => new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value)

        const calculateBasePrice = (days) => {
            return days * DAILY_RATE;
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


        const total_plus_depo = (e) => {
            const grandtotal = elements.priceInput.value;
            const total_semua = elements.grandplusdepohidden.value;
            const payment = elements.payment;
            if (e.target.checked) {
                payment.value = total_semua;
                createPrediksiButtons(total_semua);
            } else {
                elements.payment.value = grandtotal;
                createPrediksiButtons(grandtotal);
            }
            elements.change.value = 0;
            elements.changeDisplay.value = formatRupiah(0);
        }


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
            // elements.checkout.value = checkout.toISOString().split('T')[0];

            elements.harga_kamar.value = calculateBasePrice(days);
            updateFinalPrice();
        };

        // Update days based on checkin and checkout
        const updateDays = () => {
            const checkin = new Date(elements.checkin.value);
            const checkout = new Date(elements.checkout.value);
            const days = Math.floor((checkout - checkin) / MS_PER_DAY);
            days == 0 ? elements.days.value = 1 : elements.days.value = days;

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
        elements.displayDeposit.addEventListener('input', updateGrandTotal);
        elements.additionalFee.addEventListener('input', () => {
            //elements.additionalFeeDisplay.innerHTML = formatRupiah(Number(elements.additionalFee.value) || 0);

        });
        elements.totalplusdepo.addEventListener('click', total_plus_depo);


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

        // Tombol minus
        document.getElementById("btn-minus").addEventListener("click", () => {
            const input = document.getElementById("jumlah_hari");
            const checkinStr = document.getElementById("waktu_checkin").value;

            if (!checkinStr) return; // Jika check-in belum dipilih, tombol tidak berfungsi

            let val = parseInt(input.value) || 1;
            if (val > 1) {
                val--;
                input.value = val;
                hitungCheckout();
                updateCheckoutDate();
            }
        });

        // Tombol plus
        document.getElementById("btn-plus").addEventListener("click", () => {
            const input = document.getElementById("jumlah_hari");
            const checkinStr = document.getElementById("waktu_checkin").value;

            if (!checkinStr) return; // Jika check-in belum dipilih, tombol tidak berfungsi

            let val = parseInt(input.value) || 1;
            const max = parseInt(input.max) || 365; // Ambil dari max jumlah_hari
            if (val < max) {
                val++;
                input.value = val;
                hitungCheckout();
                updateCheckoutDate();
            }
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
WHERE b.id_hotel = '$idHotel'") or die(mysql_error());
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
                        jumlah_dewasa: element.jumlah_dewasa,
                        jumlah_anak_anak: element.jumlah_anak_anak,
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