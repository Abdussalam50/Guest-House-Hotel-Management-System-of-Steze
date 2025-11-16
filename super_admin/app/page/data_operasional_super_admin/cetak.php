<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    
    <?php
       function action_operasional($tabel)
{
	?>
	
	<form name="formcari" id="formcari"  action="cetak.php" method="get" target="_blank">
				
                <fieldset> 
					<table>
						<tbody>
						<tr>
							<td><b>CETAK KESELURUHAN</b></td>	
							
							<td ></td>
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
        	<form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
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
			
			<form name="formcari" id="formcari"  action="cetak.php" method="get" target="_blank">
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
 action_operasional('data_operasional');
} else {

    function location() {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_operasional");
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


    <!-- HEADER -->
    <table border="0" style="width: 100%;font-family:arial">
        <?php
        if (isset($_GET['export'])) {
            
        } else {
            ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100"></td>

                <td class="auto-style1">
            <center>
                <h1 class="auto-style1" style='font-size:25px;color:#D92C09'><?php echo $judul; ?></h1>
            </center>
        </td>

        <td class="auto-style1" rowspan="3" width="101">
            <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100"></td>
        </tr>
    <?php } ?>

    <tr>
        <td class="auto-style2">
    <center>
        <strong>LAPORAN

            <?php
            $tabelnya = "data_operasional";
            $tabelnya = str_replace("_", " ", $tabelnya);
            $tabelnya = str_replace("data", "", $tabelnya);
            $tabelnya = strtoupper($tabelnya);
            echo $tabelnya;
            ?>

        </strong>
    </center>
    </td>
    </tr>

    <tr>
        <td class="auto-style2">
            <?php
        // $idHotel=decrypt($_COOKIE['id_hotel']);
        // echo baca_database("","alamat","select * from data_hotel where id_hotel='$idHotel'"); 
        ?>
        </td>
    </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%"  class="" style='font-family:arial;font-size:11pt'>
        <tr>
            <th class="th_border cell">No</th>
           <!--h <th class="th_border cell">Id Operasional </th> h-->
                <th align="center" class="th_border cell"  >Nama Hotel</th>
                <th align="center" class="th_border cell"  >Tanggal</th>
                <th align="center" class="th_border cell"  >Operasional </th>
                <th align="center" class="th_border cell"  >Jumlah </th>
                <th align="center" class="th_border cell"  >Biaya </th>
                <?php
                    if(!isset($_GET['Berdasar'])&&!isset($_GET['hotel'])){
                ?>
                <th align="center" class="th_border cell"  >Total </th>
                <?php
                }?>
                <th align="center" class="th_border cell"  >Keperluan</th>
                <th align="center" class="th_border cell"  >Penanggung Jawab</th>


        </tr>

        <tbody>
            <?php
            $no = 0;
            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //
                $hotel=$_GET['hotel'];
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                $querytabel = "SELECT * FROM data_operasional where $Berdasarkan like '%$isi%' AND id_hotel='$hotel'";
            } else if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $hotel=$_GET['hotel'];
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                $nama=baca_database("","nama","select * from data_hotel where id_hotel='$hotel'");
                $alamat=baca_database("","alamat","select * from data_hotel where id_hotel='$hotel'");
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b> di Hotel '.$nama.'</center> <br>';
                echo "<center><b>Alamat :</b> $alamat</center><br>";
                $querytabel = "SELECT * FROM data_operasional where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2') AND id_hotel='$hotel'";
            }elseif(isset($_GET['Berdasar'])){
                $hotel=$_GET['hotel'];
                $nama_hotel=baca_database("","nama","select * from data_hotel where id_hotel='$hotel'");
                $alamat=baca_database("","alamat","select * from data_hotel where id_hotel='$hotel'");
                $querytabel="SELECT * FROM data_operasional WHERE id_hotel='$hotel'";
                echo "<center>Cetak Berdasarkan <b>Hotel SteZe Cabang ".$nama_hotel.", $alamat </center><br>";
            } else {
                //SEMUA 
                $querytabel = "SELECT * FROM data_operasional ";
                echo "<center>Cetak Semua Operasional Hotel</center><br>";
            }
            $proses = mysql_query($querytabel);
            if(isset($_GET['Berdasar'])||isset($_GET['hotel'])){
                $count_operasional=[];
            while ($data = mysql_fetch_array($proses)) {
                $count_operasional[]=$data['biaya'];
                ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1; echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_operasional']; ?></td> h-->
                        <td align="center"><?php echo baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'")  ?></td>
                        <td align="center"><?php 
                        $waktu=explode(" ",$data['tanggal']);
                        $tanggal=$waktu[0];
                        $jam=$waktu[1];
                     echo format_indo($tanggal).' '.$jam ?></td>
                        <td align="center"><?php echo $data['operasional']; ?></td>
                        <td align="center"><?php echo $data['jumlah']; ?></td>
                        <td align="center"><?php echo rupiah($data['biaya']); ?></td>
                        <td align="center"><?php echo $data['keperluan']; ?></td>
                        <td align="center"><?php echo baca_database("","nama","select * from data_admin where id_admin='{$data['id_admin']}'"); ?></td>


                </tr>
    <?php } ?>
        <tr>
            <td colspan='7' style='text-align:center;font-weight:700'> Total Operasional</td>

            <td style='color:#D92C09;font-weight:700' ><?php echo rupiah(array_sum($count_operasional))?></td>
        </tr>
    <?php
    }else{
          $query_hotel=mysql_query("SELECT * FROM data_hotel");
          $no=1;
            while($hotel=mysql_fetch_array($query_hotel)){
                $query_operasional=mysql_query("SELECT * FROM data_operasional WHERE id_hotel='$hotel[id_hotel]'");

                if(mysql_num_rows($query_operasional)==0){

                
                ?>
         <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $hotel['nama']; ?></td>
            <td  align="center">-</td>
            <td  align="center">-</td>
            <td  align="center">-</td>
            <td  align="center">Rp 0</td>
            <td  align="center">Rp 0</td>
            <td  align="center">-</td>
            <td  align="center">-</td>
        </tr>
            

                <?php
                }else{

                    $state=true;
                    $total_biaya=[];
                    $query_biaya=mysql_query("SELECT * FROM data_operasional WHERE id_hotel='$hotel[id_hotel]'");
                    
                    while($biaya=mysql_fetch_array($query_biaya)){
                         $total_biaya[]=$biaya['biaya'];
                    }
                    $jumlah_baris=count($total_biaya);
                    $total_biaya=array_sum($total_biaya);
                    while($operasional=mysql_fetch_array($query_operasional)){
                        
                        ?>
                    <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $state?$hotel['nama']:''?></td>
                        <td><?php 
                        $waktu=explode(" ",$operasional['tanggal']);
                        $tanggal=$waktu[0];
                        $jam=$waktu[1];
                        echo $operasional['tanggal']==null?'-': format_indo($tanggal).' '.$jam?></td>
                        <td><?php echo $operasional['operasional']==null?'-':$operasional['operasional']?></td>
                        <td><?php echo $operasional['jumlah']==null?'-': $operasional['jumlah']?></td>
                        <td><?php echo $operasional['biaya']==null?'Rp 0':rupiah($operasional['biaya'])?></td>
                <?php if($state){ ?>
                    <td rowspan="<?php echo $jumlah_baris; ?>"><?php echo rupiah($total_biaya); ?></td>
                <?php }
                ?>
                        <td><?php echo $operasional['keperluan']==null?'-':$operasional['keperluan']?></td>
                        <td ><?php echo baca_database("","nama","select * from data_admin where id_admin='{$operasional['id_admin']}'"); ?></td>
                    </tr>  
                <?Php
                $state=false;
                    }
                
                }
                ?>

            
        <?php
        $no++;
            }
        ?>
                <tr>
                    <td colspan='6' style='text-align:center'>Total Operasional</td>
                    <td colspan="3"><?php echo rupiah($total_biaya)?></td>
                </tr>
    <?php
    }?>
        </tbody>
    </table>
    <!-- BODY -->

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?>
    </p>
    <p class="auto-style3"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
    <p class="auto-style3"></p>

<?php } ?>
