<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kas_bank extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_KasBank']);
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

    public function getDataKasBank()
    {
        $result = $this->M_KasBank->getDataKasBank();
        echo json_encode($result);
    }

    public function getLatestNoTf()
    {
        $result = $this->M_KasBank->getLatestNoTf();
        if ($result == '') {
            echo json_encode("00001/Kas_Bank/" . date('Y'));
        } else {
            $idx = explode('/', $result->kode);
            $kode = (int)substr($idx[0], -1, 5) + 1;
            $firsthalf = str_repeat('0', 5 - strlen((string)$kode)) . $kode . "/Kas_Bank" . "/" . date('Y');
            echo json_encode($firsthalf);
        }
    }

    public function getDataPengiriman()
    {
        $result = $this->M_KasBank->getDataPengiriman();
        echo json_encode($result);
    }

    public function getDataPenerimaan()
    {
        $result = $this->M_KasBank->getDataPenerimaan();
        echo json_encode($result);
    }

    public function getDataByChecked()
    {
        $id = $this->input->post("id");
        $type = $this->input->post("type");

        $result = $this->M_KasBank->getDataByChecked($id, $type);
        echo json_encode($result);
    }

    public function getRekening()
    {
        $result = $this->db->get_where('tbl_rekening')->result();
        echo json_encode($result);
    }

    public function save()
    {
        $tgl = $this->input->post("tgl");
        $noKasBank = $this->input->post("noKasBank");
        $keterangan = $this->input->post("keterangan");
        $totPenerimaan = $this->input->post("totPenerimaan");
        $totPengeluaran = $this->input->post("totPengeluaran");
        $detailData = $this->input->post("detailData");

        $result = $this->M_KasBank->save($tgl, $noKasBank, $keterangan, $totPenerimaan, $totPengeluaran, $detailData);
        $this->session->set_flashdata('flash', 'Ditambahkan');
        echo json_encode($result);
    }
}
