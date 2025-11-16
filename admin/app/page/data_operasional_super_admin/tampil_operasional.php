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