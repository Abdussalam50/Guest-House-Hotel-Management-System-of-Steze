<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data pengelola </h5>
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
                        $sql = mysql_query("SELECT * FROM data_pengelola where id_pengelola = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id pengelola  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_pengelola']; ?>	
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_pengelola" value="<?php echo $data['id_pengelola']; ?>" readonly id="id_pengelola" required="required">


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
                                <label>Username <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="username" id="username" placeholder="Username" value="<?php echo ($data['username']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>New Password <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="password" name="password" id="password" placeholder="New Password" required="required">
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <?php btn_update(' Proses Update  Data '); ?>
    </form>


</div>