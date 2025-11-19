<!DOCTYPE html>
<html lang="en">

<?php if ($read != "detail") { ?>
    <?php include '../../../include/all_include.php'; ?>
<?php } ?>
<?php

try {

    // Ambil id_transaksi dari GET atau JSON body
    $id_transaksi = isset($_GET['id_trx'])
        ? mysql_real_escape_string($_GET['id_trx'])
        : json_decode(file_get_contents('php://input'), true)['id_trx'];

    // Ambil data transaksi sekaligus
    $datas = mysql_fetch_array(mysql_query("SELECT * FROM data_transaksi WHERE id_transaksi='$id_transaksi'"));
    $deposit = rupiah_format($datas['nominal_deposit'] == null ? 0 : $datas['nominal_deposit']);
    // Ambil data hotel
    $id_hotel = baca_database("", "id_hotel", "SELECT * FROM data_transaksi WHERE id_transaksi='$id_transaksi'");
    $hotel = mysql_fetch_array(mysql_query("SELECT * FROM data_hotel WHERE id_hotel='$id_hotel'"));
    $alamat = $hotel['alamat'];
    $cabang = $hotel['nama'];
    $no_telepon_arr = explode(",", $hotel['no_telepon']);
    $no_telepon = $no_telepon_arr[0];
    // Ambil data pelanggan
    $nama = ucwords(baca_database("", "nama", "SELECT * FROM data_pelanggan WHERE id_pelanggan='{$datas['id_pelanggan']}'"));

    // Ambil data kamar & tipe kamar
    $kamar = 'Kamar ' . baca_database("", "no_kamar", "SELECT * FROM data_kamar WHERE id_kamar='{$datas['id_kamar']}'");
    $id_tipe_kamar = baca_database("", "id_tipe_kamar", "SELECT * FROM data_kamar WHERE id_kamar='{$datas['id_kamar']}'");
    $tipe_kamar = baca_database("", "tipe_kamar", "SELECT * FROM data_tipe_kamar WHERE id_tipe_kamar='$id_tipe_kamar'");

    // Format waktu
    $waktu_checkin = format_indo($datas['waktu_checkin']);
    $waktu_checkout = format_indo($datas['waktu_checkout']);
    $tanggal = format_indo(date("Y-m-d"));

    // Admin
    $admin = isset($_GET['username'])
        ? baca_database("", "nama", "SELECT * FROM data_admin WHERE username='{$_GET['username']}'")
        : $datas['nama_admin'];

    // Pembayaran & tambahan
    $metode_pembayaran = $datas['metode_pembayaran'];
    $jumlah_dewasa = $datas['jumlah_dewasa'];
    $jumlah_anak_anak = $datas['jumlah_anak_anak'];

    $waktu_transaksi = $datas['waktu_transaksi'];
    $harga_kamar_bulanan = $datas['harga_kamar_bulanan'];
    $total_harga_kamar = $datas['total_harga_kamar'];
    $jumlah_hari = $datas['jumlah_hari'];
    $status_transaksi = $datas['status_transaksi'];
    $potongan_harga = $datas['potongan_harga'];
    $persentase_pajak = $datas['persentase_pajak'];
    $pajak = $datas['pajak'];

    if (empty($datas['biaya_tambahan_checkin'])) {
        $biaya_tambahan_checkin = 0;
    } else {
        $biaya_tambahan_checkin = $datas['biaya_tambahan_checkin'];
    }

    if (empty($datas['biaya_tambahan_checkout'])) {
        $biaya_tambahan_checkout = 0;
    } else {
        $biaya_tambahan_checkout = $datas['biaya_tambahan_checkout'];
    }


    $discount = $datas['discount'];
    $disc_nominal = ($total_harga_kamar * $discount) / 100;
    $harga_setelah_disc = $total_harga_kamar - $disc_nominal;
    $grand_total = $datas['total_bayar'];


    $nominal_bayar = ($datas['nominal_bayar']);
    if ($nominal_bayar == 0) {
        $nominal_bayar = $grand_total;
    }
    $kembalian = $datas['jumlah_kembalian'];
    $sisa_pembayaran = number_format($datas['sisa_pembayaran'] == null ? 0 : $datas['sisa_pembayaran']);

    $catatan_kaki = pengaturan_aplikasi("catatan_kaki_nota");
    $tampilkan_catatan_kaki_nota = pengaturan_aplikasi("tampilkan_catatan_kaki_nota");
    $catatan_kaki = str_replace("{nama_hotel}",  $judul . " " . ucwords($cabang), $catatan_kaki);
    $catatan_kaki = str_replace("{telepon_hotel}",  $telepon, $catatan_kaki);
    $catatan_kaki = str_replace("{cs}",  $no_telepon, $catatan_kaki);

    //informasi deposit



?>

    <?php if ($read != "detail") { ?>
        <!DOCTYPE html>

        <html id="print-page" class="display">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title><?php echo $judul; ?> <?php echo ucwords($cabang) ?> </title>
            <link rel="stylesheet" href="./notaA4/admin.css">
            <link rel="stylesheet" href="./notaA4/style.css">
            <link rel="stylesheet" href="./notaA4/bootstrap.min.css">
            <link rel="stylesheet" href="./notaA4/style.min.css">
            <link rel="stylesheet" href="./notaA4/font-awesome.min.css">
            <style> </style>

            <link rel="icon" href="../../../data/image/logo/steze-2.png" type="image/x-icon">
            <script src="./notaA4/jquery-1.10.2.min.js.download"></script>
            <script src="./notaA4/bootstrap.min.js.download"></script>
            <script src="./notaA4/accounting.min.js.download"></script>
            <script src="./notaA4/cssmenu.js.download"></script>
            <script src="./notaA4/main-script.js.download"></script>
            <!-- Font Awesome CDN -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php } ?>
        <style>
            @media print {

                .no-print,
                .no-print * {
                    display: none !important;
                }

                body {
                    padding: 0 !important;
                    border: 0 none !important;
                }
            }

            img {
                z-index: 100;
                position: relative;
            }
        </style>
        </head>

        <body id="form-rekap-pembayaran" style="">

            <style>
                body {
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 11pt;
                    color: #333;
                    margin: 20px;

                }

                .container {
                    width: 100%;
                    margin: 0 auto;
                    border-bottom: 2px solid #c02b27;
                    padding-bottom: 10px;
                    margin-bottom: 10px;
                }

                .container table {
                    width: 100%;
                }

                .container h1 {
                    font-size: 22px;
                    color: #c02b27;
                    margin: 0;
                }

                .container h3 {
                    margin: 5px 0 0 0;
                    font-size: 15px;
                    font-weight: normal;
                }

                .content table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .content th {
                    text-align: left;
                    background: #f2f2f2;
                    padding: 8px;
                    border: 1px solid #ccc;
                }

                .content td {
                    padding: 8px;
                    border: 1px solid #ccc;
                }

                .content tbody td:first-child {
                    font-weight: bold;

                }

                .footer {
                    width: 100%;
                    margin-top: 10px;
                    display: flex;
                    justify-content: space-between;
                    font-size: 12px;
                    margin-left: auto
                }

                .footer .right {
                    text-align: right;
                }

                #table-bottom {
                    width: 100%;
                    border: none !important;
                    margin-top: 20px;
                    border: collapse;
                }
            </style>
            <div class="container" style="padding-left: 0px;">

                <?php if ($read != "detail") { ?>
                    <table>
                        <tr>

                            <td width="60%" align="left">
                                <h1><?php echo $judul; ?> <?php echo ucwords($cabang) ?></h1>
                                <h6><?php echo $alamat ?></h6>
                                <h6>Telp: <?php echo $no_telepon ?> | Email: <?php echo $email ?></h6>
                            </td>
                            <td width="20%" align="right"><img src="<?php echo $logo_laporan1 ?>" alt="Logo Hotel" width="70"></td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
            <div class="row" style="display:flex;margin-right: 0px;margin-left: 0px;">
                <table style="border:collapse; width:50%;border:none;margin-bottom:10px;font-size:12px">
                    <tr>
                        <td style='font-weight:700;'>Tanggal</td>
                        <td>:</td>
                        <td><?php echo format_indo($waktu_transaksi) ?> </td>
                    </tr>

                    <tr>
                        <td style='font-weight:700;'>Pelanggan</td>
                        <td>:</td>
                        <td><?php echo $nama ?></td>
                    </tr>
                    <tr>
                        <td style='font-weight:700;'>Jumlah Tamu</td>
                        <td>:</td>
                        <td><?php echo $jumlah_dewasa ?> Dewasa
                            <?php if ($jumlah_anak_anak > 0) {
                                echo ", " . $jumlah_anak_anak . "Anak-anak";
                            } ?>
                        </td>
                    </tr>
                </table>
                <table style="border:collapse; width:50%;border:none;margin-bottom:10px;margin-left:auto;font-size:12px">
                    <tr>
                        <td style='font-weight:700;'>Kode Transaksi</td>
                        <td>:</td>
                        <td>&nbsp;<?php echo $id_transaksi ?></td>
                    </tr>
                    <tr>
                        <td style='font-weight:700;'>Status Transaksi</td>
                        <td>:</td>
                        <td>&nbsp;<?php if ($status_transaksi == "Belum Lunas") {
                                        echo "Belum Lunas";
                                    } else {
                                        echo "Lunas";
                                    }
                                    ?></td>
                    </tr>
                    <tr>
                        <td style='font-weight:700;'>Resepsionis</td>
                        <td>:</td>
                        <td>&nbsp;<?php echo ucwords($admin) ?></td>
                    </tr>



                </table>
            </div>
            <div class="content">

                <div class="content" style='font-size:12px'>

                    <table>
                        <thead>
                            <tr>

                                <th>No Kamar</th>
                                <th>Tipe</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Jumlah Bulan</th>
                                <th>Harga/Bulan</th>

                                <th>Sub Total</th>




                            </tr>
                        </thead>
                        <tbody>
                            <tr>


                                <td><?php echo $kamar ?></td>
                                <td><?php echo $tipe_kamar ?></td>
                                <td><?php echo $waktu_checkin ?></td>
                                <td><?php echo $waktu_checkout ?></td>
                                <td><?php echo $jumlah_hari ?> Bulan</td>

                                <td>Rp<?php echo rupiah_format($harga_kamar_bulanan); ?></td>
                                <td>Rp<?php echo rupiah_format($total_harga_kamar); ?></td>


                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>

                </div>


                <!-- Footer Nota -->

            </div>
            <div id='box' style='display:flex;width:100%;'>

                <div class="footer">
                    <div class="left">

                        <?php if ($read != "detail") { ?>

                            <p style="margin-bottom: 3px; margin-top: 14px;font-size:12px"><b>Jambi, <?php echo format_indo(date("Y-m-d")) ?></b></p>
                            <p style="margin-bottom: 3px; margin-top: 3px;font-size:12px">Hormat Kami,</p>
                            <br><br>
                            <p style="margin-bottom: 3px; margin-top: 3px;font-size:12px">( <?php echo ucwords($admin) ?> )</p>


                            <?php if ($tampilkan_catatan_kaki_nota == "1") { ?>
                                <div style="border:1px solid #ccc; padding:10px;  margin-top: 10px;  width: 90%; font-size:11px; background:#f9f9f9;">

                                    <?php
                                    echo $catatan_kaki;
                                    ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>


                <table id="table-bottom" style="width:60%; float:right; border:none; font-size:12px">

                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold;">Harga Kamar</td>
                        <td style='font-weight:700'>:</td>
                        <td style="text-align:right; padding:2px;">Rp<?php echo rupiah_format($total_harga_kamar); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold;">Diskon <?php echo $discount; ?>%</td>
                        <td style='font-weight:700'>:</td>
                        <td style="text-align:right; padding:2px;"> Rp<?php echo rupiah_format($disc_nominal); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold;">Potongan Harga</td>
                        <td style='font-weight:700'>:</td>
                        <td style="text-align:right; padding:2px;"> <?php echo 'Rp' . rupiah_format($potongan_harga) ?></td>
                    </tr>
                    <?php if ($biaya_tambahan_checkin > 0) { ?>
                        <tr>
                            <td style="text-align:left; padding:2px; font-weight:bold;">Biaya Tambahan Check-in</td>
                            <td style='font-weight:700'>:</td>
                            <td style="text-align:right; padding:2px;"><?php echo 'Rp' . rupiah_format($biaya_tambahan_checkin) ?></td>
                        </tr>
                    <?php } ?>

                    <?php if ($biaya_tambahan_checkout > 0) { ?>
                        <tr>
                            <td style="text-align:left; padding:2px; font-weight:bold;">Biaya Tambahan Check-out</td>
                            <td style='font-weight:700'>:</td>
                            <td style="text-align:right; padding:2px;"><?php echo 'Rp' . rupiah_format($biaya_tambahan_checkout) ?></td>
                        </tr>
                    <?php } ?>


                    <?php if ($biaya_tambahan_checkin == 0 && $biaya_tambahan_checkout == 0) { ?>
                        <tr>
                            <td style="text-align:left; padding:2px; font-weight:bold;">Tambahan Biaya </td>
                            <td style='font-weight:700'>:</td>
                            <td style="text-align:right; padding:2px;">Rp0</td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold;">Pajak <?php echo $persentase_pajak; ?>%</td>
                        <td style='font-weight:700'>:</td>
                        <td style="text-align:right; padding:2px;">Rp<?php echo rupiah_format($pajak); ?></td>
                    </tr>


                    <!-- Baris total dibuat tegas -->
                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold; border-top:2px solid #000; border-bottom:2px solid #000;">Grand Total</td>
                        <td style='font-weight:700; border-top:2px solid #000; border-bottom:2px solid #000'>:</td>
                        <td style="text-align:right; padding:2px; font-weight:bold; border-top:2px solid #000; border-bottom:2px solid #000;"><?php echo 'Rp' . rupiah_format($grand_total) ?></td>
                    </tr>


                    <?php if (substr($id_transaksi, 0, 2) === "BO") { ?>
                        <tr>
                            <td style="text-align:left;padding:2px;font-weight:bold;color:#2196f3">DP Booking</td>
                            <td style='font-weight:700;color:#2196f3'>:</td>
                            <td style="text-align:right;padding:2px;color:#2196f3">Rp <?php echo rupiah_format(baca_database("", "nominal_bayar", "select * from data_booking where id_transaksi='$id_transaksi'")); ?></td>
                        </tr>
                    <?php } ?>


                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold;color:#c02b27">Deposit</td>
                        <td style='font-weight:700;color:#c02b27'>:</td>
                        <td style="text-align:right; padding:2px;color:#c02b27"><?php echo "Rp " . $deposit ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold;">Bayar</td>
                        <td style='font-weight:700'>:</td>
                        <td style="text-align:right; padding:2px;"><?php echo 'Rp' . rupiah_format($nominal_bayar) ?></td>
                    </tr>

                    <tr>
                        <td style="text-align:left; padding:2px; font-weight:bold;">Kembalian</td>
                        <td style='font-weight:700'>:</td>
                        <td style="text-align:right; padding:2px;"><?php echo 'Rp' . rupiah_format($kembalian) ?></td>
                    </tr>


                </table>






            </div>
            <?php
            if (!isset($_GET['id_trx'])) {
                $query_checkout = mysql_query("UPDATE data_kamar SET status_kamar='Kosong' WHERE id_kamar='$datas[id_kamar]'");
                $query_transaksi = mysql_query("UPDATE data_transaksi SET status_transaksi='Selesai' WHERE id_transaksi='$id_transaksi'");
                if ($query_checkout && $query_transaksi) {

                    echo json_encode('true');
                } else {
                    echo json_encode(mysql_error());
                }
            } else {
            ?>
                <script>
                    // window.print();
                </script>
        <?php
            }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        ?>
        <style>
            * {
                text-transform: none !important;
            }
        </style>

        <?php if ($read != "detail") { ?>
            <div id="print-area-btn" class="no-print" style="margin-top:20px; text-align:right;">
                <button id="btnPrint" class="btn btn-danger" style="margin-right:10px;">
                    <i class="fa fa-print"></i> Print
                </button>
                <button id="btnSelesai" class="btn btn-secondary">
                    Selesai
                </button>

            </div>
        <?php } ?>

        <script>
            document.getElementById('btnPrint').addEventListener('click', function() {
                window.print()
            });

            document.getElementById('btnSelesai').addEventListener('click', function() {
                // Jika ingin langsung selesai tanpa print
                window.location.href = '../home/index.php';
            });
        </script>


        <?php if ($read != "detail") { ?>
            <textarea class="hidden" name="script_map" cols="50" rows="10">W10=</textarea>
        <?php } ?>
        </body>

        </html>