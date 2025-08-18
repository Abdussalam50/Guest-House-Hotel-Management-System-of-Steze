<?php
$conn = new mysqli("localhost", "root", "", "hotel");
$result = $conn->query("SELECT * FROM transaksi ORDER BY id DESC LIMIT 1");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body { font-family: monospace; max-width: 300px; margin: auto; border: 1px dashed #333; padding: 10px; }
        .center { text-align: center; }
        .btn { margin-top: 10px; padding: 5px 10px; background: black; color: white; border: none; cursor: pointer; }
        @media print {
            .btn { display: none; }
        }
    </style>
</head>
<body>



    <a href="Printer/printer.php" type="submit" name="print" class="btn">Print</button>
