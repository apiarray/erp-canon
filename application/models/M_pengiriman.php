<?php

class M_pengiriman extends CI_Model
{
	public function tampil_data()
	{
		$tanggal = $this->input->post('tanggal', true);
		$tanggalSampai = $this->input->post('tanggal_sampai', true);
		if (isset($tanggal) && isset($tanggalSampai)) {
			$this->db->where('tanggal >=', $tanggal);
			$this->db->where('tanggal <=', $tanggalSampai);
		}

		if ($this->session->userdata('id_role') === "2") {
			return $this->db->get_where('pengiriman', ['gudang_asal' => $this->session->userdata('gudang')]);
		} else {
			return $this->db->get('pengiriman');
		}
	}

	public function filter_data($data)
	{
		if($data['kode_id'] != ''){
			$this->db->where('kode_id', $data['kode_id']);
		}
		if($data['kepada'] != ''){
			$this->db->where('kepada', $data['kepada']);
		}
		if($data['alamat'] != ''){
			$this->db->where('alamat', $data['alamat']);
		}
		if($data['kota'] != ''){
			$this->db->where('kota', $data['kota']);
		}
		if($data['telepon'] != ''){
			$this->db->where('no_telepon', $data['telepon']);
		}
		if($data['no_do'] != ''){
			$this->db->where('no_do', $data['no_do']);
		}
		if($data['manager_gudang'] != ''){
			$this->db->where('manager_gudang', $data['manager_gudang']);
		}
		if($data['no_kontainer'] != ''){
			$this->db->where('no_kontainer', $data['no_kontainer']);
		}
		if($data['no_segel'] != ''){
			$this->db->where('no_segel', $data['no_segel']);
		}
		if($data['jenis_transaksi'] != 0){
			$this->db->where('jenis_transaksi', $data['jenis_transaksi']);
		}
		if($data['setup_jurnal'] != ''){
			$this->db->where('setup_jurnal', $data['setup_jurnal']);
		}

		$this->db->where('tanggal >=', $data['tanggal']);
		$this->db->where('tanggal <=', $data['tanggal_sampai']);
		
		if ($this->session->userdata('id_role') === "2") {
			return $this->db->get_where('pengiriman', ['gudang_asal' => $this->session->userdata('gudang')]);
		} else {
			return $this->db->get('pengiriman');
		}
	}

	function tampil_barang()
	{
		if ($this->session->userdata('id_role') === "2") {
			return $this->db->get_where('produk', ['gudang' => $this->session->userdata('gudang')]);
		}
		return $this->db->get('produk');
	}

	// public function cekStok($)

