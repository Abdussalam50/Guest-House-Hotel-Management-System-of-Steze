<div class="row g-2 g-xl-2 mb-2 mb-xl-2">
<?php
if(isset($_COOKIE['operasional'])){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu pengaturan\n');
        window.location.href='../../index.php'
    </script>
<?php
}
?>




	<div class="col-xl-4">
		<div class="card h-100">
			<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
				<div class="symbol symbol-60px me-5">
					<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
				</div>
				<div class="d-flex flex-column">
					<a href="../data_metode_pembayaran/index.php" class="text-gray-800 text-hover-primary">
						<div class="fs-5 fw-bolder mb-1"> Payment</div>
					</a>
					<div class="fs-7 fw-bold text-gray-400"> Jenis Pembayaran</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-xl-4">
		<div class="card h-100">
			<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
				<div class="symbol symbol-60px me-5">
					<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
				</div>
				<div class="d-flex flex-column">
					<a href="../data_bank/index.php" class="text-gray-800 text-hover-primary">
						<div class="fs-5 fw-bolder mb-1"> Bank</div>
					</a>
					<div class="fs-7 fw-bold text-gray-400"> Akun Bank</div>
				</div>
			</div>
		</div>
	</div>


	<?php if ($_COOKIE['id_hotel'] == "") {
	?>
		<div class="col-xl-4">
			<div class="card h-100">
				<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
					<div class="symbol symbol-60px me-5">
						<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
					</div>
					<div class="d-flex flex-column">
						<a href="../data_pengaturan_aplikasi/index.php" class="text-gray-800 text-hover-primary">
							<div class="fs-5 fw-bolder mb-1">Aplikasi</div>
						</a>
						<div class="fs-7 fw-bold text-gray-400">Pengaturan Aplikasi</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-xl-4">
			<div class="card h-100">
				<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
					<div class="symbol symbol-60px me-5">
						<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
					</div>
					<div class="d-flex flex-column">
						<a href="../backuprestore/index.php?input=backup" class="text-gray-800 text-hover-primary">
							<div class="fs-5 fw-bolder mb-1"> Backup</div>
						</a>
						<div class="fs-7 fw-bold text-gray-400">Backup Database</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-xl-4">
			<div class="card h-100">
				<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
					<div class="symbol symbol-60px me-5">
						<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
					</div>
					<div class="d-flex flex-column">
						<a href="../backuprestore/index.php?input=restore" class="text-gray-800 text-hover-primary">
							<div class="fs-5 fw-bolder mb-1"> Restore</div>
						</a>
						<div class="fs-7 fw-bold text-gray-400">Restore Database</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-4">
			<div class="card h-100">
				<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
					<div class="symbol symbol-60px me-5">
						<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
					</div>
					<div class="d-flex flex-column">
						<a href="../data_pengelola/index.php?input=restore" class="text-gray-800 text-hover-primary">
							<div class="fs-5 fw-bolder mb-1"> Super Admin</div>
						</a>
						<div class="fs-7 fw-bold text-gray-400">Akun Pengelola</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-4">
			<div class="card h-100">
				<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
					<div class="symbol symbol-60px me-5">
						<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
					</div>
					<div class="d-flex flex-column">
						<a href="../data_hotel/index.php?input=restore" class="text-gray-800 text-hover-primary">
							<div class="fs-5 fw-bolder mb-1"> Hotel</div>
						</a>
						<div class="fs-7 fw-bold text-gray-400">Data Hotel</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	} else {
	?>
		<div class="col-xl-4">
			<div class="card h-100">
				<div class="card-body d-flex align-items-center p-4" style="border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fdfdfd; width: 100%; margin: 16px auto;">
					<div class="symbol symbol-60px me-5">
						<img src="../../../data/image/logo/vektors.png" alt="" style="width: 60px; height: 60px;">
					</div>
					<div class="d-flex flex-column">
						<a href="../data_pengaturan_printer/index.php?input=detail" class="text-gray-800 text-hover-primary">
							<div class="fs-5 fw-bolder mb-1">Printer</div>
						</a>
						<div class="fs-7 fw-bold text-gray-400">Pengaturan Printer</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>




</div>