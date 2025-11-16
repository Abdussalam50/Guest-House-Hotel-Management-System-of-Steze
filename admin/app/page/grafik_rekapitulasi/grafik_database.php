<?php
// Assume database connection is established
// Example: mysql_connect('localhost', 'username', 'password') or die('Connection failed: ' . mysql_error());
// mysql_select_db('your_database') or die('Database selection failed: ' . mysql_error());

// Get id_hotel from cookie
$id_hotel = isset($_COOKIE['id_hotel']) ? decrypt($_COOKIE['id_hotel']) : '';

// Fetch hotels for super admin
$hotels = [];
if ($id_hotel == "") {
	$hotel_query = mysql_query("SELECT id_hotel, nama FROM data_hotel ORDER BY id_hotel") or die('Hotel query failed: ' . mysql_error());
	while ($row = mysql_fetch_assoc($hotel_query)) {
		$hotels[] = $row;
	}
}

// Build hotel filter
$filter_hotel_operasional = $id_hotel != "" ? "AND id_hotel = '$id_hotel'" : (isset($_POST['hotel']) && $_POST['hotel'] != 'all' ? "AND id_hotel = '" . mysql_real_escape_string($_POST['hotel']) . "'" : "");
$filter_hotel_transaksi = $id_hotel != "" ? "AND t.id_hotel = '$id_hotel'" : (isset($_POST['hotel']) && $_POST['hotel'] != 'all' ? "AND t.id_hotel = '" . mysql_real_escape_string($_POST['hotel']) . "'" : "");
$filter_hotel_transaksi2 = $id_hotel != "" ? "AND id_hotel = '$id_hotel'" : (isset($_POST['hotel']) && $_POST['hotel'] != 'all' ? "AND id_hotel = '" . mysql_real_escape_string($_POST['hotel']) . "'" : "");

