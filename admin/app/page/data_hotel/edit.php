<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data hotel </h5>
    <br>
    <form action="proses_update.php" enctype="multipart/form-data" method="post" id="update">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <?php
                        if (!isset($_GET['proses'])) {
                                
                        ?>
                            <script>
                                alert("AKSES DITOLAK");
                                location.href = "index.php";
                            </script>
                        <?php
                            die();
                        }
                        $proses = decrypt(mysql_real_escape_string($_GET['proses']));
                        $sql = mysql_query("SELECT * FROM data_hotel where id_hotel = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id hotel  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_hotel']; ?>	
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_hotel" value="<?php echo $data['id_hotel']; ?>" readonly id="id_hotel" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama" id="nama" placeholder="Nama" value="<?php echo ($data['nama']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Alamat <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <textarea class="form-control" style="width:50%" name="alamat" id="alamat" placeholder="Alamat" required="required"><?php echo ($data['alamat']); ?></textarea>
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>No telepon <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="no_telepon" id="no_telepon" placeholder="No telepon" value="<?php echo ($data['no_telepon']); ?>" required="required">
    </td>
</tr>
                                                
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<tr>
    <td width="25%" class="leftrowcms">
        <label>Koordinat <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <div id="mapkoordinat" style="width: 400px; height: 200px;"></div>
		<span style="cursor: pointer; font-size: 12px; color: #007bff;" onclick="searchLocationkoordinat()">Cari lokasi...</span>
        <input class="form-control" style="width:50%" type="text" name="koordinat" id="koordinat" placeholder="Koordinat" required="required">
          
    </td>
</tr>

<script src="https://unpkg.com/leaflet/dist/leaflet.js?kode=<< field.label >>"></script>
<script>
  
  var initialCoords = "<?= $data['koordinat'] ?>".split(",");
    var lat = parseFloat(initialCoords[0]) || -6.200000; 
    var lng = parseFloat(initialCoords[1]) || 106.816666;

  
    // Inisialisasi peta
    var mapkoordinat = L.map('mapkoordinat').setView([lat, lng], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapkoordinat);
    
    var markerkoordinat = L.marker([lat, lng], {
        draggable: true
    }).addTo(mapkoordinat);

    // Fungsi pencarian lokasi
    function searchLocationkoordinat() {
        var query = prompt("Masukkan nama lokasi (contoh: Monas Jakarta):");
        if (query !== null && query.trim() !== '') {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        var lat = parseFloat(data[0].lat);
                        var lon = parseFloat(data[0].lon);
                        markerkoordinat.setLatLng([lat, lon]);
                        mapkoordinat.setView([lat, lon], 15);
                        document.getElementById('koordinat').value = lat + ',' + lon;
                        alert("Lokasi ditemukan: " + data[0].display_name);
                    } else {
                        alert("Lokasi tidak ditemukan");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Error saat mencari lokasi");
                });
        }
    }

    // Update koordinat saat marker digerakkan
    markerkoordinat.on('dragend', function(e) {
        var latLng = e.target.getLatLng();
        document.getElementById('koordinat').value = latLng.lat + ',' + latLng.lng;
    });

    // Update koordinat saat peta diklik
    mapkoordinat.on('click', function(e) {
        markerkoordinat.setLatLng(e.latlng);
        document.getElementById('koordinat').value = e.latlng.lat + ',' + e.latlng.lng;
    });

    // Set nilai awal
    document.getElementById('koordinat').value = "<?= $data['koordinat'] ?>";
</script>

                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Gambar <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
          <a href="../../../../admin/upload/<?php echo $data['gambar']; ?>">
            <img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['gambar']; ?>">
              <br><?php echo $data['gambar']; ?>
          </a>
		  <input value="<?php echo ($data['gambar']); ?>" class="form-control" style="width:50%" type="hidden" name="gambar1" id="gambar1" placeholder="Gambar">
		  <input value="<?php echo ($data['gambar']); ?>" class="form-control" style="width:50%" type="file" name="gambar" id="gambar" placeholder="Gambar">
    </td>
</tr>
                        

                    </tbody>
                </table>
            </div>
        </div>
        <?php btn_update(' Proses Update  Data '); ?>
    </form>
</div>