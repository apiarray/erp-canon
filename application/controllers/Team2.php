<?php

class Team2 extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_team');
        $this->load->model('M_Daftarmitra');
        $this->load->model('M_JabatanMitra');
    }
    public function index(){
        $topik['judul'] = 'Team Page Client';
		$data['team']=$this->M_team->tampil_team();
		
        $this->load->view('templates2/header',$topik);
        $this->load->view('team2/index',$data);
        $this->load->view('templates2/footer');
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Team';
        // $data['jabatan'] = ['Logitic','Finance & Accounting','Administration','Inventory','General Affair','IT','HRD','Messenger','Resepsionist'];
        $data['jabatanList'] = $this->M_JabatanMitra->getAllData();
        // echo json_encode($data['jabatanList']);

        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('tgl_lahir','Tgl_Lahir','required');
        $this->form_validation->set_rules('jabatan','Jabatan','required');
        $this->form_validation->set_rules('thn_gabung','Thn_gabung','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('kota','Kota','required');
        $this->form_validation->set_rules('no_telp','No_telp','required');
        $this->form_validation->set_rules('email','Email','required');

        if ($this->form_validation->run() == TRUE) {
            // $formdata = $this->input->post();
            // echo json_encode($formdata); die();s

            $data = [
                "kode" => $this->input->post('kode', true),
                "nama" => $this->input->post('nama', true),
                "tgl_lahir" => $this->input->post('tgl_lahir', true),
                "jabatan" => $this->input->post('jabatan', true),
                "tahun_gabung" => $this->input->post('thn_gabung', true),
                "alamat" => $this->input->post('alamat', true),
                "kota_kec" => $this->input->post('kota', true),
                "no_telpon" => $this->input->post('no_telp', true),
                "email" => $this->input->post('email', true),
                "kodemitra" => $this->input->post('kode_mitra', true),
            ];

            $this->M_team->tambahDataTeam($data);
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('team2');
        }

        // 
        $data['listMitra'] = $this->M_Daftarmitra->getAllData();

        $this->load->view('templates2/header',$data);
        $this->load->view('team2/tambah',$data);
        $this->load->view('templates2/footer');
        
    }
}