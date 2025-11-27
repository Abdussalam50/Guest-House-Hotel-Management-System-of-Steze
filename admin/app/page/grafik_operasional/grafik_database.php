<?php

// Decrypt and validate id_hotel from cookie
$id_hotel = isset($_COOKIE['id_hotel']) ? decrypt($_COOKIE['id_hotel']) : '';

// === Build hotel filter condition ===
$filter_hotel = "";
$selected_hotel = isset($_POST['id_hotel']) ? mysql_real_escape_string($_POST['id_hotel']) : $id_hotel;

if (!empty($selected_hotel) && $selected_hotel !== 'all') {
    $filter_hotel = "AND id_hotel = '$selected_hotel'";
}

// Fetch hotel data for dropdown
$hotels_query = mysql_query("SELECT id_hotel, nama FROM data_hotel ORDER BY id_hotel");
$hotels = [];
while ($row = mysql_fetch_assoc($hotels_query)) {
    $hotels[$row['id_hotel']] = $row['nama'];
}

// Fetch distinc_oke years and months from data_operasional for combobox
$year_month_query = mysql_query("
    SELECT YEAR(tanggal) AS year, MONTH(tanggal) AS month 
    FROM data_operasional 
    WHERE 1=1 $filter_hotel
    GROUP BY YEAR(tanggal), MONTH(tanggal)
    ORDER BY year DESC, month DESC
") or die('Query failed: ' . mysql_error());

$years = [];
while ($row = mysql_fetch_assoc($year_month_query)) {
    $years[$row['year']] = $row['year'];
}

// Default to current year & month
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');
$selected_month = isset($_POST['month']) ? mysql_real_escape_string($_POST['month']) : date('m');

// Calculate number of days in selected month
$days_in_month = date('t', strtotime($selected_year . '-' . $selected_month . '-01'));


// Fetch daily operational expenses
$expense_query = mysql_query("
    SELECT DAY(tanggal) AS day,
           SUM(biaya) AS expense
    FROM data_operasional
    WHERE YEAR(tanggal) = '$selected_year' 
      AND MONTH(tanggal) = '$selected_month'
      $filter_hotel
    GROUP BY day
    ORDER BY day
");

$daily_expenses = array_fill(1, $days_in_month, 0);
$total_expense = 0;
while ($row = mysql_fetch_assoc($expense_query)) {
    $daily_expenses[$row['day']] = (float)$row['expense'];
    $total_expense += (float)$row['expense'];
}

// Labels & data for chart
$labels = range(1, $days_in_month);
$expenses = array_values($daily_expenses);

// Prevent chart error if data is empty
if (empty($expenses) || array_sum($expenses) == 0) {
    $labels = [1];
    $expenses = [0];
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Grafik Operasional Harian</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        .chart-container {
            max-width: 100%;
            margin: 0 auto;
        }

        .total-expense {
            text-align: left;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
            padding: 6px 10px;
            text-align: left;
        }

        th {
            background: #f8f9fa;
        }

        tfoot td {
            font-weight: bold;
            background: #f1f1f1;
        }

        .filter-form {
            text-align: left;
            margin-bottom: 20px;
        }

        .filter-form select {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h3 style="text-align: left;">
        Grafik Operasional Harian
        <?php echo date('F Y', mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?>
        <?php if ($selected_hotel === 'all') echo ' (All Hotels)';
        elseif (!empty($selected_hotel)) echo ' (' . htmlspecialchars($hotels[$selected_hotel]) . ')'; ?>
    </h3>
    <form method="post" class="filter-form">
        <?php if (empty($id_hotel)): ?>
            <label for="id_hotel">Hotel: </label>
            <select name="id_hotel" id="id_hotel" onchange="this.form.submit()">
                <option value="all" <?php echo $selected_hotel === 'all' ? 'selected' : ''; ?>>All Hotels</option>
                <?php foreach ($hotels as $id => $nama): ?>
                    <option value="<?php echo htmlspecialchars($id); ?>" <?php echo $id == $selected_hotel ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($nama); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <label for="year">Tahun: </label>
        <select name="year" id="year" onchange="this.form.submit()">
            <?php foreach ($years as $year): ?>
                <option value="<?php echo htmlspecialchars($year); ?>" <?php echo $year == $selected_year ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($year); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="month">Bulan: </label>
        <select name="month" id="month" onchange="this.form.submit()">
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?php echo sprintf('%02d', $m); ?>" <?php echo $m == $selected_month ? 'selected' : ''; ?>>
                    <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
                </option>
            <?php endfor; ?>
        </select>
    </form>
    <div class="chart-container">
        <canvas id="expenseChart" style="max-height: 400px;"></canvas>
    </div>
    <div class="total-expense">
        Total Biaya Operasional: <?php echo rupiah($total_expense); ?>
    </div>

    <!-- Detail table -->
    <table>
        <thead>
            <tr>
                <th>Hari</th>
                <th>Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daily_expenses as $day => $exp): ?>
                <tr>
                    <td><?php echo $day; ?></td>
                    <td><?php echo rupiah($exp); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td><?php echo rupiah($total_expense); ?></td>
            </tr>
        </tfoot>
    </table>

    <script>
        const ctx = document.getElementById('expenseChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Operational Expenses per Day',
                    data: <?php echo json_encode($expenses); ?>,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Pengeluaran'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>

</html>