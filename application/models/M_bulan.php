<?php

class M_bulan extends CI_Model{
    public function tampil_data(){
        return $this->db->get('tbl_bulan')->result_array();
    }
}
