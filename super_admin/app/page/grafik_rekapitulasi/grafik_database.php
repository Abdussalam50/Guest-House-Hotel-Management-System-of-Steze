<?php
// Fetch distinct years from data_transaksi and data_operasional for combobox
$id_hotel= decrypt($_COOKIE['id_hotel']);
$year_query = mysql_query("
    SELECT DISTINCT YEAR(tanggal) AS year FROM data_operasional 
    UNION 
    SELECT DISTINCT YEAR(waktu) AS year FROM data_pemasukan 
    ORDER BY year DESC
");
$years = [];
while ($row = mysql_fetch_assoc($year_query)) {
	$years[] = $row['year'];
}

// Default to current year if not set
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');

// Fetch transaction counts per month for the selected year
$trans_query = mysql_query("
    SELECT MONTH(waktu_checkin) AS month, COUNT(*) AS transaction_count
    FROM data_transaksi 
    WHERE YEAR(waktu_checkin) = '$selected_year'
    GROUP BY month
    ORDER BY month
");
$transaction_counts = array_fill(1, 12, 0); // Initialize array for 12 months
$total_transactions = 0;
while ($row = mysql_fetch_assoc($trans_query)) {
	$transaction_counts[$row['month']] = (int)$row['transaction_count'];
	$total_transactions += (int)$row['transaction_count'];
}
$transaction_data = array_values($transaction_counts);

// Fetch revenue per month for the selected year
if(isset($_COOKIE['id_hotel'])){
$revenue_query = mysql_query("
    SELECT MONTH(t.waktu) AS month,
           SUM(COALESCE(jumlah_bayar,0) ) AS revenue
    FROM data_pemasukan t
    t.id_hotel = '$id_hotel'
    WHERE YEAR(t.waktu) = '$selected_year'
    GROUP BY month
    ORDER BY month
");
}else{
$revenue_query = mysql_query("
    SELECT MONTH(t.waktu) AS month, SUM(COALESCE(jumlah_bayar,0) ) AS revenue
    FROM data_pemasukan t WHERE YEAR(t.waktu) = $selected_year
    GROUP BY month
    ORDER BY month
");
}

$revenues = array_fill(1, 12, 0); // Initialize array for 12 months
$total_revenue = 0;
while ($row = mysql_fetch_assoc($revenue_query)) {
	$revenues[$row['month']] = (float)$row['revenue'];
	$total_revenue += (float)$row['revenue'];
}
$revenue_data = array_values($revenues);

// Fetch operational expenses per month for the selected year
if(isset($_COOKIE['id_hotel'])){
$expense_query = mysql_query("
    SELECT MONTH(tanggal) AS month, SUM(biaya) AS expense
    FROM data_operasional
    WHERE YEAR(tanggal) = '$selected_year' AND id_hotel = '$id_hotel'
    GROUP BY month
    ORDER BY month
");
}else{
$expense_query = mysql_query("
    SELECT MONTH(tanggal) AS month, SUM(biaya) AS expense
    FROM data_operasional
    WHERE YEAR(tanggal) = '$selected_year' 
    GROUP BY month
    ORDER BY month
");
}
$expenses = array_fill(1, 12, 0); // Initialize array for 12 months
$total_expense = 0;
while ($row = mysql_fetch_assoc($expense_query)) {
	$expenses[$row['month']] = (float)$row['expense'];
	$total_expense += (float)$row['expense'];
}
$expense_data = array_values($expenses);

// Prepare month labels (January to December)
$month_labels = [];
for ($m = 1; $m <= 12; $m++) {
	$month_labels[] = date('F', mktime(0, 0, 0, $m, 1));
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Annual Transaction, Revenue, and Expense Charts</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
	<style>
		.chart-container {
			max-width: 800px;
			margin: 20px auto;
		}

		.total-text {
			text-align: center;
			margin-top: 10px;
			font-size: 18px;
			font-weight: bold;
		}

		h3 {
			text-align: center;
		}
	</style>
</head>

<body>
	<form method="post" style="text-align: center; margin: 20px;">
		<label for="year">Select Year: </label>
		<select name="year" id="year" onchange="this.form.submit()">
			<?php foreach ($years as $year): ?>
				<option value="<?php echo htmlspecialchars($year); ?>" <?php echo $year == $selected_year ? 'selected' : ''; ?>>
					<?php echo htmlspecialchars($year); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</form>

	<!-- Transaction Chart -->
	<h6>Banyak Transaksi Tiap Bulan Pada <?php echo htmlspecialchars($selected_year); ?></h6>
	<div class="chart-container">
		<canvas id="transactionChart" style="max-height: 300px;"></canvas>
	</div>

	<div class="total-text">
		Total Transaksi:  <?php echo number_format($total_transactions, 0); ?>
	</div>
	<hr>
	<!-- Revenue Chart -->
	<h6>Pendapatan per Bulan Pada <?php echo htmlspecialchars($selected_year); ?></h6>
	<div class="chart-container">
		<canvas id="revenueChart" style="max-height: 300px;"></canvas>
	</div>
	<div class="total-text">
		Total Pendapatan: Rp <?php echo number_format($total_revenue, 2); ?>
	</div>
	<hr>
	<!-- Expense Chart -->
	<h6>Biaya Operasional per Bulan Pada <?php echo htmlspecialchars($selected_year); ?></h6>
	<div class="chart-container">
		<canvas id="expenseChart" style="max-height: 300px;"></canvas>
	</div>
	<div class="total-text">
		Total Biaya Operasional: Rp <?php echo number_format($total_expense, 2); ?>
	</div>

	<script>
		// Transaction Chart
		const ctx1 = document.getElementById('transactionChart').getContext('2d');
		new Chart(ctx1, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($month_labels); ?>,
				datasets: [{
					label: 'Jumlah Transaksi Per Bulan',
					data: <?php echo json_encode($transaction_data); ?>,
					backgroundColor: '#4e73df', // Blue for transactions
					borderColor: '#4e73df',
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
							text: 'Number of Transactions'
						}
					},
					x: {
						title: {
							display: true,
							text: 'Month'
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

		// Revenue Chart
		const ctx2 = document.getElementById('revenueChart').getContext('2d');
		new Chart(ctx2, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($month_labels); ?>,
				datasets: [{
					label: 'Pendapatan per Bulan',
					data: <?php echo json_encode($revenue_data); ?>,
					backgroundColor: '#28a745', // Green for revenue
					borderColor: '#28a745',
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
							text: 'Revenue'
						}
					},
					x: {
						title: {
							display: true,
							text: 'Month'
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

		// Expense Chart
		const ctx3 = document.getElementById('expenseChart').getContext('2d');
		new Chart(ctx3, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($month_labels); ?>,
				datasets: [{
					label: 'Biaya Operasional per Bulan',
					data: <?php echo json_encode($expense_data); ?>,
					backgroundColor: '#dc3545', // Red for expenses
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
							text: 'Month'
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