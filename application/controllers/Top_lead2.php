<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Top_lead2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_lead');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu Top Leader';
        $data['tgl'] = $this->m_lead->tampil_weekending();
        $this->load->view('templates2/header', $topik);
        $this->load->view('toplead2/index', $data);
        $this->load->view('templates2/footer');
    }

    public function tampil_data2($weekending = "")
    {
        echo json_encode($this->m_lead->tampil_data2($weekending));
    }

    public function getDataById($id)
    {
        echo json_encode($this->m_lead->getDataById($id));
    }

    public function tambah()
    {
        $result = $this->m_lead->tambahDataToplead();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        echo json_encode($result);
    }

    public function edit()
    {
        $result = $this->m_lead->editDataToplead();
        $this->session->set_flashdata('flash', 'Diedit');
        echo json_encode($result);
    }

    public function hapus($id)
    {
        $this->m_lead->hapusDataToplead($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('top_lead2');
    }
    //     public function edit($id){
    //         $topik['judul'] = 'Edit Data Supplier';
    //         $data['supplier'] = $this->m_lead->getSupplierById($id);
    //         // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

    //         $this->form_validation->set_rules('kode','Kode','required');
    //         $this->form_validation->set_rules('nama','Nama','required');
    //         $this->form_validation->set_rules('alamat','Alamat','required');
    //         $this->form_validation->set_rules('telepon','Telepon','required');


    //         if ($this->form_validation->run() == FALSE) {
    //             $this->load->view('templates2/header',$topik);
    //             $this->load->view('supplier/edit',$data);
    //         }else {
    //             $this->m_lead->ubahDataSupplier();
    //             $this->session->set_flashdata('flash','Diubah');
    //             redirect('supplier');
    //         }
    // }
}
