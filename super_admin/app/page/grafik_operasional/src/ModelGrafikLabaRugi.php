<?php

namespace grafik_laba_rugi;

use grafik_laba_rugi\data\DataPenjualan;
use haryandb\BaseModel;

class ModelGrafikLabaRugi extends BaseModel
{
    public function get_total_penjualan(
        $bulan,
        $tahun
    )
    {
        $total_penjualan = 0;
        $total_modal = 0;
        $total_laba_kotor = 0;
        $penjualans = $this->get_penjualan($bulan, $tahun);

        foreach ($penjualans as $penjualan) {
            // $total_penjualan += $penjualan->get_total_penjualan();
            $total_modal += $penjualan->harga_modal*$penjualan->jumlah*$penjualan->item;

            if (!isset($displayed_tax[$penjualan->get_kode_transaksi()])) {
                $sql2 = "SELECT pajak,jumlah FROM data_transaksi WHERE kode_transaksi = '" . $penjualan->get_kode_transaksi() . "'";
                $result2 = mysql_query($sql2);
                
                if (mysql_num_rows($result2) > 0) {
                    $row2 = mysql_fetch_assoc($result2);
                    // $total_penjualan = $row2["jumlah"];
                    $displayed_tax[$penjualan->get_kode_transaksi()] = true;
        
                    $total_penjualan  += $row2["jumlah"];
                    // $pajak += $row2["pajak"]; 
                    
                }

        }

        }
        $total_laba_kotor = $total_penjualan - $total_modal;


        return [
            'total_penjualan' => $total_penjualan,
            'total_modal' => $total_modal,
            'total_laba_kotor' => $total_laba_kotor,
        ];
    }

    public function get_total_operasional(
        $bulan,
        $tahun
    )
    {
        $total_operasional = 0;
        $operasionals = $this->get_operasional($bulan, $tahun);
        foreach ($operasionals as $operasional) {
            $total_operasional += $operasional->jumlah;
        }
        return [
            "total_operasional" => $total_operasional
        ];
    }

    public function get_tahun()
    {
        $stmt = $this->dbh->prepare("
            SELECT DISTINCT
                year(tanggal_penjualan) AS tahun
            FROM
                data_penjualan
            ORDER BY
                tahun DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_bulan()
    {
        $bulans = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        return $bulans;
    }

    /**
     * @param $bulan
     * @param $tahun
     * @return array|false
     */
    private function get_penjualan($bulan, $tahun)
    {

        // $stmt = $this->dbh->prepare("
        //     SELECT
        //         data_penjualan.*,
        //         data_produk.harga_modal
        //     FROM
        //         data_penjualan
        //     JOIN data_produk ON data_penjualan.id_produk = data_produk.id_produk
        //     WHERE
        //         MONTH(tanggal_penjualan) = :bulan
        //         AND YEAR(tanggal_penjualan) = :tahun");

        $stmt = $this->dbh->prepare("
    SELECT
        data_penjualan.*,
        data_produk.harga_modal
    FROM
        data_penjualan
    JOIN data_produk ON data_penjualan.id_produk = data_produk.id_produk
    WHERE
        MONTH(tanggal_penjualan) = :bulan
        AND YEAR(tanggal_penjualan) = :tahun

    UNION ALL

    SELECT
        data_penjualan.*,
        hapus_data_produk.harga_modal
    FROM
        data_penjualan
    JOIN hapus_data_produk ON data_penjualan.id_produk = hapus_data_produk.id_produk
    WHERE
        MONTH(tanggal_penjualan) = :bulan
        AND YEAR(tanggal_penjualan) = :tahun
");


        $stmt->bindParam(':bulan', $bulan);
        $stmt->bindParam(':tahun', $tahun);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, DataPenjualan::class);
    }

    public function get_bulan_name($request_bulan)
    {
        $request_bulan = (int)ltrim($request_bulan, '0');
        if ($request_bulan >= 1 && $request_bulan <= 12) {
            $bulan = $this->get_bulan();
            return $bulan[$request_bulan];
        }
        return null;
    }

    private function get_operasional($bulan, $tahun)
    {
        $stmt = $this->dbh->prepare("
            SELECT
                data_operasional.*
            FROM
                data_operasional
            WHERE
                MONTH(tanggal) = :bulan
                AND YEAR(tanggal) = :tahun");
        $stmt->bindParam(':bulan', $bulan);
        $stmt->bindParam(':tahun', $tahun);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
}