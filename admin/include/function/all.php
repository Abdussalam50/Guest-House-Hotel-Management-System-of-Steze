<?php
if (isset($_GET['page']) && !empty($_GET['page'])) {
	$page = (int)$_GET['page'];
} else {
	$page = 1;
}
if (isset($_GET['perPage']) && !empty($_GET['perPage'])) {
	$dataPerPage = (int)$_GET['perPage'];
} else {
	$dataPerPage = 10;
}
function Pagination($pagedefault, $limit, $querypagination)
{
	if (isset($_GET['page']) && !empty($_GET['page'])) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	if (isset($_GET['perPage']) && !empty($_GET['perPage'])) {
		$dataPerPage = (int)$_GET['perPage'];
	} else {
		$dataPerPage = 10;
	}

	$queryParams = [];
	if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
		$berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
		$isi = mysql_real_escape_string($_GET['isi']);
		$queryParams['Berdasarkan'] = $berdasarkan;
		$queryParams['isi'] = $isi;
		$countTotalRow = mysql_query($querypagination);
	} else {
		$countTotalRow = mysql_query($querypagination);
	}

	$queryResult = mysql_fetch_assoc($countTotalRow);
	$totalRow = $queryResult['total'];
	$item_per_page = mysql_real_escape_string($dataPerPage);
	$current_page = mysql_real_escape_string($page);
	$total_records = $totalRow;
	$total_pages = floor($totalRow / $dataPerPage) + 1;

	$queryParams['perPage'] = $item_per_page;

	$base_url = strtok($_SERVER["REQUEST_URI"], '?');
	$query_string = http_build_query($queryParams);

	echo "Jumlah " . $totalRow . " data, ";
	echo "Halaman " . $current_page . " Dari " . $total_pages . " Halaman<br><br>";

	$pagination = '';
	$right_links = $current_page + 3;
	$previous = $current_page - 3;
	$next = $current_page + 1;

	$previous_link = ($previous == 0) ? 1 : $previous;
	$pagination .= '<a class="btn btn-sm btn-secondary fw-semibold" href="' . $base_url . '?' . $query_string . '&page=1" title="First">«</a> ';
	$pagination .= '<a class="btn btn-sm btn-secondary fw-semibold" href="' . $base_url . '?' . $query_string . '&page=' . $previous_link . '" title="Previous">« Sebelumnya</a> ';

	for ($i = ($current_page - 2); $i < $current_page; $i++) {
		if ($i > 0) {
			$pagination .= '<a class="btn btn-sm btn-secondary fw-semibold" href="' . $base_url . '?' . $query_string . '&page=' . $i . '">' . $i . '</a> ';
		}
	}

	$pagination .= '<a class="btn btn-default btn-xs">' . $current_page . '</a> ';

	for ($i = $current_page + 1; $i < $right_links; $i++) {
		if ($i <= $total_pages) {
			$pagination .= '<a class="btn btn-sm btn-secondary fw-semibold" href="' . $base_url . '?' . $query_string . '&page=' . $i . '">' . $i . '</a> ';
		}
	}

	$next_link = ($i > $total_pages) ? $total_pages : $i;
	$pagination .= '<a class="btn btn-sm btn-secondary fw-semibold" href="' . $base_url . '?' . $query_string . '&page=' . $next_link . '" >berikutnya »</a> ';
	$pagination .= '<a class="btn btn-sm btn-secondary fw-semibold" href="' . $base_url . '?' . $query_string . '&page=' . $total_pages . '" title="Last">»</a> ';

	echo $pagination;
}




//POTONG KALIMAT
function cutText($text, $length, $mode = 2)
{
	// if ($mode != 1) {
	// 	$char = $text{
	// 		$length - 1};
	// 	switch ($mode) {
	// 		case 2:
	// 			while ($char != ' ') {
	// 				$char = $text{
	// 					--$length};
	// 			}
	// 		case 3:
	// 			while ($char != ' ') {
	// 				$char = $text{
	// 					++$num_char};
	// 			}
	// 	}
	// }
	return substr($text, 0, $length);
}


//COMBO DATABASE
function combo_database($tabel, $field, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
			echo '<option>' . $data["$field"] . '</option>';
		}
	}
}

//COMBO DATABASE
function combo_database_v2($tabel, $id_field, $field, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
?>
			<option value="<?php echo $data["$id_field"]; ?>"> <?php echo $data["$field"]; ?> </option>
		<?php
		}
	}
}


//COMBO DATABASE 2
function combo_database2($tabel, $field1, $field2, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
		?>
			<option value="<?php echo $data["$field1"] ?>"><?php echo $data["$field1"] . " ( " . $data["$field2"] . ")" ?></option>';
		<?php
		}
	}
}

//COMBO DATABASE 3
function combo_database3($tabel, $field1, $field2, $field3, $pembuka_pemisah, $penutup_pemisah, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
		?>
			<option value="<?php echo $data["$field1"] ?>">
				<?php echo $pembuka_pemisah . $data["$field1"] . $penutup_pemisah . $pembuka_pemisah . $data["$field2"] . $penutup_pemisah . $pembuka_pemisah . $data["$field3"] . $penutup_pemisah; ?>
			</option>';
	<?php
		}
	}
}

//COMBO ENUM
function combo_enum($tabel, $field, $query)
{
	global $database;
	$result = mysql_query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$tabel' AND COLUMN_NAME = '$field'")
		or die(mysql_error());

	$row = mysql_fetch_array($result);
	$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));

	foreach ($enumList as $value)
		$selectDropdown .= "<option>$value</option>";
	echo $selectDropdown;
	return $selectDropdown;
}


