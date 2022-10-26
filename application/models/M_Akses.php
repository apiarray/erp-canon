<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Akses extends CI_Model {

  public function tambahHakAkses()
  {
    $data = [];

    foreach($this->db->get('tbl_menu')->result() as $menu) {
      $data2 = [];
      foreach($this->db->get_where('tbl_submenu',['id_menu' => $menu->id])->result() as $submenu) {
        $data2[] = [
          $submenu->sub_menu => [
            'create' => $this->input->post($menu->id.'_'.$submenu->id.'_create'),
            'read'  => $this->input->post($menu->id.'_'.$submenu->id.'_read'),
            'update' => $this->input->post($menu->id.'_'.$submenu->id.'_update'),
            'delete' => $this->input->post($menu->id.'_'.$submenu->id.'_delete') 
            ]
          ];
      }

      $data[$menu->menu] = $data2;
    }

    $data = [
      'name' => $this->input->post('name', true),
      'akses' => json_encode($data),
      'role_id' => $this->input->post('role', true)
    ];

    $this->db->insert('hakakses', $data);
  }

  public function getJabatan()
  {
    return $this->db->get_where('karyawan', 'jabatan')->result();
  }

}

/* End of file M_Akses_model.php */
/* Location: ./application/models/M_Akses_model.php */