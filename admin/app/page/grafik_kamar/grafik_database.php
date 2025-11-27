<?php

// Get id_hotel from cookie
$id_hotel = isset($_COOKIE['id_hotel']) ? decrypt($_COOKIE['id_hotel']) : '';

// Build hotel filter condition
$filter_hotel = '';
$selected_hotel = isset($_POST['id_hotel']) ? mysql_real_escape_string($_POST['id_hotel']) : $id_hotel;

if (!empty($selected_hotel) && $selected_hotel !== 'all') {
	$filter_hotel = "AND dk.id_hotel = '$selected_hotel'";
}

// Fetch hotel data for dropdown
$hotels_query = mysql_query("SELECT id_hotel, nama FROM data_hotel ORDER BY id_hotel") or die('Hotel query failed: ' . mysql_error());
$hotels = [];
while ($row = mysql_fetch_assoc($hotels_query)) {
	$hotels[$row['id_hotel']] = $row['nama'];
}

// Fetch distinc_oke years
$q_tahun = mysql_query("
    SELECT YEAR(waktu_checkin) AS tahun 
    FROM data_transaksi 
    GROUP BY YEAR(waktu_checkin) 
    ORDER BY tahun DESC
") or die('Year query failed: ' . mysql_error());

$tahun_list = [];
while ($r = mysql_fetch_assoc($q_tahun)) {
	$tahun_list[] = $r['tahun'];
}

// Fallback if no years available
if (empty($tahun_list)) {
	$tahun_list = [date('Y')];
}

// Selected year (default: current year)
$selected_year = isset($_POST['tahun']) ? mysql_real_escape_string($_POST['tahun']) : date('Y');

// Validate year
if (!is_numeric($selected_year)) {
	die('Invalid year selected.');
}

// Fetch room transaction data
$sql = "
    SELECT dk.no_kamar, COALESCE(COUNT(dt.id_transaksi), 0) AS total_transaksi
    FROM data_kamar dk
    LEFT JOIN data_transaksi dt 
        ON dk.id_kamar = dt.id_kamar 
        AND YEAR(dt.waktu_checkin) = '$selected_year'
        $filter_hotel
    WHERE 1=1 $filter_hotel
    GROUP BY dk.no_kamar
    ORDER BY CAST(dk.no_kamar AS UNSIGNED) ASC
";
$result = mysql_query($sql) or die('Room query failed: ' . mysql_error());

$kamar = [];
$total = [];
while ($row = mysql_fetch_assoc($result)) {
	$kamar[] = $row['no_kamar'];
	$total[] = (int)$row['total_transaksi'];
}

// Prevent chart error if data is empty
if (empty($kamar)) {
	$kamar = ['No Data'];
	$total = [0];
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Grafik Jumlah Kamar Teramai per Tahun</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
	<style>
		table {
			border-collapse: collapse;
			margin-top: 20px;
			width: 100%;
		}

		table,
		th,
		td {
			border: 1px solid #ccc;
			padding: 8px;
			text-align: center;
		}

		th {
			background: #f4f4f4;
		}

		.filter-form {
			margin-bottom: 20px;
			text-align: left;
		}

		.filter-form select {
			margin-right: 10px;
		}

		canvas {
			max-width: 900px;
			max-height: 500px;
		}
	</style>
</head>

<body>
	<h3>
		Grafik Jumlah Transaksi per Kamar (Tahun <?php echo htmlspecialchars($selected_year); ?>)
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
		<label for="tahun">Pilih Tahun: </label>
		<select name="tahun" id="tahun" onchange="this.form.submit()">
			<?php foreach ($tahun_list as $th): ?>
				<option value="<?php echo htmlspecialchars($th); ?>" <?php echo $th == $selected_year ? 'selected' : ''; ?>>
					<?php echo htmlspecialchars($th); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</form>

	<canvas id="chartKamar"></canvas>

	<!-- Tabel Data -->
	<h3>Data Transaksi per Kamar</h3>
	<table>
		<tr>
			<th>No Kamar</th>
			<th>Jumlah Transaksi</th>
		</tr>
		<?php for ($i = 0; $i < count($kamar); $i++): ?>
			<tr>
				<td><?php echo htmlspecialchars($kamar[$i]); ?></td>
				<td><?php echo htmlspecialchars($total[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	</table>

	<script>
		const ctx = document.getElementById('chartKamar').getContext('2d');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($kamar); ?>,
				datasets: [{
					label: 'Jumlah Transaksi',
					data: <?php echo json_encode($total); ?>,
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
							text: 'Jumlah Transaksi'
						}
					},
					x: {
						title: {
							display: true,
							text: 'Nomor Kamar'
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