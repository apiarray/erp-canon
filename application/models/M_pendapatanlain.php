<?php

class M_pendapatanlain extends CI_Model{
    public function tampil_data(){
        return $this->db->get('pendapatanlain')->result_array();
    }
    public function filter($data){
        $this->db->where('tgl >=', $data['tanggal']);
		$this->db->where('tgl <=', $data['tanggal_sampai']);
        
        return $this->db->get_where('pendapatanlain')->result_array();
    }
    public function getcoaByPendapatanId($id){
        $this->db->where('pendapatanlain_id', $id);
        return $this->db->get('pendapatanlain_akun_transaksi')->result_array();
    }
    public function tambahDataPendapatan(){
        $data = [
            "tgl" => $this->input->post('tgl',true),
            "rekening" => $this->input->post('rekening',true),
            "no_faktur" => $this->input->post('no_faktur',true),
            "kode_jurnal" => $this->input->post('kode_jurnal',true),
            "jumlah_total" => $this->input->post('jumlah_total',true)
        ];
        $this->db->insert('pendapatanlain',$data);
    }
    public function tambahDataPendapatanAkun($data){

        $this->db->insert('pendapatanlain_akun_transaksi',$data);
    
		$jurnal =$this->siapkanjurnal(3); // 3 ==PDPT
		$coa = $this->getcoaD($jurnal['id']);
		$mapping_coa= $this->getCoa();
        foreach ($mapping_coa as $key => $value) {
			$mapping_coa[$key]['akun']   = $this->getCoaById($value['id_coa']);
            $mapping_coa[$key]['akun_1'] = $this->getCoaById($value['id_coa_1']);
            $mapping_coa[$key]['akun_2'] = $this->getCoaById($value['id_coa_2']);
            $mapping_coa[$key]['akun_3'] = $this->getCoaById($value['id_coa_3']);
        }
		$item_jurnal = [
			'tgl' => $this->input->post('tgl', true),
			'transaksi' =>  'Pendapatan Lain',
			'no_bukti' =>  $this->input->post('no_faktur', true),
			'jumlah' => '',
			'kode_debit' => $mapping_coa[2]['akun_1']['kode'],			
			'nama_akundebit' => $mapping_coa[2]['akun_1']['nama'],
			'didebit' => $data['jumlah_subtotal'],
			'kode_kredit' => $mapping_coa[2]['akun']['kode'],
			'nama_akunkredit' => $mapping_coa[2]['akun']['nama'],
			'dikredit' => $data['jumlah_subtotal'],
			'weekending' => '',
			'tutup_buku' => '',
		];
		//echo "<pre>";
		//print_r($mapping_coa);exit();
		$this->db->replace('jurnalumum', $item_jurnal); 
	}
    public function cekkodependapatan()
    {
        $query = $this->db->query("SELECT MAX(no_faktur) as no_faktur from pendapatanlain");
        $hasil = $query->row();
        return $hasil->no_faktur;
    }
    public function getPendapatanById($id){
        return $this->db->get_where('pendapatanlain',['id'=>$id])->row_array();
    }
    public function hapusDataPendapatan($id){
        $this->db->where('id',$id);
        $this->db->delete('pendapatanlain');
    }
    public function hapusDataPendapatanAkunByPendapatanId($id){
        $this->db->where('pendapatanlain_id',$id);
        $this->db->delete('pendapatanlain_akun_transaksi');
    }
    public function ubahDataPendapatan(){
        $data = [
            "tgl" => $this->input->post('tgl',true),
            "rekening" => $this->input->post('rekening',true),
            "no_faktur" => $this->input->post('no_faktur',true),
            "kode_jurnal" => $this->input->post('kode_jurnal',true),
            "jumlah_total" => $this->input->post('jumlah_total',true)
        ];
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('pendapatanlain',$data);
    }
    public function cariDataKaryawan(){
        $keyword = $this->input->post('keyword',true);
        $this->db->like('nama',$keyword);
        $this->db->or_like('jabatan',$keyword);
        $this->db->or_like('alamat',$keyword);
        return $this->db->get('pendapatanlain')->result_array();
    }
	
	private function siapkanjurnal($id)
	{
		return $this->db->get_where('tbl_setup_jurnal', ['id' => $id])->row_array();
		
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
}