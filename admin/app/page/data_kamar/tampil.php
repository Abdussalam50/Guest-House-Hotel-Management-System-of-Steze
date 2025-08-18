<div style="display: flex; justify-content: flex-end; margin-top: -59px; gap: 8px;">
    <a href="index.php?input=tambah" class="btn btn-sm btn-secondary fw-semibold">
        <i class='fas fa-add text-black'></i> Input Kamar Baru
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
                <table <?php
                        $id_hotel = decrypt($_COOKIE['id_hotel']);
                        tabel(100, '%', 1, 'left'); ?>>
                    <tr style="background-color: #f9f9f9;">

                        <th></th>
                        <!--h <th>Id Kamar </th> h-->
                        <th align="left" class="th_border cell">Nomor Kamar </th>
                        <th align="left" class="th_border cell">Nama Hotel</th>
                        <th align="left" class="th_border cell">Kapasitas </th>
                        <th align="left" class="th_border cell">Harga Harian </th>
                        <?php if (pengaturan_aplikasi('transaksi_bulanan') == "aktif") { ?>
                            <th align="left" class="th_border cell">Harga Bulanan </th>
                        <?php } ?>

                        <th align="left" class="th_border cell">Tipe Kamar </th>
                        <th align="left" class="th_border cell">Status Kamar </th>

                    </tr>

                    <tbody>
                        <?php
                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;

                        if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                            $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                            $isi = mysql_real_escape_string($_GET['isi']);
                            $querytabel = "SELECT * FROM data_kamar where $berdasarkan like '%$isi%' AND id_hotel='$id_hotel'";
                            $querypagination = "SELECT COUNT(*) AS total FROM data_kamar where $berdasarkan like '%$isi%' AND id_hotel='$id_hotel'";
                        } else {
                            $querytabel = "SELECT * FROM data_kamar  WHERE  id_hotel='$id_hotel' ";
                            $querypagination = "SELECT COUNT(*) AS total FROM data_kamar WHERE id_hotel='id_hotel'";
                        }
                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) {
                        ?>
                            <tr class="event2">

                                <!-- <td class="th_border cell" align="left" width="200">
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_kamar']); ?>" class='mx-2'>
                                                    <i class="fa fa-info text-primary"></i> Detail
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_kamar']); ?>" class='mx-2'>
                                                    <i class="fa fa-edit text-primary"></i> Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_kamar']); ?>" class='mx-2'>
                                                    <i class="fa fa-remove text-primary"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td> -->

                                <td align="center" width="50"><?php $no = (($no + 1));
                                                                echo $no; ?></td>
                                <!--h <td align="left"><?php echo $data['id_kamar']; ?></td> h-->
                                <td align="left">
                                    <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_kamar']); ?>" class='mx-2'>
                                        Kamar <?php echo $data['no_kamar']; ?>
                                    </a>
                                </td>
                                <td align="left"><?php echo baca_database("", "nama", "select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
                                <td align="left"><?php echo $data['kapasitas']; ?></td>
                                <td align="left"><?php echo rupiah($data['harga_harian']); ?></td>

                                <?php if (pengaturan_aplikasi('transaksi_bulanan') == "aktif") { ?>
                                    <td align="left"><?php echo rupiah($data['harga_bulanan']); ?></td>
                                <?php } ?>

                                <td align="left"><?php echo baca_database("", "tipe_kamar", "select * from data_tipe_kamar where id_tipe_kamar='$data[id_tipe_kamar]'")  ?></td>


                                <?php if ($data['status_kamar'] == "Kosong") { ?>

                                    <td align="left" style="    background-color: #f3ffe6;"><?php echo $data['status_kamar']; ?></td>
                                <?php } else if ($data['status_kamar'] == "Lunas") { ?>
                                    <td align="left" style="    background-color: #fffee6;"><?php echo $data['status_kamar']; ?></td>

                                <?php } else { ?>
                                    <td align="left" style="    background-color: #ffe8e8;"><?php echo $data['status_kamar']; ?></td>
                                <?php } ?>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


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
            $sql = "desc data_kamar";
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