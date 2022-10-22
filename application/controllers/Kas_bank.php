<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas_bank extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model(['m_barang', 'M_KartuStok']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $topik['judul'] = 'Halaman Menu Kas Bank';

        $this->load->view('templates/header', $topik);
        $this->load->view('KasBank/Index/index');
        $this->load->view('templates/footer');

        //load file javascript
        $this->load->view('KasBank/Index/S_KasBank');
    }

    public function tambah()
    {
        $topik['judul'] = 'Halaman Tambah Kas Bank';

        $this->load->view('templates/header', $topik);
        $this->load->view('KasBank/Tambah/index');
        $this->load->view('templates/footer');

        //load file javascript
        $this->load->view('KasBank/Tambah/S_Tambah');
    }
}
