<?php
include '../../../include/all_include.php';

$query = decrypt($_GET['q']);

include 'src/ModelGrafikLabaRugi.php';
include 'data/DataPenjualan.php';

$request_bulan = isset($_GET['bulan']) ? xss($_GET['bulan']) : date('m');
$request_tahun = isset($_GET['tahun']) ? xss($_GET['tahun']) : date('Y');

$model_grafik_laba_rugi = new \grafik_laba_rugi\ModelGrafikLabaRugi();

?>


<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


<!-- HEADER -->
<table border="0" style="width: 100%">
    <?php if (isset($_GET['export'])) {
        header("Content-type: application/fouce-download");
        header("Cache-Control: no-cache,must-revalidate");
        header("Content-disposition: attachment; filename=produk_terlaris.xls");
    } else {

        if (isset($_GET['preview'])) {
        } else {
    ?>

            <script>
                window.print();
            </script>
        <?php } ?>
        <tr>
            <td class="auto-style1" rowspan="3" width="101">
                <img alt="" src="<?php echo $logo_laporan1; ?>" width="100" height="100">
            </td>

            <td class="auto-style1">
                <center>
                    <h2 class="auto-style1"><?php echo $judul; ?></h2>
                </center>
            </td>

            <td class="auto-style1" rowspan="3" width="101">
                <img alt="" src="<?php echo $logo_laporan2; ?>" width="100" height="100">
            </td>
        </tr>
    <?php } ?>

    <tr>
        <td class="auto-style2">
            <center>
                <strong>LAPORAN LABA RUGI
                </strong>
            </center>
        </td>
    </tr>

    <tr>
        <td class="auto-style2"><?php echo $alamat; ?></td>
    </tr>
</table>
<!-- HEADER -->


<?php if (isset($_GET['grafik'])) { ?>

    <script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="http://code.highcharts.com/modules/exporting.js"></script>
    <?php if ($grafik == 1) { ?>
        <div id="grafik" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <div id="grafik_laba_rugi" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <?php } ?>

    <?php
    $nama_database = $database;
    $data_penjualan = $model_grafik_laba_rugi->get_total_penjualan($request_bulan, $request_tahun);
    $data_operasion = $model_grafik_laba_rugi->get_total_operasional($request_bulan, $request_tahun);
    ?>

    <script>
        function IDRFormatter(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        Highcharts.chart('grafik', {
            chart: {
                type: 'column',
                marginTop: 80
            },
            credits: {
                enabled: true
            },
            title: {
                text: '<b>GRAFIK LABA KOTOR <?= $model_grafik_laba_rugi->get_bulan_name($request_bulan) . " " . $tahun ?></b>'
            },
            //subtitle: {
            //    text: '<?php //echo $subtitle; 
                            ?>//'
            //},
            xAxis: {
                type: 'category',
                labels: {
                    rotation: 0,
                    align: 'center',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif',
                        align: 'center'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Jumlah (Rupiah)'
                },
                labels: {
                    formatter: function() {
                        if (this.value >= 1E6) {
                            return 'Rp.' + (this.value / 1000000).toFixed(0) + 'Jt';
                        }
                        return 'Rp' + this.value / 1000 + 'k';
                    }
                }
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                series: {
                    borderWidth: 1,
                    dataLabels: {
                        enabled: true,
                        format: '<span>Rp. {point.y:,.0f}</span>'
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                location.href = this.options.url;
                            }
                        }
                    }
                }
            },
            tooltip: {
                shared: true,
                crosshairs: true,
                headerFormat: '<span style="color:{point.color}">Grafik </span> {series.name}<br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>Rp. {point.y:,.0f}</b><br/>'
            },
            //DAFTAR NAMA TABEL YANG ADA
            "series": [{
                "name": "Laba Kotor",
                "colorByPoint": true,
                "data": [{
                        "name": "Total Modal",
                        "y": <?= $data_penjualan['total_modal'] ?>
                    },
                    {
                        "name": "Total Penjualan",
                        "y": <?= $data_penjualan['total_penjualan'] ?>
                    },
                    {
                        "name": "Laba Kotor",
                        "y": <?= $data_penjualan['total_laba_kotor'] ?>
                    },
                ]
            }, ],
        });

        Highcharts.chart('grafik_laba_rugi', {
            chart: {
                type: 'column',
                marginTop: 80
            },
            credits: {
                enabled: true
            },
            title: {
                text: '<b>GRAFIK LABA RUGI <?= $model_grafik_laba_rugi->get_bulan_name($request_bulan) . " " . $tahun ?></b>'
            },
            //subtitle: {
            //    text: '<?php //echo $subtitle; 
                            ?>//'
            //},
            xAxis: {
                type: 'category',
                labels: {
                    rotation: 0,
                    align: 'center',
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif',
                        align: 'center'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Jumlah (Rupiah)'
                },
                labels: {
                    formatter: function() {
                        if (this.value >= 1E6) {
                            return 'Rp.' + (this.value / 1000000).toFixed(0) + 'Jt';
                        }
                        return 'Rp' + this.value / 1000 + 'k';
                    }
                }
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                series: {
                    borderWidth: 1,
                    dataLabels: {
                        enabled: true,
                        format: '<span>Rp. {point.y:,.0f}</span>'
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                location.href = this.options.url;
                            }
                        }
                    }
                }
            },
            tooltip: {
                shared: true,
                crosshairs: true,
                headerFormat: '<span style="color:{point.color}">Grafik </span> {series.name}<br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>Rp. {point.y:,.0f}</b><br/>'
            },
            //DAFTAR NAMA TABEL YANG ADA
            "series": [{
                "name": "Laba Kotor",
                "colorByPoint": true,
                "data": [{
                        "name": "Total Laba Kotor",
                        "y": <?= $data_penjualan['total_laba_kotor'] ?>
                    },
                    {
                        "name": "Total Operasional",
                        "y": <?= $data_operasion['total_operasional'] ?>
                    },
                    {
                        "name": "Laba/Rugi",
                        "y": <?= $data_penjualan['total_laba_kotor'] - $data_operasion['total_operasional'] ?>
                    },
                ]
            }, ],
        });
    </script>