	function tampil_cetak()
	{
		$this->db->select('*');
		$this->db->from('pengiriman');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function tampil()
	{
		$hasil = $this->db->query("SELECT * FROM `pengiriman` ORDER BY id DESC  LIMIT 1");
		return $hasil;
	}

	public function allGdg()
	{
		$this->db->select('kode, nama, alamat');
		return $this->db->get('gudang');
	}

	public function getLatestNoDO()
	{
		$this->db->select('no_do');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		return $this->db->get('pengiriman')->row_array();
	}

	public function cekStok($id)
	{
		$this->db->select('kode, gudang_asal');
		$data = $this->db->get_where('pengiriman', ['id' => $id])->row_array();


		$this->db->select('unitbagus, unitrusak');
		return $this->db->get_where('produk', ['kode' => $data['kode'], 'gudang' => $data['gudang_asal']])->row_array();
	}

	public function kode()
	{
		$this->db->select('RIGHT(daftar_mitra.id,2) as id', FALSE);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('daftar_mitra');  //cek dulu apakah ada sudah ada kode di tabel.    
		if ($query->num_rows() <> 0) {
			//cek kode jika telah tersedia    
			$data = $query->row();
			$kode = intval($data->id) + 1;
		} else {
			$kode = 1;  //cek jika kode belum terdapat pada table
		}
		$tgl = date('d/');
		$batas = str_pad($kode, 4, "PP/", STR_PAD_LEFT);
		$kodetampil = "" . "" . $tgl . $batas;  //format kode
		return $kodetampil;
	}

	public function tampil_datamitra()
	{
		if ($this->session->userdata('id_role') === "2") {
			return $this->db->get_where('daftar_mitra', ['gudang' => "Head Office"]);
		}
		return $this->db->get('daftar_mitra');
	}


	function tampil_datamitra1()
	{
		$username = $this->session->userdata("username");
		$this->db->where('users.username', "$username");
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('pengiriman', 'pengiriman.kode_id=users.kode_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
		
	}

	public function tambahDataPengiriman($data)
	{
		$this->db->insert('pengiriman', $data);
	}

	public function tambahDataBarangPengiriman($data)
	{
		$this->db->insert('pengiriman_barang', $data);
	}

	public function getPengirimanById($id)
	{
		return $this->db->get_where('pengiriman', ['id' => $id])->row_array();
	}
	public function getBarangByPengirimanId($pengirimanid)
	{
		return $this->db->get_where('pengiriman_barang', ['pengiriman_id' => $pengirimanid])->result_array();
	}


	public function hapusDataPengiriman($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pengiriman');
	}

	public function hapusDataPengirimanBarangByPengirimanId($id)
	{
		$this->db->where('pengiriman_id', $id);
		$this->db->delete('pengiriman_barang');
	}

	public function ubahDataPengiriman()
	{
		$data = [
			"kode" => $this->input->post('kode', true),
			"nama" => $this->input->post('nama', true),
			"qty_karton" => $this->input->post('qty_karton', true),
			"qty_perkarton" => $this->input->post('qty_perkarton', true),
			"total" => $this->input->post('total', true),
			"qty_karton_rusak" => $this->input->post('qty_karton_rsk', true),
			"qty_perkarton_rusak" => $this->input->post('qty_perkarton_rsk', true),
			"total_rusak" => $this->input->post('total_rsk', true),
			"gudang_asal" => $this->input->post('gudang_asal', true),
			"gudang_tujuan" => $this->input->post('gudang_tujuan', true),
			"kepada" => $this->input->post('kepada', true),
			"alamat" => $this->input->post('alamat', true),
			"kota" => $this->input->post('kota', true),
			"no_telepon" => $this->input->post('no_telepon', true),
			"tanggal" => $this->input->post('tanggal', true),
			"no_do" => $this->input->post('no_do', true),
			"manager_gudang" => $this->input->post('manager_gudang', true),
			"no_kontainer" => $this->input->post('no_kontainer', true),
			"no_segel" => $this->input->post('no_segel', true),
			"kode_id" => $this->input->post('kode_id', true),
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('pengiriman', $data);
		
		$jurnal =$this->siapkanjurnal(5); // 5 == KRM Pengiriman
		$coa = $this->getcoaD($jurnal['id']);
		$mapping_coa= $this->getCoa();
        foreach ($mapping_coa as $key => $value) {
			$mapping_coa[$key]['akun']   = $this->getCoaById($value['id_coa']);
            $mapping_coa[$key]['akun_1'] = $this->getCoaById($value['id_coa_1']);
            $mapping_coa[$key]['akun_2'] = $this->getCoaById($value['id_coa_2']);
            $mapping_coa[$key]['akun_3'] = $this->getCoaById($value['id_coa_3']);
        }
		
		//TRM penerimaan menggunakan map no 2, $key=1
		$item_jurnal = [
			'tgl' => $this->input->post('tanggal', true),
			'transaksi' =>  $this->input->post('no_sj', true),
			'no_bukti' =>  $this->input->post('no_lpb', true),
			'jumlah' => '',
			'kode_debit' => $mapping_coa[1]['akun']['kode'],
			'kode_kredit' => $mapping_coa[1]['akun_1']['kode'],
			'nama_akundebit' => $mapping_coa[1]['akun']['nama'],
			'didebit' => $totalHarga,
			'nama_akunkredit' => $mapping_coa[1]['akun_1']['nama'],
			'dikredit' => $totalHarga,
			'weekending' => '',
			'tutup_buku' => '',
		];
		//echo "<pre>";
		//print_r($item_jurnal);
	}
	public function cariDataKaryawan()
	{
		$keyword = $this->input->post('keyword', true);
		$this->db->like('nama', $keyword);
		$this->db->or_like('jabatan', $keyword);
		$this->db->or_like('alamat', $keyword);
		return $this->db->get('pengiriman')->result_array();
	}
	
	function jurnalumum($total)
	{
		$jurnal =$this->siapkanjurnal(5); // 5 == KRM Pengiriman
		$coa = $this->getcoaD($jurnal['id']);
		//echo $jurnal['id'];
		$mapping_coa= $this->getCoa();
        foreach ($mapping_coa as $key => $value) {
			$mapping_coa[$key]['akun']   = $this->getCoaById($value['id_coa']);
            $mapping_coa[$key]['akun_1'] = $this->getCoaById($value['id_coa_1']);
            $mapping_coa[$key]['akun_2'] = $this->getCoaById($value['id_coa_2']);
            $mapping_coa[$key]['akun_3'] = $this->getCoaById($value['id_coa_3']);
        }
		
		//TRM penerimaan menggunakan map no 2, $key=1
		$item_jurnal = [
			'tgl' => $this->input->post('tanggal', true),
			'transaksi' =>  $this->input->post('no_do', true),
			'no_bukti' =>  $this->input->post('no_do', true),
			'jumlah' => '',
			'kode_debit' => $mapping_coa[1]['akun_2']['kode'],
			'kode_kredit' => $mapping_coa[1]['akun']['kode'],
			'nama_akundebit' => $mapping_coa[1]['akun_2']['nama'],
			'didebit' => $total,
			'nama_akunkredit' => $mapping_coa[1]['akun']['nama'],
			'dikredit' => $total,
			'weekending' => '',
			'tutup_buku' => '',
		];
		
		//echo "<pre>";
		//print_r($jurnal);
		//print_r($item_jurnal);
		//print_r($mapping_coa);
		$this->db->replace('jurnalumum', $item_jurnal);
	}
	
	private function siapkanjurnal($id)
	{
		return $this->db->get_where('tbl_setup_jurnal', ['id' => $id])->row_array();
		
		//$this->db->select('RIGHT(penerimaan.no_lpb,2) as no_lpb', FALSE);
		//$this->db->order_by('no_lpb', 'DESC');
		//$this->db->where('id', $this->input->post('id'));
		//$this->db->limit(1); ['setup_jurnal_id' => $id]
	}
	
	private function getcoaD($id)
	{		
        return $this->db->get('tbl_mapping_coa', ['setup_jurnal_id' => $id, 'tipe' => 'debit' ])->row_array();   
	}
	
	public function getCoaById($id) {
        $this->db->where('id', $id);
        return $this->db->get('chartofaccount')->row_array();
    }
	
	public function getCoa(){
        return $this->db->get('tbl_mapping_coa')->result_array();
    }

    public function getReceivedAssetMitra($mitra)
    {
        $this->db->select('
            pengiriman_barang.*,
            tbl_category.name as kategori,
            pengiriman.tanggal,
            pengiriman.no_do
        ');
        $this->db->from('pengiriman_barang');
        $this->db->join('produk', 'produk.kode = pengiriman_barang.kode', 'left');
        $this->db->join('tbl_category', 'tbl_category.kode = produk.kode', 'left');
        $this->db->join('pengiriman', 'pengiriman.id = pengiriman_barang.pengiriman_id');
        $this->db->where('pengiriman.kepada', $mitra);
        $this->db->order_by('pengiriman.tanggal', 'DESC');

        return $this->db->get()->result_array();
    }
}
