<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sub_menu_model extends CI_Model
{
  private $_table = 'system_sub_menu';

  public function rules()
  {
    return [
      [
        'field' => 'name',
        'label' => 'Sub Menu',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'url',
        'label' => 'URL',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'icon',
        'label' => 'Icon',
        'rules' => 'required|trim'
      ]
    ];
  }

  public function data()
  {
    return [
      'menu_id' => htmlspecialchars($this->input->post('menu_id', true)),
      'name' => htmlspecialchars($this->input->post('name', true)),
      'url' => htmlspecialchars($this->input->post('url', true)),
      'icon' => htmlspecialchars($this->input->post('icon', true))
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

  public function deleteMenu($id)
  {
    return $this->db->delete($this->_table, ['menu_id' => $id]);
  }

  public function edit($id)
  {
    $this->db->update($this->_table, $this->data(), ['id' => $id]);
  }
}
