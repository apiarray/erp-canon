<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller JabatanMitra
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Jabatan extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    
    $this->load->model('M_jabatanmitra');

    if ($this->session->userdata('id_role') != 1) {
      redirect('auth/login', 'refresh');
    }
  }

  public function index()
  {
    echo "Jabatanmitra";
  }

}


/* End of file JabatanMitra.php */
/* Location: ./application/controllers/JabatanMitra.php */