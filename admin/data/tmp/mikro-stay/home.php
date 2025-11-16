	<?php
	$color_type = "danger";
	include 'loader.php';
	?>
	<style>
		.bg-danger {
			--bs-bg-rgb-color: var(--bs-danger-rgb);
			background-color: #f6f7f9 !important;
		}
	</style>

	<div class="row mx-5">

		<!-- ===================== -->
		<!-- NAVBAR (DESKTOP ONLY) -->
		<!-- ===================== -->
		<nav class="navbar navbar-expand-lg navbar-light d-none d-lg-block" style="padding: 20px; margin-top: -35px;">
			<div class="container-fluid my-3" style="box-shadow: 0 4px 8px rgb(47 47 47 / 30%); border-radius: 10px; height: 53px; padding-top: 7px; background-color: #ffffff; overflow-x:scroll">

				<div class="collapse navbar-collapse" id="navbarNav">

					<style>
						.category-container {
							max-width: 82%;
							overflow-x: auto;
							-webkit-overflow-scrolling: touch;
						}

						.btn-group {
							display: flex;
							gap: 5px;
							white-space: nowrap;
							border-radius: 0.85rem;
						}

						.btn-dangers {
							background-color: #808080;
							color: #ffffff;
						}
					</style>

					<div class="btn-group">
						<?php
						$idhotel_cookie = decrypt($_COOKIE['id_hotel']);

						if ($_COOKIE['id_hotel'] == "") {
							$idhotel_cookie = pengaturan_aplikasi("default_hotel");
						}

						$idhotel_aktif = isset($_GET['hotel']) ? decrypt($_GET['hotel']) : $idhotel_cookie;

						// Atur urutan: yang sama dengan COOKIE muncul di atas
						$queryHotel = mysql_query("SELECT * FROM data_hotel ORDER BY id_hotel = '$idhotel_cookie' DESC, id_hotel ASC");

						while ($data = mysql_fetch_array($queryHotel)) {
							$isActive = ($data['id_hotel'] == $idhotel_aktif);
							$textClass = $isActive ? "btn btn-secondary btn-sm" : "btn btn-light btn-sm";
							$icon = $isActive ? "fas fa-bed text-black" : "";
						?>
							<button onclick="window.location.href='index.php?hotel=<?php echo encrypt($data['id_hotel']) ?>';" class="<?php echo $textClass ?>">
								<i class="<?php echo $icon ?>"></i> <?php echo $data['nama'] ?>
							</button>
						<?php } ?>
					</div>

				</div>
			</div>
		</nav>



	</div>




	<div class="app-main flex-column flex-row-fluid " id="kt_app_main">

		<div class="d-flex flex-column flex-column-fluid">
			<div id="kt_app_content" class="app-content  flex-column-fluid ">
				<div id="kt_app_content_container" class="app-container  container-xxl ">
					<div class="d-flex flex-column flex-xl-row">
						<div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
							<div class="card card-flush card-p-0 bg-transparent border-0 ">
								<div class="card-body">
									<div id="app" class="tab-content">
										<div id="app">
											<div>
												<div id="kt_pos_food_content_1" class="tab-pane fade show active">
													<div class="d-flex flex-wrap d-grid gap-5 gap-xxl-9">

														<?php

														if (isset($_GET['hotel'])) {
															$idhotel = decrypt($_GET['hotel']);

															$queryKamar = mysql_query("SELECT * FROM data_kamar WHERE id_hotel = '$idhotel' ");
															while ($dataKamar = mysql_fetch_array($queryKamar)) {
																if ($dataKamar['status_kamar'] == 'Kosong') {
														?>
																	<div class="card card-flush flex-row-fluid p-8 pb-5 mw-100 card" style="--bs-card-box-shadow: 0px 0px 20px 0px rgb(72 85 127 / 55%); cursor: pointer; background-position: right top; background-size: 30%; background-repeat: no-repeat; background-image: url(&quot;../../../upload/1747180187-26415-1698105518-17748-abstract-1.svg&quot;); visibility: visible;">
																		<div class="card-body text-center" style="width: 150px; position: relative; color: rgb(255, 255, 255);">
																			<div class="mb-2">
																				<div class="text-left">
																					<span onclick="window.location.href='../data_booking/index.php?input=tambah&id_kamar=<?php echo $dataKamar['id_kamar'] ?>'" class="fw-bold text-gray-800 cursor-pointer text-hover-<?php echo $color_type; ?> fs-3 fs-xl-1" style="text-align: left;"> Kamar <?php echo $dataKamar['no_kamar'] ?></span>
																					<span class="<?php echo $dataKamar['status_kamar'] == 'Kosong' ? 'text-gray-600' : 'text-blank' ?> fw-semibold d-block fs-6 mt-n1" style="text-align: left;">
																						<p></p>
																						<?php echo ucwords(baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$dataKamar[id_tipe_kamar]'")); ?> <br>
																						<i class='fas fa-sign-in-alt text-grey'></i> Check In: -
																						<br>
																						<i class='fas fa-sign-out-alt text-grey'></i> Check Out: -

																						<br>
																						<?php echo rupiah($dataKamar['harga_harian']) ?> <b style="font-size: 9px;"></b> <b style="font-size: 9px;"></b>/Days
																						<br>

																						<p style='color:#000000'><b><br>Total: Rp 0</b></p>
																						<?php
																						if (decrypt($_COOKIE['id_hotel']) === $idhotel) {
																						?>
																							<p></p> <button class="btn btn-light btn-sm" onclick="window.location.href='../data_transaksi/index.php?input=tambah&id=<?php echo $dataKamar['id_kamar'] ?>'">Check In</button> <!---->
																						<?php
																						} else { ?>
																							<p></p> <button class="btn btn-light btn-sm">Ready</button>
																						<?php
																						} ?>
																					</span>
																				</div>
																			</div>
																			<span class="text-<?php echo $color_type; ?> text-end fw-bold fs-1"></span>
																		</div>
																	</div>
																<?php
																} else {


																	$queryTransaksi = mysql_query("select * from data_transaksi left join data_kamar on data_transaksi.id_kamar=data_kamar.id_kamar where data_kamar.id_kamar='$dataKamar[id_kamar]' and (status_transaksi='Lunas' or status_transaksi='Belum Lunas')");
																	$dataTransaksi = mysql_fetch_array($queryTransaksi);
																?>
																	<div onclick="open_detail('<?php echo $dataTransaksi['id_transaksi']; ?>')" class="card card-flush flex-row-fluid p-8 pb-5 mw-100 card bg-<?php echo $color_type; ?>" style="--bs-card-box-shadow: 0px 0px 20px 0px rgb(72 85 127 / 55%); cursor: pointer; background-position: right top; background-size: 30%; background-repeat: no-repeat; background-image: url(&quot;../../../upload/1747180187-26415-1698105518-17748-abstract-1.svg&quot;); visibility: visible;">
																		<div class="card-body text-center " style="width: 150px; position: relative; color: rgb(255, 255, 255);">
																			<div class="mb-2">
																				<div class="text-left">
																					<span onclick="window.location.href='../data_booking/index.php?input=tambah&id_kamar=<?php echo $dataKamar['id_kamar'] ?>'" class="fw-bold text-gray-800 cursor-pointer text-hover-<?php echo $color_type; ?> fs-3 fs-xl-1" style="text-align: left;"> Kamar <?php echo $dataKamar['no_kamar'] ?></span>
																					<span class="<?php echo $dataKamar['status_kamar'] == 'Kosong' ? 'text-gray-600' : 'text-black' ?> fw-semibold d-block fs-6 mt-n1" style="text-align: left;">
																						<p></p>
																						<?php echo ucwords(baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$dataKamar[id_tipe_kamar]'")); ?> <br>
																						<?php

																						if ($dataTransaksi['waktu_checkin'] !== null) {
																							$waktu_checkin = explode(" ", $dataTransaksi['waktu_checkin']);
																							$waktu_checout = explode(" ", $dataTransaksi['waktu_checkout']);

																							$tgl_checkin = new DateTime($dataTransaksi['waktu_checkin']);
																							$tgl_checkout = new DateTime($dataTransaksi['waktu_checkout']);

																							$selisih = $tgl_checkin->diff($tgl_checkout);
																							$jumlah_hari = $selisih->days;

																							echo "<i class='fas fa-sign-in-alt text-success'></i> " . format_indo($waktu_checkin[0]) . " " . $waktu_checkin[1];
																							echo "<br>";
																							echo "<i class='fas fa-sign-out-alt text-danger'></i> " . format_indo($waktu_checout[0]) . " " . $waktu_checout[1];
																						?>

																						<?php
																						} else {

																							$jumlah_hari = 0;
																						?>
																							<i class='fas fa-sign-in-alt text-grey'></i> Check In: -
																							<br>
																							<i class='fas fa-sign-out-alt text-grey'></i> Check Out: -
																						<?php
																						} ?>
																						<br>
																						<?php
																						if ($dataTransaksi['jenis_transaksi'] === 'bulanan') {
																							echo rupiah($dataTransaksi['harga_bulanan']);
																						?>
																							<b style="font-size: 9px;"></b> <b style="font-size: 9px;"></b> @ <?php echo intval($jumlah_hari) / 30 ?> Bulan
																						<?php
																						} else {
																							echo rupiah($dataTransaksi['harga_harian']);
																						?>
																							<b style="font-size: 9px;"></b> <b style="font-size: 9px;"></b> @ <?php echo $jumlah_hari ?> Days
																						<?php
																						}
																						?>
																						<br>
																						<br>

																						<p style='color:#bf2b27'><b>Total: <?php echo rupiah($dataTransaksi['total_bayar']) ?></b></p>
																						<?php
																						if (decrypt($_COOKIE['id_hotel']) === $idhotel) {
																						?>
																							<p></p> <button class="btn btn-danger btn-sm" onclick="window.location.href='../checkout/index.php?input=tampil&id=<?php echo $dataTransaksi['id_kamar'] ?>&trx=<?php echo encrypt($dataTransaksi['id_transaksi']) ?>'">Check Out</button>
																						<?php
																						} else { ?>
																							<p></p> <button class="btn btn-danger btn-sm"><?php echo baca_database("", "status_kamar", "select * from data_kamar where id_kamar='$dataTransaksi[id_kamar]'")
																																			?></button>
																						<?php
																						} ?>
																					</span>
																				</div>
																			</div>
																			<span class="text-<?php echo $color_type; ?> text-end fw-bold fs-1"></span>
																		</div>
																	</div>
																<?php
																}
															};
														} else {
															$id_hotel = decrypt($_COOKIE['id_hotel']);

															if ($_COOKIE['id_hotel'] == "") {
																$id_hotel = pengaturan_aplikasi("default_hotel");
															}


															$queryKamar = mysql_query("SELECT * FROM data_kamar WHERE id_hotel = '$id_hotel' ORDER BY CAST(REGEXP_SUBSTR(LOWER(no_kamar), '[0-9]+') AS UNSIGNED), REGEXP_SUBSTR(LOWER(no_kamar), '[a-z]+$')");
															while ($data_kamar = mysql_fetch_array($queryKamar)) {
																if ($data_kamar['status_kamar'] == 'Kosong') {
																?>
																	<div class="card card-flush flex-row-fluid p-8 pb-5 mw-100 card <?php echo $data_kamar['status_kamar'] == 'Kosong' ? 'bg-white' : 'bg-' . $color_type . '' ?>" style="--bs-card-box-shadow: 0px 0px 20px 0px rgb(72 85 127 / 55%); cursor: pointer; background-position: right top; background-size: 30%; background-repeat: no-repeat; background-image: url(&quot;../../../upload/1747180187-26415-1698105518-17748-abstract-1.svg&quot;); visibility: visible;">
																		<div class="card-body text-center" style="width: 150px; position: relative; color: rgb(255, 255, 255);">
																			<div class="mb-2">
																				<div class="text-left">
																					<span onclick="window.location.href='../data_booking/index.php?input=tambah&id_kamar=<?php echo $data_kamar['id_kamar'] ?>'" class="fw-bold text-gray-800 cursor-pointer text-hover-<?php echo $color_type; ?> fs-3 fs-xl-1" style="text-align: left;">Kamar <?php echo $data_kamar['no_kamar'] ?></span>
																					<span class="<?php echo $data_kamar['status_kamar'] == 'Kosong' ? 'text-gray-600' : 'text-black' ?> fw-semibold d-block fs-6 mt-n1" style="text-align: left;">
																						<p></p>
																						<?php echo ucwords(baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$data_kamar[id_tipe_kamar]'")) ?> <br>

																						<i class='fas fa-sign-in-alt text-grey'></i> Check In: -
																						<br>
																						<i class='fas fa-sign-out-alt text-grey'></i> Check Out: -
																						<br>

																						<?php echo rupiah($data_kamar['harga_harian']) ?> <b style="font-size: 9px;"></b> <b style="font-size: 9px;"></b>/Days
																						<br>


																						<p style='color:#000000'><b><br>Total: Rp 0 </b></p>

																						<?php
																						if ($_COOKIE['id_hotel'] == "") {
																						?>
																							<p></p> <button class="btn btn-light btn-sm">Ready</button>
																						<?php
																						} else {
																						?>
																							<button class="btn btn-light btn-sm" onclick="window.location.href='../data_transaksi/index.php?input=tambah&id=<?php echo $data_kamar['id_kamar'] ?>'">Check in</button>
																						<?php
																						}
																						?>



																						<!---->
																					</span>
																				</div>
																			</div>
																			<span class="text-<?php echo $color_type; ?> text-end fw-bold fs-1"></span>
																		</div>
																	</div>
																<?php
																} else {
																?>

																	<?php
																	$tanggal_checkin = date("Y-m-d H:i:s");
																	$queryTransaksi = mysql_query("SELECT * FROM data_transaksi LEFT JOIN data_kamar ON data_transaksi.id_kamar=data_kamar.id_kamar WHERE data_kamar.id_kamar='$data_kamar[id_kamar]' AND (data_transaksi.status_transaksi='Lunas' OR data_transaksi.status_transaksi='Belum Lunas')");
																	$data_transaksi = mysql_fetch_array($queryTransaksi);
																	?>


																	<div onclick="open_detail('<?php echo $data_transaksi['id_transaksi']; ?>')" class="card card-flush flex-row-fluid p-8 pb-5 mw-100 card <?php echo $data_kamar['status_kamar'] == 'Kosong' ? 'bg-white' : 'bg-' . $color_type . '' ?>" style="--bs-card-box-shadow: 0px 0px 20px 0px rgb(72 85 127 / 55%); cursor: pointer; background-position: right top; background-size: 30%; background-repeat: no-repeat; background-image: url(&quot;../../../upload/1747180187-26415-1698105518-17748-abstract-1.svg&quot;); visibility: visible;">
																		<div class="card-body text-center" style="width: 150px; position: relative; color: rgb(255, 255, 255);">
																			<div class="mb-2">
																				<div class="text-left">
																					<span onclick="window.location.href='../data_booking/index.php?input=tambah&id_kamar=<?php echo $data_kamar['id_kamar'] ?>'" class="fw-bold text-gray-800 cursor-pointer text-hover-<?php echo $color_type; ?> fs-3 fs-xl-1" style="text-align: left;">Kamar <?php echo $data_kamar['no_kamar'] ?></span>
																					<span class="<?php echo $data_kamar['status_kamar'] == 'Kosong' ? 'text-gray-600' : 'text-black' ?> fw-semibold d-block fs-6 mt-n1" style="text-align: left;">
																						<p></p>

																						<?php echo ucwords(baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$data_kamar[id_tipe_kamar]'")) ?> <br>
																						<?php

																						if ($data_transaksi['waktu_checkin'] == null || $data_transaksi['status_kamar'] == 'Kosong') {
																							$jumlah_hari = 0;
																						?>
																							<i class='fas fa-sign-in-alt text-grey'></i> Check In: -
																							<br>
																							<i class='fas fa-sign-out-alt text-grey'></i> Check Out: -
																						<?php
																						} else {

																							$waktu_checkin = explode(" ", $data_transaksi['waktu_checkin']);
																							$waktu_checout = explode(" ", $data_transaksi['waktu_checkout']);

																							$tgl_checkin = new DateTime($data_transaksi['waktu_checkin']);
																							$tgl_checkout = new DateTime($data_transaksi['waktu_checkout']);

																							$selisih = $tgl_checkin->diff($tgl_checkout);
																							$jumlah_hari = $selisih->days;

																							echo "<i class='fas fa-sign-in-alt text-success'></i> " . format_indo($waktu_checkin[0]) . " " . $waktu_checkin[1];
																							echo "<br>";
																							echo "<i class='fas fa-sign-out-alt text-danger'></i> " . format_indo($waktu_checout[0]) . " " . $waktu_checout[1];
																						}
																						?>
																						<br>


																						<?php
																						if ($data_transaksi['jenis_transaksi'] == 'bulanan') {
																							echo rupiah($data_transaksi['harga_bulanan']);
																						?>

																							<b style="font-size: 9px;"></b> <b style="font-size: 9px;"></b> @ <?php echo floor($jumlah_hari / 30) ?> Bulan
																						<?php
																						} else {
																							echo rupiah($data_transaksi['harga_harian']);
																						?>
																							<b style="font-size: 9px;"></b> <b style="font-size: 9px;"></b> @ <?php echo $jumlah_hari ?> Days
																						<?php
																						} ?>


																						<br>
																						<p style='color:#bf2b27'><b><br>Total: <?php echo $data_transaksi['status_kamar'] == 'Kosong' ? 'Rp 0' : rupiah($data_transaksi['total_bayar']) ?> </b></p>
																						<p></p>
																						<?php

																						if ($data_transaksi['status_kamar'] == 'Kosong') {
																						?>
																							<button class="btn btn-light btn-sm" onclick="window.location.href='../data_transaksi/index.php?input=tambah&id=<?php echo $data_kamar['id_kamar'] ?>'">Check In</button>
																						<?php
																						} else {
																						?>

																							<?php
																							if ($_COOKIE['id_hotel'] == "") {
																							?>
																								<button class="btn btn-danger btn-sm"><?php echo baca_database("", "status_kamar", "select * from data_kamar where id_kamar='$data_kamar[id_kamar]'")
																																		?></button>
																							<?php
																							} else {
																							?>
																								<button class="btn btn-danger btn-sm" onclick="window.location.href='../checkout/index.php?input=tampil&id=<?php echo encrypt($data_kamar['id_kamar']) ?>&proses=checkout&trx=<?php echo encrypt($data_transaksi['id_transaksi']) ?>'">Check Out</button>
																							<?php
																							}
																							?>

																						<?php
																						}
																						?>

																						<!---->
																					</span>
																				</div>
																			</div>
																			<span class="text-<?php echo $color_type; ?> text-end fw-bold fs-1"></span>
																		</div>
																	</div>
														<?php
																}
															}
														}
														?>


													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>






		<style>
			/* CSS for the list-group-item */
			.list-group-item {
				padding: 10px;
				margin-bottom: 5px;
				background-color: #f9f9f9;
				border: 1px solid #ddd;
				border-radius: 5px;
				cursor: pointer;
				text-align: left;
			}

			.list-group-item:hover {
				background-color: #eaeaea;
			}
		</style>




		<script src="vue.min.js"></script>
		<script src="app.js"></script>





		<!--begin::Footer-->
		<div id="kt_app_footer" class="app-footer ">
			<!--begin::Footer container-->
			<div class="app-container  container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3 ">
				<!--begin::Copyright-->
				<div class="text-dark order-2 order-md-1">
					<?php echo $copyright; ?>
				</div>
				<!--end::Copyright-->

				<script>
					function showBillingSystemToast() {
						Swal.fire({
							title: 'Steze Management System',
							html: `
			<p><strong>Nama Aplikasi:</strong> Steze Management System v1.0 (Juli 2025)</p>
			<p><strong>Deskripsi:</strong> Steze adalah aplikasi manajemen kost dan homestay yang membantu pemilik properti dalam mengelola kamar, transaksi, dan laporan keuangan secara efisien dan otomatis.</p>
			<p><strong>Tanggal Rilis:</strong> Juli 2025</p>
		`,
							icon: 'success',
							confirmButtonText: 'OK',
						});
					}

					function showSupportToast() {
						Swal.fire({
							title: 'Steze Management System',
							html: `
			<p><strong>Contact Support:</strong> 0853-****-****</p>
		`,
							icon: 'info',
							confirmButtonText: 'OK',
						});
					}
				</script>


				<!--begin::Menu-->
				<ul class="menu menu-gray-600 menu-hover-<?php echo $color_type; ?> fw-semibold order-1">

					<li class="menu-item"><a style="cursor:pointer" onclick="showBillingSystemToast()" class="menu-link px-2">About</a></li>

					<li class="menu-item"><a style="cursor:pointer" onclick="showSupportToast()" class="menu-link px-2">Support</a></li>

					<li class="menu-item"><a href="" class="menu-link px-2">Reload&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
					</li>
				</ul>
				<!--end::Menu-->
			</div>
			<!--end::Footer container-->
		</div>
		<!--end::Footer-->
	</div>

	<style>
		/* Tombol hanya tampil di mobile */
		@media (min-width: 992px) {
			.mobile-floating-btn {
				display: none !important;
			}
		}

		/* Styling tombol mengambang di sisi kanan */
		.mobile-floating-btn {
			position: fixed;
			right: -58px;
			z-index: 975;
			transform: rotate(91deg);
			transform-origin: left bottom;
			border-radius: 0 0 0.5rem 0.5rem;
		}

		/* Atur posisi atas dan bawah */
		#btnMenuMobile {
			top: 10%
		}

		#btnDashboardMobile {
			bottom: 35%;
		}
	</style>

	<!-- Tombol MENU -->
	<a id="kt_app_sidebar_toggle">
		<button id="btnMenuMobile"
			class="mobile-floating-btn explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-danger shadow-sm px-5 fw-bolder fs-6"
			onclick="/* fungsi sidebar di sini */">

			<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
				<g fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" />
					<path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3" />
				</g>
			</svg>
			&nbsp;Menu
		</button>
	</a>

	<button onclick="showHotelModal()" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-trigger="hover" class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-danger shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0"> <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Substract.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
			<title>Stockholm-icons / Design / Substract</title>
			<desc>Created with Sketch.</desc>
			<defs />
			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<rect x="0" y="0" width="24" height="24" />
				<path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero" />
				<path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3" />
			</g>
		</svg><!--end::Svg Icon-->&nbsp;Dashboard</span> </button>


	<style>
		.glass-card {
			background: rgba(255, 255, 255, 0.15);
			border-radius: 12px;
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);

			--bs-card-box-shadow: 0px 0px 20px 0px rgb(72 85 127 / 29%);
			border: 1px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease-in-out;
		}

		.glass-card:hover {
			transform: scale(1.05);
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
		}

		.card-title {
			font-size: 0.9rem;
			font-weight: 600;
		}

		.card-sub {
			font-size: 0.75rem;
			color: #6c757d;
		}

		.stat-row {
			font-size: 0.75rem;
			display: flex;
			justify-content: space-between;
		}

		.popover.custom-dark {


			border: none;
			font-size: 12px;
			/* kecilin font */
			white-space: pre-line;
			/* penting supaya \n jadi enter */
		}
	</style>





	<!-- Modal -->
	<div class="modal fade" id="hotelModal" tabindex="-1" aria-labelledby="hotelModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">

			<div class="modal-content">
				<div class="modal-header bg-light">
					<h5 class="modal-title" id="hotelModalLabel"> Kost & Guest house SteZe</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
				</div>
				<div class="modal-body">
					<?php
					$months = [
						'January'   => 'Januari',
						'February'  => 'Februari',
						'March'     => 'Maret',
						'April'     => 'April',
						'May'       => 'Mei',
						'June'      => 'Juni',
						'July'      => 'Juli',
						'August'    => 'Agustus',
						'September' => 'September',
						'October'   => 'Oktober',
						'November'  => 'November',
						'December'  => 'Desember'
					];

					?>
					<!-- <h2 class="text-start text-danger" style="margin-bottom:15px">Pendapatan dan Operasional Hotel Per Bulan <?php echo $months[date('F')] . ' ' . date('Y') ?></h2> -->
					<div class="row g-3">

						<?php
						$idhotel_cookie = decrypt($_COOKIE['id_hotel']);
						$idhotel_aktif = isset($_GET['hotel']) ? decrypt($_GET['hotel']) : $idhotel_cookie;


						if ($_COOKIE['id_hotel'] == "") {
							$queryHotel = mysql_query("SELECT * FROM data_hotel ORDER BY  id_hotel ASC");
						} else {
							$queryHotel = mysql_query("SELECT * FROM data_hotel ORDER BY id_hotel = '$idhotel_cookie' DESC, id_hotel ASC");
						}


						while ($data = mysql_fetch_array($queryHotel)) {
							$idHotel = $data['id_hotel'];

							$queryKamar = mysql_query("SELECT 
                SUM(status_kamar = 'Kosong') AS kosong, 
                SUM(status_kamar = 'Terisi') AS terisi, 
                COUNT(*) AS total 
                FROM data_kamar 
                WHERE id_hotel = '$idHotel'");
							$kamar = mysql_fetch_assoc($queryKamar);
							$kosong = $kamar ? (int)$kamar['kosong'] : 0;
							$terisi = $kamar ? (int)$kamar['terisi'] : 0;
							$total  = $kamar ? (int)$kamar['total'] : 0;


							// Hitung jumlah kamar kosong per tipe_kamar
							$queryKosongTipe = mysql_query("
							SELECT t.tipe_kamar, SUM(k.status_kamar = 'Kosong') AS jumlah_kosong
							FROM data_kamar k
							INNER JOIN data_tipe_kamar t ON k.id_tipe_kamar = t.id_tipe_kamar
							WHERE k.id_hotel = '$idHotel'
							GROUP BY t.tipe_kamar
						");

							$kosong_per_tipe_arr = [];
							while ($row = mysql_fetch_assoc($queryKosongTipe)) {
								$kosong_per_tipe_arr[] = $row['tipe_kamar'] . " : " . $row['jumlah_kosong'];
							}

							// Gabungkan jadi 1 string
							$kosong_per_tipe_kamar = implode("\n", $kosong_per_tipe_arr);


							$isActive = ($idHotel == $idhotel_aktif);
							$border = $isActive ? "border-danger border-2" : "border-0";
							$badge = $isActive ? '<span style=" background-color: #F44336 !important;color: white;" class="badge bg-danger position-absolute  m-2">Selected</span>' : '';

							$logoPath = "../../../upload/" . $data['gambar'];
							if (!file_exists($logoPath)) {
								$logoPath = "https://via.placeholder.com/400x120?text=No+Logo";
							}


							$queryPendapatan = mysql_query("
    SELECT SUM(jumlah_bayar) AS pendapatan
    FROM data_pemasukan
    WHERE id_hotel = '$idHotel'
      AND MONTH(waktu) = MONTH(CURRENT_DATE())
      AND YEAR(waktu) = YEAR(CURRENT_DATE())
");

							$pendapatan = mysql_fetch_assoc($queryPendapatan);


							$queryOperasional = mysql_query("SELECT SUM(biaya) as operasional FROM data_operasional WHERE id_hotel='$idHotel' AND (
														MONTH(tanggal)=MONTH(CURRENT_DATE())
														AND YEAR(tanggal)=YEAR(CURRENT_DATE())
														OR MONTH(tanggal)=MONTH(CURRENT_DATE())
														AND YEAR(tanggal)=YEAR(CURRENT_DATE())
													)");
							$operasional = mysql_fetch_assoc($queryOperasional);
						?>

							<div class="col-6 col-md-4 col-xl-2 col-xxl-2">
								<div onclick="window.location.href = 'index.php?hotel=<?php echo encrypt($idHotel) ?>'"
									class="card glass-card position-relative h-100 <?php echo $border ?>"
									style="cursor: pointer; font-size: 0.8rem;">

									<?php echo $badge ?>

									<img src="<?php echo $logoPath ?>"
										class="card-img-top"
										alt="Logo Hotel"
										style="height: 100px; object-fit: cover; border-radius: 12px 12px 0 0;">

									<div class="card-body p-3 d-flex flex-column">
										<!-- Bagian atas -->
										<div>
											<div class="card-title mb-1"><?php echo $data['nama'] ?></div>


											<!-- <div class="card-sub ">
												<b>Telepon : <?php echo $data['no_telepon'] ?></b>
											</div> -->


											<div class="card-sub mb-2">
												<i class="fas fa-map-marker-alt text-grey me-1"></i> <?php echo $data['alamat'] ?>
											</div>

										</div>

										<!-- Bagian bawah (statistik) -->
										<div class="mt-auto">
											<div class="stat-row mb-1">
												<span><i class="fas fa-bed text-grey me-1"></i> Kosong</span>
												<span data-bs-container="body"
													data-bs-toggle="popover"
													data-bs-placement="top"
													data-bs-trigger="hover"
													data-bs-custom-class="custom-dark"
													data-bs-content="<?php echo htmlspecialchars($kosong_per_tipe_kamar, ENT_QUOTES); ?>"><?php echo $kosong ?></span>
											</div>




											<div class="stat-row mb-1">
												<span><i class="fas fa-bed text-danger me-1"></i> Terisi</span>
												<span><?php echo $terisi ?></span>
											</div>
											<div class="stat-row mb-2">
												<strong><i class="fas fa-bed text-warning me-1"></i> Total</strong>
												<strong><?php echo $total ?></strong>
											</div>

											<?php if ($_COOKIE['id_hotel'] == "") { ?>
												<hr>
												<div class="stat-row mb-2">
													<strong><i class="fas fa-credit-card text-success me-1"></i>Cash in</strong>
													<strong><?php echo rupiah($pendapatan['pendapatan']) ?></strong>
												</div>
												<div class="stat-row mb-2">
													<strong><i class="fas fa-credit-card text-danger me-1"></i>Cash Out</strong>
													<strong><?php echo rupiah($operasional['operasional']) ?></strong>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>



						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</div>



	<script>
		function showHotelModal() {
			var myModal = new bootstrap.Modal(document.getElementById('hotelModal'));
			myModal.show();
		}
	</script>

	<script>
		// inisialisasi popover agar aktif
		const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
		const popoverList = [...popoverTriggerList].map(el => new bootstrap.Popover(el))
	</script>



	<style>
		/* Default desktop */
		.custom-modal {
			max-width: 60%;
		}

		/* Mobile / layar kecil */
		@media (max-width: 768px) {
			.custom-modal {
				max-width: 95%;
				margin: 0 10px;
				/* beri sedikit margin kiri-kanan */
			}
		}
	</style>
	<!-- Modal -->
	<div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiLabel" aria-hidden="true">
		<div class="modal-dialog custom-modal">
			<div class="modal-content" style="max-height: 100vh; overflow-y: auto;">
				<div class="modal-header">
					<h4 class="modal-title" id="detailTransaksiLabel">Detail Transaksi</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="modalBody">
					Loading...
				</div>
			</div>
		</div>
	</div>

	<script>
		function open_detail(id_transaksi) {
			var modalBody = document.getElementById("modalBody");
			modalBody.innerHTML = "Loading...";

			// Panggil PHP detail_transaksi.php via AJAX
			var xhr = new XMLHttpRequest();
			xhr.open("GET", "detail_transaksi.php?proses=" + id_transaksi, true);
			xhr.onload = function() {
				if (xhr.status === 200) {
					modalBody.innerHTML = xhr.responseText;
					// Tampilkan modal Bootstrap
					var myModal = new bootstrap.Modal(document.getElementById('detailTransaksiModal'));
					myModal.show();
				} else {
					modalBody.innerHTML = "Terjadi kesalahan saat memuat data.";
				}
			};
			xhr.send();
		}
	</script>