<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
                <h2>Clear database</h2>
                <br>
                <h4>Hati hati..!! proses ini akan mengosongkan database anda..</h4>
                <div class="row g-2 g-xl-2 mb-2 mb-xl-2">

                    <?php


                    // Cek apakah form sudah disubmit
                    if (isset($_POST['submit_password'])) {
                        $password = $_POST['password'];

                        if ($password === 'rudin') { // Password valid

                            include '../backuprestore/backup.php';
                            $tables = array(
                                'data_booking',
                                'data_booking_list_kamar',
                                'data_deposit',
                                'data_hapus_transaksi',
                                'data_pajak',
                                'data_pemasukan',
                                'data_riwayat_admin',
                                'data_riwayat_superadmin',
                                'data_transaksi',
                                'data_transaksi_list_kamar'
                            );

                            // Loop untuk truncate tabel
                            foreach ($tables as $table) {
                                $sql = "TRUNCATE TABLE `$table`";
                                $result = mysql_query($sql, $conn);
                                if ($result) {
                                    echo "Tabel `$table` berhasil dikosongkan.<br>";
                                } else {
                                    echo "Gagal mengosongkan tabel `$table`: " . mysql_error() . "<br>";
                                }
                            }

                            // Update status kamar menjadi 'Kosong'
                            $sqlUpdateKamar = "UPDATE `data_kamar` SET `status_kamar` = 'Kosong'";
                            $resultKamar = mysql_query($sqlUpdateKamar, $conn);
                            if ($resultKamar) {
                                echo "Status semua kamar berhasil diubah menjadi 'Kosong'.<br>";
                            } else {
                                echo "Gagal mengubah status kamar: " . mysql_error() . "<br>";
                            }
                        } else {
                            echo "<span style='color:red;'>Password salah! Aksi dibatalkan.</span>";
                        }
                    } else {
                        // Form input password
                    ?>
                        <form method="post">
                            <label>Masukkan password untuk reset data:</label>
                            <input type="password" name="password" required>
                            <button type="submit" name="submit_password">Eksekusi</button>
                        </form>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>