<?php

class Activity extends CI_Controller
{
    // public function __construct(){
    //     parent::__construct();
    //     $this->load->model('m_account');
    //     $this->load->library('form_validation');
    // }
    public function index(){
        $topik['judul'] = 'Halaman Activity';
        $this->load->view('templates/header',$topik);
        $this->load->view('activity/index');
        $this->load->view('templates/footer');
    }
}