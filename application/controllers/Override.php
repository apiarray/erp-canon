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

    $this->load->model('M_Daftarmitra');
    $this->load->model('M_OverrideSaldo');
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
      $this->form_validation->set_rules('kode', 'Kode', 'required');
      $this->form_validation->set_rules('kode_jabatan', 'Nama Jabatan', 'required');
      if ($this->form_validation->run() == TRUE)
      {
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
          $response = array(
              'msg' => 'Error!',
              'data' => validation_errors(),
              'success' => false,
          );
      }

      echo json_encode($response);

  }

  public function edit($id)
  {
    $topik['judul'] = 'Jabatan Mitra';
    $data['judul'] = $topik['judul'];       
    $data['overrides'] = $this->M_Overridemitra->view($id);
    $data['jabatanList'] = $this->M_JabatanMitra->getAllData();

    if($this->input->post())
    {
      $post = $this->input->post();
      // echo json_encode($post);
      $this->form_validation->set_rules('kode', 'Kode', 'required');
      $this->form_validation->set_rules('kode_jabatan', 'Nama Jabatan', 'required');
      if ($this->form_validation->run() == TRUE)
      {
        $fields_name = $post['check'][0];

        $data = array(
          'kode' => $post['kode'],
          'kode_jabatan' => $post['kode_jabatan'],
          'persen' => $post['persen'][$post['check'][0]],
        );

        if($fields_name=="omsetless_15") {
          $data = array_merge($data, array(
            'omsetless_15' => 'Y',
            'omsetmore_15' => null,
            'omsetall' => null
          ));
        }

        if($fields_name=="omsetmore_15") {
          $data = array_merge($data, array(
            'omsetless_15' => null,
            'omsetmore_15' => 'Y',
            'omsetall' => null
          ));
        }

        if($fields_name=="omsetall") {
          $data = array_merge($data, array(
            'omsetless_15' => null,
            'omsetmore_15' => null,
            'omsetall' => 'Y'
          ));
        }

        $this->M_Overridemitra->update($post['id'], $data);
        
        $this->session->set_flashdata('success', 'Update Override berhasil!');
        redirect('override/edit/' . $id, 'refresh');
      }
    }

		$this->load->view('templates/header',$topik);
    $this->load->view('override/view',$data);
    $this->load->view('templates/footer');
  }

  public function hapus($id)
  {
    $query = $this->M_Overridemitra->delete($id);
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

  public function saldo(){
    $topik['judul'] = 'Saldo Override';
    $data['judul'] = $topik['judul'];       
    $data['mitraList'] = $this->M_OverrideSaldo->getAllData();

    $this->load->view('templates/header',$topik);
    $this->load->view('override/saldo',$data);
    $this->load->view('templates/footer');
  }

  public function saldoUpdate($id){
    $topik['judul'] = 'Saldo Override';
    $data['judul'] = $topik['judul'];       
    $data['mitraList'] = $this->M_OverrideSaldo->view($id);

    if($this->input->post())
    {
      $post = $this->input->post();
      // echo json_encode($post);
      $this->form_validation->set_rules('kode', 'Kode', 'required');
      // $this->form_validation->set_rules('saldo_override', 'Nama Jabatan', 'required');
      if ($this->form_validation->run() == TRUE)
      {
        // echo "OK";
        $this->M_OverrideSaldo->update($post['id'], array(
          'idmitra' => $post['id'],
          'saldo_override' => $post['saldo_override'],
          'saldo_ho' => $post['saldo_ho']
        ));
        
        $this->session->set_flashdata('success', 'Update Saldo berhasil!');
        redirect('override/saldoupdate/' . $id, 'refresh');
      }

    }

    $this->load->view('templates/header',$topik);
    $this->load->view('override/saldo_update',$data);
    $this->load->view('templates/footer');
  }

  public function ApiGetMitra($id){
    // echo $id;
    $data['data'] = $this->M_OverrideSaldo->viewByKode($id);
    $response = array(
      'kodemitra' => $id,
      'data' => $data['data'],
      'success' => !empty($data['data']) ? true : false,
    );

    echo json_encode($response);
  }

}


/* End of file Override.php */
/* Location: ./application/controllers/Override.php */