<?php if ($_GET['input'] == "truncate") : ?>
    <?php if ($_GET['input'] == "truncate") { ?><h2>Backup & Kosongkan Database</h2> <?php } ?>
    <?php if ($_GET['input'] == "truncate" && isset($_GET['verified']) && $_GET['verified'] == '1') {
    } else { ?>
        <script src="../crud/sweetalert2@11.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Masukkan Password',
                    input: 'password',
                    inputLabel: 'Password diperlukan untuk mengosongkan database',
                    inputPlaceholder: 'Masukkan password',
                    inputAttributes: {
                        maxlength: 20,
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Lanjutkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value === 'mikro') {
                            window.location.href = window.location.href + '&verified=1';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Password Salah',
                                text: 'Anda akan diarahkan kembali.'
                            }).then(() => {
                                window.location.href = '../data_pengaturan/index.php';
                            });
                        }
                    } else {
                        window.location.href = '../data_pengaturan/index.php';
                    }
                });
            });
        </script>
    <?php } ?>
<?php endif; ?>

<?php
if ($_GET['input'] == "truncate" && isset($_GET['verified']) && $_GET['verified'] == '1') {
    include 'backup.php';

    // Tambahkan pengecualian default
    $pengecualian = array('data_pengaturan_pengosongan');

    // Ambil pengecualian tambahan dari tabel
    $queryPengecualian = mysql_query("SELECT tabel_pengecualian FROM data_pengaturan_pengosongan");
    while ($row = mysql_fetch_assoc($queryPengecualian)) {
        if (!in_array($row['tabel_pengecualian'], $pengecualian)) {
            $pengecualian[] = $row['tabel_pengecualian'];
        }
    }

    // Ambil semua tabel dari database
    $result = mysql_query("SHOW TABLES");
    if (!$result) {
        die("Gagal mengambil daftar tabel: " . mysql_error());
    }

    echo "<h2>Kosongkan Database</h2>";
    echo "<div style='font-family: monospace;'>";
    while ($row = mysql_fetch_row($result)) {
        $tabel = $row[0];

        // Kosongkan hanya jika tabel tidak termasuk pengecualian
        if (!in_array($tabel, $pengecualian)) {
            echo date('Y-m-d H:i:s') . " - Mengosongkan tabel: <strong>$tabel</strong>..." . str_repeat('.', 50 - strlen($tabel));
            if (mysql_query("TRUNCATE TABLE `$tabel`")) {
                echo " <span style='color: green;'>[OK]</span><br>";
            } else {
                echo " <span style='color: red;'>[GAGAL]</span><br>";
            }
        } else {
            echo "Lewati tabel: <strong>$tabel</strong> <span style='color: red;'>(pengecualian)</span><br>";
        }
    }
    echo "</div>";
    echo "<br><strong>Semua tabel berhasil dikosongkan, kecuali:</strong> " . implode(', ', $pengecualian);


    // Jalankan query auto insert setelah truncate
    $autoInsert = mysql_query("SELECT query FROM data_pengaturan_auto_insert");
    echo "<br><br><strong>Menjalankan Auto Insert:</strong><br>";
    while ($row = mysql_fetch_assoc($autoInsert)) {
        $q = $row['query'];
        echo "<div style='font-family: monospace;'>Menjalankan: <code>$q</code> ... ";
        if (mysql_query($q)) {
            echo "<span style='color: green;'>[OK]</span></div>";
        } else {
            echo "<span style='color: red;'>[GAGAL]</span> - " . mysql_error() . "</div>";
        }
    }
}



?>