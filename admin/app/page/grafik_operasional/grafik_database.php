<?php
$id_hotel = decrypt($_COOKIE['id_hotel']); // ambil id hotel dari cookie

// === buat kondisi filter hotel ===
$filter_hotel = "";
if (!empty($id_hotel)) {
    $filter_hotel = "AND id_hotel = '$id_hotel'";
}

// Fetch distinct years and months dari data_operasional untuk combobox
$year_month_query = mysql_query("
    SELECT DISTINCT YEAR(tanggal) AS year, MONTH(tanggal) AS month 
    FROM data_operasional 
    WHERE 1=1 $filter_hotel
    ORDER BY year DESC, month DESC
");
$years = [];
while ($row = mysql_fetch_assoc($year_month_query)) {
    $years[$row['year']] = $row['year'];
}

// Default ke tahun & bulan saat ini
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');
$selected_month = isset($_POST['month']) ? mysql_real_escape_string($_POST['month']) : date('m');

// Hitung jumlah hari di bulan yang dipilih
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);

// Ambil biaya operasional per hari sesuai hotel + bulan + tahun
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

// Labels & data chart
$labels = range(1, $days_in_month);
$expenses = array_values($daily_expenses);

// Jika kosong biar chart tidak error
if (empty($expenses) || array_sum($expenses) == 0) {
    $labels = [1];
    $expenses = [0];
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Daily Operational Expense Chart</title>
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
    </style>
</head>

<body>
    <h3 style="text-align: left;">Daily Operational Expenses for <?php echo date('F Y', mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?></h3>
    <form method="post" style="text-align: left; margin-bottom: 20px;">
        <label for="year">Year: </label>
        <select name="year" id="year" onchange="this.form.submit()">
            <?php foreach ($years as $year): ?>
                <option value="<?php echo htmlspecialchars($year); ?>" <?php echo $year == $selected_year ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($year); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="month">Month: </label>
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
        Total Operational Expenses: <?php echo rupiah($total_expense); ?>
    </div>

    <!-- Tabel detail -->
    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Expense</th>
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
                    backgroundColor: '#dc3545', // Modern red for expenses
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
                            text: 'Expenses'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Day of Month'
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