//CETAK BERDASARKAN
function cetakberdasarkan($tabel, $jenis, $pakaiperperiode)
{ ?>
	<style type="text/css">
		#tampil_modal {
			padding-top: 5em;
			background-color: rgba(0, 0, 0, 0.8);
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			z-index: 10;
			display: block;
		}

		#modal {
			padding: 15px;
			font-size: 16px;
			background: #e74c3c;
			color: #000;
			width: 540px;
			border-radius: 15px;
			margin: 0 auto 20px;
			padding-bottom: 50px;
			z-index: 9;
		}

		#modal_atas {
			width: 540px;
			color: #fff;
			background: #c0392b;
			padding: 15px;
			margin-left: -15px;
			font-size: 18px;
			margin-top: -15px;
			border-top-left-radius: 15px;
			border-top-right-radius: 15px;
		}

		#oke {
			background: #c0392b;
			border: none;
			float: right;
			width: 80px;
			height: 30px;
			color: #fff;
			margin-right: 5px;
			cursor: pointer;
		}
	</style>
	<?php
	$ket = strtoupper($tabel);
	if ($jenis == "xls") {
		$judulcetak = "Export Ms.Excel";
	} elseif ($jenis == "doc") {
		$judulcetak = "Export Ms.Word";
	} else {
		$judulcetak = "Cetak Laporan";
	}
	?>
	<div id="tampil_modal">
		<div id="modal">
			<div id="modal_atas"><?php echo $judulcetak; ?></div>
			<br>
			<form action="cetak.php" method="get">

				<div class="item form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Berdasarkan<span class="required">:</span>
					</label>
					<br>
					<select
						data-style="btn-default"
						class="selectpicker show-tick form-control"
						name="apa"
						data-live-search="true"
						data-size="7">

						<?php

						$sql = "desc $tabel";
						$result = @mysql_query($sql);
						while ($row = @mysql_fetch_array($result)) {
							echo "<option  data-icon='glyphicon glyphicon-search'  data-tokens='berdasarkan' name='apa' value=$row[0]>$row[0]</option>";
						}
						?>

					</select>
					<div class="input-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Pencarian
							<span class="required">:</span>
						</label><br>
						<span class="input-group-addon" id="basic-addon1">
							<i class="fa fa-indent"></i>
						</span>
						<input class="form-control col-md-7 col-xs-12" name="isi" type="text">
					</div>

					<?php if ($pakaiperperiode == "ya") { ?>
						<div class="input-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Dari Tanggal
								<span class="required">:</span>
							</label><br>
							<span class="input-group-addon" id="basic-addon1">
								<i class="fa fa-calendar"></i>
							</span>
							<input
								class="form-control col-md-7 col-xs-12"
								name="periode1"
								placeholder="periode1"
								type="date">
						</div>

						<div class="input-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Sampai Tanggal
								<span class="required">:</span>
							</label><br>
							<span class="input-group-addon" id="basic-addon1">
								<i class="fa fa-calendar"></i>
							</span>
							<input
								class="form-control col-md-7 col-xs-12"
								name="periode2"
								placeholder="periode2"
								type="date">
						</div>
					<?php } ?>
					<input name="jenis" value="<?php echo $jenis; ?>" type="hidden">
					<button type="submit" id="oke">Cetak</button>
					</a>
				</div>
			</form>
			<!-- <a href="index.php"><button id="oke">Batal</button></a> -->
		</div>
	</div>
	<?php }

//HEADER CETAK
function cetakapa($cetakapa)
{
	if ($cetakapa == "xls") {
		header("Content-Type: application/force-download");
		header("Cache-Control: no-cache, must-revalidate");
		header("content-disposition: attachment;filename=laporan_%tabel%_" . date('dmY') . ".xls");
	} elseif ($cetakapa == "doc") {
		header("Content-Type: application/force-download");
		header("Cache-Control: no-cache, must-revalidate");
		header("content-disposition: attachment;filename=laporan_%tabel%_" . date('dmY') . ".doc");
	} elseif ($cetakapa == "pdf") {
		header("Content-Type: application/force-download");
		header("Cache-Control: no-cache, must-revalidate");
		header("content-disposition: attachment;filename=laporan_%tabel%_" . date('dmY') . ".pdf");
	} elseif ($cetakapa == "print") {
	?>
		<script>
			window.print();
		</script>
	<?php
	}
}

//POPUP
function popup($pesan, $judul, $button, $link_oke, $link_back)
{
	?>
	<div class="popup-wrapper" id="popup">
		<div class="popup-container">
			<h1><?php echo $judul; ?></h1>
			<p style="font-size:19px;"><?php echo $pesan; ?></p>
			<a href="<?php echo $link_oke; ?>"><?php btn_ya("OK") ?></a>
			<a class="popup-close" href="<?php echo $link_back; ?>">X</a>
		</div>
	</div>
	<?php
}

//KEYPRESS
function action($proses)
{
	echo "onkeyup='$proses();' onchange='$proses();' onkeyup='$proses();' onkeydown='$proses();' onclick='$proses();'";
}

//TOTAL
function total($tabel, $query)
{
	if ($query == "") {
		$sql = 'SELECT * FROM ' . $tabel;
	} else {
		$sql = $query;
	}
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	echo "$count";
}

//TOTALR
function totalr($tabel, $query)
{
	if ($query == "") {
		$sql = 'SELECT * FROM ' . $tabel;
	} else {
		$sql = $query;
	}
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	return $count;
}

//TANGGAL OTOMATIS
function tanggal_otomatis()
{
	$tanggal = date("Y-m-d");
	echo $tanggal;
}