<?php } ?>

<?php if (isset($_GET['data'])) { ?>

    <style>
        td.bold {
            font-weight: bold;
        }

        td.untung {
            color: green;
        }

        td.rugi {
            color: red;
        }

        td.text18sp {
            font-size: 1.5em;
        }
    </style>

    <table width="100%" class="stat-table responsive table table-stats table-striped table-sortable table-bordered"
        border="1">
        <tr>
            <td align="center" class="bold">Total Modal</td>
            <td align="center"><?php rupiah($data_penjualan['total_modal']) ?></td>
        </tr>
        <tr>
            <td align="center" class="bold">Total Penjualan</td>
            <td align="center"><?php rupiah($data_penjualan['total_penjualan']) ?></td>
        </tr>
        <tr>
            <td align="center" class="bold">Total Laba Kotor</td>
            <td align="center"><?php rupiah($data_penjualan['total_penjualan'] - $data_penjualan['total_modal']) ?></td>
        </tr>
        <tr>
            <td align="center" class="bold">Total Biaya Operasional</td>
            <td align="center"><?php rupiah($data_operasion['total_operasional']) ?></td>
        </tr>
        <?php
        $laba_rugi = $data_penjualan['total_penjualan'] - $data_penjualan['total_modal'] - $data_operasion['total_operasional'];
        ?>
        <tr>
            <td align="center" class="bold">Total Laba/Rugi</td>
            <td align="center" class="bold text18sp <?= $laba_rugi > 0 ? 'untung' : 'rugi' ?>"><?php rupiah($laba_rugi) ?></td>
        </tr>
    </table>
    <br>
<?php } ?>


<!-- FOOTER -->
<p class="auto-style3"><?php echo $formatwaktu; ?>
</p>
<p class="auto-style3"><?php echo $ttd; ?></p>
<p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>
<p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
<p class="auto-style3"></p>