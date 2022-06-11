<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  private $_table = 'system_user';

  public function rules()
  {
    return [
      [
        'field' => 'nip',
        'label' => 'NIP',
        'rules' => 'required|trim|exact_length[18]'
      ],
      [
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required|trim'
      ]
    ];
  }

  public function data()
  {
    return [
      'role_id' => htmlspecialchars($this->input->post('role_id', true)),
      'satker_id' => htmlspecialchars($this->input->post('satker_id', true)),
      'nip' => htmlspecialchars($this->input->post('nip', true)),
      'nama' => htmlspecialchars($this->input->post('nama', true))
    ];
  }

  public function getAll()
  {
    return $this->db->query("SELECT a.*, b.name, c.nama AS satker FROM system_user a LEFT JOIN system_role b ON a.role_id=b.id LEFT JOIN landing_ref_eselon3 c ON a.satker_id=c.id")->result_array();
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

  public function editNip($nip)
  {
    $data = [
      'nama' => htmlspecialchars($this->input->post('nama', true)),
      'email' => htmlspecialchars($this->input->post('email', true))
    ];
    $this->db->update($this->_table, $data, ['nip' => $nip]);
  }

  public function editPass($nip, $new_password)
  {
    $data = [
      'password' => password_hash($new_password, PASSWORD_DEFAULT)
    ];
    $this->db->update($this->_table, $data, ['nip' => $nip]);
  }
}
