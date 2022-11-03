<?php

class M_team extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('team')->result_array();
    }

    function tampil_team()
    {

        return $this->db->select("*")->from("team")->get()->result_array();
    }

    public function tambahDataTeam()
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "nama" => $this->input->post('nama', true),
            "tgl_lahir" => $this->input->post('tgl_lahir', true),
            "jabatan" => $this->input->post('jabatan', true),
            "tahun_gabung" => $this->input->post('thn_gabung', true),
            "alamat" => $this->input->post('alamat', true),
            "kota_kec" => $this->input->post('kota', true),
            "no_telpon" => $this->input->post('no_telp', true),
            "email" => $this->input->post('email', true),

        ];
        $this->db->insert('team', $data);
    }
    public function hitungJumlahAsset()
    {

        $query = $this->db->get('team');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    // public function getteamById($id){
    //     return $this->db->get_where('team',['id'=>$id])->row_array();
    // }
    public function hapusDatateam($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('team');
    }
    public function getteamById($id)
    {
        return $this->db->get_where('team', ['id' => $id])->row_array();
    }
    public function ubahDatateam()
    {
        $data = [
            "kode_id" => $this->input->post('kode_id', true),
            "nama" => $this->input->post('nama', true),
            "tgl_lahir" => $this->input->post('tgl_lahir', true),
            "jabatan" => $this->input->post('jabatan', true),
            "tahun_gabung" => $this->input->post('thn_gabung', true),
            "alamat" => $this->input->post('alamat', true),
            "kota_kec" => $this->input->post('kota', true),
            "no_telpon" => $this->input->post('no_telp', true),
            "email" => $this->input->post('email', true)

        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('team', $data);
    }
    public function cariDatateam()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jabatan', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->db->get('team')->result_array();
    }
}