// Fetch distinct years
$year_query = mysql_query("
    SELECT DISTINCT YEAR(tanggal) AS year 
    FROM data_operasional 
    WHERE 1=1 $filter_hotel_operasional
    UNION 
    SELECT DISTINCT YEAR(waktu_checkin) AS year 
    FROM data_transaksi 
    WHERE 1=1 $filter_hotel_transaksi2
    ORDER BY year DESC
") or die('Year query failed: ' . mysql_error());
$years = [];
while ($row = mysql_fetch_assoc($year_query)) {
	$years[] = $row['year'];
}

// Fallback if no years available
if (empty($years)) {
	$years = [date('Y')];
}

// Selected year and hotel
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');
$selected_hotel = isset($_POST['hotel']) ? mysql_real_escape_string($_POST['hotel']) : ($id_hotel != "" ? $id_hotel : 'all');

// Validate year
if (!is_numeric($selected_year)) {
	die('Invalid year selected.');
}

// === JUMLAH TRANSAKSI ===
$trans_query = mysql_query("
    SELECT MONTH(waktu_checkin) AS month, COUNT(*) AS transaction_count
    FROM data_transaksi
    WHERE YEAR(waktu_checkin) = '$selected_year'
    $filter_hotel_transaksi2
    GROUP BY month
    ORDER BY month
") or die('Transaction query failed: ' . mysql_error());
$transaction_counts = array_fill(1, 12, 0);
$total_transactions = 0;
while ($row = mysql_fetch_assoc($trans_query)) {
	$transaction_counts[$row['month']] = (int)$row['transaction_count'];
	$total_transactions += (int)$row['transaction_count'];
}
$transaction_data = array_values($transaction_counts);

// === PENDAPATAN ===
$revenue_query = mysql_query("
    SELECT MONTH(waktu) AS month, SUM(jumlah_bayar) AS revenue
    FROM data_pemasukan
    WHERE YEAR(waktu) = '$selected_year'
    $filter_hotel_transaksi2
    GROUP BY month
    ORDER BY month
") or die('Revenue query failed: ' . mysql_error());
$revenues = array_fill(1, 12, 0);
$total_revenue = 0;
while ($row = mysql_fetch_assoc($revenue_query)) {
	$revenues[$row['month']] = (float)$row['revenue'];
	$total_revenue += (float)$row['revenue'];
}
$revenue_data = array_values($revenues);

// === BIAYA OPERASIONAL ===
$expense_query = mysql_query("
    SELECT MONTH(tanggal) AS month, SUM(biaya) AS expense
    FROM data_operasional
    WHERE YEAR(tanggal) = '$selected_year'
    $filter_hotel_operasional
    GROUP BY month
    ORDER BY month
") or die('Expense query failed: ' . mysql_error());
$expenses = array_fill(1, 12, 0);
$total_expense = 0;
while ($row = mysql_fetch_assoc($expense_query)) {
	$expenses[$row['month']] = (float)$row['expense'];
	$total_expense += (float)$row['expense'];
}
$expense_data = array_values($expenses);

// === CASHFLOW ===
$cashflow_data = [];
$total_cashflow = 0;
for ($i = 0; $i < 12; $i++) {
	$cashflow = $revenue_data[$i] - $expense_data[$i];
	$cashflow_data[] = $cashflow;
	$total_cashflow += $cashflow;
}

// Label bulan
$month_labels = [];
for ($m = 1; $m <= 12; $m++) {
	$month_labels[] = date('F', mktime(0, 0, 0, $m, 1));
}

// Prevent chart error if data is empty
if (array_sum($transaction_data) == 0) {
	$transaction_data = array_fill(0, 12, 0);
}
if (array_sum($revenue_data) == 0) {
	$revenue_data = array_fill(0, 12, 0);
}
if (array_sum($expense_data) == 0) {
	$expense_data = array_fill(0, 12, 0);
}
if (array_sum($cashflow_data) == 0 && array_sum($revenue_data) == 0 && array_sum($expense_data) == 0) {
	$cashflow_data = array_fill(0, 12, 0);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Annual Transaction, Revenue, Expense, and Cashflow Charts</title>
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

		h3,
		h6 {
			text-align: center;
		}

		.filter-form {
			text-align: center;
			margin: 20px;
		}

		.filter-form select {
			margin: 0 10px;
		}
	</style>
</head>

<body>
	<form method="post" class="filter-form">
		<?php if ($id_hotel == ""): ?>
			<label for="hotel">Pilih Hotel: </label>
			<select name="hotel" id="hotel" onchange="this.form.submit()">
				<option value="all" <?php echo $selected_hotel == 'all' ? 'selected' : ''; ?>>All Hotels</option>
				<?php foreach ($hotels as $hotel): ?>
					<option value="<?php echo htmlspecialchars($hotel['id_hotel']); ?>" <?php echo $selected_hotel == $hotel['id_hotel'] ? 'selected' : ''; ?>>
						<?php echo htmlspecialchars($hotel['nama']); ?>
					</option>
				<?php endforeach; ?>
			</select>
		<?php endif; ?>
		<label for="year">	Pilih Tahun: </label>
		<select name="year" id="year" onchange="this.form.submit()">
			<?php foreach ($years as $year): ?>
				<option value="<?php echo htmlspecialchars($year); ?>" <?php echo $year == $selected_year ? 'selected' : ''; ?>>
					<?php echo htmlspecialchars($year); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</form>

	<!-- Transaction Chart -->
	<h6>Jumlah Transaksi Tahun <?php echo htmlspecialchars($selected_year); ?>
		<?php if ($selected_hotel === 'all') echo ' (All Hotels)';
		elseif (!empty($selected_hotel)) echo ' (' . htmlspecialchars($hotels[array_search($selected_hotel, array_column($hotels, 'id_hotel'))]['nama']) . ')'; ?>
	</h6>
	<div class="chart-container">
		<canvas id="transactionChart" style="max-height: 300px;"></canvas>
	</div>
	<div class="total-text">
		Total Transaksi: <?php echo number_format($total_transactions, 0); ?>
	</div>
	<hr>

	<!-- Revenue Chart -->
	<h6>Pendapatan Tahun <?php echo htmlspecialchars($selected_year); ?>
		<?php if ($selected_hotel === 'all') echo ' (All Hotels)';
		elseif (!empty($selected_hotel)) echo ' (' . htmlspecialchars($hotels[array_search($selected_hotel, array_column($hotels, 'id_hotel'))]['nama']) . ')'; ?>
	</h6>
	<div class="chart-container">
		<canvas id="revenueChart" style="max-height: 300px;"></canvas>
	</div>
	<div class="total-text">
		Total Pendapatan: Rp <?php echo number_format($total_revenue, 2); ?>
	</div>
	<hr>

	<!-- Expense Chart -->
	<h6>Biaya Operasional Tahun <?php echo htmlspecialchars($selected_year); ?>
		<?php if ($selected_hotel === 'all') echo ' (All Hotels)';
		elseif (!empty($selected_hotel)) echo ' (' . htmlspecialchars($hotels[array_search($selected_hotel, array_column($hotels, 'id_hotel'))]['nama']) . ')'; ?>
	</h6>
	<div class="chart-container">
		<canvas id="expenseChart" style="max-height: 300px;"></canvas>
	</div>
	<div class="total-text">
		Total Biaya Operasional: Rp <?php echo number_format($total_expense, 2); ?>
	</div>
	<hr>

	<!-- Cashflow Chart -->
	<h6>Cashflow Tahun <?php echo htmlspecialchars($selected_year); ?>
		<?php if ($selected_hotel === 'all') echo ' (All Hotels)';
		elseif (!empty($selected_hotel)) echo ' (' . htmlspecialchars($hotels[array_search($selected_hotel, array_column($hotels, 'id_hotel'))]['nama']) . ')'; ?>
	</h6>
	<div class="chart-container">
		<canvas id="cashflowChart" style="max-height: 300px;"></canvas>
	</div>
	<div class="total-text">
		Total Biaya Operasional: Rp <?php echo number_format($total_expense, 2); ?><br>
		Total Cashflow: Rp <?php echo number_format($total_cashflow, 2); ?>
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
					backgroundColor: '#4e73df',
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
					backgroundColor: '#28a745',
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
							text: 'Pendapatan'
						}
					},
					x: {
						title: {
							display: true,
							text: 'Bulan'
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
							text: 'Bulan'
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

		// Cashflow Chart
		const ctx4 = document.getElementById('cashflowChart').getContext('2d');
		new Chart(ctx4, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($month_labels); ?>,
				datasets: [{
						label: 'Pendapatan',
						data: <?php echo json_encode($revenue_data); ?>,
						backgroundColor: '#28a745',
						borderColor: '#28a745',
						borderWidth: 1
					},
					{
						label: 'Biaya Operasional',
						data: <?php echo json_encode($expense_data); ?>,
						backgroundColor: '#dc3545',
						borderColor: '#dc3545',
						borderWidth: 1
					},
					{
						label: 'Cashflow',
						data: <?php echo json_encode($cashflow_data); ?>,
						backgroundColor: '#007bff',
						borderColor: '#007bff',
						borderWidth: 1
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					y: {
						beginAtZero: true,
						title: {
							display: true,
							text: 'Jumlah (Rp)'
						}
					},
					x: {
						title: {
							display: true,
							text: 'Bulan'
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