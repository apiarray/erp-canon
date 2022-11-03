<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Top_asmen2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_asmen');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu Asmen';
        $data['tgl'] = $this->m_asmen->weekending();
        $data['manager'] = $this->db->select("name")->from("daftar_mitra")->where("jabatan", "Assistant Manager")->get()->result();
        $this->load->view('templates2/header', $topik);
        $this->load->view('topasmen2/index', $data);
        $this->load->view('templates2/footer');
    }

    public function getData($weekending = "")
    {
        echo json_encode($this->m_asmen->tampil_data($weekending));
    }

    public function getDataById($id)
    {
        echo json_encode($this->m_asmen->getDataById($id));
    }

    public function tambah()
    {
        $result = $this->m_asmen->tambahDataAsmen();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        echo json_encode($result);
    }

    public function edit()
    {
        $result = $this->m_asmen->editDataAsmen();
        $this->session->set_flashdata('flash', 'Diedit');
        echo json_encode($result);
    }

    public function hapus($id)
    {
        $this->m_asmen->hapusDataAsmen($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('top_asmen2');
    }
    //     public function edit($id){
    //         $topik['judul'] = 'Edit Data Supplier';
    //         $data['supplier'] = $this->M_asmen->getSupplierById($id);
    //         // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

    //         $this->form_validation->set_rules('kode','Kode','required');
    //         $this->form_validation->set_rules('nama','Nama','required');
    //         $this->form_validation->set_rules('alamat','Alamat','required');
    //         $this->form_validation->set_rules('telepon','Telepon','required');


    //         if ($this->form_validation->run() == FALSE) {
    //             $this->load->view('templates2/header',$topik);
    //             $this->load->view('supplier/edit',$data);
    //         }else {
    //             $this->M_asmen->ubahDataSupplier();
    //             $this->session->set_flashdata('flash','Diubah');
    //             redirect('supplier');
    //         }
    // }
}
