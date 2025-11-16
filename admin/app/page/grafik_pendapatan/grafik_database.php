<?php
$id_hotel = decrypt($_COOKIE['id_hotel']); // ambil id hotel dari cookie

// Fetch hotels for super admin
$hotels = [];
if ($id_hotel == "") {
	$hotel_query = mysql_query("SELECT id_hotel, nama FROM data_hotel ORDER BY id_hotel");
	while ($row = mysql_fetch_assoc($hotel_query)) {
		$hotels[] = $row;
	}
}

// === buat kondisi filter hotel ===
$filter_hotel = ($id_hotel != "") ? "AND id_hotel = '$id_hotel'" : (isset($_POST['hotel']) && $_POST['hotel'] != 'all' ? "AND id_hotel = '" . mysql_real_escape_string($_POST['hotel']) . "'" : "");

// Fetch distinct years and months from data_pemasukan for combobox
$year_month_query = mysql_query("
    SELECT DISTINCT YEAR(waktu) AS year, MONTH(waktu) AS month 
    FROM data_pemasukan
    WHERE 1=1 $filter_hotel
    ORDER BY year DESC, month DESC
");
$years = [];
$months = [];
while ($row = mysql_fetch_assoc($year_month_query)) {
	$years[$row['year']] = $row['year'];
	$months[$row['year']][$row['month']] = $row['month'];
}

// Default to current year and month if not set
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');
$selected_month = isset($_POST['month']) ? mysql_real_escape_string($_POST['month']) : date('m');
$selected_hotel = isset($_POST['hotel']) ? mysql_real_escape_string($_POST['hotel']) : ($id_hotel != "" ? $id_hotel : 'all');

// Get number of days in the selected month
$days_in_month = date('t', strtotime($selected_year . '-' . $selected_month . '-01'));


// Fetch revenue per day for the selected month and year
$trans_query = mysql_query("
    SELECT DAY(waktu) AS day,
           SUM(jumlah_bayar) AS revenue
    FROM data_pemasukan
    WHERE YEAR(waktu) = '$selected_year' 
      AND MONTH(waktu) = '$selected_month'
      $filter_hotel
    GROUP BY day
    ORDER BY day
");

$daily_revenues = array_fill(1, $days_in_month, 0);
$total_revenue = 0;
while ($row = mysql_fetch_assoc($trans_query)) {
	$daily_revenues[$row['day']] = (float)$row['revenue'];
	$total_revenue += (float)$row['revenue'];
}

// Prepare labels and revenues
$labels = range(1, $days_in_month);
$revenues = array_values($daily_revenues);

// If no data, initialize empty arrays to avoid chart errors
if (empty($revenues) || array_sum($revenues) == 0) {
	$labels = [1];
	$revenues = [0];
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Daily Revenue Chart</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
	<style>
		.chart-container {
			max-width: 100%;
			margin: 0 auto;
		}

		.total-revenue {
			text-align: center;
			margin-top: 20px;
			font-size: 18px;
			font-weight: bold;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			text-align: left;
		}

		table,
		th,
		td {
			border: 1px solid #ccc;
		}

		th,
		td {
			padding: 8px 12px;
			text-align: center;
		}

		th {
			background-color: #f4f4f4;
		}

		.filter-form {
			text-align: center;
			margin-bottom: 20px;
		}

		.filter-form select {
			margin: 0 10px;
		}
	</style>
</head>

<body>
	<h3 style="text-align: center;">Grafik Pendapatan Harian Untuk <?php echo date('F Y', mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?></h3>
	<form method="post" class="filter-form">
		<?php if ($id_hotel == ""): ?>
			<label for="hotel">Hotel: </label>
			<select name="hotel" id="hotel" onchange="this.form.submit()">
				<option value="all" <?php echo $selected_hotel == 'all' ? 'selected' : ''; ?>>All Hotels</option>
				<?php foreach ($hotels as $hotel): ?>
					<option value="<?php echo htmlspecialchars($hotel['id_hotel']); ?>" <?php echo $selected_hotel == $hotel['id_hotel'] ? 'selected' : ''; ?>>
						<?php echo htmlspecialchars($hotel['nama']); ?>
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
		<canvas id="revenueChart" style="max-height: 400px;"></canvas>
	</div>
	<div class="total-revenue">
		Total Pendapatan: <?php echo "Rp ".number_format($total_revenue, 0); ?>
	</div>

	<table>
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Pendapatan</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($daily_revenues as $day => $revenue): ?>
				<tr>
					<td><?php echo $day; ?></td>
					<td><?php echo number_format($revenue, 0); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<script>
		const ctx = document.getElementById('revenueChart').getContext('2d');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($labels); ?>,
				datasets: [{
					label: 'Pendapatan Per Hari',
					data: <?php echo json_encode($revenues); ?>,
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