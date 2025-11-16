<div class="row g-2 g-xl-2 mb-2 mb-xl-2">

	<?php
	$query_akses=mysql_query("select * from data_pengaturan_aplikasi where nama_pengaturan='akses_laporan'");
	$data=mysql_fetch_array($query_akses);
	$akses_laporan=$data['value'];
	if(isset($_COOKIE['id_hotel']) && $akses_laporan!==1){
		?>
		<script>
			alert('Perhatian! \nAnda Tidak Dapat Mengakses Data Laporan Hingga Mendapatkan Izin Dari Super admin\nTerima Kasih');
			window.location.href='../../index.php'
		</script>
	<?php
	}elseif(isset($_COOKIE['operasional'])){
		 $akses=baca_database("","value","select * from data_pengaturan_aplikasi where nama_pengaturan='akses_laporan_operasional'");
		 if($akses==0){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu laporan\n');
        window.location.href='../../index.php'
    </script>
<?php
		 }
}

	$idHotel = decrypt($_COOKIE['id_hotel']);


	$url_xml = "../../../include/settings/menu.xml";


	$xml1 = new SimpleXMLElement($url_xml, null, true);
	foreach ($xml1 as $i) {
		if ($i->t == 'm') {
			$idmenu = $i->id;
			if ($idmenu == 'C') {
				$xml1 = new SimpleXMLElement($url_xml, null, true);
				foreach ($m1 as $i1) {
					if ($i1->s == "$idmenu" and $i1->t == 'sm') {

						if ($_COOKIE['id_hotel'] == "") {
	?>
							<div class="col-md-6 col-lg-4 col-xl-3">
								<div class="card h-100">

									<div class="card-body d-flex justify-content-center text-center flex-column p-8" style=" border: 1px solid #ddd; border-radius: 12px;  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  padding: 16px;  background-color: #fdfdfd;  width: 100%; margin: 16px auto;">
										<a href="<?php
													if (strpos(strtolower($i1->n), 'hotel') !== false) {
														echo "#";
													} elseif (strpos(strtolower($i1->n), 'grafik') !== false) {
														echo $i1->l;
													} elseif (strpos(strtolower($i1->n), 'transaksi') !== false) {
														echo "../data_transaksi_super_admin/index.php?input=cetak";
													} elseif (strpos(strtolower($i1->n), 'operasional') !== false) {
														echo "../data_operasional_super_admin/index.php?input=cetak";
													} elseif (strpos(strtolower($i1->n), 'cashflow') !== false) {
														echo "../data_transaksi_super_admin/index.php?input=cetak_cashflow&id_hotel=";
													}elseif(strpos(strtolower($i1->n),'deposit')!==false){
														echo "../data_transaksi/index.php?input=cetak_deposit&id_hotel=";
													}elseif(strpos(strtolower($i1->n),'riwayat admin')!==false){
														echo "../data_admin/index.php?input=cetak_riwayat&id_hotel=";
													}elseif(strpos(strtolower($i1->n),'superadmin')!==false){
														echo "../data_admin/index.php?input=cetak_riw_superadmin";
													}else {
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
						} else { ?>

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
													}elseif(strpos(strtolower($i1->n),'deposit')!==false){
														echo "../data_transaksi/index.php?input=cetak_deposit&id_hotel=$idHotel";
													}elseif(strpos(strtolower($i1->n),'riwayat')!==false){
														continue;
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
	}
	?>





</div>