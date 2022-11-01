<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_Overridemitra_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class M_Overridemitra extends CI_Model {

  protected $table = 'override_mitra';

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    if ($this->db->table_exists($this->table))
    {
      $this->up();
    }
  }

  public function getAllData()
  {
    $this->db->select('om.*, jm.name');
    $this->db->from($this->table . ' om');
    $this->db->join('jabatan_mitra jm', 'jm.kode = om.kode_jabatan');
    $query = $this->db->get()->result_array();
    // echo $this->db->last_query();
    return $query;
    // return $this->db->get($this->table)->result_array();
  }

  public function create($data)
  {
    return $this->db->insert($this->table,$data);
  }

  public function view($id, $limit="", $offset="")
  {
    $this->db->select('om.*, jm.name');
    $this->db->from($this->table . ' om');
    $this->db->join('jabatan_mitra jm', 'jm.kode = om.kode_jabatan');
    $this->db->where('om.id', $id);
    $query = $this->db->get()->row();
    // echo $this->db->last_query();
    return $query;
    // $this->db->get()->result();
  }

  public function update($id, $data)
  {
    return $this->db->update($this->table, $data, array('id' => $id));
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete($this->table);
  }

  public function getLastIndex(){
    $this->db->select_max('kode');
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function up()
  {
    // drop table if exist
    $this->dbforge->drop_table($this->table,TRUE);

    // create table
    $fields = array(
      'id' => array('type' => 'INT', 'auto_increment' => TRUE),
      'kode' => array('type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE),
      'kode_jabatan' => array('type' => 'VARCHAR', 'constraint' => 50,'null' => TRUE),
      'persen' => array('type' => 'INT', 'constraint' => 10,'null' => TRUE),
      'omsetless_15' => array('type' => 'ENUM', 'null' => TRUE),
      'omsetmore_15' => array('type' => 'ENUM', 'null' => TRUE),
      'omsetall' => array('type' => 'ENUM', 'null' => TRUE),
    );

    $this->dbforge->add_column($this->table, $fields);
  }

}

/* End of file M_Overridemitra_model.php */
/* Location: ./application/models/M_Overridemitra_model.php */