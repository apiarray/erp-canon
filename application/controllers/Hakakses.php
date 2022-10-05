<?php

class Hakakses extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Akses','m_akses');
        $this->load->model('M_menu');
        $this->load->model('m_role');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu User';
        $data['tbl_role'] = $this->m_role->tampil_data();
        $data['jabatan'] = $this->m_akses->getJabatan();
        var_dump($data['jabatan']);
        $this->load->view('templates/header',$topik);
        $this->load->view('hakakses/index',$data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $topik['judul'] = 'Form Tambah Data Hak Akses';

        $this->form_validation->set_rules('name', 'Nama', 'required');

        if($this->form_validation->run() == FALSE) {
            $data['menus'] = $this->M_menu->getMenu();
            $data['subMenus'] = $this->M_menu->getSubMenu();
            $this->load->view('templates/header', $topik);
            $this->load->view('hakakses/tambah', $data);
        } else {
            $this->M_Akses->tambahHakAkses();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('users');
        }
    }
    
}