<?php

if(isset($_GET['input'])){
    echo "<h3> Cetak Laporan Pendapatan ";
   
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
<?php
    function action_cetak_pendapatan($tabel)
{
	?>
	
	<form name="formcari" id="formcari"  action="pendapatan.php" method="get" target="_blank">
				
                <fieldset> 
					<table>
						<tbody>
						<tr>
							<td><b>CETAK KESELURUHAN</b></td>	
							
							<td ></td>
						</tr>
                        <tr>
                            <td>Pilih Tahun :</td>
                            <td>
                                <select name="tahun" id="tahun" class="form-control">
                                    <?php
                                        $query=mysql_query("SELECT DISTINCT YEAR(waktu_transaksi) AS tahun FROM data_transaksi ORDER BY waktu_transaksi DESC");
                                        if(mysql_num_rows($query)>0){
                                            while($data=mysql_fetch_array($query)){
                                                ?>
                                                <option value="<?php echo $data['tahun']?>"><?php echo $data['tahun']?></option>
                                    <?php
                                            }
                                        }else{
                                            ?>
                                            <option value="<?php echo date('Y')?>"><?php echo date('Y')?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>

						<tr>
							<td  style="width:40%"></td>	
						
							<td>							
								<?php btn_preview_laporan('Print Preview'); ?>
								<?php btn_cetak_laporan('Print'); ?>
								<?php btn_export_laporan('Export Excel'); ?>
							</td>
						</tr>
					</tbody>
					</table>									
				</fieldset>
			</form>
		<br>
        	<form name="formcari" id="formcari" action="pendapatan.php" method="get" target="_blank">
		<fieldset>
			<table>
				<tbody>
					<tr>
						<td><b>CETAK DENGAN FILTER</b></td>

						<td>
						</td>
					</tr>

					<tr>
						<td style="width:40%">Berdasarkan :</td>

						<td>
							<select class="form-control selectpicker" data-live-search="true" name="Berdasar" id="Berdasarkan">
                                <option value="Berdasarkan1">Hotel</option>
							</select>
						</td>
					</tr>

					<tr>
						<td style="width:40%">Pilih Hotel :</td>

						<td>
                            <select class="form-control selectpicker" name="hotel" id="hotel">
                               
                            <?php
                                combo_database_v2("data_hotel","id_hotel","nama","");
                            ?>
                            </select>

                            
						</td>
					</tr>

					<tr>
						<td></td>

						<td>
							<?php btn_preview_laporan('Print Preview'); ?>
							<?php btn_cetak_laporan('Print'); ?>
							<?php btn_export_laporan('Export Excel'); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>
			
			<form name="formcari" id="formcari"  action="pendapatan.php" method="get" target="_blank">
				<fieldset> 
					<table>
						<tbody>
						<tr>
							<td><b>CETAK PERPERIODE</b></td>	
						
							<td></td>
						</tr>
						<tr>
							<td  style="width:40%">Berdasarkan :</td>	
							
							<td>
								<select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
								<?php
								$sql = "desc $tabel";
								$result = @mysql_query($sql);
								while($row = @mysql_fetch_array($result)){
									$typedata = $row[1];
									
									$kalimat = $typedata;
									if(preg_match("/date/i", $kalimat)) {
										
									echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
									
									} 
									
									
								}
								?>
							</select>							
							</td>
						</tr>
						
						
						<tr>
							<td  style="width:40%">Dari Tanggal :</b></td>	
							
							<td><input type="date" name="tanggal1"></td>
						</tr>
						
						<tr>
							<td  style="width:40%">Sampai Tanggal :</b></td>	
							
							<td><input type="date" name="tanggal2"></td>
						</tr>
						<tr>
                            <td style='width:40%'>Di hotel :</td>
                            <td>
                                <select class='form-control selectpicker' name="hotel" id="hotel">
                                    <?php combo_database_v2("data_hotel","id_hotel","nama","")?>
                                </select>
                            </td>
                        </tr>

						<tr>
							<td></td>	
							
							<td>							
								<?php btn_preview_laporan('Print Preview'); ?>
								<?php btn_cetak_laporan('Print'); ?>
								<?php btn_export_laporan('Export Excel'); ?>
							</td>
						</tr>
					</tbody>
					</table>									
				</fieldset>
			</form>

	
	<?php
}
 action_cetak_pendapatan("data_transaksi");
}else{
    include '../../../include/all_include.php';
   


if(isset($_GET['tanggal1'])&& isset($_GET['tanggal2'])&&!empty($_GET['tanggal1']) && !empty($_GET['tanggal2'])){
    $hotel=$_GET['hotel'];
    $nama_hotel=baca_database("","nama","select * from data_hotel where id_hotel='$hotel'");
    $dari=$_GET['tanggal1'];
    $sampai=$_GET['tanggal2'];
    $text="Hasil Laporan Pendapatan dari ".format_indo( $dari )." Sampai ".format_indo($sampai)." Hotel Stezee Cabang $nama_hotel";
    $column=$_GET['Berdasarkan'];
    $query="SELECT * FROM data_transaksi LEFT JOIN data_kamar ON data_transaksi.id_kamar=data_kamar.id_kamar WHERE  waktu_checkin BETWEEN '$dari' AND '$sampai' AND (status_transaksi='Lunas' OR status_transaksi='Selesai')";
   
    $alamat=baca_database("","alamat","select * from data_hotel where id_hotel='$hotel'");
    
}elseif(isset($_GET['Berdasar'])){
    $id_hotel=$_GET['hotel'];
    $alamat=baca_database("","alamat","select * from data_hotel where id_hotel='$id_hotel'");
    $query="SELECT * FROM data_transaksi WHERE id_hotel='$id_hotel' AND (status_transaksi='Lunas' OR status_transaksi='Selesai')";
    $nama_hotel=ucwords(baca_database("","nama","select * from data_hotel where id_hotel='$id_hotel'"));
}else{
$query="SELECT * FROM data_transaksi LEFT JOIN data_kamar ON data_transaksi.id_kamar=data_kamar.id_kamar WHERE (status_transaksi='Lunas' OR status_transaksi='Selesai')";
$nama_hotel='Semua Hotel';
}

$result=mysql_query($query);
?>
<style>
    body {
        font-family: 'Arial', sans-serif !important;
        font-size: 12px !important;
        color: #333;
    }

    #tableheader {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    #tableheader td {
        border: none;
        padding: 10px;
        vertical-align: middle;
    }

    h1, h4 {
        margin: 0;
        padding: 0;
        color: #222;
    }

    .container {
        width: 100%;
        padding: 0 15px;
        box-sizing: border-box;
    }

    #table-content {
        width: 100%;
        border-collapse: collapse;
    }

    #table-content th, #table-content td {
        border: 1px solid #ccc;
        padding: 6px;
        text-align: center;
        vertical-align: middle;
    }

    #table-content thead th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    #table-content tbody tr:nth-child(even) {
        background-color: #fafafa;
    }

    #table-content tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>
