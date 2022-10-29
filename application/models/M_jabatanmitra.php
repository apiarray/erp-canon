<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_jabatanmitra
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

class M_jabatanmitra extends CI_Model {

  protected $table = 'jabatan_mitra';

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function getAllData()
  {
    return $this->db->get($this->table)->result_array();
  }

  public function create($data)
  {
    return $this->db->insert($this->table,$data);
  }

  public function view($id, $limit="", $offset="")
  {
    return $this->db->get_where($this->table, array('id' => $id), $limit, $offset);
  }

  public function update($id, $data)
  {
    return $this->db->update($this->table, $data, array('id' => $id));
  }

  public function delete($id)
  {
    return $this->db->delete($this->table)->where(array('id' => $id));
  }

}

/* End of file M_jabatanmitra.php_model.php */
/* Location: ./application/models/M_jabatanmitra.php_model.php */