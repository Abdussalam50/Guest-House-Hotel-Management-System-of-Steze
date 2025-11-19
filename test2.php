<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        background: #f7f9fc;
        font-family: 'Inter', sans-serif;
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

    .swal2-container {
        z-index: 99999 !important;
    }

    .btn-month {
        width: 40px;
        height: 38px;
        padding: 0;
        text-align: center;
        font-weight: bold;
    }
</style>

<div class="container mt-3">
    <form id="formBookingBulanan" action="oke.php" method="get">
        <label class="form-label">Tanggal Cek In</label>
        <input id="waktu_checkin_preview" class="form-control mb-2" placeholder="Pilih tanggal..." required>
        <input id="waktu_checkin" name="waktu_checkin" type="hidden" required>

        <label class="form-label">Tanggal Cek Out</label>
        <input id="waktu_check_out_preview" class="form-control mb-2" placeholder="Pilih Check-in..." readonly>
        <input id="waktu_check_out" name="waktu_check_out" type="hidden" required>

        <label class="form-label">Jumlah Bulan</label>
        <div class="input-group mb-2">
            <button id="btn-minus" style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">-</button>
            <input class="form-control" style="height: 38px;text-align: center;" type="number" name="jumlah_bulan" min="1" id="jumlah_bulan" value="1" placeholder="Jumlah Bulan" required>
            <button id="btn-plus" style="height: 38px;padding-top: 9px;" class="btn btn-secondary" type="button">+</button>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Simpan / Kirim</button>
    </form>
</div>

<script>
    function toLocalDateString(date) {
        if (!date || !(date instanceof Date) || isNaN(date.getTime())) return '';
        const d = String(date.getDate()).padStart(2, '0');
        const m = String(date.getMonth() + 1).padStart(2, '0');
        const y = date.getFullYear();
        return `${d}/${m}/${y}`;
    }

    function toDateInputString(date) {
        if (!date || !(date instanceof Date) || isNaN(date.getTime())) return '';
        const d = String(date.getDate()).padStart(2, '0');
        const m = String(date.getMonth() + 1).padStart(2, '0');
        const y = date.getFullYear();
        return `${y}-${m}-${d}`;
    }

    const dateMap = {};
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const todayStr = toLocalDateString(today);
    const disableBeforeToday = [d => {
        const dd = new Date(d);
        dd.setHours(0, 0, 0, 0);
        return dd < today;
    }];

    let fpCheckIn;

    // Ambil schedule dari server
    fetch('schedule.php')
        .then(res => res.json())
        .then(scheduleData => {
            scheduleData.forEach(i => {
                let cur = new Date(i.checkin);
                const last = new Date(i.checkout);
                while (cur <= last) {
                    const dateStr = toLocalDateString(cur);
                    if (!dateMap[dateStr] || i.type === "transaksi") dateMap[dateStr] = {
                        type: i.type,
                        info: i.info
                    };
                    cur.setDate(cur.getDate() + 1);
                }
            });

            fpCheckIn = flatpickr("#waktu_checkin_preview", {
                dateFormat: "d/m/Y",
                disable: disableBeforeToday,
                onChange: function(_, dateStr) {
                    if (!dateStr) return;
                    const parts = dateStr.split('/');
                    const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
                    document.getElementById("waktu_checkin").value = toDateInputString(checkin);
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
                    if (dateStr === todayStr) {
                        dayElem.classList.add("today-date");
                        dayElem.dataset.info = "Hari Ini";
                    }
                    if (dayElem.dataset.info) dayElem.title = dayElem.dataset.info;

                    dayElem.addEventListener("click", function(e) {
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
        });

    function hitungCheckout() {
        const checkinStr = document.getElementById("waktu_checkin_preview").value;
        if (!checkinStr) return;
        const bulan = parseInt(document.getElementById("jumlah_bulan").value || 1);
        const parts = checkinStr.split('/');
        const checkin = new Date(parts[2], parts[1] - 1, parts[0]);
        if (isNaN(checkin.getTime())) return;

        const checkout = new Date(checkin);
        checkout.setMonth(checkin.getMonth() + bulan);

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
                title: "Tanggal Tidak Bisa Dipilih",
                html: `Dalam <b>${bulan} bulan</b> dari ${checkinStr} terdapat transaksi/booking sehingga jumlah bulan tidak dapat digunakan.`,
                icon: "warning"
            }).then(() => resetInput());
            return;
        }

        document.getElementById("waktu_check_out_preview").value = toLocalDateString(checkout);
        document.getElementById("waktu_check_out").value = toDateInputString(checkout);
    }

    document.getElementById("jumlah_bulan").addEventListener("input", hitungCheckout);
    document.getElementById("btn-plus").addEventListener("click", () => {
        const input = document.getElementById("jumlah_bulan");
        input.value = parseInt(input.value || 1) + 1;
        hitungCheckout();
    });
    document.getElementById("btn-minus").addEventListener("click", () => {
        const input = document.getElementById("jumlah_bulan");
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            hitungCheckout();
        }
    });

    function resetInput() {
        document.getElementById("waktu_checkin_preview").value = "";
        document.getElementById("waktu_checkin").value = "";
        document.getElementById("jumlah_bulan").value = 1;
        document.getElementById("waktu_check_out_preview").value = "";
        document.getElementById("waktu_check_out").value = "";
        if (fpCheckIn) fpCheckIn.clear();
    }
</script>