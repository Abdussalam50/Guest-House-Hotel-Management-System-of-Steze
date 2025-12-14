<?php

if (isset($_GET['id_hotel'])) {
    $id_hotel = decrypt($_GET['id_hotel']);
} else {
    $id_hotel = isset($_COOKIE['id_hotel']) ? decrypt($_COOKIE['id_hotel']) : '';
}

if ($id_hotel == "") {
    include 'tampil_admin.php';
    die();
} elseif (isset($_COOKIE['operasional'])) {
    // $akses=baca_database("","value","select * from data_pengaturan_aplikasi where nama_pengaturan='pengaturan_oleh_operasional'")
?>
    <script>
        alert('Perhatian! \nAnda tidak dapat mengakses dan menggunakan menu pelanggan\n');
        window.location.href = '../../index.php'
    </script>
<?php
}
?>

<div style="display: flex; justify-content: flex-end; margin-top: -59px; gap: 8px;">

    <?php if ($_COOKIE['id_hotel'] == "") {
    ?>

        <a href="index.php" class=" btn btn-sm btn-secondary fw-semibold">
            <i class='fas fa-backward text-black'></i> Kembali
        </a>
        <a onclick="pencarian()" class="btn btn-sm btn-danger fw-semibold">
            <i class='fas fa-search text-white'></i> Pencarian
        </a>
    <?php
    } else { ?>
        <a href="../data_transaksi/index.php?input=cetak" class="btn btn-sm btn-secondary fw-semibold">
            <i class='fas fa-print text-black'></i> Report Transaksi
        </a>
        <a href="../data_transaksi/index.php?input=cetak_cashflow&id_hotel=<?php echo $id_hotel ?>" class=" btn btn-sm btn-secondary fw-semibold">
            <i class='fas fa-file-text text-black'></i> Cashflow
        </a>
        <a href="../grafik_rekapitulasi/index.php" class=" btn btn-sm btn-secondary fw-semibold">
            <i class='fas fa-chart-pie text-black'></i> Grafik
        </a>
        <a onclick="pencarian()" class="btn btn-sm btn-danger fw-semibold">
            <i class='fas fa-search text-white'></i> Pencarian
        </a>

    <?php } ?>
</div>
<br>

