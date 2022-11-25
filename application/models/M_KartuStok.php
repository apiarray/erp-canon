<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_KartuStok extends CI_Model
{

    public function getKodeProduk()
    {
        return $this->db->select("kode")->from("produk")->order_by('kode', 'ASC')->get()->result();
    }

    public function getGudang()
    {
        return $this->db->select("kode, nama")->from("gudang")->order_by('kode', 'ASC')->get()->result();
    }

    public function getAllProduk()
    {
        return $this->db->query("SELECT produk.kode, produk.nama, produk.gudang, produk.kategori, 
                                    COALESCE(penerimaan.qty, 0) - COALESCE(pengiriman.qty, 0) as stok,
                                    produk.hpp, produk.jumlah
                                FROM produk
                                LEFT JOIN (SELECT kode, SUM(total_qty) as qty FROM penerimaan_item GROUP BY kode) AS penerimaan
                                    on produk.kode = penerimaan.kode
                                LEFT JOIN (SELECT kode, total, SUM(total) as qty FROM pengiriman_barang group by kode, total) as pengiriman
                                    ON produk.kode = pengiriman.kode;")->result();
    }

    public function getProdukByFilter($kode, $gudang)
    {
        $this->db->select('kode, SUM(total_qty) as qty');
        $this->db->from('penerimaan_item');
        $this->db->group_by('kode');
        $sumReceivedItem = $this->db->get_compiled_select();

        $this->db->select('kode, SUM(total) as qty');
        $this->db->from('pengiriman_barang');
        $this->db->group_by('kode');
        $sumSentItem = $this->db->get_compiled_select();

        $this->db->select('
            produk.*, 
            COALESCE(penerimaan.qty, 0) - COALESCE(pengiriman.qty, 0) as stok
        ');
        $this->db->from('produk');
        $this->db->join("($sumReceivedItem) as penerimaan", 'penerimaan.kode = produk.kode', 'left');
        $this->db->join("($sumSentItem) as pengiriman", 'pengiriman.kode = produk.kode', 'left');
        
        if ($kode) {
            $this->db->where('produk.kode', $kode);
        }

        if ($gudang != 'all') {
            $this->db->where('produk.gudang', $gudang);
        }

        return $this->db->get()->result();
    }
}
