<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Bulanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
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
                <label class="mb-0 me-2">Jumlah Bulan</label>
                <button id="btn-minus" class="btn btn-secondary btn-day" type="button">-</button>
                <input id="jumlah_bulan" name="jumlah_bulan" type="number" class="form-control text-center" min="1" value="1" style="width:80px" required>
                <button id="btn-plus" class="btn btn-secondary btn-day" type="button">+</button>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Simpan / Kirim</button>
        </form>
    </div>

    <script>
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

        let dateMap = {};
        let fpCheckIn;

        fetch('schedule.php').then(res => res.json()).then(data => {
            data.forEach(i => {
                let cur = new Date(i.checkin);
                const last = new Date(i.checkout);
                while (cur <= last) {
                    const str = toLocalDateString(cur);
                    if (!dateMap[str] || i.type === "transaksi") {
                        dateMap[str] = {
                            type: i.type,
                            info: i.info,
                            end: cur.getTime() === last.getTime(),
                            checkin: i.checkin
                        };
                    }
                    cur.setDate(cur.getDate() + 1);
                }
            });
            initFlatpickr();
        });

        function isRangeAvailable(checkin, jumlahBulan) {
            const checkout = new Date(checkin);
            checkout.setMonth(checkin.getMonth() + jumlahBulan);
            let cur = new Date(checkin);
            while (cur < checkout) {
                const key = toLocalDateString(cur);
                if (dateMap[key] && !dateMap[key].end) return false;
                cur.setDate(cur.getDate() + 1);
            }
            return true;
        }

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

                    const parts = dateStr.split('/');
                    const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
                    const jumlahBulan = parseInt(document.getElementById("jumlah_bulan").value || 1);

                    if (!isRangeAvailable(checkin, jumlahBulan)) {
                        Swal.fire({
                            title: "Tanggal tidak dapat dipilih",
                            html: `Tanggal check-in <b>${dateStr}</b> tidak dapat digunakan karena ada booking/transaksi di bulan yang dipilih.`,
                            icon: "warning"
                        });
                        this.clear();
                        document.getElementById("waktu_checkin").value = "";
                        document.getElementById("waktu_check_out_preview").value = "";
                        document.getElementById("waktu_check_out").value = "";
                        return;
                    }

                    document.getElementById("waktu_checkin").value = toDateInputString(checkin);
                    const checkout = new Date(checkin);
                    checkout.setMonth(checkin.getMonth() + jumlahBulan);
                    document.getElementById("waktu_check_out_preview").value = toLocalDateString(checkout);
                    document.getElementById("waktu_check_out").value = toDateInputString(checkout);
                },
                onDayCreate: function(_, __, ___, dayElem) {
                    const dateStr = toLocalDateString(dayElem.dateObj);
                    if (dateMap[dateStr]) {
                        const {
                            type,
                            end
                        } = dateMap[dateStr];

                        // Styling sesuai status
                        if (end) dayElem.classList.add(type === "booking" ? "booking-end" : "transaksi-end");
                        else dayElem.classList.add(type === "booking" ? "booking-date" : "transaksi-date");

                        // Cek overlap untuk checkin baru
                        let isOverlap = false;
                        if (end) {
                            for (const key in dateMap) {
                                if (dateMap[key].checkin && toLocalDateString(new Date(dateMap[key].checkin)) === dateStr) {
                                    isOverlap = true;
                                    break;
                                }
                            }
                        }
                        if (isOverlap) dayElem.classList.add("overlap-checkin");
                    }

                    if (dateStr === todayStr) dayElem.classList.add("today-date");

                    if (dayElem.dataset.info) dayElem.title = dayElem.dataset.info;

                    dayElem.addEventListener("click", function(e) {
                        const item = dateMap[dateStr];
                        if ((item && !item.end) || dayElem.classList.contains("overlap-checkin")) {
                            e.preventDefault();
                            e.stopPropagation();
                            Swal.fire({
                                title: "Tidak Dapat dipilih",
                                html: `Dalam hari dari tanggal <b>${dateStr}</b> terdapat Booking/Transaksi sehingga tanggal tidak dapat digunakan.`,
                                icon: "warning"
                            });
                        }
                    });
                }
            });
        }

        function hitungCheckout() {
            const checkinStr = document.getElementById("waktu_checkin_preview").value;
            if (!checkinStr) return;
            const bulan = parseInt(document.getElementById("jumlah_bulan").value || 1);
            const parts = checkinStr.split('/');
            const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
            const checkout = new Date(checkin);
            checkout.setMonth(checkin.getMonth() + bulan);
            document.getElementById("waktu_check_out_preview").value = toLocalDateString(checkout);
            document.getElementById("waktu_check_out").value = toDateInputString(checkout);
        }

        const input = document.getElementById("jumlah_bulan");

        input.addEventListener("input", function() {
            let value = parseInt(this.value);
            const max = parseInt(this.max || 12);
            if (isNaN(value) || value < 1) value = 1;
            if (value > max) value = max;

            const checkinStr = document.getElementById("waktu_checkin_preview").value;
            if (checkinStr) {
                const parts = checkinStr.split('/');
                const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
                if (!isRangeAvailable(checkin, value)) {
                    Swal.fire({
                        title: "Tidak Dapat dipilih",
                        html: `Dalam hari dari tanggal <b>${checkinStr}</b> terdapat Booking/Transaksi sehingga tanggal tidak dapat digunakan.`,
                        icon: "warning"
                    });
                    value = parseInt(this.value) - 1;
                }
            }

            this.value = value;
            hitungCheckout();
        });

        document.getElementById("btn-plus").addEventListener("click", () => {
            const inp = document.getElementById("jumlah_bulan");
            let nextValue = parseInt(inp.value) + 1;
            const max = parseInt(inp.max || 12);
            if (nextValue > max) nextValue = max;

            const checkinStr = document.getElementById("waktu_checkin_preview").value;
            if (checkinStr) {
                const parts = checkinStr.split('/');
                const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
                if (!isRangeAvailable(checkin, nextValue)) {
                    Swal.fire({
                        title: "Tidak Dapat dipilih",
                        html: `Dalam hari dari tanggal <b>${checkinStr}</b> terdapat Booking/Transaksi sehingga tanggal tidak dapat digunakan.`,
                        icon: "warning"
                    });
                    return;
                }
            }

            inp.value = nextValue;
            hitungCheckout();
        });

        document.getElementById("btn-minus").addEventListener("click", () => {
            const inp = document.getElementById("jumlah_bulan");
            if (parseInt(inp.value) > 1) inp.value = parseInt(inp.value) - 1;
            hitungCheckout();
        });
    </script>
</body>

</html>