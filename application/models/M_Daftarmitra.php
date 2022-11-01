<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model M_Daftarmitra_model
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

class M_Daftarmitra extends CI_Model {

  protected $table = 'daftar_mitra';

  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    // 
  }

  public function getAllData()
  {
    return $this->db->get($this->table)->result_array();
  }

}

/* End of file M_Daftarmitra_model.php */
/* Location: ./application/models/M_Daftarmitra_model.php */