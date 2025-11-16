<?php

namespace grafik_laba_rugi\data;

class DataPenjualan
{
    public $id_penjualan;
    public $kode_transaksi_penjualan;
    public $tanggal_penjualan;
    public $id_pelanggan;
    public $id_produk;
    public $jumlah;
    public $harga;
    /**
     * di dapat dari tabel data_produ
     * @var string
     */
    public $harga_modal;
    public $jenis_transaksi;
    public $jenis_pembayaran;
    public $discount;
    public $status;
    public $kasir;

    public function get_total_penjualan()
    {
        $harga = $this->harga_setelah_diskon();
        return $harga * $this->jumlah;
    }

    public function get_kode_transaksi()
    {
        
        return $this->kode_transaksi_penjualan;
    }

    public function get_total_modal()
    {
        return $this->harga_modal * $this->jumlah;
    }

    private function harga_setelah_diskon()
    {
        return $this->harga - ($this->harga * $this->discount / 100);
    }

}