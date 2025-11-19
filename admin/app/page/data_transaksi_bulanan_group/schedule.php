<?php
header('Content-Type: application/json');

// Contoh data booking/transaksi
$data = [
    ["type" => "booking", "checkin" => "2025-11-28", "checkout" => "2025-11-30", "info" => "<a href=''>Booking A</a>"],
    ["type" => "transaksi", "checkin" => "2025-11-20", "checkout" => "2025-11-24", "info" => "<a href=''>Transaksi B</a>"],
    ["type" => "booking", "checkin" => "2026-01-15", "checkout" => "2026-01-18", "info" => "<a href=''>Booking C</a>"]
];

// Jika ambil dari database, tinggal ganti query disini

echo json_encode($data);
