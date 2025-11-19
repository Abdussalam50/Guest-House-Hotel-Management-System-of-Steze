	<?php

	if (isset($_COOKIE['operasional'])) {
	?>
		<script>
			alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu transaksi\n');
			window.location.href = '../../index.php'
		</script>
	<?php
	} ?>
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

			font-weight: 600;
		}

		.card-sub {

			color: #6c757d;
		}

		.stat-row {

			display: flex;
			justify-content: space-between;
		}
	</style>
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

			?>

				<div class="col-6 col-md-4 col-xl-3 col-xxl-3">
					<div onclick="window.location.href = 'index.php?id_hotel=<?php echo encrypt($idHotel) ?>&nama_hotel=<?php echo $data['nama'] ?>'"
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



								<div class="stat-row mb-2">
									<strong><i class="fas fa-sign-in-alt text-primary me-1"></i>Total Booking</strong>
									<strong><?php echo baca_database("", "jumlah_transaksi_lunas", "SELECT 
                                                                                        COUNT(*) AS jumlah_transaksi_lunas
                                                                                    FROM 
                                                                                        data_booking
                                                                                    WHERE 
                                                                                        status_transaksi = 'Booking' and id_hotel='$idHotel';
                                                                                    ") ?> Booking</strong>
								</div>






							</div>
						</div>
					</div>
				</div>



			<?php } ?>

		</div>
	</div>