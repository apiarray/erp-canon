<?php

class M_asmen extends CI_Model
{
    public function tampil_data($weekending)
    {
        if ($weekending != "") {
            return $this->db->get_where('topasmen', ['tgl' => $weekending])->result_array();
        } else {
            return;
        }
    }

    public function getDataById($id)
    {
        return $this->db->get_where('topasmen', ['id' => $id])->row_array();
    }

    public function weekending()
    {
        $this->db->select('tgl');
        $this->db->where_not_in('tgl', 'up');
        $this->db->distinct();
        return $this->db->get('topasmen')->result_array();
    }

    public function tambahDataAsmen()
    {
        $data = [
            "tgl" => "up",
            "nama" => $this->input->post('mitra', true),
            "manager" => $this->input->post('manager', true),
            "poin_sendiri" => $this->input->post('pointSendiri', true),
            "poin_tim" => $this->input->post('pointTeam', true),
            "peringkat_langsung" => $this->input->post('peringkatLangsung', true),
            "peringkat_tidaklangsung" => $this->input->post('peringkatTidakLangsung', true),
            "jumlah_leader" => $this->input->post('leader', true),
            "jumlah_distributor" => $this->input->post('distributor', true),
            "jumlah_retrain" => $this->input->post('retrain', true),
            "jumlah_observasi" => $this->input->post('observasi', true),
            "jumlah_team" => $this->input->post('team', true)
        ];
        return $this->db->insert('topasmen', $data);
    }

    public function editDataAsmen()
    {
        $data = [
            "nama" => $this->input->post('mitra', true),
            "manager" => $this->input->post('manager', true),
            "poin_sendiri" => $this->input->post('pointSendiri', true),
            "poin_tim" => $this->input->post('pointTeam', true),
            "peringkat_langsung" => $this->input->post('peringkatLangsung', true),
            "peringkat_tidaklangsung" => $this->input->post('peringkatTidakLangsung', true),
            "jumlah_leader" => $this->input->post('leader', true),
            "jumlah_distributor" => $this->input->post('distributor', true),
            "jumlah_retrain" => $this->input->post('retrain', true),
            "jumlah_observasi" => $this->input->post('observasi', true),
            "jumlah_team" => $this->input->post('team', true)
        ];

        $this->db->set($data);
        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('topasmen');
    }

    public function getKaryawanById($id)
    {
        return $this->db->get_where('manager', ['id' => $id])->row_array();
    }
    public function hapusDataAsmen($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('topasmen');
    }
    // public function ubahDataKaryawan(){
    //     $data = [
    //         "kode_id" => $this->input->post('kode_id',true),
    //         "nama" => $this->input->post('nama',true),
    //         "tgl_lahir" => $this->input->post('tgl_lahir',true),
    //         "jabatan" => $this->input->post('jabatan',true),
    //         "thn_gabung" => $this->input->post('thn_gabung',true),
    //         "alamat" => $this->input->post('alamat',true),
    //         "kota" => $this->input->post('kota',true),
    //         "no_telp" => $this->input->post('no_telp',true),
    //         "email" => $this->input->post('email',true),
    //     ];
    //     $this->db->where('id',$this->input->post('id'));
    //     $this->db->update('manager',$data);
    // }
    // public function cariDataKaryawan(){
    //     $keyword = $this->input->post('keyword',true);
    //     $this->db->like('nama',$keyword);
    //     $this->db->or_like('jabatan',$keyword);
    //     $this->db->or_like('alamat',$keyword);
    //     return $this->db->get('manager')->result_array();
    // }
}
