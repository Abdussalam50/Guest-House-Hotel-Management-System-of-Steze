<?php
include '../../../include/all_include.php';

$query =  decrypt($_GET['q']);

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
        <strong>LAPORAN PRODUK TERLARIS

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
  <script src="../../../data/cssjs/grafik/highcharts.js"></script>
  <script src="../../../data/cssjs/grafik/data.js"></script>
  <script src="../../../data/cssjs/grafik/drilldown.js"></script>
  <script src="../../../data/cssjs/grafik/exporting.js"></script>
  <div id="grafik" style="width:90%;height: 400px; margin: 0 auto"></div>
  <script>
    Highcharts.chart('grafik', {

      chart: {
        type: 'column'
      },

      title: {
        text: '<b>GRAFIK </b>'
      },

      subtitle: {
        text: '<?php echo $subtitle; ?>'
      },

      xAxis: {
        type: 'category'
      },

      yAxis: {
        title: {
          text: 'Jumlah Data '
        }

      },

      legend: {
        enabled: false
      },

      plotOptions: {

        series: {

          borderWidth: 0,
          dataLabels: {
            enabled: true,
            format: '{point.y:f}'
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
        headerFormat: '<span style="color:{point.color}">Grafik </span> {series.name}<br>',
        pointFormat: '<span style="color:{point.color}">Jumlah {point.name}</span>: <b>{point.y:f}</b> data<br/>'
      },


      //DAFTAR NAMA TABEL YANG ADA  
      "series": [{

          "name": "Produk Terlaris",
          "colorByPoint": true,
          "data": [
            <?php
            $queryes = mysql_query($query);
            while ($data = mysql_fetch_array($queryes)) {
            ?> {
                //MENAMPILKAN DATA DALAM GRAFIK
                "name": "<?php echo $data['nama_produk']; ?> (<?php echo $data['kategori']; ?>)",
                "y": <?php echo $data['total']; ?>,
                url: '#',
                //"drilldown": "<?php echo $tampil_showtables; ?>" //NULL
              },
            <?php
            }
            ?>

          ]
        },


      ],

    });
  </script>


<?php } ?>

<?php if (isset($_GET['data'])) { ?>
  <div style="overflow-x:auto;">
    <table class="tblcms2">
      <tr>
        <th>No</th>
        <th style="align:left;" class="th_border cell">Produk</th>
        <th align="center" class="th_border cell">Kategori</th>
        <th align="center" class="th_border cell">Jumlah Terjual</th>
      </tr>

      <tbody>
        <?php
        $no = 0;

        $proses = mysql_query($query);
        while ($data = mysql_fetch_array($proses)) {
          $id_produk = $data['id_produk'];
          $data_produk_nama_produk = baca_database("", "nama_produk", "select * from data_produk where id_produk='$id_produk'");
          if (empty($data_produk_nama_produk)) {
            $foto = baca_database("", "foto", "select * from hapus_data_produk where id_produk='$id_produk'");
            $id_satuan = baca_database("", "id_satuan", "select * from hapus_data_produk where id_produk='$id_produk'");
          } else {
            $foto = baca_database("", "foto", "select * from data_produk where id_produk='$id_produk'");
            $id_satuan = baca_database("", "id_satuan", "select * from data_produk where id_produk='$id_produk'");
          }
          $satuan = baca_database("", "satuan", "select * from data_satuan where id_satuan='$id_satuan'");
        ?>
          <tr class="event2">

            <td align="center"><?php $no = (($no + 1));
                                echo $no;  ?></td>
            <td align="center">
              <a href='../../../../admin/upload/<?php echo $foto; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='30' height='30' src='../../../../admin/upload/<?php echo $foto; ?>'></a>
              &nbsp;
              &nbsp;
              <b><?php echo ($data['nama_produk']); ?></b>
            </td>
            <td><?php echo $data['kategori']; ?></td>
            <td><b><?php echo $data['total'] . "</b>&nbsp;&nbsp;&nbsp;" . $satuan; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  </body>
<?php } ?>


<!-- FOOTER -->
<p class="auto-style3"><?php echo $formatwaktu; ?>
</p>
<p class="auto-style3"><?php echo $ttd; ?></p>
<p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>
<p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
<p class="auto-style3"></p>