<?php
header('Content-Type: application/json');

// Contoh data booking/transaksi
$data = [
    ["type" => "booking", "checkin" => "2025-11-19", "checkout" => "2025-11-21", "info" => "<a href=''>Booking A</a>"],
    ["type" => "booking", "checkin" => "2025-11-21", "checkout" => "2025-11-22", "info" => "<a href=''>Booking AA</a>"],
    ["type" => "transaksi", "checkin" => "2025-11-24", "checkout" => "2025-11-25", "info" => "<a href=''>Transaksi B</a>"],
    ["type" => "transaksi", "checkin" => "2025-11-25", "checkout" => "2025-11-26", "info" => "<a href=''>Transaksi BB</a>"],
    ["type" => "booking", "checkin" => "2026-01-15", "checkout" => "2026-01-18", "info" => "<a href=''>Booking C</a>"]
];

// Jika ambil dari database, tinggal ganti query disini

echo json_encode($data);
