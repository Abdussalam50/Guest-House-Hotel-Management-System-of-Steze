<?php
$id_hotel = decrypt($_COOKIE['id_hotel']); // ambil id hotel dari cookie
$filter_hotel = ($id_hotel != "") ? "AND dk.id_hotel = '$id_hotel'" : "";

// ambil daftar tahun untuk combobox
$q_tahun = mysql_query("SELECT DISTINCT YEAR(waktu_checkin) as tahun FROM data_transaksi ORDER BY tahun DESC");
$tahun_list = [];
while ($r = mysql_fetch_assoc($q_tahun)) {
	$tahun_list[] = $r['tahun'];
}

// tahun yang dipilih (default: tahun sekarang)
$selected_year = isset($_POST['tahun']) ? mysql_real_escape_string($_POST['tahun']) : date('Y');

// ambil semua kamar lalu join dengan transaksi (biar yg kosong jadi 0)
$sql = "
    SELECT dk.no_kamar, COALESCE(COUNT(dt.id_transaksi),0) AS total_transaksi
    FROM data_kamar dk
    LEFT JOIN data_transaksi dt 
        ON dk.id_kamar = dt.id_kamar 
        AND YEAR(dt.waktu_checkin) = '$selected_year'
        $filter_hotel
    WHERE 1=1 $filter_hotel
    GROUP BY dk.no_kamar
    ORDER BY CAST(dk.no_kamar AS UNSIGNED) ASC
";
$result = mysql_query($sql);

$kamar = [];
$total = [];
while ($row = mysql_fetch_assoc($result)) {
	$kamar[] = $row['no_kamar'];
	$total[] = (int)$row['total_transaksi'];
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Grafik Jumlah Kamar Teramai per Tahun</title>
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
	<h3>Grafik Jumlah Transaksi per Kamar (Tahun <?= htmlspecialchars($selected_year); ?>)</h3>

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

	<canvas id="chartKamar" style="max-width: 900px; max-height: 500px;"></canvas>

	<!-- Tabel Data -->
	<h3>Data Transaksi per Kamar</h3>
	<table>
		<tr>
			<th>No Kamar</th>
			<th>Jumlah Transaksi</th>
		</tr>
		<?php for ($i = 0; $i < count($kamar); $i++): ?>
			<tr>
				<td><?= htmlspecialchars($kamar[$i]); ?></td>
				<td><?= htmlspecialchars($total[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	</table>

	<script>
		const ctx = document.getElementById('chartKamar').getContext('2d');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?= json_encode($kamar); ?>,
				datasets: [{
					label: 'Jumlah Transaksi',
					data: <?= json_encode($total); ?>,
					backgroundColor: '#28a745',
					borderColor: '#28a745',
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
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
				}
			}
		});
	</script>
</body>

</html>