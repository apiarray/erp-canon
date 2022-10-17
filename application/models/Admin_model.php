<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $table = 'tbl_role';

    public function rules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'description',
                'label' => 'description',
                'rules' => 'trim|required'
            ]
        ];
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row();
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function save()
    {
        $data = array(
            "name" => $this->input->post('name'),
            "description" => $this->input->post('description')
        );
        return $this->db->insert($this->table, $data);
    }

    public function update()
    {
        $data = array(
            "name" => $this->input->post('name'),
            "description" => $this->input->post('description')
        );
        return $this->db->update($this->table, $data, array('id' => $this->input->post('id')));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array("id" => $id));
    }
}
