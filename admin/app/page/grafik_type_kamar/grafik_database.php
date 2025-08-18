<?php
$id_hotel = decrypt($_COOKIE['id_hotel']);
$filter_hotel = ($id_hotel != "") ? "AND dk.id_hotel = '$id_hotel'" : "";

// ambil daftar tahun untuk combobox
$q_tahun = mysql_query("SELECT DISTINCT YEAR(waktu_checkin) as tahun FROM data_transaksi ORDER BY tahun DESC");
$tahun_list = [];
while ($r = mysql_fetch_assoc($q_tahun)) {
	$tahun_list[] = $r['tahun'];
}

// tahun yang dipilih (default: tahun sekarang)
$selected_year = isset($_POST['tahun']) ? mysql_real_escape_string($_POST['tahun']) : date('Y');

// ambil semua tipe kamar + join transaksi (biar yang kosong tetap muncul 0)
$sql = "
    SELECT tk.tipe_kamar, COALESCE(COUNT(dt.id_transaksi),0) AS total_transaksi
    FROM data_tipe_kamar tk
    INNER JOIN data_kamar dk ON tk.id_tipe_kamar = dk.id_tipe_kamar
    LEFT JOIN data_transaksi dt 
        ON dk.id_kamar = dt.id_kamar 
        AND YEAR(dt.waktu_checkin) = '$selected_year'
        $filter_hotel
    WHERE 1=1 $filter_hotel
    GROUP BY tk.tipe_kamar
    ORDER BY tk.tipe_kamar ASC
";
$result = mysql_query($sql);

$tipe_kamar = [];
$total = [];
while ($row = mysql_fetch_assoc($result)) {
	$tipe_kamar[] = $row['tipe_kamar'];
	$total[] = (int)$row['total_transaksi'];
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Grafik Jumlah Transaksi per Tipe Kamar</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
	</style>
</head>

<body>
	<h3>Grafik Jumlah Transaksi per Tipe Kamar (Tahun <?= htmlspecialchars($selected_year); ?>)</h3>

	<form method="post" style="margin-bottom:20px;">
		<label for="tahun">Pilih Tahun: </label>
		<select name="tahun" id="tahun" onchange="this.form.submit()">
			<?php foreach ($tahun_list as $th): ?>
				<option value="<?= $th; ?>" <?= $th == $selected_year ? 'selected' : ''; ?>>
					<?= $th; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</form>

	<!-- Grafik -->
	<div style="max-width: 100%; height: 400px;">
		<canvas id="chartTipeKamar"></canvas>
	</div>

	<!-- Tabel Data -->
	<h3>Data Transaksi per Tipe Kamar</h3>
	<table>
		<tr>
			<th>Tipe Kamar</th>
			<th>Jumlah Transaksi</th>
		</tr>
		<?php for ($i = 0; $i < count($tipe_kamar); $i++): ?>
			<tr>
				<td><?= htmlspecialchars($tipe_kamar[$i]); ?></td>
				<td><?= htmlspecialchars($total[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	</table>

	<script>
		const ctx = document.getElementById('chartTipeKamar').getContext('2d');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?= json_encode($tipe_kamar); ?>,
				datasets: [{
					label: 'Jumlah Transaksi',
					data: <?= json_encode($total); ?>,
					backgroundColor: '#007bff',
					borderColor: '#007bff',
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
							text: 'Tipe Kamar'
						}
					}
				}
			}
		});
	</script>
</body>

</html>