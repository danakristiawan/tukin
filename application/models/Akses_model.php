<?php defined('BASEPATH') or exit('No direct script access allowed');

class Akses_model extends CI_Model
{
  private $_table = 'system_access';

  public function rules()
  {
    return [
      [
        'field' => 'role_id',
        'label' => 'Id Role',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'menu_id',
        'label' => 'Id Menu',
        'rules' => 'required|trim'
      ]
    ];
  }

  public function data()
  {
    return [
      'role_id' => htmlspecialchars($this->input->post('role_id', true)),
      'menu_id' => htmlspecialchars($this->input->post('menu_id', true))
    ];
  }

  public function getAll()
  {
    return $this->db->query("SELECT a.*, b.name FROM system_access a LEFT JOIN system_menu b ON a.menu_id = b.id")->result_array();
  }

  public function get($id)
  {
    return $this->db->get_where($this->_table, ['id' => $id])->row_array();
  }


  public function add()
  {
    $this->db->insert($this->_table, $this->data());
  }

  public function delete($id)
  {
    return $this->db->delete($this->_table, ['id' => $id]);
  }

  public function deleteRole($id)
  {
    return $this->db->delete($this->_table, ['role_id' => $id]);
  }

  public function edit($id)
  {
    $this->db->update($this->_table, $this->data(), ['id' => $id]);
  }
}
