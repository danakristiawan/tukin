<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akses extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('judul_model', 'judul');
    $this->load->model('akses_model', 'akses');
    $this->load->model('role_model', 'role');
    $this->load->model('menu_model', 'menu');
  }

  public function index()
  {
    // data
    $data['title'] = $this->judul->title();
    $data['role'] = $this->role->getAll();
    $data['access'] = $this->akses->getAll();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('akses/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    // data
    $data['title'] = $this->judul->title();
    // validasi
    $validation = $this->form_validation->set_rules($this->role->rules());
    if ($validation->run()) {
      //query
      $this->role->add();
      redirect('akses');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('akses/add', $data);
    $this->load->view('template/footer');
  }

  public function delete($id)
  {
    // cek id
    if (!isset($id)) show_404();
    // query
    if ($this->role->delete($id)) {
      $this->akses->deleteRole($id);
      redirect('akses');
    }
  }

  public function edit($id)
  {
    // data
    $data['title'] = $this->judul->title();
    $data['role'] = $this->role->get($id);
    // validasi
    $validation = $this->form_validation->set_rules($this->role->rules());
    if ($validation->run()) {
      //query
      $this->role->edit($id);
      redirect('akses');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('akses/edit', $data);
    $this->load->view('template/footer');
  }

  public function addMenu($role_id)
  {
    // cek id
    if (!isset($role_id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['menu'] = $this->menu->getAll();
    $data['role_id'] = $role_id;

    // validasi
    $validation = $this->form_validation->set_rules($this->akses->rules());
    if ($validation->run()) {
      //query
      $this->akses->add();
      redirect('akses');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('akses/addMenu', $data);
    $this->load->view('template/footer');
  }

  public function deleteMenu($id)
  {
    // cek id
    if (!isset($id)) show_404();
    // query
    if ($this->akses->delete($id)) {
      redirect('akses');
    }
  }
}
