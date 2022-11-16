<?php

class M_team extends CI_Model
{
    protected $table = 'team';

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->up();
    }

    public function tampil_data()
    {
        return $this->db->get($this->table)->result_array();
    }

    function tampil_team()
    {
        $this->db->select("*")->from($this->table . ' tm');
        $this->db->join('daftar_mitra dm', 'dm.kode=tm.kodemitra', 'left');
        // return $this->db->select("*")->from("team")->get()->result_array();
        $query = $this->db->get(); 
        // echo $this->db->last_query();
        if($query->num_rows() != 0) {
            return $query->result_array();
        }
    }

    public function tambahDataTeam($data)
    {
        
        $this->db->insert($this->table, $data);
    }
    public function hitungJumlahAsset()
    {

        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    // public function getteamById($id){
    //     return $this->db->get_where($this->table,['id'=>$id])->row_array();
    // }
    public function hapusDatateam($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    public function getteamById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
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
        $this->db->update($this->table, $data);
    }
    public function cariDatateam()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jabatan', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->db->get($this->table)->result_array();
    }
    
    public function up()
    {
        // 
        if (!$this->db->field_exists('kodemitra', $this->table))
        {
        $fields = array(
            'kodemitra' => array('type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE),
        );
        
        $this->dbforge->add_column($this->table, $fields);
        }

    }

    public function down()
    {
      // Produces: DROP TABLE IF EXISTS table_name
    //   $this->dbforge->drop_table($this->table,TRUE);
    }
}
