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
    $this->db->select('om.*, jm.kode,name,jabatan');
    $this->db->from($this->table . ' om');
    $this->db->join('daftar_mitra jm', 'jm.id = om.idmitra', 'RIGHT');
    $query = $this->db->get()->result_array();
    // echo $this->db->last_query();
    return $query;
  }

  public function up()
  {
    // Produces: DROP TABLE IF EXISTS table_name
    // $this->dbforge->drop_table($this->table,TRUE);

    // create table
    $fields = array(
      'id' => array('type' => 'INT', 'auto_increment' => TRUE),
      'idmitra' => array('type' => 'INT', 'constraint' => 10, 'null' => TRUE),
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

  public function down()
  {
    // Produces: DROP TABLE IF EXISTS table_name
    $this->dbforge->drop_table($this->table,TRUE);
  }

}

/* End of file M_OverrideSaldo_model.php */
/* Location: ./application/models/M_OverrideSaldo_model.php */