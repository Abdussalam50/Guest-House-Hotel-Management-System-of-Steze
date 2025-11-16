<div style="display: flex; justify-content: flex-end; margin-top: -59px; gap: 8px;">

    <a href="../data_transaksi/index.php?input=cetak" class="btn btn-sm btn-secondary fw-semibold">
        <i class='fas fa-print text-black'></i> Report Transaksi
    </a>

    <a href="../data_transaksi/index.php?input=cetak_cashflow&id_hotel=HOT20250710063626968"" class=" btn btn-sm btn-secondary fw-semibold">
        <i class='fas fa-file-text text-black'></i> Cashflow
    </a>
    <a href="../grafik_rekapitulasi/index.php" class=" btn btn-sm btn-secondary fw-semibold">
        <i class='fas fa-chart-pie text-black'></i> Grafik
    </a>


    <a onclick="pencarian()" class="btn btn-sm btn-danger fw-semibold">
        <i class='fas fa-search text-white'></i> Pencarian
    </a>

</div>
<br>

<div class="content-widgets gray">

    <div class="widget-container">
        <div class="content-box">



            <div style="overflow-x:auto;">
                <table <?php tabel(100, '%', 1, 'left'); ?>>
                    <tr style="background-color: #f9f9f9;">

                        <th></th>
                        <th>Kode&nbsp;Transaksi</th>
                        <!--h <th>Id Transaksi </th> h-->
                        <th align="left" class="th_border cell">Pelanggan </th>
                        <th align="left" class="th_border cell">Kamar </th>
                        <th align="left" class="th_border cell">Check&nbsp;in </th>
                        <th align="left" class="th_border cell">Check&nbsp;Out </th>
                        <!-- <th align="left" class="th_border cell">Rekening </th> -->
                        <th align="left" class="th_border cell">Harga</th>
                        <!-- <th align="left" class="th_border cell">Metode&nbsp;Transaksi </th>
                        <th align="left" class="th_border cell">Dewasa </th>
                        <th align="left" class="th_border cell">Anak&nbsp;Anak </th> -->
                        <th align="left" class="th_border cell">Hari</th>
                        <th align="left" class="th_border cell">Disc</th>
                        <th align="left" class="th_border cell">Biaya Kamar</th>
                        <th align="left" class="th_border cell">Biaya Tambahan In</th>
                        <th align="left" class="th_border cell">Biaya Tambahan Out</th>
                        <th align="left" class="th_border cell">Total</th>
                        <th align="left" class="th_border cell">Status</th>

                    </tr>

                    <tbody>
                        <?php
                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;
                        $id_hotel = decrypt($_COOKIE['id_hotel']);
                        if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                            $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                            $isi = mysql_real_escape_string($_GET['isi']);
                            $querytabel = "SELECT * FROM data_transaksi join data_pelanggan on data_transaksi.id_pelanggan =data_pelanggan.id_pelanggan where data_transaksi.$berdasarkan like '%$isi%'   order by data_transaksi.id_transaksi DESC LIMIT $startRow ,$dataPerPage";
                            $querypagination = "SELECT COUNT(*) AS total FROM data_transaksi join data_pelanggan on data_transaksi.id_pelanggan=data_pelanggan.id_pelanggan where data_transaksi.$berdasarkan like '%$isi%'";
                        } else {
                            $querytabel = "SELECT * FROM data_transaksi join data_pelanggan on data_transaksi.id_pelanggan=data_pelanggan.id_pelanggan  order by data_transaksi.id_transaksi DESC LIMIT $startRow ,$dataPerPage ";
                            $querypagination = "SELECT COUNT(*) AS total FROM data_transaksi join data_pelanggan on data_transaksi.id_pelanggan=data_pelanggan.id_pelanggan  ";
                        }
                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) {
                        ?>
                            <tr class="event2">


                               <td align="center" width="50">&nbsp;&nbsp;<?php $no = (($no + 1));
                                                                            echo $no; ?></td>
                                <td align="left"><a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_transaksi']); ?>" class='mx-2'><?php echo $data['id_transaksi']; ?></a></td>
                                <td align="left"><?php echo ucwords(baca_database("", "nama", "select * from data_pelanggan where id_pelanggan='$data[id_pelanggan]'"))  ?></td>
                                <td align="left"><?php echo baca_database("", "no_kamar", "select * from data_kamar where id_kamar='$data[id_kamar]'")  ?></td>

                                <td align="left"><?php

                                                    echo format_indo($data['waktu_checkin']) ?></td>
                                <td align="left"><?php

                                                    echo format_indo($data['waktu_checkout']) ?></td>
                                <!-- <td align="left"><?php echo $data['no_rekening']; ?></td> -->
                                <td align="left"><?php
                                                    $tgl_checkin = new DateTime($data['waktu_checkin']);
                                                    $tgl_checkout = new DateTime($data['waktu_checkout']);
                                                    $selisih = $tgl_checkin->diff($tgl_checkout);
                                                    $jumlah_hari = $selisih->days;
                                 $id_kamar = $data['id_kamar'];
                                    $harga_harian = baca_database("", "harga_harian", "select * from data_kamar where id_kamar='$id_kamar'");
                                    $harga_bulanan = baca_database("", "harga_bulanan", "select * from data_kamar where id_kamar='$id_kamar'");
                                    if($jumlah_hari >=30){
                                        $jumlah_bulan = floor($jumlah_hari/30);
                                        $harga_fix=$harga_bulanan;
                                    }else{
                                        $harga_fix=$harga_harian;
                                    }
                                 echo rupiah($harga_fix); ?></td>
                                <!-- <td align="left"><?php echo $data['metode_transaksi']!=='-'?baca_database("", "metode_pembayaran", "select * from data_metode_pembayaran where id_metode_pembayaran='{$data['metode_transaksi']}'"):'-'; ?></td> -->
                                <!-- <td align="left"><?php echo $data['jumlah_dewasa']; ?></td>
                                <td align="left"><?php echo $data['jumlah_anak_anak']; ?></td> -->
                                <td align="left"><?php

                                                    echo $jumlah_hari; ?></td>
                                <td align="left"><?php echo $data['discount']; ?>%</td>
                                <td align="left">
                                    <?php if ($data['discount'] > 0) { ?>
                                        <strike><?php 
                                            if($jumlah_hari>=30){
                                                $jumlah_bulan=floor($jumlah_hari/30);
                                                $data_harga = $jumlah_bulan * $harga_bulanan;
                                            }else{
                                                $data_harga = $jumlah_hari * $harga_harian;
                                            }
                                            echo rupiah($data_harga); ?></strike>

                                    <?php } ?>
                                    <?php
    
                                    echo rupiah($data['harga']);                                ?>
                                </td>
                                <td align="left"><?php echo rupiah($data['biaya_tambahan_checkin']); ?></td>
                                <td align="left"><?php echo rupiah($data['biaya_tambahan_checkout']); ?></td>
                                <td align="left"><?php echo rupiah($data['harga']+$data['biaya_tambahan_checkin']+$data['biaya_tambahan_checkout']); ?></td>

                                <?php if ($data['status_transaksi'] == "Selesai") { ?>

                                    <td align="left" style="    background-color: #f3ffe6;"><?php echo $data['status_transaksi']; ?></td>
                                <?php } else if ($data['status_transaksi'] == "Lunas") { ?>
                                    <td align="left" style="    background-color: #fffee6;"><?php echo $data['status_transaksi']; ?></td>

                                <?php } else { ?>
                                    <td align="left" style="    background-color: #ffe8e8;"><?php echo $data['status_transaksi']; ?></td>
                                <?php } ?>

                            </tr>
                        <?php } ?>
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
</style>
<script>
    function pencarian() {
        const formHTML = `
    <form id="formCariSweet" style="text-align: left; font-size: 14px;">
      <div style="margin-bottom: 8px;">
         <div style="display: flex; gap: 10px; align-items: left; margin-bottom: 12px;">
        <label for="Berdasarkan" style="flex: 0 0 100px; text-align: right;">Berdasarkan</label>
        <select id="Berdasarkan" name="Berdasarkan" style="flex: 1; height: 32px; padding: 4px; font-size: 13px; border-radius: 4px; border: 1px solid #ccc;">
          <?php
            $sql = "desc data_transaksi";
            $result = @mysql_query($sql);
            while ($row = @mysql_fetch_array($result)) {

                echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
            }
            ?>
        </select>
      </div>

      <div style="display: flex; gap: 10px; align-items: left;">
        <label for="isi" style="flex: 0 0 100px; text-align: right;">Kata Kunci</label>
        <input type="text" id="isi" name="isi" style="flex: 1; height: 32px; padding: 4px; font-size: 13px; border-radius: 4px; border: 1px solid #ccc;" required>
      </div>
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
                denyButton: 'swal-cancel-btn' // sama class dengan cancel agar sama warna
            },
            preConfirm: () => {
                const berdasarkan = document.getElementById('Berdasarkan').value;
                const isi = document.getElementById('isi').value;

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