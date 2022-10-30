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
    // 
  }

  public function up()
  {
    // drop table if exist
    $this->dbforge->drop_table($this->table,TRUE);

    // create table
    $fields = array(
      'id' => array('type' => 'INT', 'auto_increment' => TRUE),
      'kode' => array('type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE),
      'name' => array('type' => 'VARCHAR', 'constraint' => 50,'null' => TRUE),
      'omsetless_15' => array('type' => 'VARCHAR', 'null' => TRUE),
      'omsetmore_15' => array('type' => 'VARCHAR', 'null' => TRUE),
      'omsetall' => array('type' => 'VARCHAR', 'null' => TRUE),
    );

    $this->dbforge->add_column($this->table, $fields);
  }

}

/* End of file M_Overridemitra_model.php */
/* Location: ./application/models/M_Overridemitra_model.php */