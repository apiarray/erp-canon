<?php

class Hakakses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Akses', 'm_akses');
        $this->load->model('M_menu');
        $this->load->model('m_role');

        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu User';
        $data['tbl_role'] = $this->m_role->tampil_data();
        $data['jabatan'] = $this->m_akses->getJabatan();
        $this->load->view('templates/header', $topik);
        $this->load->view('hakakses/index', $data);
        $this->load->view('hakakses/akses_js');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $topik['judul'] = 'Form Tambah Data Hak Akses';

        $this->form_validation->set_rules('name', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['menus'] = $this->M_menu->getMenu();
            $data['subMenus'] = $this->M_menu->getSubMenu();
            $data['roles'] = $this->M_menu->getRole();
            $this->load->view('templates/header', $topik);
            $this->load->view('hakakses/tambah', $data);
        } else {
            $this->m_akses->tambahHakAkses();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('users');
        }
    }

    public function simpan()
    {
        $this->M_akses->tambahHakAkses();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('users');
    }

    public function edit()
    {
        if ($this->session->set_userdata('role_id') == 1) {
            $this->session->set_flashdata('gagal', 'Anda Tidak Memiliki Akses');
            redirect('unautorized');
        } else {
            $data['list_menu'] = $this->m_akses->list_menu();
            $data['list_user'] = $this->m_akses->list_user();
            $this->load->view('hakakses/akses_edit', $data);
        }
    }

    public function hapus($id)
    {
        $this->m_role->hapus_data($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('users');
    }

    public function simpan_akses()
    {
 
        return 'jembot';
     }

    public function update()
    {
        $this->m_role->update_data();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('users');
    }
}