<div class="content-widgets gray">
    <div class="widget-container">
        <div class="content-box">
            <div style="overflow-x:auto;">
                <table <?php tabel(100, '%', 1, 'left'); ?> border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr style="background-color: #f9f9f9; text-align:center;">
                            <th>No</th>
                            <th>Kode&nbsp;Transaksi</th>
                            <th>Pelanggan</th>
                            <th>Kamar</th>
                            <th>Jenis&nbsp;Trx</th>
                            <th>Check&nbsp;In</th>
                            <th>Check&nbsp;Out</th>
                            <th>Harga</th>
                            <th>Jumlah&nbsp;</th>
                            <th>Harga&nbsp;Kamar&nbsp;Total</th>
                            <th>Diskon</th>
                            <th>Potongan</th>
                            <th>Tambahan&nbsp;In</th>
                            <th>Tambahan&nbsp;Out</th>
                            <th>Dp&nbsp;Booking</th>
                            <th>Deposit</th>
                            <th>Pajak</th>
                            <th>Grand&nbsp;Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = ($page - 1) * $dataPerPage;
                        $basepagination = "SELECT COUNT(*) AS total FROM data_transaksi WHERE id_hotel='$id_hotel'";
                        // Query dengan filter jika ada
                        $where_clauses = [];
                        if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                            $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                            $isi = mysql_real_escape_string($_GET['isi']);
                            $where_clauses[] = "$berdasarkan LIKE '%$isi%'";
                            $querypagination = $basepagination . " AND $berdasarkan LIKE '%$isi%'";
                        }

                        // Add id_hotel filter only if it exists and is not empty
                        if (!empty($id_hotel)) {
                            $where_clauses[] = "dt.id_hotel='$id_hotel'";
                            $querypagination = $basepagination;
                        }

                        // Build the WHERE clause
                        $where_clause = !empty($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) : '';

                        $querytabel = "SELECT dt.*,dp.nama
                                       FROM data_transaksi dt
                                       JOIN data_pelanggan dp ON dt.id_pelanggan = dp.id_pelanggan
                                       $where_clause
                                       ORDER BY dt.id_transaksi DESC 
                                       LIMIT " . (($page - 1) * $dataPerPage) . ", $dataPerPage";


                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) {
                            $no++;

                            $id_transaksi = $data['id_transaksi'];

                            $jenis_group = "non_group";
                            if (json_check($data['no_kamar'])) {
                                $jenis_group = "group";
                            }

                            $jenis_transaksi = $data['jenis_transaksi'];
                            $harga_per_hari = $data['harga_kamar_harian'];
                            $harga_per_bulan = $data['harga_kamar_bulanan'];
                            $tgl_checkin = new DateTime($data['waktu_checkin']);
                            $tgl_checkout = new DateTime($data['waktu_checkout']);
                            $jumlah_hari = $data['jumlah_hari'];
                            $harga_kamar_total = 0;


                            if ($jenis_group == "group") {
                                $query_kamar = "SELECT * FROM data_transaksi_list_kamar 
                                            WHERE id_transaksi = '$id_transaksi' 
                                            ORDER BY waktu DESC ";

                                $proses_kamar = mysql_query($query_kamar);
                                while ($datakamar = mysql_fetch_array($proses_kamar)) {

                                    if ($jenis_transaksi == "harian") {
                                        $harga_kamar_total =  $harga_kamar_total + ($datakamar['harga_kamar_harian'] * $jumlah_hari);
                                    } else {
                                        $harga_kamar_total =  $harga_kamar_total +  ($datakamar['harga_kamar_bulanan'] * $jumlah_hari);
                                    }
                                }
                            } else {

                                if ($jenis_transaksi == "harian"){
                                    $harga_kamar_total = $harga_per_hari * $jumlah_hari;
                                } else {
                                    $harga_kamar_total = $harga_per_bulan * $jumlah_hari;
                                }
                            }



                        ?>
                            <tr class="event2" style="text-align:left;">
                                <td><?= $no ?></td>
                                <td align="left"                                                                 <?php
                                                                    if($data['status_transaksi']=='Lunas'){
                                                                        echo "onclick='ubah_status(this)'";
                                                                    }
                                                                
                                                                ?>><a id='id_table_transaksi' href="<?php index(); ?>?input=detail&id_trx=<?= ($data['id_transaksi']); ?>">
                                        <?= $data['id_transaksi']; ?></a>
                                </td>
                                <td align="left"><?= ucwords($data['nama']); ?></td>
                                <td align="left"><?= json_preview_br($data['no_kamar']); ?></td>
                                <td align="left"><b><?= ucwords($jenis_transaksi); ?> <?php if ($jenis_group == "group") {
                                                                                            echo "(Group)";
                                                                                        }
                                                                                      ?></b></td>
                                <td><?= str_replace(" ", "&nbsp;", format_indo($data['waktu_checkin'])); ?></td>
                                <td><?php
                                    $today = strtotime(date('Y-m-d'));
                                    $checkout = strtotime($data['waktu_checkout']);
                                    $hari_tersisa = ($checkout - $today) / (60 * 60 * 24);

                                    if ($hari_tersisa > 0) {
                                        $hari_tersisa = ceil($hari_tersisa);
                                        if ($data['status_transaksi'] == 'Selesai') {
                                            echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
                                        } else {
                                            echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']))
                                                . "<b style='color:red'>&nbsp;{$hari_tersisa}&nbsp;hari&nbsp;lagi</b>";
                                        }
                                    } elseif ($hari_tersisa == 0) {
                                        if ($data['status_transaksi'] == 'Selesai') {
                                            echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
                                        } else {
                                            // Hari ini
                                            echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']))
                                                . "<b style='color:green'>&nbsp;Hari ini</b>";
                                        }
                                    } else {
                                        // Lewat
                                        echo str_replace(" ", "&nbsp;", format_indo($data['waktu_checkout']));
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    if ($jenis_transaksi == "harian") {
                                        echo  json_preview_rupiah_br($harga_per_hari);
                                    } else {
                                        echo  json_preview_rupiah_br($harga_per_bulan);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($jenis_transaksi == "harian") {
                                        echo  $jumlah_hari . " Hari";
                                    } else {
                                        echo  $jumlah_hari . " Bulan";
                                    }
                                    ?>

                                </td>
                                <td><?= rupiah($harga_kamar_total); ?></td>
                                <td><?= $data['discount']; ?>%</td>
                                <td><?= rupiah($data['potongan_harga']); ?></td>
                                <td><?= rupiah($data['biaya_tambahan_checkin']); ?></td>
                                <td><?= rupiah($data['biaya_tambahan_checkout']); ?></td>
                                <td>

                                    <?php if (substr($id_transaksi, 0, 2) === "BO") { ?>
                                        <font color="blue">
                                            Rp<?php echo rupiah_format(baca_database("", "nominal_bayar", "select * from data_booking where id_transaksi='$id_transaksi'")); ?>
                                        </font>
                                    <?php } else {
                                        echo "Rp0";
                                    } ?>


                                </td>
                                <td>
                                    <font color="red">
                                        <?= rupiah($data['nominal_deposit']); ?>
                                    </font>
                                </td>
                                <td><?= ($data['persentase_pajak']); ?>%</td>
                                <td><?= rupiah($data['total_bayar']); ?></td>



                                <td style="background-color: <?php
                                                                if ($data['status_transaksi'] == 'Selesai') {
                                                                    echo '#f3ffe6';
                                                                } elseif ($data['status_transaksi'] == 'Lunas') {
                                                                    echo '#fffee6';
                                                                } else {
                                                                    echo '#ffe8e8';
                                                                } ?>"
                                                                >
                                    <?= $data['status_transaksi']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <?php
            //perlu perbaikan handle paginationnya
            if ($_COOKIE['id_hotel'] == "") {
            } else {
                Pagination($page, $dataPerPage, $querypagination);
            }
            ?>


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
                denyButton: 'swal-cancel-btn'
            },
            preConfirm: () => {
                const berdasarkan = document.getElementById('Berdasarkan').value;
                const isi = document.getElementById('isi').value;

                if (!berdasarkan || !isi) {
                    Swal.showValidationMessage('Semua field wajib diisi');
                    return false;
                }


                <?php
                if (isset($_GET['id_hotel'])) {
                ?>
                    window.location.href = `?Berdasarkan=${encodeURIComponent(berdasarkan)}&isi=${encodeURIComponent(isi)}&id_hotel=<?php echo $_GET['id_hotel']; ?>&nama_hotel=<?php echo $_GET['nama_hotel']; ?>`;
                <?php
                } else {
                ?>
                    window.location.href = `?Berdasarkan=${encodeURIComponent(berdasarkan)}&isi=${encodeURIComponent(isi)}`;
                <?php
                }
                ?>


            },
            preDeny: () => {
                window.location.href = 'index.php?id_hotel=<?php echo $_GET['id_hotel']; ?>&nama_hotel=<?php echo $_GET['nama_hotel']; ?>';
            }
        });
    }

    function ubah_status(id){
       
        const parent=id;
        const id_transaksi=parent.querySelector("a").innerText;
        console.log(id_transaksi);
        Swal.fire({
            title:'Ubah Status',
            text:'Peringatan! fitur ini hanya dapat digunakan oleh developer',
            html:`
            <div class="container">
    <form action="" method="post" id='form_status'>
        <input type="hidden" name="id_transaksi" value='${id_transaksi}'>
        <label class='form-label'>Status Transaksi</label>
        <select name="status_transaksi" id="status_transaksi" class="form-control mb-3">
            <?php
                combo_enum("data_transaksi","status_transaksi","");
            ?>
        </select>
        <label class='form-label'>Password</label>
        <input type="password" name="password" id="password"placeholder="password" class='form-control mb-3'>
        <button type="button" id="submit_status" class='btn btn-danger'>Ubah Status</button>
    </form>
</div>
            `,
            showConfirmButton:false,
            showCancelButton:false,
            didOpen:()=>{
        document.getElementById('submit_status').addEventListener('click',function(){
            const formdata=new FormData(document.getElementById('form_status'));
             console.log([...formdata.entries()]);

             fetch("ubah_status.php",{
                method:'POST',
                body:formdata
             })
             .then(response=>response.json())
             .then(data=>{
                console.log(data);
                if(data.response=='true'){
                    Swal.fire({
                        title:'Proses Berhasil',
                        text:'Status berhasil diubah!',
                        showConfirmButton:false,
                        showCancelButton:false,
                        icon:'success'
                    })
                }else{
                    Swal.fire({
                        title:'Proses Gagal',
                        text:'Status gagal diubah!',
                        showConfirmButton:false,
                        showCancelButton:false,
                        icon:'error'
                    })
                }
            })
             .catch(error=>console.error(error))
        })                
            }
        })
    }


</script>
