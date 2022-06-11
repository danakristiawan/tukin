<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
  private $_table = 'system_menu';

  public function rules()
  {
    return [
      [
        'field' => 'name',
        'label' => 'Menu',
        'rules' => 'required|trim'
      ]
    ];
  }

  public function data()
  {
    return [
      'name' => htmlspecialchars($this->input->post('name', true))
    ];
  }

  public function getAll()
  {
    return $this->db->get($this->_table)->result_array();
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

  public function edit($id)
  {
    $this->db->update($this->_table, $this->data(), ['id' => $id]);
  }
}
