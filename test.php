<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Datepicker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
</head>

<body>
    <div class="container mt-3">
        <form id="formBooking" action="oke.php" method="get">
            <div class="mb-3">
                <label>Waktu Check-In</label>
                <input id="waktu_checkin_preview" class="form-control" placeholder="Pilih tanggal..." required>
                <input id="waktu_checkin" name="checkin" type="hidden" required>
            </div>

            <div class="mb-3">
                <label>Waktu Check-Out</label>
                <input id="waktu_check_out_preview" class="form-control" readonly>
                <input id="waktu_check_out" name="checkout" type="hidden">
            </div>

            <div class="mb-3 d-flex align-items-center gap-2">
                <label class="mb-0 me-2">Jumlah Hari</label>
                <button id="btn-minus" class="btn btn-secondary btn-day" type="button">-</button>
                <input id="jumlah_hari" name="jumlah_hari" type="number" class="form-control text-center" min="1" value="1" style="width:80px" required>
                <button id="btn-plus" class="btn btn-secondary btn-day" type="button">+</button>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Simpan / Kirim</button>
        </form>
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
        fetch('schedule.php').then(res => res.json()).then(data => {
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
                                html: `Dalam hari dari tanggal <b>${dateStr}</b>  terdapat ${item.info || 'Transaksi'} sehingga tanggal tidak dapat digunakan. `,
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
                                html: `Dalam hari dari tanggal <b>${dateStr}</b>  terdapat Booking/Transaksi sehingga tanggal tidak dapat digunakan. `,
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
        document.getElementById("btn-plus").addEventListener("click", () => {
            const input = document.getElementById("jumlah_hari");
            const max = parseInt(input.max || 365);
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
                hitungCheckout();
            }
        });
        document.getElementById("btn-minus").addEventListener("click", () => {
            const input = document.getElementById("jumlah_hari");
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                hitungCheckout();
            }
        });
    </script>
</body>

</html>