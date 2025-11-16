<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
        function action_cetak_pelanggan($tabel)
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
			


	
	<?php
}
action_cetak_pelanggan("data_pelanggan");
} else {

    function location() {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_pelanggan");
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
                <h1 class="auto-style1" style='font-family:arial;color:#E62600;font-size:25px'><?php echo $judul; ?></h1>
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
            $tabelnya = "data_pelanggan";
            $tabelnya = str_replace("_", " ", $tabelnya);
            $tabelnya = str_replace("data", "", $tabelnya);
            $tabelnya = strtoupper($tabelnya);
            echo $tabelnya;
            ?>

        </strong>
    </center>
    </td>
    </tr>

 
    </table>
    <!-- HEADER -->

    <!-- BODY -->

            <?php
            $no = 0;
            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                $querytabel = "SELECT * FROM data_pelanggan where $Berdasarkan like '%$isi%'";
            } else if (isset($_GET['Berdasar'])) {
                //PERIODE
                $hotel=mysql_real_escape_string($_GET['hotel']);
                $alamat=baca_database("","alamat","select * from data_hotel where id_hotel='$hotel'");
                $nama=baca_database("","nama","select * from data_hotel where id_hotel='$hotel'");
                echo '<center> Cetak Berdasarkan <b> Hotel SteeZe Cabang ' . $nama . '</b></center>';
                echo '<center> <b>Alamat :</b> '.$alamat.'</center>';
                $querytabel = "SELECT * FROM data_pelanggan where id_hotel='$hotel'";
            } else {
                //SEMUA
                $querytabel = "SELECT * FROM data_pelanggan";
                echo '<center> Cetak Semua Pelanggan Cabang Hotel</center>';
            }
            $proses = mysql_query($querytabel);
            if(isset($_GET['hotel']) ||isset($_GET['Berdasarkan'])||isset($_GET['isi'])){
            ?>
    <table width="100%"  class="" style='margin-top:20px' style='font-family:arial;font-size:11pt'>
        <tr style='font-family:arial;font-size:11pt'>
            <th class="th_border cell">No</th>
           <!--h <th class="th_border cell">Id Pelanggan </th> h-->
                <th align="center" class="th_border cell"  >Nama </th>
                <th align="center" class="th_border cell"  >Jenis Kelamin </th>
                <th align="center" class="th_border cell"  >Nama Hotel</th>
                <th align="center" class="th_border cell"  >No Hp </th>



        </tr>

        <tbody style='font-family:arial;font-size:11pt'>
            <?php
            while ($data = mysql_fetch_array($proses)) {
                ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1; echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_pelanggan']; ?></td> h-->
                        <td align="center"><?php echo ucwords($data['nama']); ?></td>
                        <td align="center"><?php echo ucwords($data['jenis_kelamin']); ?></td>
                        <td align="center"><?php echo ucwords(baca_database("","nama","select * from data_hotel where id_hotel='$data[id_hotel]'"))  ?></td>
                        <td align="center"><?php echo $data['no_hp']; ?></td>




                </tr>
    <?php } 
    }else{
        ?>
        <table width="100%"  class="" style='margin-top:20px' style='font-family:arial;font-size:11pt'>
        <tr>
            <th class="th_border cell">No</th>
           <!--h <th class="th_border cell">Id Pelanggan </th> h-->
                <th align="center" class="th_border cell"  >Cabang Hotel</th>
                <th align="center" class="th_border cell"  >Jumlah Pelanggan </th>
                <th align="center" class="th_border cell"  >Jumlah Laki-Laki</th>
                <th align="center" class="th_border cell"  >Jumlah Perempuan</th>

        </tr>

        <tbody>
    <?php
        $queryHotel=mysql_query("SELECT * FROM data_hotel");
        $no=1;
        while($hotel=mysql_fetch_array($queryHotel)){
            $query=mysql_query("SELECT COUNT(*) as total,SUM(jenis_kelamin='laki-laki') AS Laki, SUM(jenis_kelamin='perempuan') AS Perempuan FROM data_pelanggan WHERE id_hotel='$hotel[id_hotel]'");
            $pelanggan=mysql_fetch_array($query);
            $total_pelanggan=$pelanggan['total'];
            $laki=$pelanggan['Laki'];
            $perempuan=$pelanggan['Perempuan'];
            ?>
        <tr>
            <td><?php echo $no++?></td>
            <td><?php echo $hotel['nama']?></td>
            <td><?php echo $total_pelanggan?> Orang</td>
            <td><?php echo $laki==null?0:$laki?> Orang</td>
            <td><?php echo $perempuan==null?0:$perempuan?> Orang</td>

        </tr>
        <?php
        }
        ?>

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
