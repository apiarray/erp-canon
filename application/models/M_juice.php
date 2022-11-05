<?php

class M_juice extends CI_Model {


    public function tampil_data($weekending) {
        if (!$weekending) {
            $this->db->select('weekly_manager2.tgl_validasi as tgl_validasi,daftar_mitra.name as nama_mitra, weekly_manager2.nominal_total as total,
            daftar_mitra.kota AS lokasi');
            $this->db->from('weekly_manager2');
            $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->select('weekly_manager2.tgl_validasi as tgl_validasi,daftar_mitra.name as nama_mitra, weekly_manager2.nominal_total as total,
            daftar_mitra.kota AS lokasi');
            $this->db->from('weekly_manager2');
            $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
            $this->db->where('tgl_validasi',$weekending);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
    public function tampil_semua_data(){
        $this->db->select('weekly_manager2.tgl_validasi as tgl_validasi,daftar_mitra.name as nama_mitra');
        $this->db->from('weekly_manager2');
        $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function tambahDataJuice(){
        $data = [
            "nama" => $this->input->post('nama',true),
            "lokasi" => $this->input->post('lokasi',true),
            "point" => $this->input->post('point',true),
            "omzet" => $this->input->post('omzet',true),
            "weekending" => "up"

        ];
        $this->db->insert('juice',$data);
    }

    public function editDataJuice(){
        $data = [
            "nama" => $this->input->post('nama2',true),
            "lokasi" => $this->input->post('lokasi2',true),
            "point" => $this->input->post('point2',true),
            "omzet" => $this->input->post('omzet2',true)
        ];
        $this->db->where('id', $this->input->post('id', true));
        $this->db->set($data);
        $this->db->update('juice');
    }

    public function get_tgl() {
        $this->db->select('tgl_validasi');
        $this->db->distinct();
        $this->db->where('tgl_validasi is NOT NULL', NULL, FALSE);
        $this->db->order_by('tgl_validasi', 'DESC');
        return $this->db->get('weekly_manager2')->result_array();
    }

    public function getDataById($id) {
        return $this->db->get_where('juice', ['id' => $id])->row_array();
    }

    public function hapusDataJuice($id) {
        $this->db->where('id',$id);
        $this->db->delete('juice');
    }
    public function ubahDataJuice(){
        $data = [
            "kode_id" => $this->input->post('kode_id',true),
            "nama" => $this->input->post('nama',true),
            "tgl_lahir" => $this->input->post('tgl_lahir',true),
            "jabatan" => $this->input->post('jabatan',true),
            "thn_gabung" => $this->input->post('thn_gabung',true),
            "alamat" => $this->input->post('alamat',true),
            "kota" => $this->input->post('kota',true),
            "no_telp" => $this->input->post('no_telp',true),
            "email" => $this->input->post('email',true),
        ];
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('juice',$data);
    }
    public function cariDataJuice(){
        $keyword = $this->input->post('keyword',true);
        $this->db->like('nama',$keyword);
        $this->db->or_like('jabatan',$keyword);
        $this->db->or_like('alamat',$keyword);
        return $this->db->get('juice')->result_array();
    }
    
    public function tampil_data_by_mitra()
    {
      $this->db->select('daftar_mitra.name');
      $this->db->distinct();
      $this->db->from('daftar_mitra');
      $this->db->join('weekly_manager2', 'weekly_manager2.kode_id = daftar_mitra.kode');
      $query = $this->db->get();
      return $query->result_array();
    }

    public function tampil_data_like($bulan) {
        $this->db->select('weekly_manager2.tgl_validasi as tgl_validasi,daftar_mitra.name as nama_mitra, weekly_manager2.nominal_total as total,
        daftar_mitra.kota AS lokasi');
        $this->db->from('weekly_manager2');
        $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
        $this->db->like('tgl_validasi', $bulan);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function tampil_data_mitra($name){
        $this->db->select('weekly_manager2.tgl_validasi as tgl_validasi,daftar_mitra.name as nama_mitra, weekly_manager2.nominal_total as total,
        daftar_mitra.kota AS lokasi');
        $this->db->from('weekly_manager2');
        $this->db->join('daftar_mitra', 'weekly_manager2.kode_id = daftar_mitra.kode');
        $this->db->like('daftar_mitra.name', $name);

        $query = $this->db->get();
        return $query->result_array();
    }

    

    
}
