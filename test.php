<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
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
        border-radius: 10px !important;
        border: 2px solid #9bd354 !important;
        font-weight: 700;
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

<div class="container mt-3">
    <form id="formBooking" action="oke.php" method="get">
        <div class="mb-3">
            <label>Waktu Check-In</label>
            <input id="waktu_checkin_preview" class="form-control" placeholder="Pilih tanggal..." required>
            <input id="waktu_checkin" name="checkin" type="text" required>
        </div>

        <div class="mb-3 d-flex align-items-center gap-2">
            <label class="mb-0 me-2">Jumlah Hari</label>
            <button id="btn-minus" class="btn btn-secondary btn-day" type="button">-</button>
            <input id="jumlah_hari" name="jumlah_hari" type="number" class="form-control text-center" min="1" value="1" style="width:80px" required>
            <button id="btn-plus" class="btn btn-secondary btn-day" type="button">+</button>
        </div>

        <div class="mb-3">
            <label>Waktu Check-Out</label>
            <input id="waktu_check_out_preview" class="form-control" readonly>
            <input id="waktu_check_out" name="checkout" type="text">
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
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const todayStr = toLocalDateString(today);
    const disableBeforeToday = [d => {
        d.setHours(0, 0, 0, 0);
        return d < today;
    }];

    let fpCheckIn;

    // Ambil schedule
    fetch('schedule.php')
        .then(res => res.json())
        .then(data => {
            data.forEach(i => {
                let cur = new Date(i.checkin);
                const last = new Date(i.checkout);
                while (cur <= last) {
                    const str = toLocalDateString(cur);
                    if (!dateMap[str] || i.type === "transaksi") dateMap[str] = {
                        type: i.type,
                        info: i.info
                    };
                    cur.setDate(cur.getDate() + 1);
                }
            });
            initFlatpickr();
        });

    function initFlatpickr() {
        fpCheckIn = flatpickr("#waktu_checkin_preview", {
            dateFormat: "d/m/Y",
            disable: disableBeforeToday,
            onChange: function(_, dateStr) {
                if (!dateStr) return;
                const maxHari = getMaxDays(dateStr);
                document.getElementById("jumlah_hari").max = maxHari;

                const parts = dateStr.split('/');
                const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
                document.getElementById("waktu_checkin").value = toDateInputString(checkin);

                let checkout = new Date(checkin);
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
                        info
                    } = dateMap[dateStr];
                    dayElem.classList.add(type === "booking" ? "booking-date" : "transaksi-date");
                    dayElem.dataset.info = info;
                    dayElem.dataset.type = type;
                }
                if (dateStr === todayStr) dayElem.classList.add("today-date");
                if (dayElem.dataset.info) dayElem.title = dayElem.dataset.info;

                dayElem.addEventListener("click", e => {
                    if (dayElem.dataset.info && dayElem.dataset.info !== "Hari Ini") {
                        e.preventDefault();
                        e.stopPropagation();
                        fpCheckIn.open();
                        Swal.fire({
                            title: "Tidak dapat dipilih",
                            html: `Dalam hari dari tanggal <b>${dateStr}</b> terdapat ${dayElem.dataset.info} sehingga tanggal tidak dapat digunakan.`,
                            icon: dayElem.dataset.type === "booking" ? "info" : "warning"
                        }).then(() => resetInput());
                    }
                });
            }
        });
    }

    function getMaxDays(checkinStr) {
        if (!checkinStr) return 1;
        const parts = checkinStr.split('/');
        const start = new Date(parts[2], parts[1] - 1, parts[0]);
        for (let i = 1; i <= 365; i++) {
            const temp = new Date(start);
            temp.setDate(start.getDate() + i);
            if (dateMap[toLocalDateString(temp)]) return i;
        }
        return 365;
    }

    function hitungCheckout() {
        const checkinStr = document.getElementById("waktu_checkin_preview").value;
        if (!checkinStr) return;
        const hari = parseInt(document.getElementById("jumlah_hari").value || 1);
        const parts = checkinStr.split('/');
        const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
        if (isNaN(checkin.getTime())) return;

        let checkout = new Date(checkin);
        checkout.setDate(checkin.getDate() + hari);

        let cur = new Date(checkin);
        let hasConflict = false;
        while (cur < checkout) {
            if (dateMap[toLocalDateString(cur)]) {
                hasConflict = true;
                break;
            }
            cur.setDate(cur.getDate() + 1);
        }
        if (hasConflict) {
            fpCheckIn.open();
            Swal.fire({
                title: "Jumlah hari tidak bisa dipilih",
                html: `Dalam <b>${hari}</b> hari dari <b>${checkinStr}</b> terdapat transaksi/booking sehingga jumlah hari tidak dapat digunakan.`,
                icon: "warning"
            }).then(() => resetInput());
            return;
        }

        document.getElementById("waktu_check_out_preview").value = toLocalDateString(checkout);
        document.getElementById("waktu_check_out").value = toDateInputString(checkout);
    }

    function resetInput() {
        document.getElementById("waktu_checkin_preview").value = "";
        document.getElementById("waktu_checkin").value = "";
        document.getElementById("jumlah_hari").value = 1;
        document.getElementById("waktu_check_out_preview").value = "";
        document.getElementById("waktu_check_out").value = "";
        fpCheckIn.clear();
    }

    // Plus & Minus
    document.getElementById("jumlah_hari").addEventListener("input", hitungCheckout);
    document.getElementById("btn-plus").addEventListener("click", () => {
        const checkinStr = document.getElementById("waktu_checkin_preview").value;
        if (!checkinStr) return;
        const input = document.getElementById("jumlah_hari");
        const max = parseInt(input.max || 365);
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
            hitungCheckout();
        }
    });
    document.getElementById("btn-minus").addEventListener("click", () => {
        const checkinStr = document.getElementById("waktu_checkin_preview").value;
        if (!checkinStr) return;
        const input = document.getElementById("jumlah_hari");
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            hitungCheckout();
        }
    });
</script>