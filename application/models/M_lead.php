<?php

class M_lead extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('toplead')->result_array();
    }

    public function tampil_data2($weekending)
    {
        if ($weekending != "") {
            $this->db->where('tgl', $weekending);
            return $this->db->get('toplead')->result_array();
        } else {
            return;
        }
    }

    public function tampil_weekending()
    {
        $this->db->select('tgl');
        $this->db->distinct();
        $this->db->where_not_in('tgl', "up");
        $this->db->from('toplead');
        return $this->db->get()->result_array();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('toplead', ['id' => $id])->row_array();
    }

    public function getLatestFaktur()
    {
        $this->db->select('faktur');
        $this->db->order_by('faktur', 'DESC');
        $this->db->limit(1);
        return $this->db->get('toplead')->row_array();
    }

    public function tambahDataToplead()
    {
        $faktur_latest = $this->getLatestFaktur();
        $faktur_latest = $faktur_latest['faktur'];

        $data = [
            "faktur" => $faktur_latest + 1,
            "tgl" => "up",
            "nama" => $this->input->post('mitra', true),
            "manager" => $this->input->post('manager', true),
            "poin_sendiri" => $this->input->post('pointSendiri', true),
            "poin_team" => $this->input->post('pointTeam', true),
            "peringkat_langsung" => $this->input->post('peringkatLangsung', true),
            "peringkat_tidaklangsung" => $this->input->post('peringkatTidakLangsung', true),
            "jumlah_leader" => $this->input->post('leader', true),
            "jumlah_distributor" => $this->input->post('distributor', true),
            "jumlah_retrain" => $this->input->post('retrain', true),
            "jumlah_observasi" => $this->input->post('observasi', true),
            "jumlah_team" => $this->input->post('team', true)

        ];
        return $this->db->insert('toplead', $data);
    }

    public function editDataToplead()
    {
        $data = [
            "nama" => $this->input->post('mitra', true),
            "manager" => $this->input->post('manager', true),
            "poin_sendiri" => $this->input->post('pointSendiri', true),
            "poin_team" => $this->input->post('pointTeam', true),
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
        return $this->db->update('toplead');
    }

    public function hapusDataToplead($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('toplead');
    }
    public function ubahDataKaryawan()
    {
        $data = [
            "kode_id" => $this->input->post('kode_id', true),
            "nama" => $this->input->post('nama', true),
            "tgl_lahir" => $this->input->post('tgl_lahir', true),
            "jabatan" => $this->input->post('jabatan', true),
            "thn_gabung" => $this->input->post('thn_gabung', true),
            "alamat" => $this->input->post('alamat', true),
            "kota" => $this->input->post('kota', true),
            "no_telp" => $this->input->post('no_telp', true),
            "email" => $this->input->post('email', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('manager', $data);
    }
    public function cariDataKaryawan()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jabatan', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->db->get('manager')->result_array();
    }
}
