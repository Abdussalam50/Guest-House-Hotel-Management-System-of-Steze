<?php
if(isset($_COOKIE['operasional'])){
    ?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu pelanggan\n');
        window.location.href='../../index.php'
    </script>
<?php
}elseif(isset($_GET['id_hotel']))

?>
<div class="action-buttons" style="display: flex; justify-content: flex-end; margin-top: -59px; gap: 8px;">
    <a href="index.php?input=tambah" class="btn btn-sm btn-secondary fw-semibold btn-action" aria-label="Input Operasional">
        <i class="fas fa-add text-black"></i> Input Operasional
    </a>
    <a onclick="pencarian()" class="btn btn-sm btn-danger fw-semibold btn-action" aria-label="Pencarian Data">
        <i class="fas fa-search text-white"></i> Pencarian
    </a>
</div>
<br>

<div class="content-widgets gray">
    <div class="widget-container">
        <div class="content-box">
            <div style="overflow-x: auto;">
                <table <?php tabel(100, '%', 1, 'left'); ?> class="data-table">
                    <thead>
                        <tr style="background-color: #f9f9f9;">
                            <th scope="col"></th>
                            <th scope="col" align="left" class="th_border cell">Operasional</th>
                            <th scope="col" align="left" class="th_border cell">Nama Hotel</th>
                            <th scope="col" align="left" class="th_border cell">Tanggal</th>
                            <th scope="col" align="left" class="th_border cell">Jumlah</th>
                            <th scope="col" align="left" class="th_border cell">Biaya</th>
                            <th scope="col" align="left" class="th_border cell">Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;
                        $id_hotel = decrypt($_COOKIE['id_hotel']);
                        if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                            $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                            $isi = mysql_real_escape_string($_GET['isi']);
                            $querytabel = "SELECT * FROM data_operasional where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                            $querypagination = "SELECT COUNT(*) AS total FROM data_operasional where $berdasarkan like '%$isi%' ";
                        } else {
                            $querytabel = "SELECT * FROM data_operasional  LIMIT $startRow ,$dataPerPage ";
                            $querypagination = "SELECT COUNT(*) AS total FROM data_operasional ";
                        }
                        $proses = mysql_query($querytabel);
                        if (mysql_num_rows($proses)) {
                            while ($data = mysql_fetch_array($proses)) {
                        ?>
                                <tr class="event2">
                                    <td align="center" width="50"><?php $no = (($no + 1)); echo $no; ?></td>
                                    <td align="left">
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_operasional']); ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars(ucwords($data['operasional'])); ?>
                                        </a>
                                    </td>
                                    <td align="left"><?php echo htmlspecialchars(ucwords(baca_database("", "nama", "select * from data_hotel where id_hotel='$data[id_hotel]'"))); ?></td>
                                    <td align="left"><?php echo htmlspecialchars(format_indo($data['tanggal'])); ?></td>
                                    <td align="left"><?php echo htmlspecialchars($data['jumlah']); ?></td>
                                    <td align="left"><?php echo htmlspecialchars(rupiah($data['biaya'])); ?></td>
                                    <td align="left"><?php echo htmlspecialchars(ucwords(baca_database("", "nama", "select * from data_admin where id_admin='$data[id_admin]'"))); ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php Pagination($page, $dataPerPage, $querypagination); ?>
        </div>
    </div>
</div>

<style>
    .swal-cancel-btn {
        background-color: #ccc !important;
        color: #333 !important;
        border: none !important;
    }
    .btn-action {
        padding: 6px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
    .btn-action:hover {
        opacity: 0.9;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table th, .data-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    .data-table tr:nth-child(even) {
        background-color: #fafafa;
    }
    .data-table a {
        color: #007bff;
        text-decoration: none;
    }
    .data-table a:hover {
        text-decoration: underline;
    }
    .swal2-form-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }
    .swal2-form-label {
        flex: 0 0 100px;
        text-align: right;
        font-size: 14px;
    }
    .swal2-form-input, .swal2-form-select {
        flex: 1;
        padding: 6px;
        font-size: 13px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>

<script>
    function pencarian() {
        const formHTML = `
            <form id="formCariSweet" style="text-align: left; font-size: 14px;">
                <div class="swal2-form-group">
                    <label for="Berdasarkan" class="swal2-form-label">Berdasarkan</label>
                    <select id="Berdasarkan" name="Berdasarkan" class="swal2-form-select">
                        <?php
                        $sql = "desc data_operasional";
                        $result = @mysql_query($sql);
                        while ($row = @mysql_fetch_array($result)) {
                            echo "<option value='" . htmlspecialchars($row[0]) . "'>" . htmlspecialchars($row[0]) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="swal2-form-group">
                    <label for="isi" class="swal2-form-label">Kata Kunci</label>
                    <input type="text" id="isi" name="isi" class="swal2-form-input" required>
                </div>
            </form>
        `;

        Swal.fire({
            title: '<b style="font-size:16px;">Pencarian Data</b>',
            html: formHTML,
            width: 400,
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: 'Pencarian',
            cancelButtonText: 'Cancel',
            denyButtonText: 'Reset Pencarian',
            focusConfirm: false,
            customClass: {
                cancelButton: 'swal-cancel-btn',
                denyButton: 'swal-cancel-btn'
            },
            preConfirm: () => {
                const berdasarkan = document.getElementById('Berdasarkan').value;
                const isi = document.getElementById('isi').value.trim();

                if (!berdasarkan || !isi) {
                    Swal.showValidationMessage('Semua field wajib diisi');
                    return false;
                }

                window.location.href = `?Berdasarkan=${encodeURIComponent(berdasarkan)}&isi=${encodeURIComponent(isi)}`;
            },
            preDeny: () => {
                window.location.href = 'index.php';
            }
        });
    }
</script>