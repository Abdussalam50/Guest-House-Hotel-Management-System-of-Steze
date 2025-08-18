<div class="row g-2 g-xl-2 mb-2 mb-xl-2">



	<?php
	$idHotel = decrypt($_COOKIE['id_hotel']);
	$xml = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);
	foreach ($xml as $i) {
		if ($i->t == 'm') {
			$idmenu = $i->id;
			if ($idmenu == 'C') {
				$xml1 = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);
				foreach ($m1 as $i1) {
					if ($i1->s == "$idmenu" and $i1->t == 'sm') {
	?>



						<div class="col-md-6 col-lg-4 col-xl-3">
							<div class="card h-100">

								<div class="card-body d-flex justify-content-center text-center flex-column p-8" style=" border: 1px solid #ddd; border-radius: 12px;  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  padding: 16px;  background-color: #fdfdfd;  width: 100%; margin: 16px auto;">
									<a href="<?php
												if (strpos(strtolower($i1->n), 'hotel') !== false) {
													echo "#";
												} elseif (strpos(strtolower($i1->n), 'cashflow') !== false) {
													echo "../data_transaksi/index.php?input=cetak_cashflow&id_hotel=$idHotel";
												} elseif ($i1->n == 'Pendapatan') {
													echo "../data_transaksi/index.php?input=cetak_pendapatan&id_hotel=$idHotel";
												} else {
													echo $i1->l;
												}
												?>" class="text-gray-800 text-hover-primary d-flex flex-column">
										<div class="symbol symbol-60px mb-5">
											<img src="../../../data/image/logo/vektors.png" alt="">
										</div>
										<div class="fs-5 fw-bolder mb-2"> <?php
																			echo $name = $i1->n;
																			?></div>
									</a>
									<div class="fs-7 fw-bold text-gray-400">Jumlah <?php echo ucwords($name1) ?> Saat Ini</div>
								</div>
							</div>
						</div>




	<?php
					}
				}
			}
		}
	}
	?>





</div>