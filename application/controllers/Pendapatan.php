<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_pendapatanlain');
        $this->load->library('form_validation');
    }
    public function index(){
        
        $topik['judul'] = 'Halaman Menu Pendapatan Lain';
        $data['pendapatanlain'] = $this->M_pendapatanlain->tampil_data();
        $this->load->view('templates/header',$topik);
        $this->load->view('pendapatanlain/index',$data);
        $this->load->view('templates/footer');
    }
    public function filter(){
        $topik['judul'] = 'Halaman Menu Pendapatan Lain';
        $dfil['tanggal'] = $this->input->get('tanggal', true);
        $dfil['tanggal_sampai'] = $this->input->get('tanggal_sampai', true);

        $data['pendapatanlain'] = $this->M_pendapatanlain->filter($dfil);
        $this->load->view('templates/header',$topik);
        $this->load->view('pendapatanlain/index',$data);
        $this->load->view('templates/footer');
    }
    
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Pendapatan Lain';
        
            $dariDB = $this->M_pendapatanlain->cekkodependapatan();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($dariDB, 3, 4);
            $cekkodependapatan = $nourut + floatval("1");
            $data2 = array('no_faktur' => $cekkodependapatan);

        //$dariDB = $this->M_pendapatanlain->cekkodependapatan();
        // contoh PN0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        //$nourut = substr($dariDB, 3, 4);
        //$kodePendapatan = $nourut + 1;
        //$data2 = array('no_faktur' => $kodePendapatan);

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No_Faktur','required');
        $this->form_validation->set_rules('transaksi','Transaksi','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$data);
            $this->load->view('pendapatanlain/tambah',$data2);
            $this->load->view('templates/footer');
        }else {
            $this->M_pendapatanlain->tambahDataPendapatan();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('pendapatan');
        }
        
    }
    // public function detail($id){
    //     $topik['judul'] = 'Detail Data Karyawan';
    //     $data['pendapatanlain'] = $this->M_pendapatanlain->getPengirimanById($id);
    //     $this->load->view('templates/header',$topik);
    //     $this->load->view('pendapatanlain/detail',$data);
    // }
    public function hapus($id){
        $this->M_pendapatanlain->hapusDataPendapatan($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('pendapatan');
    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Pendapatan Lain';
        $data['pendapatanlain'] = $this->M_pendapatanlain->getPendapatanById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No_Faktur','required');
        $this->form_validation->set_rules('transaksi','Transaksi','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header',$topik);
            $this->load->view('pendapatanlain/edit',$data);
        }else {
            $this->M_pendapatanlain->ubahDataPendapatan();
            $this->session->set_flashdata('flash','Diubah');
            redirect('pendapatan');
        }
}
}