<table id='tableheader'>
    <tr>
        <td width='10%'><center><img src="../../../data/image/logo/steze-2.png" alt="" srcset="" width='100'></center></td>
        <td width='80%'>
          <center><h3 style='color:#E62600; font-size:20px;margin:0px'>SteZe</h3></center>  
          <center><h1>LAPORAN PENDAPATAN</h1></center>  
          <center><h4 style='padding:5px;background-color:#eaeaea'><?php 
          if(isset($text)){
            echo $text;
          }else{
            ?>Semua Cabang Hotel dan Jangka Waktu di Tahun <?php echo $_GET['tahun'];
        
          } ?></h4></center>
         <?php
            if(isset($_GET['hotel'])){
                ?>
                <br>
                <center><p style="background-color:#eaeaea;padding:10px"><?php echo $alamat?></p></center>
            
            <?php
            }

         ?>
        </td>
        <td width='10%'><center><img src="../../../data/image/logo/steze-2.png" alt="" srcset="" width='100'></center></td>
    </tr>
</table>
<div class="container">
    <?php
    if(isset($_GET['hotel'])){    
    ?>
    <table class="table" id="table-content" width='100%'>
        <thead>
            <th>No</th>
            <th>Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga</th>
            <th>Discount</th>
            <th>Tanggal CheckIn</th>
            <th>Tanggal CheckOut</th>
            <th>Jumlah Hari</th>
            <th>Total</th>
        </thead>

        <tbody>
            <?php
                $no=1;
                $harga=[];
                while($data=mysql_fetch_array($result)){

                    $harga[]=($data['harga']+$data['biaya_tambahan_checkin']+$data['biaya_tambahan_checkout']);
                    ?>
                <tr>
                    <?php
                        $checkin=new DateTime($data['waktu_checkin']);
                        $checkout=new DateTime($data['waktu_checkout']);
                        $selisih=$checkin->diff($checkout);
                        $jumlah_hari=$selisih->days;
                    ?>
                    <td><?php echo $no++?></td>
                    <td>Kamar <?php echo baca_database("","no_kamar","select * from data_kamar where id_kamar='{$data['id_kamar']}'")?></td>
                    <td><?php
                     $id_tipekamar= baca_database("","id_tipe_kamar","select * from data_kamar where id_kamar='{$data['id_kamar']}'");
                     echo ucwords(baca_database("","tipe_kamar","select * from data_tipe_kamar where id_tipe_kamar='$id_tipekamar'"));
                     ?></td>
                     <td>Rp <?php 
                            if($jumlah_hari>=30){
                                echo number_format(baca_database("","harga_bulanan","select * from data_kamar where id_kamar='{$data['id_kamar']}'"));
                            }else{
                                echo number_format(baca_database("","harga_harian","select * from data_kamar where id_kamar='{$data['id_kamar']}'"));
                            }
                               ?></td>
                     <td> <?php echo $data['discount']?> %</td>
                    <td><?php 
                       
                        echo format_indo($data['waktu_checkin']);
                    ?></td>
                    <td><?php
                       
                        echo format_indo($data['waktu_checkout']);
                     ?></td>
                    <td><?php
                     echo $jumlah_hari?> Hari</td>
                    <td>Rp <?php echo number_format($data['harga']+$data['biaya_tambahan_checkin']+$data['biaya_tambahan_checkout'])?></td>

                </tr>
            <?php
                }
            
            ?>
            <tr>
                <td colspan='8' style='font-weight:700'>Total Pendapatan</td>
                <td style='font-weight:700'>Rp <?php echo number_format(array_sum($harga))?></td>
            </tr>
        </tbody>
    </table>
    <?php
    }else{?>
<table class="table" id="table-content" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Cabang Hotel</th>
            <th>Januari</th>
            <th>Februari</th>
            <th>Maret</th>
            <th>April</th>
            <th>Mei</th>
            <th>Juni</th>
            <th>Juli</th>
            <th>Agustus</th>
            <th>September</th>
            <th>Oktober</th>
            <th>November</th>
            <th>Desember</th>
            <th>Total Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $tahun = $_GET['tahun']; // tentukan tahun yang mau diambil

        // Ambil semua hotel
        $query_hotel = mysql_query("SELECT * FROM data_hotel");
        while ($hotel = mysql_fetch_array($query_hotel)) {
            $id_hotel = $hotel['id_hotel'];
            $nama_hotel = $hotel['nama'];

            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $nama_hotel . "</td>";

            // Loop 12 bulan
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $q_transaksi = mysql_query("
                    SELECT SUM(COALESCE(harga,0) + COALESCE(biaya_tambahan_checkin,0) + COALESCE(biaya_tambahan_checkout,0)) AS total
                    FROM data_transaksi
                    WHERE id_hotel = '$id_hotel'
                    AND MONTH(waktu_transaksi) = '$bulan'
                    AND YEAR(waktu_transaksi) = '$tahun' AND status_transaksi IN('Lunas','Selesai')
                ");
                $row_transaksi = mysql_fetch_array($q_transaksi);
                $total = $row_transaksi['total'] ? $row_transaksi['total'] : 0;

                echo "<td>Rp " . number_format($total, 0, ',', '.') . "</td>";
            }

            // Total per tahun
            $q_transaksibyyear = mysql_query("
                SELECT SUM(COALESCE(harga,0) + COALESCE(biaya_tambahan_checkin,0) + COALESCE(biaya_tambahan_checkout,0)) AS total 
                FROM data_transaksi 
                WHERE id_hotel = '$id_hotel'
                AND YEAR(waktu_transaksi) = '$tahun' AND status_transaksi IN('Lunas','Selesai')
            ");
            $row_total_year = mysql_fetch_array($q_transaksibyyear);
            $total_byyear = $row_total_year['total'] ? $row_total_year['total'] : 0;

            echo "<td>Rp " . number_format($total_byyear, 0, ',', '.') . "</td>";
            echo "</tr>";
        }
    }
        ?>
    </tbody>
</table>

</div>
<div style='padding:20px'>
    <p style="text-align:right"><?php echo $formatwaktu?></p>
    
    <p class="auto-style3"style="text-align:right"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    <p style='text-align:right'><?php echo $siapa?></p>
       <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    
    <p class="auto-style3"></p>
</div>
<?php
}?>

