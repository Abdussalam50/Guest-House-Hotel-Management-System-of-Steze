<a href="<?php index(); ?>">
	<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">

	<form action="proses_simpan.php" enctype="multipart/form-data" method="post">
		<div class="content-box-content">
			<div id="postcustom">
				<table <?php tabel_in(100, '%', 0, 'center');  ?>>
					<tbody>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;pengaturan&nbsp;printer <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="readonly" readonly value="<?php echo id_otomatis("data_pengaturan_printer", "id_pengaturan_printer", "10"); ?>" name="id_pengaturan_printer" placeholder="id_pengaturan_printer" id="id_pengaturan_printer" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Printer&nbsp;Nota <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class="form-control form-control-solid form-control-xs" type="text" name="ukruan_kertas" id="ukruan_kertas" placeholder="Nama&nbsp;Printer&nbsp;Nota" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Ukuran Kertas<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<select class="form-control form-control-solid form-control-xs" type="text" name="ukruan_kertas" id="ukruan_kertas" placeholder="Nama&nbsp;Printer&nbsp;Nota" required="required">
									<option value=""></option><?php combo_enum("data_pengaturan_printer", "ukuran_kertas", "") ?>
								</select>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Printer&nbsp;Laporan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class="form-control form-control-solid form-control-xs" type="text" name="nama_printer_laporan" id="nama_printer_laporan" placeholder="Nama&nbsp;Printer&nbsp;Laporan" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Gambar&nbsp;Logo <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="file" name="gambar_logo" id="gambar_logo" placeholder="Gambar&nbsp;Logo" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Header1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="text" name="header1" id="header1" placeholder="Header1" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Header2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="text" name="header2" id="header2" placeholder="Header2" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Header3 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="text" name="header3" id="header3" placeholder="Header3" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Footer1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="text" name="footer1" id="footer1" placeholder="Footer1" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Footer2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="text" name="footer2" id="footer2" placeholder="Footer2" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nota&nbsp;Email <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="email" name="nota_email" id="nota_email" placeholder="Nota&nbsp;Email" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Email&nbsp;Sumber <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="email" name="email_sumber" id="email_sumber" placeholder="Email&nbsp;Sumber" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nota&nbsp;Wa <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control form-control-solid form-control-xs' data-live-search='true' type="enum" name="nota_wa" id="nota_wa" placeholder="Nota&nbsp;Wa" required="required">
									<option></option><?php combo_enum('data_pengaturan_printer', 'nota_wa', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>No&nbsp;Wa&nbsp;Sumber <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class="form-control form-control-solid form-control-xs" type="text" name="no_wa_sumber" id="no_wa_sumber" placeholder="No&nbsp;Wa&nbsp;Sumber" required="required">


							</td>
						</tr>

					</tbody>
				</table>
				<div class="content-box-content">
					<center>
						<?php btn_simpan(' SIMPAN'); ?>
					</center>
				</div>
			</div>
		</div>
	</form>