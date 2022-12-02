<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->model('M_kategori');
        $this->load->model('M_gudang');
        $this->load->model('M_karyawan');
        $this->load->model('M_pengiriman');
        // $this->check_login();

        $role = [2, 6];

        if (!in_array((int)$this->session->userdata('id_role'), $role)) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $gudang = $this->session->userdata('gudang');
        $manager = $this->session->userdata('username');

        $topik['judul'] = 'Halaman Dashboard';
        $topik['totalJenisBarang'] = $this->M_barang->get_jenis_barang_mitra_groupped($manager);
        $topik['totalBarang'] = $this->M_barang->sum_total_barang_mitra($manager);
        $topik['barangDiterima'] = $this->M_pengiriman->getReceivedAssetMitra($manager);
        //die(json_encode($topik['barangDiterima']));
        $this->load->view('templates2/header', $topik);
        $this->load->view('dashboard2');
        $this->load->view('templates2/footer');
    }
}
