<?php
// Fetch distinct years and months from data_operasional for combobox
$year_month_query = mysql_query("SELECT DISTINCT YEAR(tanggal) AS year, MONTH(tanggal) AS month FROM data_operasional ORDER BY year DESC, month DESC");
$years = [];
$months = [];
$hotel=[];
while ($row = mysql_fetch_assoc($year_month_query)) {
    $years[$row['year']] = $row['year'];
    $months[$row['year']][$row['month']] = $row['month'];
}
$query_hotels=mysql_query("SELECT * FROM data_hotel");
while($row_hotel=mysql_fetch_array($query_hotels)){
    $hotel[$row_hotel['id_hotel']]=$row_hotel['nama'];
}

// Default to current year and month if not set
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');
$selected_month = isset($_POST['month']) ? mysql_real_escape_string($_POST['month']) : date('m');
$selected_hotel=isset($_POST['hotel'])?mysql_real_escape_string($_POST['hotel']):'';
// Get number of days in the selected month
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);

// Fetch operational expenses per day for the selected month and year
$expense_query = mysql_query("
    SELECT DAY(tanggal) AS day,
           SUM(biaya) AS expense
    FROM data_operasional
    WHERE YEAR(tanggal) = '$selected_year' AND MONTH(tanggal) = '$selected_month' AND id_hotel='$selected_hotel'
    GROUP BY day
    ORDER BY day
");
$daily_expenses = array_fill(1, $days_in_month, 0); // Initialize array with 0 for each day
$total_expense = 0; // Initialize total expense
while ($row = mysql_fetch_assoc($expense_query)) {
    $daily_expenses[$row['day']] = (float)$row['expense'];
    $total_expense += (float)$row['expense'];
}

// Prepare labels (days 1 to max days) and expenses
$labels = range(1, $days_in_month);
$expenses = array_values($daily_expenses);

// If no data, initialize empty arrays to avoid chart errors
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
            max-width: 800px;
            margin: 0 auto;
        }

        .total-expense {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center;">Biaya Operasional Harian Cabang <?php echo baca_database("","nama","select * from data_hotel where id_hotel='$selected_hotel'")?> Periode <?php echo date('F Y', mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?></h3>
    <form method="post" style="text-align: center; margin-bottom: 20px;">
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
        <label for="hotel">Hotel :</label>
        <select name="hotel" id="" onchange="this.form.submit()">
            <option>--Hotel--</option>
            <?php
                foreach($hotel as $item=>$value){
                    ?>
                <option value="<?php echo $item?>"><?php echo $value?></option>
            <?php
                }
            ?>
        </select>
    </form>
    <div class="chart-container">
        <canvas id="expenseChart" style="max-height: 400px;"></canvas>
    </div>
    <div class="total-expense">
        Total Biaya Operasional Hotel  : <?php echo rupiah($total_expense); ?>
    </div>

    <script>
        const ctx = document.getElementById('expenseChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Biaya Operasional Per Hari',
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
                            text: 'Operasional'
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