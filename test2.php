<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        background: #f7f9fc;
        font-family: 'Inter', sans-serif;
    }

    . {
        border: 2px solid #e0e6ed !important;
        border-radius: 12px !important;
        padding: 12px 14px !important;
        font-size: 15px;
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

    .flatpickr-day.selected:hover,
    .flatpickr-day.startRange:hover,
    .flatpickr-day.endRange:hover {
        border-radius: 10px !important;
    }

    .flatpickr-day:hover {
        border-radius: 10px !important;
        background: #e5e5e5 !important;
    }
</style>


<div class="container">


    <div class="mb-3">
        <label>Waktu Check-In</label>
        <input id="waktu_check_in" class="form-control " placeholder="Pilih tanggal...">
    </div>

    <div class="mb-3">
        <label>Jumlah Bulan</label>
        <input id="jumlah_hari" type="number" class="form-control " min="1" value="1">
    </div>

    <div class="mb-3">
        <label>Waktu Checkout</label>
        <input id="waktu_checkout" class="form-control " readonly>
    </div>

</div>

<script>
    function toLocalDateString(date) {
        const y = date.getFullYear();
        const m = String(date.getMonth() + 1).padStart(2, '0');
        const d = String(date.getDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    const dateMap = {};
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const todayStr = toLocalDateString(today);

    const disableBeforeToday = [
        function(date) {
            const d = new Date(date);
            d.setHours(0, 0, 0, 0);
            return d < today;
        }
    ];

    let fpCheckIn;

    // Ambil schedule dari schedule.php
    fetch('schedule.php')
        .then(res => res.json())
        .then(scheduleData => {
            scheduleData.forEach(i => {
                let cur = new Date(i.checkin);
                const last = new Date(i.checkout);
                while (cur <= last) {
                    const dateStr = toLocalDateString(cur);
                    if (!dateMap[dateStr] || i.type === "transaksi")
                        dateMap[dateStr] = {
                            type: i.type,
                            info: i.info
                        };
                    cur.setDate(cur.getDate() + 1);
                }
            });

            // Setelah data diambil, init Flatpickr
            fpCheckIn = flatpickr("#waktu_check_in", {
                dateFormat: "Y-m-d",
                disable: disableBeforeToday,

                onChange: function(selectedDates, dateStr) {
                    const maxBulan = getMaxBulan(dateStr);
                    document.getElementById("jumlah_hari").max = maxBulan;

                    if (parseInt(document.getElementById("jumlah_hari").value) > maxBulan)
                        document.getElementById("jumlah_hari").value = maxBulan;

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
                            const iconType = dayElem.dataset.type === "booking" ? "info" : "warning";

                            Swal.fire({
                                title: "Tidak dapat dipilih",

                                title: "Tidak dapat dipilih",
                                html: `Dalam hari dari tanggal <b>${dateStr}</b> terdapat ${dayElem.dataset.info} sehingga tanggal tidak dapat digunakan.`,
                                icon: iconType
                            }).then(() => {
                                document.getElementById("waktu_check_in").value = "";
                                document.getElementById("jumlah_hari").value = 1;
                                document.getElementById("waktu_checkout").value = "";
                                fpCheckIn.clear(); // reset selected
                            });
                        }
                    });
                }
            });
        });

    function hitungCheckout() {
        const checkinStr = document.getElementById("waktu_check_in").value;
        const bulan = parseInt(document.getElementById("jumlah_hari").value || 1);
        if (!checkinStr) return;

        const checkin = new Date(checkinStr);
        const checkout = new Date(checkin);
        checkout.setMonth(checkin.getMonth() + bulan);

        let cur = new Date(checkin);
        let hasConflict = false;
        while (cur <= checkout) {
            const str = toLocalDateString(cur);
            if (dateMap[str]) {
                hasConflict = true;
                break;
            }
            cur.setDate(cur.getDate() + 1);
        }

        if (hasConflict) {
            Swal.fire({
                title: "Tanggal Tidak Bisa Dipilih",
                html: `Dalam <b>${bulan} bulan</b> dari ${checkinStr} terdapat transaksi/booking sehingga jumlah bulan tidak dapat digunakan.`,
                icon: "warning"
            }).then(() => resetInput());
            return;
        }

        document.getElementById("waktu_checkout").value = toLocalDateString(checkout);
    }

    function getMaxBulan(checkinStr) {
        const checkin = new Date(checkinStr);
        for (let i = 1; i <= 24; i++) {
            const temp = new Date(checkin);
            temp.setMonth(checkin.getMonth() + i);

            let conflict = false;
            const startMonth = new Date(temp.getFullYear(), temp.getMonth(), 1);
            const endMonth = new Date(temp.getFullYear(), temp.getMonth() + 1, 0);
            let cur = new Date(startMonth);
            while (cur <= endMonth) {
                const str = toLocalDateString(cur);
                if (dateMap[str]) {
                    conflict = true;
                    break;
                }
                cur.setDate(cur.getDate() + 1);
            }

            if (conflict) return i;
        }
        return 24;
    }

    document.getElementById("jumlah_hari").addEventListener("input", hitungCheckout);

    function resetInput() {
        document.getElementById("waktu_check_in").value = "";
        document.getElementById("jumlah_hari").value = 1;
        document.getElementById("waktu_checkout").value = "";
        fpCheckIn.clear();
    }
</script>