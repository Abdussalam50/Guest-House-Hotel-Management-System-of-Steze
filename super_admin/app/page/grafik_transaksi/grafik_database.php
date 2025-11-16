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
$q_hotel=mysql_query("SELECT * FROM data_hotel");
while($data_hotel=mysql_fetch_array($q_hotel)){
	$hotel[$data_hotel['id_hotel']]=$data_hotel['nama'];
}
// Default to current year and month if not set
$selected_year = isset($_POST['year']) ? mysql_real_escape_string($_POST['year']) : date('Y');
$selected_month = isset($_POST['month']) ? mysql_real_escape_string($_POST['month']) : date('m');
$selected_hotel=isset($_POST['hotel'])?mysql_real_escape_string($_POST['hotel']):'';


// Get number of days in the selected month
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);

// Fetch transaction counts per day for the selected month and year
$trans_query = mysql_query("
    SELECT DAY(waktu_transaksi) AS day, COUNT(*) AS transaction_count
    FROM data_transaksi
    WHERE YEAR(waktu_transaksi) = '$selected_year' AND MONTH(waktu_transaksi) = '$selected_month' AND id_hotel='$selected_hotel'
    GROUP BY day
    ORDER BY day
");
$daily_counts = array_fill(1, $days_in_month, 0); // Initialize array with 0 for each day
while ($row = mysql_fetch_assoc($trans_query)) {
	$daily_counts[$row['day']] = (int)$row['transaction_count'];
}

// Prepare labels (days 1 to max days) and counts
$labels = range(1, $days_in_month);
$counts = array_values($daily_counts);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Traffic Transaksi Harian</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>

<body>
	<h3>Transaksi Harian Per Bulan</h3>
	<form method="post" style="margin-bottom: 20px;">
		<label for="year">Year: </label>
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
		<select name="hotel" id="hotel" onchange="this.form.submit()">
			<?php
				
				foreach($hotel as $item=>$value){
					?>
					<option value="<?php echo $item?>"><?php echo $value?></option>
			<?php
				}
			?>
		</select>
	</form>
	<canvas id="transactionChart" style="max-width: 800px; max-height: 400px;"></canvas>

	<script>
		const ctx = document.getElementById('transactionChart').getContext('2d');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($labels); ?>,
				datasets: [{
					label: 'Transaksi Per Hari',
					data: <?php echo json_encode($counts); ?>,
					backgroundColor: '#4e73df', // Modern blue
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
							text: 'Jumlah Transaksi'
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