//FORMAT INDO
function format_indo($value)
{
	if (!$value) return '';

	$bulanIndo = [
		1 => 'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	];
	$date = date_create($value);
	if (!$date) return '';

	$day = $date->format('d');
	$month = (int)$date->format('m');
	$year = $date->format('Y');
	$hasTime = strlen($value) > 10;

	$formatted = $day . ' ' . $bulanIndo[$month] . ' ' . $year;

	if ($hasTime) {
		$time = $date->format('H:i');
		$formatted .= ' ' . $time;
	}

	return $formatted;
}

function readmore($text, $limit = 50)
{
	if (strlen($text) <= $limit) {
		return htmlspecialchars($text);
	}
	$short = substr($text, 0, $limit) . '...';
	$escaped = htmlspecialchars($text, ENT_QUOTES);
	return "<span style='cursor:pointer;' onclick='alert(\"{$escaped}\")'>{$short}</span>";
}


function frame_maps($koordinat, $width = "100%", $height = "60")
{
	if (!$koordinat || strpos($koordinat, ',') === false) return '-';

	$koordinat = trim($koordinat);
	$src = "https://maps.google.com/maps?q={$koordinat}&z=15&output=embed";
	$href = "https://maps.google.com/maps?q={$koordinat}";

	return "<iframe width=\"{$width}\" height=\"{$height}\" frameborder=\"0\" style=\"border:0\" 
            src=\"{$src}\" allowfullscreen></iframe><br><small><a href=\"{$href}\" target=\"_blank\">{$koordinat}</a></small>";
}


//FORMAT RUPIAH
function rupiah($rp)
{

	echo "Rp" . number_format($rp, 0, ",", ".");
}

function rupiah_format($rp)
{

	return number_format($rp, 0, ",", ".");
}

//BACA DATABASE
function baca_database($tabel, $field, $query)
{

	if ($query == "") {
		$sql = 'SELECT * FROM ' . $tabel;
	} else {
		$sql = $query;
	}

	$querytabelualala = $sql;
	$prosesulala = mysql_query($querytabelualala);
	$datahasilpemrosesanquery = mysql_fetch_array($prosesulala);
	$hasiltermantab = $datahasilpemrosesanquery[$field];
	return $hasiltermantab;
}

//CEK DATABASE
function cek_database($tabel, $field, $value, $query)
{
	if ($query == "") {
		$sql = "SELECT * FROM " . $tabel . " WHERE " . $field . " ='" . $value . "'";
	} else {
		$sql = $query;
	}

	$cek_user = mysql_num_rows(mysql_query($sql));
	if ($cek_user > 0) {
		$hasiltermantab = "ada";
	} else {
		$hasiltermantab = "nggak";
	}
	return $hasiltermantab;
}

//BACA SESSION
function baca_session($namasession)
{
	session_save_path($_SERVER['DOCUMENT_ROOT'] . "/../tmp");
	session_id("login");
	if (session_status() == PHP_SESSION_NONE) {
		@session_start();
	}
	$hasiltermantab = $_SESSION[$namasession];
	return $hasiltermantab;
}

//SIMPAN SESSION
function simpan_session($namasession, $apa)
{
	session_save_path($_SERVER['DOCUMENT_ROOT'] . "/../tmp");
	session_id("login");
	if (session_status() == PHP_SESSION_NONE) {
		@session_start();
	}
	$_SESSION[$namasession] = $apa;
}

//CEK SESSION
function cek_session($namasession)
{
	session_save_path($_SERVER['DOCUMENT_ROOT'] . "/../tmp");
	session_id("login");
	if (session_status() == PHP_SESSION_NONE) {
		@session_start();
	}
	if (empty($_SESSION[$namasession])) {
		$hasiltermantab = "nggak";
	} else {
		$hasiltermantab = "ada";
	}
	return $hasiltermantab;
}

//HALAMAN
function halaman()
{
	if (!empty($_GET['halaman'])) {
		$halaman = $_GET['halaman'];
		$cari = 'components/halaman/' . $halaman . '.php';
		if (file_exists($cari)) {
			include 'components/halaman/' . $halaman . '.php';
		} else {
			echo "MAAF HALAMAN TIDAK TERSEDIA.";
		}
	} else {
		//HOME
		include 'components/halaman/home.php';
	}
}

//KEKATA
function kekata($x)
{
	$x = abs($x);
	$angka = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas"
	);
	$temp = "";
	if ($x < 12) {
		$temp = " " . $angka[$x];
	} else if ($x < 20) {
		$temp = kekata($x - 10) . " belas";
	} else if ($x < 100) {
		$temp = kekata($x / 10) . " puluh" . kekata($x % 10);
	} else if ($x < 200) {
		$temp = " seratus" . kekata($x - 100);
	} else if ($x < 1000) {
		$temp = kekata($x / 100) . " ratus" . kekata($x % 100);
	} else if ($x < 2000) {
		$temp = " seribu" . kekata($x - 1000);
	} else if ($x < 1000000) {
		$temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
	} else if ($x < 1000000000) {
		$temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
	} else if ($x < 1000000000000) {
		$temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
	} else if ($x < 1000000000000000) {
		$temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
	}
	return $temp;
}

//TERBILANG
function terbilang($x)
{
	if ($x < 0) {
		$hasil = "minus " . trim(kekata($x));
	} else {
		$hasil = trim(kekata($x));
	}

	$hasil = ucwords($hasil);
	return $hasil;
}

