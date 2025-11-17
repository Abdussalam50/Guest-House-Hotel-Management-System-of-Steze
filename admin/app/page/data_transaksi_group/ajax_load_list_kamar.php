<?php
include '../../../include/all_include.php';

$id_transaksi = isset($_POST['id_transaksi']) ? mysql_real_escape_string($_POST['id_transaksi']) : '';

$q = "SELECT *
      FROM data_transaksi_list_kamar 
      WHERE id_transaksi = '$id_transaksi' 
      ORDER BY waktu DESC";

$r = mysql_query($q);

echo '<div class="table-scroll">
        <table class="room-table table align-middle">
            <thead>
                <tr style="background-color: #f9f9f9;">
                    <th scope="col">Kamar</th>
                    <th scope="col" class="text-center">Dewasa</th>
                    <th scope="col" class="text-center">Anak</th>
                </tr>
            </thead>
            <tbody>';

if (mysql_num_rows($r) > 0) {

    while ($row = mysql_fetch_assoc($r)) {

        echo '
            <tr>
                <td>
                    <a href="#" class="hapus-kamar"
                       data-id="' . $row['id_transaksi_list_kamar'] . '"
                       style="color:#007BFF; font-weight:bold; text-decoration:none;">
                       ' . htmlspecialchars($row['no_kamar']) . '
                    </a>
                    <br> 
                    ' . number_format($row['harga_kamar_harian'], 0, ',', '.') . ' @ ' . $row['jumlah_hari'] . ' Days
                </td>
                <td class="text-center">' . $row['jumlah_dewasa'] . '</td>
                <td class="text-center">' . $row['jumlah_anak_anak'] . '</td>
            </tr>';
    }
} else {

    echo '
            <tr>
                <td colspan="3" class="text-center py-4">
                    <img src="https://media.baamboozle.com/uploads/images/113260/1638441135_66175_gif-url.gif"
                        width="60" class="mb-2 opacity-75">
                    <div class="fw-semibold text-muted">Belum ada kamar yang dipilih</div>
                </td>
            </tr>';
}

echo '      </tbody>
        </table>
    </div>';
