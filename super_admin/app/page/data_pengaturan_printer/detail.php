<img class="img-fluid" src="head.png" width="400">
<br><br>

<div class="content-box">
	<div class="content-box-header" style="height: 39px">
		<h3 style="cursor: s-resize;"></h3>
	</div>
	<div class="content-box-content" style="overflow-x: auto;">
		<table <?php tabel_in(100, '%', 0, 'center');  ?>>
			<tbody>
				<?php

				$sql = mysql_query("SELECT * FROM data_pengaturan_printer");
				$data = mysql_fetch_array($sql);
				?>


				<tr>
					<td class="clleft" width="25%">Nama&nbsp;printer&nbsp;nota</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['nama_printer_nota']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Ukuran Kertas</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['ukuran_kertas']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Nama&nbsp;printer&nbsp;laporan</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['nama_printer_laporan']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Pengaturan&nbsp;cash&nbsp;drawer</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['pengaturan_cash_drawer']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Gambar&nbsp;logo</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><a href='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='250' src='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'></a></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Header1</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['header1']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Header2</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['header2']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Header3</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['header3']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Footer1</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['footer1']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Footer2</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['footer2']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Footer3</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['footer3']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Nota&nbsp;email</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['nota_email']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Email&nbsp;sumber</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['email_sumber']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Nota&nbsp;wa</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['nota_wa']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">No&nbsp;wa&nbsp;sumber</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['no_wa_sumber']; ?></td>
				</tr>



			</tbody>
			<td>
				<a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_pengaturan_printer']); ?>">
					<?php btn_edit('Edit Pengaturan Printer'); ?></a>
			</td>
		</table>
	</div>
</div>