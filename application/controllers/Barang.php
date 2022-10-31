<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->model('M_account');
        $this->load->library('form_validation');
        $this->load->library('dompdf_gen');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->allBarang('n');
    }

    public function allBarang($show = NULL)
    {
        $topik['judul'] = 'Halaman Menu Produk';
        if ($show == null) {
            $x['data'] = $this->M_barang->show_barang();
        } else {
            $x['data'] = null;
        }

        $x['databrg'] = $this->M_barang->show_barang();
        $x['get_category'] = $this->M_barang->get_option();
        $x['get_category1'] = $this->M_barang->get_option1();

        $x['get_kategori'] = $this->M_barang->get_option_kategori();
        $x['get_gudang'] = $this->M_barang->get_option_gudang();

        $x['listakun'] = $this->M_account->tampil_data("up");

        // echo json_encode([
        //     'dataProduk' => $x['data']->result_array(),
        //     'dataKategori' => $x['get_category']
        // ]);
        // die;

        $this->load->view('templates/header', $topik);
        $this->load->view('barang/index_show', $x);
        $this->load->view('templates/footer');
    }

    public function getAkun()
    {
        echo json_encode($this->M_barang->getAkun());
    }

    public function all_gudang()
    {
        echo json_encode($this->M_barang->all_gudang());
    }

    public function index_serach()
    {
        $topik['judul'] = 'Halaman Menu Produk';
        $x['data'] = $this->M_barang->show_barang();
        $x['data'] = $this->M_barang->search();
        $x['get_kategori'] = $this->M_barang->get_option_kategori();
        $x['get_gudang'] = $this->M_barang->get_option_gudang();

        $this->load->view('templates/header', $topik);
        $this->load->view('barang/index_serach', $x);
        $this->load->view('templates/footer');
    }

    public function search()
    {
        $topik['judul'] = 'Halaman Menu Produk';
        $x['data'] = $this->M_barang->show_barang();
        $x['data'] = $this->M_barang->search_kode();

        $this->load->view('templates/header', $topik);
        $this->load->view('barang/search', $x);
        $this->load->view('templates/footer');
    }

    public function searchBarang($input = NULL)
    {
        $input = urldecode($input);
        echo json_encode($this->M_barang->searchBarang($input));
        // echo json_encode('OK');
    }

    public function getBarang($id = NULL)
    {
        echo json_encode($this->M_barang->getBarang($id));
    }

    public function tambah()
    {

        $data['judul'] = 'Form Tambah Data';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('manager', 'Manager', 'required');
        $this->form_validation->set_rules('gudang', 'Gudang', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');
        $this->form_validation->set_rules('unitbagus', 'Unitbagus', 'required');
        $this->form_validation->set_rules('unitrusak', 'Unitrusak', 'required');
        $this->form_validation->set_rules('hpp', 'Hpp', 'required');
        $this->form_validation->set_rules('sebelumpajak', 'Sebelumpajak', 'required');
        $this->form_validation->set_rules('ppn', 'Ppn', 'required');
        $this->form_validation->set_rules('setelahpajak', 'Setelahpajak', 'required');
        $this->form_validation->set_rules('hargasetoran', 'Hargasetoran', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');


        // $this->form_validation->set_rules('image','Image','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('barang/tambah');
        } else {
            $this->M_barang->tambahDataProduct();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('barang');
        }
    }

    function tambah_aksi()
    {
        $kode = $this->input->post('kode');
        //script validasi data

        $chkData  = $this->db->select("*")->from("produk")->where("kode", $kode)->get()->num_rows();

        if ($chkData > 0) {
            echo "<script>window.alert('kode yang anda masukan sudah ada')
    		window.location='http://localhost/erp-canon/barang/allBarang'</script>";
        }
        $nama = $this->input->post('nama');
        $kategori = $this->input->post('kategori');
        // $manager = $this->input->post('manager');
        $gudang = $this->input->post('gudang');
        $qty = $this->input->post('qty');
        $unitbagus = $this->input->post('unitbagus');
        $unitrusak = $this->input->post('unitrusak');
        $hpp = $this->input->post('hpp');
        $sebelumpajak = $this->input->post('sebelumpajak');
        $ppn = $this->input->post('ppn');
        $setelahpajak = $this->input->post('setelahpajak');
        $hargasetoran = $this->input->post('hargasetoran');
        $jumlah = $this->input->post('jumlah');
        $id_coa = $this->input->post('id_coa_create');

        $data = array(
            'kode' => $kode,
            'nama' => $nama,
            'kategori' => $kategori,
            // 'manager' => $manager,
            'gudang' => $gudang,
            'qty' => $qty,
            'unitbagus' => $unitbagus,
            'unitrusak' => $unitrusak,
            'hpp' => str_replace(",", "", $hpp),
            'sebelumpajak' => str_replace(",", "", $sebelumpajak),
            'ppn' => $ppn,
            'setelahpajak' => str_replace(",", "", $setelahpajak),
            'hargasetoran' => str_replace(",", "", $hargasetoran),
            'jumlah' => str_replace(",", "", $jumlah),
            'id_coa' => $id_coa
        );
        $this->M_barang->input_data($data, 'produk');
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('barang/index');
    }


    public function edit()
    {
        // $topik['judul'] = 'Edit Data Product';
        // $data['produk'] = $this->M_barang->getProdukById($id);

        $this->M_barang->ubahDataProduct();
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('barang');
    }
    public function hapus($id)
    {
        $this->M_barang->hapusDataProduk($id);
        $this->session->set_flashdata('flash2', 'Dihapus');
        redirect('barang');
    }
    // public function print(){
    //     $data['produk'] = $this->m_mahasiswa->tampil_data('mahasiswa')->result();
    //     $this->load->view('print_mahasiswa',$data);
    // }
    // public function export_excel(){
    //     $data['produk'] = $this->M_barang->get_by_role();
    //     $this->load->view('barang/laporan_excel',$data);
    //     }
    //     public function export_excel(){
    //     // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
    //     header("Content-type: application/vnd-ms-excel");
    //     header("Content-Disposition: attachment; filename=Data_Barang.xls");

    //     // $data['produk'] = $this->SiswaModel->view();
    //     $data['produk'] = $this->M_barang->get_by_role();
    //     $this->load->view('barang/laporan_excel', $data);
    //   }
    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('Gun Gun Priatna - re:code lab')
            ->setLastModifiedBy('Gun Gun Priatna - re:code lab')
            ->setTitle('Tes Export Excel')
            ->setSubject('Tes Export Excel')
            ->setDescription('Tes Export Excel')
            ->setKeywords(' Tes Export Excel')
            ->setCategory('Test export excel');

        //Add data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Kode')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Qty')
            ->setCellValue('D1', 'Manager')
            ->setCellValue('E1', 'Gudang');
        // ->setCellValue('F1', 'Alamat');

        $i = 2;

        // $mahasiswa = $this->model_mahasiswa->getAll();
        $produk = $this->M_barang->get_by_role();

        foreach ($produk as $erp) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $erp['kode'])
                ->setCellValue('B' . $i, $erp['nama'])
                ->setCellValue('C' . $i, $erp['qty'])
                ->setCellValue('D' . $i, $erp['manager'])
                ->setCellValue('E' . $i, $erp['gudang']);
            // ->setCellValue('G' . $i, $erp->alamat);
            $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Report Excel' . date('Y-m-d'));
        $spreadsheet->setActiveSheetIndex(0);


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
        header('Cache-Control: max-age=0');

        header('Cache-Control: max-age=1');


        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }


    public function laporan_pdf()
    {

        // $data = array(
        //     "dataku" => array(
        //         "nama" => "Petani Kode",
        //         "url" => "http://petanikode.com"
        //     )
        // );

        // $this->load->library('pdf');

        // $this->pdf->setPaper('A4', 'potrait');
        // $this->pdf->filename = "laporan-petanikode.pdf";
        // $this->pdf->load_view('laporan_pdf', $data);
        $data['produk'] = $this->M_barang->get_by_role();

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-petanikode.pdf";
        $this->pdf->load_view('barang/laporan_pdf', $data);
    }

    public function getDataBarangById($id)
    {
        echo json_encode([
            'dataBarang' => $this->db->get_where('produk', ["id" => $id])->row(),
            'dataCategory' => $this->M_barang->get_option(),
            'dataGudang' => $this->M_barang->get_option_gudang(),
            'dataListAkun' => $this->M_account->tampil_data("up")
        ]);
    }
}