//TMP
function temp()
{

	if (isset($_GET['s'])) {
		$tmp = $_GET['s'];
		$xml = simplexml_load_file("../../../include/settings/settings.xml");
		$sxe = new SimpleXMLElement($xml->asXML());
		$rows = count($sxe);
		for ($i = 0, $length = $rows; $i < $length; $i++) {
			if ($sxe->users[$i]->id == "1") {
				$sxe->users[$i]->tmp =  ($tmp);
			}
		}
		$sxe->asXML("../../../include/settings/settings.xml");
	?>
		<script>
			location.href = "index.php?tmp=x";
		</script>
	<?php
	}	 ?>
	<form action="index.php" method="get">
		<center>
			<h1>SETTING TEMA</h1>
			<?php
			$xml = simplexml_load_file("../../../include/settings/settings.xml");
			$sxe = new SimpleXMLElement($xml->asXML());
			$rows = count($sxe);
			for ($i = 0; $i < $rows; $i++)
				if ($sxe->users[$i]->id == '1') {
					$tmp =  ($sxe->users[$i]->tmp);
					$v =  ($sxe->users[$i]->v);
				}
			?>

			<font color="green">

				<H3>VERSI : <?php echo $v; ?></H3>
				<br>
			</font>
			<font color="red">
				Tema Terpilih :
				<?php echo $tmp; ?></font>
			<br>
			<br>
			Change Template :
			<select name="s">
				<option value="<?php echo $tmp; ?>"><?php echo $tmp; ?></option>
				<option value="<?php echo $tmp; ?>">----------------</option>
				<?php
				$dir = opendir('../../../data/tmp/');
				while ($file = readdir($dir)) {
					if ($file == '.' || $file == '..') {
						continue;
					}
				?>

					<option><?php echo $file; ?></option>
				<?php
				}
				closedir($dir);
				?>

			</select>
			<button class="btn btn-success" href="index.php?tmp=x">Simpan</button>
			<a class="btn btn-danger" href="index.php">Batal</a>
			<a class="btn btn-warning" href="index.php?tmp_f=x">Setting Front End</a>
			<input type="hidden" value="x" name="tmp">

			<br>
			<br>

			<div class="col-12">
				<?php



				$dir1 = opendir('../../../data/tmp/');

				while ($file1 = readdir($dir1)) {

					if ($file1 == '.' || $file1 == '..') {
						continue;
					}
				?>
					<div class="col-md-4">

						<a href="index.php?tmp=x&s=<?php echo $file1; ?>">

							<?php
							if (file_exists("../../../data/tmp/" . $file1 . "/menuutama.jpg")) {
							?>
								<img src="../../../data/tmp/<?php echo $file1; ?>/menuutama.jpg" width="300" height="200">
							<?php
							} else {
							?>
								<img src="../../../data/tmp/<?php echo $file1; ?>/menuutama.png" width="300" height="200">
							<?php
							}
							?>

							<center><?php echo $file1; ?>

								<?php
								if (file_exists("../../../data/tmp/" . $file1 . "/login.php")) {
									echo "+login";
								}
								?>
							</center>
						</a>
					</div>
				<?php
				}
				closedir($dir);
				?>
			</div>
	</form><?php
		}
		//TMP_F
		function tmp_f()
		{
			if (isset($_GET['s'])) {
				$tmp1 = $_GET['s'];
				$xml1 = simplexml_load_file("../../../../home/include/settings/settings.xml");
				$sxe1 = new SimpleXMLElement($xml1->asXML());
				$rows1 = count($sxe1);
				for ($i = 0, $length1 = $rows1; $i < $length1; $i++) {
					if ($sxe1->users[$i]->id == "1") {
						$sxe1->users[$i]->tmp =  ($tmp1);
					}
				}
				$sxe1->asXML("../../../../home/include/settings/settings.xml");
			?>
		<script>
			location.href = "index.php?tmp_f=x";
		</script>
	<?php
			}
	?>
	<form action="index.php" method="get">
		<center>
			<h1>SETTING TEMA</h1>
			<?php
			$xml = simplexml_load_file("../../../../home/include/settings/settings.xml");
			$sxe = new SimpleXMLElement($xml->asXML());
			$rows = count($sxe);
			for ($i = 0; $i < $rows; $i++)
				if ($sxe->users[$i]->id == '1') {
					$tmp =  ($sxe->users[$i]->tmp);
					$v =  ($sxe->users[$i]->v);
				}
			?>
			<font color="green">
				<H3>VERSI : <?php echo $v; ?></H3>
				<br>
			</font>
			<font color="red">
				Tema Terpilih :
				<?php echo $tmp; ?></font>
			<br>
			<br>
			Change Template :
			<select name="s">
				<option value="<?php echo $tmp; ?>"><?php echo $tmp; ?></option>
				<option value="<?php echo $tmp; ?>">----------------</option>
				<?php
				$dir = opendir('../../../../home/data/tmp/');
				while ($file = readdir($dir)) {
					if ($file == '.' || $file == '..') {
						continue;
					}
				?>

					<option><?php echo $file; ?></option>
				<?php
				}
				closedir($dir);
				?>

			</select>
			<button class="btn btn-success" href="index.php?tmp_f=x">Simpan</button>
			<a class="btn btn-danger" href="index.php">Batal</a>
			<a class="btn btn-primary" href="index.php?tmp=x">Setting Back End</a>
			<a target="_blank" class="btn btn-info" href="../../../../">Lihat Halaman Front End</a>
			<input type="hidden" value="x" name="tmp_f">

			<br>
			<br>

			<div class="col-12">
				<?php



				$dir1 = opendir('../../../../home/data/tmp/');

				while ($file1 = readdir($dir1)) {

					if ($file1 == '.' || $file1 == '..') {
						continue;
					}
				?>
					<div class="col-md-4">

						<a href="index.php?tmp_f=x&s=<?php echo $file1; ?>">

							<?php
							if (file_exists("../../../../home/data/tmp/" . $file1 . "/home.jpg")) {
							?>
								<img src="../../../../home/data/tmp/<?php echo $file1; ?>/home.jpg" width="300" height="200">
							<?php
							} else {
							?>
								<img src="../../../../home/data/tmp/<?php echo $file1; ?>/home.png" width="300" height="200">
							<?php
							}
							?>

							<center><?php echo $file1; ?>

								<?php
								if (file_exists("../../../../home/data/tmp/" . $file1 . "/login.php")) {
									echo "+login";
								}
								?>
							</center>
						</a>
					</div>
				<?php
				}
				closedir($dir);
				?>
			</div>
	</form>
<?php
		}

		//ACTION CETAK
		function action_cetak($tabel)
		{
?>

	<form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
		<fieldset>
			<table>
				<tbody>
					<tr>
						<td><b>CETAK KESELURUHAN</b></td>

						<td></td>
					</tr>


					<tr>
						<td style="width:40%"></td>

						<td>
							<?php btn_preview_laporan('Print Preview'); ?>

							<?php
							if ($tabel == 'data_pelanggan') {
								btn_export_laporan('Export Excel');
							} ?>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>
	<br>
	<form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
		<fieldset>
			<table>
				<tbody>
					<tr>
						<td><b>CETAK DENGAN FILTER</b></td>

						<td>
						</td>
					</tr>

					<tr>
						<td style="width:40%">Berdasarkan :</td>

						<td>
							<select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
								<?php
								$sql = "desc $tabel";
								$result = @mysql_query($sql);
								while ($row = @mysql_fetch_array($result)) {
									echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
								}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td style="width:40%">Pencarian :</td>

						<td>
							<input class="form-control" type="text" name="isi" value="">
						</td>
					</tr>

					<tr>
						<td></td>

						<td>
							<?php btn_preview_laporan('Print Preview'); ?>
							<!-- <?php btn_cetak_laporan('Print'); ?> -->
							<?php
							if ($tabel == 'data_pelanggan') {
								btn_export_laporan('Export Excel');
							} ?>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>
	<br>
	<?php
			$ada = 0;
			$sql = "desc $tabel";
			$result = @mysql_query($sql);
			while ($row = @mysql_fetch_array($result)) {
				$typedata = $row[1];

				$kalimat = $typedata;
				if (preg_match("/date/i", $kalimat)) {

					$ada = $ada + 1;
				} else {
				}
			}

			if ($ada > 0) {
	?>

		<form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
			<fieldset>
				<table>
					<tbody>
						<tr>
							<td><b>CETAK PERPERIODE</b></td>

							<td></td>
						</tr>
						<tr>
							<td style="width:40%">Berdasarkan :</td>

							<td>
								<select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
									<?php
									$sql = "desc $tabel";
									$result = @mysql_query($sql);
									while ($row = @mysql_fetch_array($result)) {
										$typedata = $row[1];

										$kalimat = $typedata;
										if (preg_match("/date/i", $kalimat)) {

											echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>


						<tr>
							<td style="width:40%">Dari Tanggal :</b></td>

							<td><input type="date" name="tanggal1"></td>
						</tr>

						<tr>
							<td style="width:40%">Sampai Tanggal :</b></td>

							<td><input type="date" name="tanggal2"></td>
						</tr>


						<tr>
							<td></td>

							<td>
								<?php btn_preview_laporan('Print Preview'); ?>
								<!-- <?php btn_cetak_laporan('Print'); ?> -->
								<?php
								if ($tabel == 'data_pelanggan') {
									btn_export_laporan('Export Excel');
								} ?>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>


	<?php
			}
		}
		//PROSES ACTION CETAK
		function proses_action_cetak($tabel)
		{

			$status = "";
			if (isset($_GET['preview'])) {
				$status = "preview";
			} else if (isset($_GET['cetak'])) {
				$status = "cetak";
	?>
		<script>
			window.print();
		</script>
	<?php
			} else if (isset($_GET['export'])) {


				$status = "export";
				header("Content-Type: application/force-download");
				header("Cache-Control: no-cache, must-revalidate");
				header("content-disposition: attachment;filename=laporan_$tabel" . date('dmY') . ".xls");
			} else {
				include '../../../include/function/session.php';
			}
		}

		//XSS
		function xss($val)
		{
			$val = htmlentities($val);
			$val = strip_tags($val);
			$val = filter_var($val, FILTER_SANITIZE_STRING);
			return $val;
		}

		//UPLOAD
		function upload($namafile)
		{
			$time = time();
			$acak = rand(10000, 99999);
			$foto = $time . "-" . $acak . "-" . $_FILES[$namafile]['name'];
			$tmp_file = $_FILES[$namafile]['tmp_name'];
			$path = "../../../upload/" . $foto;
			global $ekstensi_dilarang;
			$nama = $_FILES[$namafile]['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			if (in_array($ekstensi, $ekstensi_dilarang) === false) {
				move_uploaded_file($tmp_file, $path);
				return $foto;
			} else {
	?>
		<script>
			alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");
			window.history.back();
		</script>
	<?php
				die();
			}
		}

		//UPLOAD HOME
		function upload_home($namafile)
		{
			$time = time();
			$acak = rand(10000, 99999);
			$foto = $time . "-" . $acak . "-" . $_FILES[$namafile]['name'];
			$tmp_file = $_FILES[$namafile]['tmp_name'];
			$path = "admin/upload/" . $foto;
			global $ekstensi_dilarang;
			$nama = $_FILES[$namafile]['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			if (in_array($ekstensi, $ekstensi_dilarang) === false) {
				move_uploaded_file($tmp_file, $path);
				return $foto;
			} else {
	?>
		<script>
			alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");
			window.history.back();
		</script>
	<?php
				die();
			}
		}

		//UPLOAD ADMIN
		function upload_admin($namafile)
		{
			$time = time();
			$acak = rand(10000, 99999);
			$foto = $time . "-" . $acak . "-" . $_FILES[$namafile]['name'];
			$tmp_file = $_FILES[$namafile]['tmp_name'];
			$path = "../../../../admin/upload/" . $foto;
			global $ekstensi_dilarang;
			$nama = $_FILES[$namafile]['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			if (in_array($ekstensi, $ekstensi_dilarang) === false) {
				move_uploaded_file($tmp_file, $path);
				return $foto;
			} else {
	?>
		<script>
			alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");
			window.history.back();
		</script>
<?php
				die();
			}
		}

		//KODE OTOMATIS	 	
		function id_otomatis($nama_tabel, $id_nama_tabel, $panjang_id)
		{
			$cek = mysql_query("SELECT * FROM $nama_tabel");
			$rowcek = mysql_num_rows($cek);


			$kodedepan = strtoupper($nama_tabel);
			$kodedepan = str_replace("DATA_", "", $kodedepan);
			$kodedepan = str_replace("DATA", "", $kodedepan);
			$kodedepan = str_replace("TABEL_", "", $kodedepan);
			$kodedepan = str_replace("TABEL", "", $kodedepan);
			$kodedepan = str_replace("TABLE_", "", $kodedepan);
			$kodedepan = strtoupper(substr($kodedepan, 0, 3));
			$id_tabel_otomatis = $kodedepan . date('YmdHis');
			$min = pow($panjang_id, 3 - 1);
			$max = pow($panjang_id, 3) - 1;

			$kodeakhir = mt_rand($min, $max);
			return $id_tabel_otomatis . $kodeakhir;
		}


		//JUMLAHKAN DATABASE
		function jumlahkan_database($tabel, $total, $query)
		{
			$sql = $query;
			$querytabelualala = $sql;
			$prosesulala = mysql_query($querytabelualala);
			$datahasilpemrosesanquery = mysql_fetch_array($prosesulala);
			$hasiltermantab = $datahasilpemrosesanquery[$total];
			return $hasiltermantab;
		}

		//FORMAT HIJRIAH
		class HijriCalendar
		{
			function monthName($i)
			{
				static $month  = array(
					"Muharram",
					" Syafar",
					"Rabiul Awal",
					" Rabiul Akhir",
					"Jumadil Awal",
					" Jumadil Akhir",
					"Rajab",
					"Sya'ban",
					"Ramadhan",
					"Syawal",
					"Dzulka'dah",
					"Dzulhijjah"
				);
				return $month[$i - 1];
			}

			function GregorianToHijri($t)
			{
				$pecahkan = explode('-', $t);

				$m = $pecahkan[1];
				$d = $pecahkan[2];
				$y = $pecahkan[0];

				return HijriCalendar::JDToHijri(
					cal_to_jd(CAL_GREGORIAN, $m, $d, $y)
				);
			}
			function HijriToGregorian($m, $d, $y)
			{
				return jd_to_cal(
					CAL_GREGORIAN,
					HijriCalendar::HijriToJD($m, $d, $y)
				);
			}
			function JDToHijri($jd)
			{
				$jd = $jd - 1948440 + 10632;
				$n  = (int)(($jd - 1) / 10631);
				$jd = $jd - 10631 * $n + 354;
				$j  = ((int)((10985 - $jd) / 5316)) *
					((int)(50 * $jd / 17719)) +
					((int)($jd / 5670)) *
					((int)(43 * $jd / 15238));
				$jd = $jd - ((int)((30 - $j) / 15)) *
					((int)((17719 * $j) / 50)) -
					((int)($j / 16)) *
					((int)((15238 * $j) / 43)) + 29;
				$m  = (int)(24 * $jd / 709);
				$d  = $jd - (int)(709 * $m / 24);
				$y  = 30 * $n + $j - 30;

				return array($m, $d, $y);
			}
			function HijriToJD($m, $d, $y)
			{
				return (int)((11 * $y + 3) / 30) +
					354 * $y + 30 * $m -
					(int)(($m - 1) / 2) + $d + 1948440 - 385;
			}
		};
		function format_hijriah($t)
		{
			$hijri = HijriCalendar::GregorianToHijri($t);
			return $hijri[1] . ' ' . HijriCalendar::monthName($hijri[0]) . ' ' . $hijri[2];
		}

		function selisih_waktu($kategori, $tanggal1, $tanggal2)
		{

			$awal  = date_create($tanggal1);
			$akhir = date_create($tanggal2);
			$diff  = date_diff($awal, $akhir);

			if ($kategori == "tanggal") {
				return $diff->d;
			} else if ($kategori == "bulan") {
				return $diff->m;
			} else if ($kategori == "tahun") {
				return $diff->y;
			} else if ($kategori == "jam") {
				return $diff->h;
			} else if ($kategori == "menit") {
				return $diff->i;
			} else if ($kategori == "detik") {
				return $diff->s;
			}
		}

		function penambahan_waktu($kategori, $penambahanwaktu, $tanggal)
		{
			if ($kategori == "tanggal") {
				return date('Y-m-d', strtotime('+' . $penambahanwaktu . ' days', strtotime($tanggal)));
			} else if ($kategori == "bulan") {
				return date('Y-m-d', strtotime('+' . $penambahanwaktu . ' month', strtotime($tanggal)));
			} else if ($kategori == "tahun") {
				return date('Y-m-d', strtotime('+' . $penambahanwaktu . ' year', strtotime($tanggal)));
			}
		}

		function usia($tanggal)
		{
			$diff  = date_diff(date_create($tanggal), date_create());
			return  $diff->format('%Y tahun %d hari');
		}

		function kolom($tabel, $buka, $isi, $tutup)
		{
			return $buka . $isi . $tutup;
		}

		function pengaturan_aplikasi($nama_pengaturan)
		{
			return baca_database("", "value", "select * from data_pengaturan_aplikasi where nama_pengaturan='$nama_pengaturan'");
		}

		function pengaturan_printer($kolom, $id_hotel)
		{
			return baca_database("", $kolom, "select * from data_pengaturan_printer where id_hotel='$id_hotel'");
		}
?>


<?php
function detail_transaksi($id_transaksi)
{


	$id_transaksi = (mysql_real_escape_string($id_transaksi));

	$sql = mysql_query("SELECT dt.*,dp.nama, dk.no_kamar 
                        FROM data_transaksi dt
                        JOIN data_pelanggan dp ON dt.id_pelanggan = dp.id_pelanggan
                        JOIN data_kamar dk ON dt.id_kamar = dk.id_kamar
                        WHERE dt.id_transaksi='$id_transaksi'");
	$data = mysql_fetch_array($sql);

	if (!$data) {
		echo "<script>alert('Data transaksi tidak ditemukan');history.back();</script>";
		die();
	}

	// Hitung harga sesuai jenis transaksi
	$harga_per_hari = $data['harga_kamar_harian'];
	$jumlah_hari = $data['jumlah_hari'];
	$harga_kamar_total = ($data['jenis_transaksi'] == 'bulanan')
		? $data['harga_kamar_bulanan'] * ($jumlah_hari / 30)
		: $harga_per_hari * $jumlah_hari;

	// Diskon hanya untuk harga kamar
	$disc_nominal = ($harga_kamar_total * $data['discount']) / 100;
	$harga_setelah_disc = $harga_kamar_total - $disc_nominal;

	// Tambahan dan potongan
	$tambahan_in = $data['biaya_tambahan_checkin'];
	$tambahan_out = $data['biaya_tambahan_checkout'];
	$potongan_harga = $data['potongan_harga'];
	$metode_pembayaran = $data['metode_pembayaran'];
	$no_rekening = $data['no_rekening'];

	// Subtotal, pajak, total
	$sub_total = $harga_setelah_disc + $tambahan_in + $tambahan_out - $potongan_harga;
	$pajak = ($sub_total * $data['persentase_pajak']) / 100;
	$total_bayar = $sub_total + $pajak;
	$id_hotel  = $data['id_hotel'];

	//durasi counter hanya untuk memunculkan tombol hanya 5 jam saja dari waktu checkin
	$waktu_checkin = strtotime($data['waktu_checkin'] . ' ' . $data['jam_checkin']);
	$now = strtotime(date('Y-m-d H:i:s'));
	$selisih = $now - $waktu_checkin;
	//deposit
	$nominal_deposit = $data['nominal_deposit'];
	if ($nominal_deposit !== null && $nominal_deposit > 0) {
		$status_deposit = "Iya";
	} else {
		$status_deposit = "Tidak";
	}
	// konversi ke jam (dibulatkan ke bawah)
	$jam = floor($selisih / 3600);

?>
	<div class="card shadow-sm mb-3" style="max-width:900px;margin:auto;">
		<div class="card-body">


			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">ID Transaksi</div>
				<div class="col-md-8"><?= ucwords($data['id_transaksi']); ?></div>
			</div>
			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Nama Pelanggan</div>
				<div class="col-md-8"><?= ucwords($data['nama']); ?></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Kamar</div>
				<div class="col-md-8"><?= $data['no_kamar']; ?></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Check In</div>
				<div class="col-md-8"><?= format_indo($data['waktu_checkin']); ?></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Check Out</div>
				<div class="col-md-8"><?php

										$today = strtotime(date('Y-m-d'));
										$checkout = strtotime($data['waktu_checkout']);
										$hari_tersisa = ($checkout - $today) / (60 * 60 * 24);

										if ($hari_tersisa > 0) {
											$hari_tersisa = ceil($hari_tersisa);
											if ($data['status_transaksi'] == 'Selesai') {
												echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
											} else {
												echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']))
													. "<b style='color:red'>&nbsp;{$hari_tersisa}&nbsp;hari&nbsp;lagi</b>";
											}
										} elseif ($hari_tersisa == 0) {
											// Hari ini
											echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']))
												. "<b style='color:green'>&nbsp;Hari ini</b>";
										} else {
											// Lewat
											echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
										}




										?></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Jumlah Hari</div>
				<div class="col-md-8"><?= $jumlah_hari ?> Hari</div>
			</div>

			<hr>
			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Pakai Deposit</div>
				<div class="col-md-8"><strong class="<?= $status_deposit == "Iya" ? "text-success" : "text-danger" ?>"><?= $status_deposit; ?></strong></div>
			</div>
			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Nominal Deposit</div>
				<div class="col-md-8"><strong class="text-dark"><?= rupiah($nominal_deposit); ?></strong></div>
			</div>
			<hr>
			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Harga Kamar/Hari</div>
				<div class="col-md-8"><?= rupiah($harga_per_hari); ?></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Harga Kamar Total</div>
				<div class="col-md-8"><?= rupiah($harga_kamar_total); ?></div>
			</div>


			<?php if ($data['discount']  == 0) {
			?>
				<div class="row mb-2">
					<div class="col-md-4 font-weight-bold">Diskon (0%)</div>
					<div class="col-md-8">Rp0</span></div>
				</div>
			<?php
			} else {
			?>

				<div class="row mb-2">
					<div class="col-md-4 font-weight-bold">Diskon (<?= $data['discount']; ?>%)</div>
					<div class="col-md-8"><?= rupiah($disc_nominal); ?> → <span class="text-success"><?= rupiah($harga_setelah_disc); ?></span></div>
				</div>
			<?php

			}
			?>


			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Tambahan In</div>
				<div class="col-md-8">
					<?= rupiah($tambahan_in); ?>
					<?php if (!empty($data['deskripsi']) && $tambahan_in > 0) : ?>
						<small class="text-danger">(<?= $data['deskripsi']; ?>)</small>
					<?php endif; ?>
				</div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Tambahan Out</div>
				<div class="col-md-8">
					<?= rupiah($tambahan_out); ?>
					<?php if (!empty($data['deskripsi_out']) && $tambahan_out > 0) : ?>
						<small class="text-danger">(<?= $data['deskripsi_out']; ?>)</small>
					<?php endif; ?>
				</div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Potongan Harga</div>
				<div class="col-md-8"><?= rupiah($potongan_harga); ?></div>
			</div>

			<hr>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Subtotal</div>
				<div class="col-md-8"><?= rupiah($sub_total); ?></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Pajak (<?= $data['persentase_pajak']; ?>%)</div>
				<div class="col-md-8"><?= rupiah($pajak); ?></div>
			</div>


			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Total Bayar</div>
				<div class="col-md-8"><strong class="text-danger"><?= rupiah($total_bayar); ?></strong></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Metode Pembayaran</div>
				<div class="col-md-8"><strong><?= ($metode_pembayaran); ?></strong></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Nomor Rekeing</div>
				<div class="col-md-8"><strong> <?= ($no_rekening); ?></strong></div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 font-weight-bold">Status Transaksi</div>
				<div class="col-md-8">
					<span class="badge badge-<?php echo ($data['status_transaksi'] == 'Lunas') ? 'success' : 'warning'; ?>">
						<?= $data['status_transaksi']; ?>
					</span>
				</div>
			</div>
			<?php
			$jam_default = baca_database("", "value", "select * from data_pengaturan_aplikasi where nama_pengaturan='jam_batal_transaksi'");
			if ($jam < $jam_default && $data['status_transaksi'] !== 'Selesai') {
			?>
				<p class="text-start text-danger">
					<span style='font-weight:700'>Information!:</span> Fitur hapus transaksi hanya dapat digunakan <?= $jam_default ?> jam dari waktu checkin.
				</p>
			<?php
			} ?>


		</div>
	</div>

	<?php if (isset($_COOKIE['id_hotel']) && $id_hotel == decrypt($_COOKIE['id_hotel'])) { ?>
		<?php if ($data['status_transaksi'] == "Selesai") {
		} else {

			if (pengaturan_printer("ukuran_kertas", $id_hotel) == "A4") {
		?>
				<button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/notaA4.php?id_trx=<?php echo $id_transaksi; ?>&status=checkin'">Cetak Ulang Nota</button>
			<?php
			} else {
			?>
				<button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/cetak_nota.php?id_trx=<?php echo $id_transaksi; ?>'">Cetak Ulang Nota</button>
			<?php
			}



			?>



			<button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/index.php?input=tampil&id=<?php echo $data['id_kamar'] ?>&trx=<?php echo encrypt($data['id_transaksi']) ?>'">Check Out</button>



			<?php
		}
	} elseif (isset($_COOKIE['operasional'])) {
		echo "";
	} else {
		if ($data['status_transaksi'] == "Selesai") {
		} else {

			if (pengaturan_printer("ukuran_kertas", $id_hotel) == "A4") {
			?>
				<button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/notaA4.php?id_trx=<?php echo $id_transaksi; ?>&status=checkin'">Cetak Ulang Nota</button>
			<?php
			} else {
			?>
				<button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/cetak_nota.php?id_trx=<?php echo $id_transaksi; ?>'">Cetak Ulang Nota</button>
			<?php
			}



			?>



			<button class="btn btn-light-danger btn-sm" onclick="window.location.href='../checkout/index.php?input=tampil&id=<?php echo $data['id_kamar'] ?>&trx=<?php echo encrypt($data['id_transaksi']) ?>'">Check Out</button>



	<?php
		}
	} ?>

	<?php

	if ($jam <= $jam_default && $data['status_transaksi'] == 'Lunas') {
		$jenenge = decrypt($_COOKIE['jenenge']);

		$id_admin = baca_database("", "id_admin", "select * from data_admin where username='$jenenge'");
		if ($id_admin == null) {
			$id_admin = baca_database("", "id_pengelola", "select * from data_pengelola where username='$jenenge'");
		}
	?>
		<button class="btn btn-light-danger btn-sm" onclick="window.location.href='../data_transaksi/index.php?input=hapus&proses=<?php echo encrypt($data['id_transaksi']) ?>&admin=<?= $id_admin ?>'"> Hapus Transaksi</button>
<?php
	}
}
?>


<?php

function simpan_riwayat($nama_tabel, $nama_kolom, $id_kolom, $proses_query, $admin)
{
	// Buat ID unik dan waktu sekarang
	$id_riwayat = uniqid('riwayat_');
	$waktu = date('Y-m-d H:i:s');
	$data_json = 'NULL';

	// Ambil ID admin dari cookie
	$id_admin = isset($_COOKIE['id_admin']) ? mysql_real_escape_string($_COOKIE['id_admin']) : $admin;
	$id_hotel = isset($_COOKIE['id_hotel']) ? baca_database("", "id_hotel", "select * from data_admin where id_admin='$id_admin'") : '-';

	// Escape proses_query
	$proses_query = mysql_real_escape_string($proses_query);

	// Deteksi action dari query
	$action = 'UNKNOWN';
	$query_lower = strtolower(trim($proses_query));

	if (strpos($query_lower, 'insert') === 0) {
		$action = 'INSERT';
	} elseif (strpos($query_lower, 'update') === 0) {
		$action = 'UPDATE';
	} elseif (strpos($query_lower, 'delete') === 0) {
		$action = 'DELETE';
	}

	// Ambil data sebelum perubahan untuk UPDATE atau DELETE
	$sql_data = "SELECT * FROM `$nama_tabel` WHERE `$nama_kolom` = '$id_kolom'";
	$result = mysql_query($sql_data);

	if ($result && mysql_num_rows($result) > 0) {
		$data = mysql_fetch_assoc($result);
		$json_data = json_encode($data);
		if ($json_data !== false) {
			$data_json = "'" . mysql_real_escape_string($json_data) . "'";
		} else {
			// Log JSON encoding error
			error_log("JSON encoding failed for table $nama_tabel, column $nama_kolom, id $id_kolom");
			$data_json = 'NULL';
		}
	}

	// Simpan ke tabel data_riwayat_admin
	if (isset($_COOKIE['id_hotel'])) {
		$sql_insert = "INSERT INTO data_riwayat_admin 
        (id_riwayat_admin, waktu, action, nama_tabel, id_hotel, nama_kolom, id_kolom, data_json, proses_query, id_admin)
        VALUES 
        ('$id_riwayat', '$waktu', '$action', '$nama_tabel', '$id_hotel', '$nama_kolom', '$id_kolom', $data_json, '$proses_query', '$id_admin')";
	} else {
		$sql_insert = "INSERT INTO data_riwayat_superadmin 
        (id_riwayat_admin, waktu, action, nama_tabel, id_hotel, nama_kolom, id_kolom, data_json, proses_query, id_admin)
        VALUES 
        ('$id_riwayat', '$waktu', '$action', '$nama_tabel', '$id_hotel', '$nama_kolom', '$id_kolom', $data_json, '$proses_query', '$id_admin')";
	}
	mysql_query($sql_insert) or die("Gagal simpan riwayat: " . mysql_error());
}




function json_check($str)
{
	$data = json_decode($str, true);
	return (json_last_error() === JSON_ERROR_NONE && is_array($data));
}

function json_sum($str)
{
	if (!json_check($str)) return $str;
	$data = json_decode($str, true);
	return array_sum($data);
}

function json_count($str)
{
	if (!json_check($str)) return $str;
	$data = json_decode($str, true);
	return count($data);
}

function json_preview($str)
{
	if (!json_check($str)) return $str;
	$data = json_decode($str, true);
	return implode(",", $data);
}


function json_preview_br($str)
{
	if (!json_check($str)) return $str;
	$data = json_decode($str, true);
	return implode("<br>", $data);
}

function json_preview_rupiah($str)
{
	if (!json_check($str)) return $str;
	$data = json_decode($str, true);

	$formatted = array_map(function ($num) {
		return number_format($num, 0, ",", ".");
	}, $data);

	return implode(",", $formatted);
}

function json_preview_rupiah_br($str)
{
	if (!json_check($str)) return "Rp" . number_format($str, 0, ",", ".");;
	$data = json_decode($str, true);

	$formatted = array_map(function ($num) {
		return "Rp" . number_format($num, 0, ",", ".");
	}, $data);

	return implode("<br>", $formatted);
}


function json_count_sum($str, $kali)
{
	if (!json_check($str)) return $str;
	$data = json_decode($str, true);

	$total = 0;
	foreach ($data as $num) {
		$total += ($num * $kali);
	}

	return $total;
}


?>