<div class="popup-wrapper" id="popup">
<div class="popup-container">
<h1>HAPUS</h1>
<p style="font-size:19px;">Apakah anda ingin hapus data ini..?</p>

<a href="<?php index(); ?>">
<?php btn_tidak('NO'); ?>
</a>
<?php
$admin=decrypt(mysql_real_escape_string($_GET['admin']));
?>
<a href="proses_hapus.php?proses=<?php echo decrypt(mysql_real_escape_string($_GET['proses']));?>&admin=<?php echo $admin; ?>">
<?php btn_ya('YES'); ?>
</a>

<a class="popup-close" href="<?php index(); ?>">X</a>
</div>
</div>
