<br><br>

<div class="content-box" style="overflow-x: auto;">

</div>
<form action="proses_update.php" enctype="multipart/form-data" method="post">
	<div class="content-box-content">
		<div id="postcustom">
			<table <?php tabel_in(100, '%', 0, 'center');  ?>>
				<tbody>
					<?php

					if (!isset($_GET['proses'])) {
						     ?>
						<script>
							alert("AKSES DITOLAK");
							location.href = "index.php";
						</script>
					<?php
						die();
					}
					$proses = decrypt(mysql_real_escape_string($_GET['proses']));
					$sql = mysql_query("SELECT * FROM data_pengaturan_printer where id_pengaturan_printer = '$proses'");
					$data = mysql_fetch_array($sql);
					?>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>id&nbsp;pengaturan&nbsp;printer <font color="red">*</font></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" type="readonly" readonly name="id_pengaturan_printer" value="<?php echo $data['id_pengaturan_printer']; ?>" readonly id="id_pengaturan_printer" required="required">
						</td>
					</tr>

					<tr>
						<td width="25%" class="leftrowcms">
							<label>Nama&nbsp;Printer&nbsp;Nota <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="nama_printer_nota" id="nama_printer_nota" placeholder="Nama&nbsp;Printer&nbsp;Nota" value="<?php echo ($data['nama_printer_nota']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Ukuran Kertas<span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<select class="form-control form-control-solid form-control-xs" required="required" type="text" name="ukuran_kertas" id="ukuran_kertas" placeholder="Nama&nbsp;Printer&nbsp;Nota" value="<?php echo ($data['nama_printer_nota']); ?>">
								<option value=""></option><?php combo_enum("data_pengaturan_printer", "ukuran_kertas", "") ?>
							</select>

						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Pengaturan&nbsp;Cash&nbsp;Drawer <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<select class='form-control form-control-solid form-control-xs' data-live-search='true' required="required" type="enum" name="pengaturan_cash_drawer" id="pengaturan_cash_drawer" placeholder="Pengaturan&nbsp;Cash&nbsp;Drawer" value="<?php echo ($data['pengaturan_cash_drawer']); ?>">
								<option value='<?php echo $data[pengaturan_cash_drawer]; ?>'>- <?php echo $data[pengaturan_cash_drawer]; ?> -</option><?php combo_enum('data_pengaturan_printer', 'pengaturan_cash_drawer', ''); ?>
							</select>

						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Nama&nbsp;Printer&nbsp;Laporan <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input onkeypress='return h(event)' class="form-control form-control-solid form-control-xs" required="required" type="text" name="nama_printer_laporan" id="nama_printer_laporan" placeholder="Nama&nbsp;Printer&nbsp;Laporan" value="<?php echo ($data['nama_printer_laporan']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Gambar&nbsp;Logo<span class="highlight">*</span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<a href='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='100' height='60' src='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'></a>
							<br>
							<?php echo $data['gambar_logo']; ?>
							<input type="hidden" name="gambar_logo1" value="<?php echo $data['gambar_logo']; ?>">
							<br>
							<input class="form-control form-control-solid form-control-xs" type="file" name="gambar_logo" id="gambar_logo" placeholder="Gambar&nbsp;Logo" value="<?php echo ($data['gambar_logo']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Header1 <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="header1" id="header1" placeholder="Header1" value="<?php echo ($data['header1']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Header2 <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="header2" id="header2" placeholder="Header2" value="<?php echo ($data['header2']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Header3 <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="header3" id="header3" placeholder="Header3" value="<?php echo ($data['header3']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Footer1 <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="footer1" id="footer1" placeholder="Footer1" value="<?php echo ($data['footer1']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Footer2 <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="footer2" id="footer2" placeholder="Footer2" value="<?php echo ($data['footer2']); ?>">



						</td>
					</tr>

					<tr>
						<td width="25%" class="leftrowcms">
							<label>footer3 <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="footer3" id="footer3" placeholder="footer3" value="<?php echo ($data['footer3']); ?>">



						</td>
					</tr>


					<tr>
						<td width="25%" class="leftrowcms">
							<label>Nota&nbsp;Email <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>


							<select class='form-control form-control-solid form-control-xs' data-live-search='true' required="required" type="enum" name="nota_email" id="nota_email" placeholder="Nota&nbsp;email" value="<?php echo ($data['nota_email']); ?>">
								<option value='<?php echo $data[nota_email]; ?>'>- <?php echo $data[nota_email]; ?> -</option><?php combo_enum('data_pengaturan_printer', 'nota_email', ''); ?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Email&nbsp;Sumber <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="" name="email_sumber" id="email_sumber" placeholder="Email&nbsp;Sumber" value="<?php echo ($data['email_sumber']); ?>">



						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>Nota&nbsp;Wa <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<select class='form-control form-control-solid form-control-xs' data-live-search='true' required="required" type="enum" name="nota_wa" id="nota_wa" placeholder="Nota&nbsp;Wa" value="<?php echo ($data['nota_wa']); ?>">
								<option value='<?php echo $data[nota_wa]; ?>'>- <?php echo $data[nota_wa]; ?> -</option><?php combo_enum('data_pengaturan_printer', 'nota_wa', ''); ?>
							</select>

						</td>
					</tr>
					<tr>
						<td width="25%" class="leftrowcms">
							<label>No&nbsp;Wa&nbsp;Sumber <span class="highlight"></span></label>
						</td>
						<td width="2%">:</td>
						<td>
							<input class="form-control form-control-solid form-control-xs" required="required" type="text" name="no_wa_sumber" id="no_wa_sumber" placeholder="No&nbsp;Wa&nbsp;Sumber" value="<?php echo ($data['no_wa_sumber']); ?>">



						</td>
					</tr>

				</tbody>
			</table>
			<div class="content-box-content">
				<center>
					<?php btn_update(' UPDATE'); ?>
				</center>
			</div>
		</div>
	</div>
	</div>
</form>