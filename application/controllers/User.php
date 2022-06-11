<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('judul_model', 'judul');
    $this->load->model('user_model', 'user');
    $this->load->model('role_model', 'role');
  }

  public function index()
  {
    // data
    $data['title'] = $this->judul->title();
    $data['user'] = $this->user->getAll();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    //providing data
    $data['title'] = $this->judul->title();
    $data['pegawai'] = $this->db->query("SELECT * FROM landing_ref_pegawai")->result_array();

    //open form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('user/add', $data);
    $this->load->view('template/footer');
  }

  public function adduser()
  {
    $nip = $this->input->post('nip');
    $nama = $this->input->post('nama');

    $data = [
      'nip' => $nip,
      'nama' => $nama
    ];

    $result = $this->db->get_where('system_user', $data);

    if ($result->num_rows() < 1) {
      $this->db->insert('system_user', $data);
    } else {
      $this->db->delete('system_user', $data);
    }
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // query
    if ($this->user->delete($id)) {
      redirect('user');
    }
  }

  public function edit($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['user'] = $this->user->get($id);
    $data['role'] = $this->role->getAll();
    $data['satker'] = $this->db->get('landing_ref_eselon3')->result_array();
    // validasi
    $validation = $this->form_validation->set_rules($this->user->rules());
    if ($validation->run()) {
      //query
      $this->user->edit($id);
      redirect('user');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('user/edit', $data);
    $this->load->view('template/footer');
  }
}
