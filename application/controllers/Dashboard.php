<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->model('M_kategori');
        $this->load->model('M_gudang');
        $this->load->model('M_karyawan');
        $this->load->model('M_override');
        $this->load->model('M_JabatanMitra');

        $this->load->library('form_validation');
        $this->load->helper('form');

        // $this->check_login();
        if ($this->session->userdata('id_role') != 1) {
            redirect('auth/login', 'refresh');
        }
    }
	public function index()
	{
        $topik['judul'] = 'Halaman Dashboard';
        $data['produk'] = $this->M_barang->hitungJumlahAsset();
        $data['tbl_category'] = $this->M_kategori->hitungJumlahAsset();
        $data['gudang'] = $this->M_gudang->hitungJumlahAsset();
        $data['karyawan'] = $this->M_karyawan->hitungJumlahAsset();

		$this->load->view('templates/header',$topik);
        $this->load->view('dashboard/index',$data);
        // $this->load->view('dashboard/index');
        $this->load->view('templates/footer');
    }

    public function Override() {
        $topik['judul'] = 'Override';
        $data['judul'] = $topik['judul'];       
        $data['overrides'] = $this->M_override->getAllData();
        $data['jabatanList'] = $this->M_JabatanMitra->getAllData();

		$this->load->view('templates/header',$topik);
        $this->load->view('dashboard/override',$data);
        $this->load->view('templates/footer');
    }

    public function Override_Saldo(){
        $topik['judul'] = 'Saldo Override';
        $data['judul'] = $topik['judul'];       
        $data['overrides'] = $this->M_override->getAllData();       

		$this->load->view('templates/header',$topik);
        $this->load->view('dashboard/override_saldo',$data);
        $this->load->view('templates/footer');
    }

    public function Override_Create()
    {
        $post = $this->input->post();
        // echo json_encode($post);
        // {"kode":"OV00006","name":"1","persen":"4","check":"on"}

        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('name', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('persen', 'Persen', 'required');
        if ($this->form_validation->run() == TRUE)
        {

            // response as ajax
            $response = array(
                'msg' => 'Overide Mitra berhasil tersimpan!',
                'data' => ($post),
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

    public function override_getkode()
    {
        // OV-00001
        $jsonArr = $this->M_JabatanMitra->getLastIndex();
        $docno = array_column($jsonArr, 'kode');
        $num = preg_replace('/\D/', '', $docno[0]);
        $newKode = "OV" . str_pad((int)$num+1, 5, '0', STR_PAD_LEFT);

        echo ($newKode);
    }
   
}
