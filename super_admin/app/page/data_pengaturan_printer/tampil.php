<body>
	<a href="<?php index(); ?>?input=tambah">
		<?php btn_tambah('Tambah'); ?>
	</a>

	<a target="blank" href="cetak.php?berdasarkan=data_pengaturan_printer&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
		<?php btn_export('Export Excel'); ?>
	</a>

	<a target="blank" href="cetak.php?berdasarkan=data_pengaturan_printer&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
		<?php btn_cetak('Cetak'); ?>
	</a>

	<a href="<?php index(); ?>">
		<?php btn_refresh('Refresh'); ?>
	</a>

	<br><br>

	<form name="formcari" id="formcari" action="" method="get">
		<fieldset>
			<table>
				<tbody>
					<tr>
						<td>Berdasarkan</td>
						<td>:</td>
						<td>
							<!-- <input value="" name="Berdasarkan" id="Berdasarkan" > --> <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
								<?php
								$sql = "desc data_pengaturan_printer";
								$result = @mysql_query($sql);
								while ($row = @mysql_fetch_array($result)) {
									echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
								}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>Pencarian</td>
						<td>:</td>
						<td>
							<!--<input class="form-control" type="text" name="isi" value="" >--> <input type="text" name="isi" value="">
							<?php btn_cari('Cari'); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>

	<div style="overflow-x:auto;">
		<table <?php tabel(100, '%', 1, 'left');  ?>>
			<tr>
				<th>Action</th>
				<th>No</th>
				<th>Id&nbsp;pengaturan&nbsp;printer</th>
				<th align="center" class="th_border cell">Nama&nbsp;printer&nbsp;nota</th>
				<th align="center" class="th_border cell">Ukuran Kertas</th>
				<th align="center" class="th_border cell">Nama&nbsp;printer&nbsp;laporan</th>
				<th align="center" class="th_border cell">Gambar&nbsp;logo</th>
				<th align="center" class="th_border cell">Header1</th>
				<th align="center" class="th_border cell">Header2</th>
				<th align="center" class="th_border cell">Header3</th>
				<th align="center" class="th_border cell">Footer1</th>
				<th align="center" class="th_border cell">Footer2</th>
				<th align="center" class="th_border cell">Nota&nbsp;email</th>
				<th align="center" class="th_border cell">Email&nbsp;sumber</th>
				<th align="center" class="th_border cell">Nota&nbsp;wa</th>
				<th align="center" class="th_border cell">No&nbsp;wa&nbsp;sumber</th>

			</tr>

			<tbody>
				<?php
				$no = 0;
				$startRow = ($page - 1) * $dataPerPage;
				$no = $startRow;

				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
					$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
					$isi =  mysql_real_escape_string($_GET['isi']);
					$querytabel = "SELECT * FROM data_pengaturan_printer where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
					$querypagination = "SELECT COUNT(*) AS total FROM data_pengaturan_printer where $berdasarkan like '%$isi%'";
				} else {
					$querytabel = "SELECT * FROM data_pengaturan_printer  LIMIT $startRow ,$dataPerPage";
					$querypagination = "SELECT COUNT(*) AS total FROM data_pengaturan_printer";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) { ?>
					<tr class="event2">
						<td class="th_border cell" align="center" width="200">
							<table border="0">
								<tr>
									<td>
										<a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_pengaturan_printer']); ?>">
											<?php btn_detail('Detail'); ?></a>
									</td>
									<td>
										<a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_pengaturan_printer']); ?>">
											<?php btn_edit('Edit'); ?></a>
									</td>
									<td>
										<a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_pengaturan_printer']); ?>">
											<?php btn_hapus('Hapus'); ?></a>
									</td>
								</tr>
							</table>
						</td>
						<td align="center" width="50"><?php $no = (($no + 1));
														echo $no;  ?></td>
						<td align="center"><?php echo $data['id_pengaturan_printer']; ?></td>

						<td align="center"><?php echo ($data['nama_printer_nota']); ?></td>
						<td align="center"><?php echo ($data['ukuran_kertas']); ?></td>
						<td align="center"><?php echo ($data['nama_printer_laporan']); ?></td>
						<td align="center"><a href='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='50' height='30' src='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'></a></td>
						<td align="center"><?php echo ($data['header1']); ?></td>
						<td align="center"><?php echo ($data['header2']); ?></td>
						<td align="center"><?php echo ($data['header3']); ?></td>
						<td align="center"><?php echo ($data['footer1']); ?></td>
						<td align="center"><?php echo ($data['footer2']); ?></td>
						<td align="center"><?php echo ($data['nota_email']); ?></td>
						<td align="center"><?php echo ($data['email_sumber']); ?></td>
						<td align="center"><?php echo ($data['nota_wa']); ?></td>
						<td align="center"><?php echo ($data['no_wa_sumber']); ?></td>

					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>