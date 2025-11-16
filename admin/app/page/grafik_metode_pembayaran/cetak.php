<?php
include '../../../include/all_include.php';

$query =  decrypt($_GET['q']);

?>


<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


<!-- HEADER -->
<table border="0" style="width: 100%">
	<?php if (isset($_GET['export'])) {
		header("Content-type: application/fouce-download");
		header("Cache-Control: no-cache,must-revalidate");
		header("Content-disposition: attachment; filename=produk_terlaris.xls");
	} else {

		if (isset($_GET['preview'])) {
		} else {
	?>

			<script>
				window.print();
			</script>
		<?php } ?>
		<tr>
			<td class="auto-style1" rowspan="3" width="101">
				<img alt="" src="<?php echo $logo_laporan1; ?>" width="100" height="100">
			</td>

			<td class="auto-style1">
				<center>
					<h2 class="auto-style1"><?php echo $judul; ?></h2>
				</center>
			</td>

			<td class="auto-style1" rowspan="3" width="101">
				<img alt="" src="<?php echo $logo_laporan2; ?>" width="100" height="100">
			</td>
		</tr>
	<?php } ?>

	<tr>
		<td class="auto-style2">
			<center>
				<strong>LAPORAN PENDAPATAN

				</strong>
			</center>
		</td>
	</tr>

	<tr>
		<td class="auto-style2"><?php echo $alamat; ?></td>
	</tr>
</table>
<!-- HEADER -->



