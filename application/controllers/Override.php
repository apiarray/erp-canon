<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Override
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

class Override extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();

    $this->load->model('M_Overridemitra');
    $this->load->model('M_JabatanMitra');

    $this->load->library('form_validation');
    $this->load->helper('form');

    if ($this->session->userdata('id_role') != 1) {
      redirect('auth/login', 'refresh');
    }
  }

  public function index()
  {
    $topik['judul'] = 'Override';
    $data['judul'] = $topik['judul'];       
    $data['overrides'] = $this->M_Overridemitra->getAllData();
    $data['jabatanList'] = $this->M_JabatanMitra->getAllData();

    $this->load->view('templates/header',$topik);
    $this->load->view('override/index',$data);
    $this->load->view('templates/footer');
  }

  public function Override_Create()
  {
      $post = $this->input->post();
      // echo json_encode($post);
      // {"kode":"OV00006","name":"1","persen":"4","check":"on"}

      $this->form_validation->set_rules('kode', 'Kode', 'required');
      $this->form_validation->set_rules('kode_jabatan', 'Nama Jabatan', 'required');
      // $this->form_validation->set_rules('persen', 'Persen', 'required');
      if ($this->form_validation->run() == TRUE)
      {
        // echo $post['check'][0] . "<br>";
        // echo $post['persen'][$post['check'][0]];
        $fields_name = $post['check'][0];

          $data = array(
            'kode' => $post['kode'],
            'kode_jabatan' => $post['kode_jabatan'],
            'persen' => $post['persen'][$post['check'][0]],
          );

          if($fields_name=="omsetless_15") $data = array_merge($data, array('omsetless_15' => 'Y'));

          if($fields_name=="omsetmore_15") $data = array_merge($data, array('omsetmore_15' => 'Y'));

          if($fields_name=="omsetall") $data = array_merge($data, array('omsetall' => 'Y'));

          $this->M_Overridemitra->create($data);

          // response as ajax
          $response = array(
              'msg' => 'Overide Mitra berhasil tersimpan!',
              'data' => ($data),
              'success' => true,
          );
      } else {
          // echo validation_errors();
          $response = array(
              'msg' => 'Error!',
              'data' => validation_errors(),
              'success' => false,
          );
      }

      echo json_encode($response);

  }

  public function hapus($id)
  {
    $query = $this->M_overridemitra->delete($id);        
    // $this->session->set_flashdata('success', 'Jabatan berhasil dihapus!');
    // redirect('jabatan', 'refresh');

    $response = array(
      'msg' => 'Jabatan berhasil dihapus!',
      'success' => true,
    );

    echo json_encode($response);
  }

  public function override_getkode()
  {
      // OV-00001
      $jsonArr = $this->M_Overridemitra->getLastIndex();
      $docno = array_column($jsonArr, 'kode');
      $num = preg_replace('/\D/', '', $docno[0]);
      $newKode = "OV" . str_pad((int)$num+1, 5, '0', STR_PAD_LEFT);

      echo ($newKode);
  }

}


/* End of file Override.php */
/* Location: ./application/controllers/Override.php */