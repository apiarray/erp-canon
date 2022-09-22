<?php

class M_transfergudang extends CI_Model
{
    public function tampil_data(){
        return $this->db->get('tf_gudang')->result_array();
    }
    public function tambahDataTfGudang() {
        $data = [
            "tgl" => $this->input->post('tgl_tfgdg',true),
            "no_transfer" => $this->input->post('no_transfer_tfgdg',true),
            "keterangan" => $this->input->post('keterangan_tfgdg',true),
            "kode" => $this->input->post('kode_tfgdg',true),
            "barang" => $this->input->post('barang_tfgdg',true),
            "gudang_asal" => $this->input->post('gudang_asal_tfgdg',true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan_tfgdg',true),
            "qty" => $this->input->post('qty_tfgdg',true),
            "kode_id" => $this->session->userdata('kode_id')
        ];
        
        $this->db->insert('tf_gudang', $data);
    }

    public function getAllGdg() {
        $this->db->select('nama');
        return $this->db->get('gudang')->result_array();
    }

    public function getLatestNoTf() {
        $this->db->select('no_transfer');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('tf_gudang')->row_array();
    }

    public function getTfGudangById($id){
        return $this->db->get_where('tf_gudang',['id'=>$id])->row_array();
    }
    public function hapusDataTfGudang($id){
        $this->db->where('id',$id);
        $this->db->delete('tf_gudang');
    }
    public function ubahDataTfGudang(){
        $data = [
            "tgl" => $this->input->post('tgl_tfgdg',true),
            "no_transfer" => $this->input->post('no_transfer_tfgdg',true),
            "keterangan" => $this->input->post('keterangan_tfgdg',true),
            "kode" => $this->input->post('kode_tfgdg',true),
            "barang" => $this->input->post('barang_tfgdg',true),
            "gudang_asal" => $this->input->post('gudang_asal_tfgdg',true),
            "gudang_tujuan" => $this->input->post('gudang_tujuan_tfgdg',true),
            "qty" => $this->input->post('qty_tfgdg',true),
            "kode_id" => $this->session->userdata('kode_id')
        ];
        $this->db->where('id', $this->input->post('id_tfgdg'));
        $this->db->update('tf_gudang',$data);
    }
}
