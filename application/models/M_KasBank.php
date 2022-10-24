<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_KasBank extends CI_Model
{


    public function getDataKasBank()
    {
        return $this->db->select("a.kode, a.tanggal, COALESCE(SUM(b.penerimaan),0) as penerimaan, COALESCE(SUM(b.pengeluaran),0) as pengeluaran")
            ->from("kas_bank a")
            ->join("kas_bank_detail b", "a.kode = b.kode_kas_bank", "left")
            ->group_by("a.kode, a.tanggal")->get()->result();
    }

    public function getLatestNoTf()
    {
        $this->db->select('kode');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('kas_bank')->row();
    }

    public function getDataPengiriman()
    {
        return $this->db->select("p.id, p.no_do as no_aktivitas, p.total_pengiriman as nominal, p.tanggal")
            ->from("pengiriman p")
            ->join("kas_bank_detail kbd", "p.id = kbd.id_pengiriman", "left")
            ->where("kbd.id_pengiriman", NULL)->get()->result();
    }

    public function getDataPenerimaan()
    {
        return $this->db->select("p.id, p.total_harga as nominal, p.tanggal, p.no_lpb as no_aktivitas")
            ->from("penerimaan p")
            ->join("kas_bank_detail kbd", "p.id = kbd.id_penerimaan", "left")
            ->where("kbd.id_penerimaan", NULL)->get()->result();
    }

    public function getDataByChecked($id, $type)
    {
        if ($type == "pengiriman") {
            return $this->db->select("id, no_do as no_aktivitas, total_pengiriman as nominal, tanggal")
                ->from("pengiriman")->where_in('id', explode(',', $id))->get()->result();
        }

        if ($type == "penerimaan") {
            return $this->db->select("id, total_harga as nominal, tanggal, no_lpb as no_aktivitas")
                ->from("penerimaan")->where_in('id', explode(',', $id))->get()->result();
        }
    }

    public function save($tgl, $noKasBank, $keterangan, $totPenerimaan, $totPengeluaran, $detailData)
    {
        $this->db->trans_begin();

        //insert to header
        $dataheader = [
            'kode' => $noKasBank,
            'tanggal' => $tgl,
            'keterangan' => $keterangan == "" ? NULL : $keterangan,
            'total_penerimaan' => $totPenerimaan,
            'total_pengeluaran' => $totPengeluaran,
        ];

        $this->db->insert('kas_bank', $dataheader);

        //insert to detail
        foreach ($detailData as $key => $value) {
            $type = explode(",", $value['id']);

            $idPenerimaan = $type[0] == "penerimaan" ? $type[1] : NULL;
            $idPengiriman = $type[0] == "pengiriman" ? $type[1] : NULL;

            $dataDetail = [
                'kode_kas_bank' => $noKasBank,
                'tanggal' => $value['tgl'],
                'nomor_aktivitas' => $value['nomorAktivitas'],
                'nominal_aktivitas' => $value['nominal'],
                'sisa_aktivitas' => $value['sisaAktivitas'],
                'penerimaan' => $value['penerimaan'] == "" ? NULL : $value['penerimaan'],
                'pengeluaran' => $value['pengeluaran'] == "" ? NULL : $value['pengeluaran'],
                'id_pengiriman' => $idPengiriman,
                'id_penerimaan' => $idPenerimaan,
            ];

            $this->db->insert('kas_bank_detail', $dataDetail);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}
