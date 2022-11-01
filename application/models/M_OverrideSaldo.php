<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_OverrideSaldo_model
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

class M_OverrideSaldo extends CI_Model {

  protected $table = 'override_saldo';

  public function __construct()
  {
    parent::__construct();

    $this->load->dbforge();

    $this->up();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  public function getAllData()
  {
    $this->db->select('dm.id,kode,name,jabatan, om.saldo_override,saldo_ho');
    $this->db->from('daftar_mitra dm');
    $this->db->join($this->table . ' om', 'om.idmitra = dm.id', 'left');
    $query = $this->db->get()->result_array();
    // echo $this->db->last_query();
    return $query;
  }

  public function view($id){
    $this->db->select('dm.id,kode,name,jabatan, om.saldo_override,saldo_ho');
    $this->db->from('daftar_mitra dm');
    $this->db->join($this->table . ' om', 'om.idmitra = dm.id', 'left');
    $this->db->where('dm.id', $id);
    $query = $this->db->get()->row();
    // echo $this->db->last_query();
    return $query;
  }

  public function update($id, $data)
  {
    $array = array('idmitra' => $id);
    $result = $this->db->select('idmitra')->from($this->table)->where($array)->get();
    if($result->num_rows())
    {
      return $this->db->update($this->table, $data, $array);
      
    } else {
      return $this->db->insert($this->table,$data);
    }
  }

  public function create($data)
  {
    return $this->db->insert($this->table,$data);
  }

  public function up()
  {
    // Produces: DROP TABLE IF EXISTS table_name
    // $this->dbforge->drop_table($this->table,TRUE);
    if (!$this->db->table_exists($this->table))
    {
      // create table
      $fields = array(
        'id' => array('type' => 'INT', 'auto_increment' => TRUE),
        'idmitra' => array('type' => 'INT', 'constraint' => 10, 'null' => TRUE),
        'kode' => array('type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE),
        'saldo_override' => array('type' => 'INT', 'constraint' => 10,'null' => TRUE),
        'saldo_ho' => array('type' => 'INT', 'constraint' => 10,'null' => TRUE),
      );

      $this->dbforge->add_field($fields);

      $this->dbforge->add_key('id', TRUE);
      // gives PRIMARY KEY (id)

      $attributes = array('ENGINE' => 'InnoDB');
      // CREATE TABLE IF NOT EXISTS table_name
      $this->dbforge->create_table($this->table, TRUE, $attributes);
    }

    // 
    if (!$this->db->field_exists('kode', $this->table))
    {
      $fields = array(
        'kode' => array('type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE),
      );
      
      $this->dbforge->add_column($this->table, $fields);
    }
  }

  public function down()
  {
    // Produces: DROP TABLE IF EXISTS table_name
    $this->dbforge->drop_table($this->table,TRUE);
  }

}

/* End of file M_OverrideSaldo_model.php */
/* Location: ./application/models/M_OverrideSaldo_model.php */