<?php if (isset($_GET['grafik'])) { ?>

	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
	<script type="text/javascript" src="http://code.highcharts.com/modules/exporting.js"></script>
	<?php if ($grafik == 1) { ?>
		<div id="grafik" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<?php } ?>
	<?php
	$nama_database = $database;
	?>

	<script>
		function IDRFormatter(angka, prefix) {
			var number_string = angka.toString().replace(/[^,\d]/g, ''),
				split = number_string.split(','),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

		Highcharts.setOptions({
			lang: {
				thousandsSep: ','
			}
		});
		Highcharts.chart('grafik', {

			chart: {
				type: 'line',
				marginTop: 80
			},
			credits: {
				enabled: true
			},
			title: {
				text: '<b>GRAFIK </b>'
			},

			subtitle: {
				text: '<?php echo $subtitle; ?>'
			},

			xAxis: {
				type: 'category',
				labels: {
					rotation: 0,
					align: 'center',
					style: {
						fontSize: '10px',
						fontFamily: 'Verdana, sans-serif',
						align: 'center'
					}
				}
			},


			yAxis: {
				title: {
					text: 'Jumlah (Rupiah)'
				},
				labels: {
					formatter: function() {
						if (this.value >= 1E6) {
							return 'Rp.' + (this.value / 1000000).toFixed(0) + 'Jt';
						}
						return 'Rp' + this.value / 1000 + 'k';
					}
				}

			},

			legend: {
				enabled: true
			},

			plotOptions: {

				series: {

					borderWidth: 1,
					dataLabels: {
						enabled: true,
						format: '<span>Rp. {point.y:,.0f}</span>'


					},
					cursor: 'pointer',
					point: {
						events: {
							click: function() {
								location.href = this.options.url;
							}
						}
					}
				}


			},

			tooltip: {
				shared: true,
				crosshairs: true,
				headerFormat: '<span style="color:{point.color}">Grafik </span> {series.name}<br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>Rp. {point.y:,.0f}</b><br/>'
			},


			//DAFTAR NAMA TABEL YANG ADA  
			"series": [{

					"name": "Pendapatan ",
					"colorByPoint": true,
					"data": [
						<?php
						if (isset($_GET['tanggal1'])) {
							$tanggal1 = $_GET['tanggal1'];
							$tanggal2 = $_GET['tanggal2'];

							$query = "SELECT * FROM data_transaksi where (data_transaksi.tanggal BETWEEN '$tanggal1' AND '$tanggal2') GROUP BY tanggal asc";
						} else {
							$query = "SELECT * FROM data_transaksi GROUP BY tanggal asc";
						}
						$queryes = mysql_query($query);
						while ($data = mysql_fetch_array($queryes)) {
						?> {
								//MENAMPILKAN DATA DALAM GRAFIK
								"name": "    <?php echo format_indo($tanggal = $data['tanggal']); ?>",
								"y": <?php
										$total = 0;
										$querytabel = "SELECT
					data_transaksi.id_transaksi,
					data_transaksi.kode_transaksi,
					data_transaksi.tanggal,
					data_transaksi.jam,
					data_transaksi.keterangan,
					data_transaksi.`status`,
					data_penjualan.kasir,
					data_transaksi.jumlah
					FROM data_transaksi,data_penjualan
					where (data_transaksi.tanggal BETWEEN '$tanggal' AND '$tanggal') and
					 data_transaksi.kode_transaksi=data_penjualan.kode_transaksi_penjualan AND data_penjualan.kasir LIKE '%%'
                    group by kode_transaksi";
										$prosestabel = mysql_query($querytabel);
										while ($datatabel = mysql_fetch_array($prosestabel)) {
											$total = $total + ($datatabel['jumlah']);
										}
										echo $total;

										?>,
								url: '#',
								//"drilldown": "<?php echo $tampil_showtables; ?>" //NULL
							},
						<?php
						}
						?>

					]
				},


			],

		});
	</script>





<?php } ?>

<?php if (isset($_GET['data'])) { ?>


	<table width="100%" class="stat-table responsive table table-stats table-striped table-sortable table-bordered" border="1">


		<tr>
			<th class="th_border cell">NO</th>
			<th class="th_border cell">TANGGAL</th>
			<th class="th_border cell">PESANAN </th>
			<th class="th_border cell">PENJUALAN </th>
			<th class="th_border cell">TOTAL PENDAPATAN</th>
		</tr>
		<?php
		$pemesanan = 0;
		$penjualan = 0;
		$seluruh = 0;
		$no = 0;
		if (isset($_GET['tanggal1'])) {
			$tanggal1 = $_GET['tanggal1'];
			$tanggal2 = $_GET['tanggal2'];

			$queryew = "SELECT * FROM data_transaksi where (data_transaksi.tanggal BETWEEN '$tanggal1' AND '$tanggal2') GROUP BY tanggal asc";
		} else {
			$queryew = "SELECT * FROM data_transaksi GROUP BY tanggal asc";
		}
		$queryesew = mysql_query($queryew);
		while ($dataew = mysql_fetch_array($queryesew)) {

		?>
			<tr>
				<td align="center"><?php echo $no = $no + 1; ?></td>
				<td align="center"> <?php echo format_indo($tanggal = $dataew['tanggal']); ?></td>
				<td align="left"><?php
									$total = 0;
									$querytabel = "SELECT
					data_transaksi.id_transaksi,
					data_transaksi.kode_transaksi,
					data_transaksi.tanggal,
					data_transaksi.jam,
					data_transaksi.keterangan,
					data_transaksi.`status`,
					data_penjualan.kasir,
					data_transaksi.jumlah
					FROM data_transaksi,data_penjualan
					where (data_transaksi.tanggal BETWEEN '$tanggal' AND '$tanggal') and
					 data_transaksi.kode_transaksi=data_penjualan.kode_transaksi_penjualan AND 
					 data_penjualan.kasir LIKE '%%' AND
					 data_transaksi.keterangan <> 'Penjualan' 
                    group by kode_transaksi";
									$prosestabel = mysql_query($querytabel);
									while ($datatabel = mysql_fetch_array($prosestabel)) {
										$total = $total + ($datatabel['jumlah']);
									}
									echo rupiah($total);
									$pemesanan = $pemesanan + $total;

									?></td>


				<td align="left"><?php
									$total = 0;
									$querytabel = "SELECT
					data_transaksi.id_transaksi,
					data_transaksi.kode_transaksi,
					data_transaksi.tanggal,
					data_transaksi.jam,
					data_transaksi.keterangan,
					data_transaksi.`status`,
					data_penjualan.kasir,
					data_transaksi.jumlah
					FROM data_transaksi,data_penjualan
					where (data_transaksi.tanggal BETWEEN '$tanggal' AND '$tanggal') and
					data_transaksi.kode_transaksi=data_penjualan.kode_transaksi_penjualan AND 
					data_penjualan.kasir LIKE '%%' AND
					data_transaksi.keterangan = 'Penjualan'  
                    group by kode_transaksi";
									$prosestabel = mysql_query($querytabel);
									while ($datatabel = mysql_fetch_array($prosestabel)) {
										$total = $total + ($datatabel['jumlah']);
									}
									echo rupiah($total);
									$penjualan = $penjualan + $total;

									?></td>


				<td align="left"><?php
									$total = 0;
									$querytabel = "SELECT
					data_transaksi.id_transaksi,
					data_transaksi.kode_transaksi,
					data_transaksi.tanggal,
					data_transaksi.jam,
					data_transaksi.keterangan,
					data_transaksi.`status`,
					data_penjualan.kasir,
					data_transaksi.jumlah
					FROM data_transaksi,data_penjualan
					where (data_transaksi.tanggal BETWEEN '$tanggal' AND '$tanggal') and
					 data_transaksi.kode_transaksi=data_penjualan.kode_transaksi_penjualan AND data_penjualan.kasir LIKE '%%'
                    group by kode_transaksi";
									$prosestabel = mysql_query($querytabel);
									while ($datatabel = mysql_fetch_array($prosestabel)) {
										$total = $total + ($datatabel['jumlah']);
									}
									echo rupiah($total);
									$seluruh = $seluruh + $total;

									?></td>
			</tr>
		<?php } ?>


		<tr>
			<td align="right" colspan="2">
				<b>
					TOTAL:
				</b>
			</td>

			<td align="center"><b><?php echo rupiah($pemesanan); ?></b></td>
			<td align="center"><b><?php echo rupiah($penjualan); ?></b></td>
			<td align="center"><b><?php echo rupiah($seluruh); ?></b></td>

		</tr>
	</table>
	<br>

<?php } ?>


<!-- FOOTER -->
<p class="auto-style3"><?php echo $formatwaktu; ?>
</p>
<p class="auto-style3"><?php echo $ttd; ?></p>
<p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>
<p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
<p class="auto-style3"></p>