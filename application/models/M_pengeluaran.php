<?php

class M_pengeluaran extends CI_Model{
    public function tampil_data(){
        return $this->db->get('pengeluaran')->result_array();
    }
	
    public function filter($data){
        $this->db->where('tgl >=', $data['tanggal']);
		$this->db->where('tgl <=', $data['tanggal_sampai']);
        
        return $this->db->get_where('pengeluaran')->result_array();
    }

	function tampil_data1(){
    $username=$this->session->userdata("username");
     $this->db->where('users.username',"$username");
	  $this->db->select('pengeluaran.id,pengeluaran.tgl,pengeluaran.uraian,pengeluaran.reff,pengeluaran.batasan,pengeluaran.jumlah,pengeluaran.no_akun,pengeluaran.kode_id');
	 $this->db->from('users');
	 $this->db->join('pengeluaran','pengeluaran.kode_id=users.kode_id');
	 $query = $this->db->get();
	 return $query->result_array();
	}
	
    public function tambahDataPengeluaran($data){
        
        $this->db->insert('pengeluaran',$data);
    }

    public function tambahDataPengeluaranAkun($data){
        $this->db->insert('pengeluaran_akun_transaksi',$data);
    }
    public function hapusAkunDataPengeluaran($pengeluaranid){
        $this->db->where('pengeluaran_id',$pengeluaranid);
        $this->db->delete('pengeluaran_akun_transaksi');
    }
    public function getPengeluaranById($id){
        return $this->db->get_where('pengeluaran',['id'=>$id])->row_array();
    }
    public function getAkunPengeluaran($pengeluaranid){
        return $this->db->get_where('pengeluaran_akun_transaksi',['pengeluaran_id'=>$pengeluaranid])->result_array();
    }
    public function hapusDataPengeluaran($id){
        $this->db->where('id',$id);
        $this->db->delete('pengeluaran');
    }
    public function ubahDataPengeluaran($data){
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('pengeluaran',$data);
		
		$jurnal =$this->siapkanjurnal(4); // 3 ==PDPT
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
			'transaksi' =>  'Pengeluaran',
			'no_bukti' =>  $this->input->post('reff',true),
			'jumlah' => '',
			'kode_debit' => $mapping_coa[2]['akun_1']['kode'],			
			'nama_akundebit' => $mapping_coa[2]['akun_1']['nama'],
			'didebit' => $this->input->post('jumlah_total',true),
			'kode_kredit' => $mapping_coa[2]['akun']['kode'],
			'nama_akunkredit' => $mapping_coa[2]['akun']['nama'],
			'dikredit' => $this->input->post('jumlah_total',true),
			'weekending' => '',
			'tutup_buku' => '',
		];
		echo "<pre>";
		print_r($mapping_coa);exit();
		$this->db->replace('jurnalumum', $item_jurnal); 
    }
    // public function cariDataKaryawan(){
    //     $keyword = $this->input->post('keyword',true);
    //     $this->db->like('nama',$keyword);
    //     $this->db->or_like('jabatan',$keyword);
    //     $this->db->or_like('alamat',$keyword);
    //     return $this->db->get('pendapatanlain')->result_array();
    // }
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