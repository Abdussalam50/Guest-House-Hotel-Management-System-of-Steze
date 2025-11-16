<?php
// Fetch distinct years and months from data_transaksi for combobox
$year_month_query = mysql_query("SELECT DISTINCT YEAR(waktu_checkin) AS year, MONTH(waktu_checkin) AS month FROM data_transaksi ORDER BY year DESC, month DESC");
$years = [];
$months = [];
$hotel=[];
while ($row = mysql_fetch_assoc($year_month_query)) {
	$years[$row['year']] = $row['year'];
	$months[$row['year']][$row['month']] = $row['month'];
}
$hotel_query=mysql_query("SELECT * FROM data_hotel");
while($hotels=mysql_fetch_array($hotel_query)){
	$hotel[$hotels['id_hotel']]=$hotels['nama'];
}
// Default to current year and month if not set
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');
$selected_month = isset($_POST['month']) ? mysql_real_escape_string($_POST['month']) : date('m');
$selected_hotel=isset($_POST['hotel'])?mysql_real_escape_string(($_POST['hotel'])):'';

// Get number of days in the selected month
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);

// Fetch revenue per day for the selected month and year
$trans_query = mysql_query("
    SELECT DAY(t.waktu_checkin) AS day,
           SUM(COALESCE(harga,0)+COALESCE(biaya_tambahan_checkin,0)+COALESCE(biaya_tambahan_checkout,0)) AS revenue
    FROM data_transaksi t
    JOIN data_kamar k ON t.id_kamar = k.id_kamar
    WHERE YEAR(t.waktu_checkin) = '$selected_year' AND MONTH(t.waktu_checkin) = '$selected_month' AND t.id_hotel='$selected_hotel' AND t.status_transaksi IN('Lunas','Selesai')
    GROUP BY day
    ORDER BY day
");
$daily_revenues = array_fill(1, $days_in_month, 0); // Initialize array with 0 for each day
$total_revenue = 0; // Initialize total revenue
while ($row = mysql_fetch_assoc($trans_query)) {
	$daily_revenues[$row['day']] = (float)$row['revenue'];
	$total_revenue += (float)$row['revenue'];
}

// Prepare labels (days 1 to max days) and revenues
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
			max-width: 800px;
			margin: 0 auto;
		}

		.total-revenue {
			text-align: center;
			margin-top: 20px;
			font-size: 18px;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<h3 style="text-align: center;">Daily Revenue for <?php echo date('F Y', mktime(0, 0, 0, $selected_month, 1, $selected_year)); ?></h3>
	<form method="post" style="text-align: center; margin-bottom: 20px;">
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
		<label for="hotel">Hotel :</label>
		<select name="hotel" id="" onchange="this.form.submit()">
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
		<canvas id="revenueChart" style="max-height: 400px;"></canvas>
	</div>
	<div class="total-revenue">
		Total Revenue: <?php echo number_format($total_revenue, 2); ?>
	</div>

	<script>
		const ctx = document.getElementById('revenueChart').getContext('2d');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($labels); ?>,
				datasets: [{
					label: 'Revenue per Day',
					data: <?php echo json_encode($revenues); ?>,
					backgroundColor: '#28a745', // Modern green for revenue
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