<a onclick="history.back()">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-content">






        <?php
        // Panggil fungsi detail_transaksi
        if (isset($_GET['proses'])) {
            
            detail_transaksi(decrypt($_GET['proses']));
        } else {
            echo "<p>Transaksi tidak ditemukan.</p>";
        }
        ?>
        <br>

        <hr>




        <!-- <a href="<?php index() ?>?input=hapus&proses=<?php echo encrypt($data['id_transaksi']) ?>&admin=<?php echo $_COOKIE['jenenge'] ?>" class='btn btn-sm btn-secondary fw-semibold'><i class="fa fa-remove"></i> Hapus Transaksi</a> -->
    </div>
</div>