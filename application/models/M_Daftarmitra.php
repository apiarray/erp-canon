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

  public function create($data)
  {
    return $this->db->insert($this->table,$data);
  }

  public function getLastIndex(){
    $this->db->select_max('kode');
    $query = $this->db->get($this->table);
    return $query->result();
  }

  public function getLastKode(){
    // MT-00001
    $jsonArr = $this->getLastIndex();
    $docno = array_column($jsonArr, 'kode');
    $num = preg_replace('/\D/', '', $docno[0]);
    $newKode = "MT-" . str_pad((int)$num+1, 5, '0', STR_PAD_LEFT);

    echo ($newKode);
  }

}

/* End of file M_Daftarmitra_model.php */
/* Location: ./application/models/M_Daftarmitra_model.php */