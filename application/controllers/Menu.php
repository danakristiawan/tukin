<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('judul_model', 'judul');
    $this->load->model('menu_model', 'menu');
    $this->load->model('sub_menu_model', 'submenu');
    $this->load->model('sub_sub_menu_model', 'subsubmenu');
  }

  public function index()
  {
    // data
    $data['title'] = $this->judul->title();
    $data['menu'] = $this->menu->getAll();
    $data['submenu'] = $this->submenu->getAll();
    $data['subsubmenu'] = $this->subsubmenu->getAll();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('menu/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    // data
    $data['title'] = $this->judul->title();
    // validasi
    $validation = $this->form_validation->set_rules($this->menu->rules());
    if ($validation->run()) {
      //query
      $this->menu->add();
      redirect('menu');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('menu/add', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // query
    if ($this->menu->delete($id)) {
      $this->submenu->deleteMenu($id);
      $this->subsubmenu->deleteMenu($id);
      redirect('menu');
    }
  }

  public function edit($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['menu'] = $this->menu->get($id);
    // validasi
    $validation = $this->form_validation->set_rules($this->menu->rules());
    if ($validation->run()) {
      //query
      $this->menu->edit($id);
      redirect('menu');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('menu/edit', $data);
    $this->load->view('template/footer');
  }

  public function addSub($menu_id = null)
  {
    // cek id
    if (!isset($menu_id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['menu_id'] = $menu_id;
    // validasi
    $validation = $this->form_validation->set_rules($this->submenu->rules());
    if ($validation->run()) {
      //query
      $this->submenu->add();
      redirect('menu');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('menu/addSub', $data);
    $this->load->view('template/footer');
  }

  public function editSub($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['submenu'] = $this->submenu->get($id);
    // validasi
    $validation = $this->form_validation->set_rules($this->submenu->rules());
    if ($validation->run()) {
      //query
      $this->submenu->edit($id);
      redirect('menu');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('menu/editSub', $data);
    $this->load->view('template/footer');
  }

  public function deleteSub($id)
  {
    // cek id
    if (!isset($id)) show_404();
    // query
    if ($this->submenu->delete($id)) {
      $this->subsubmenu->deleteSubMenu($id);
      redirect('menu');
    }
  }

  public function addSubSub($menu_id = null, $sub_menu_id = null)
  {
    // cek id
    if (!isset($menu_id)) show_404();
    if (!isset($sub_menu_id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['menu_id'] = $menu_id;
    $data['sub_menu_id'] = $sub_menu_id;
    // validasi
    $validation = $this->form_validation->set_rules($this->subsubmenu->rules());
    if ($validation->run()) {
      //query
      $this->subsubmenu->add();
      redirect('menu');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('menu/addSubSub', $data);
    $this->load->view('template/footer');
  }

  public function deleteSubSub($id)
  {
    // cek id
    if (!isset($id)) show_404();
    // query
    if ($this->subsubmenu->delete($id)) {
      redirect('menu');
    }
  }

  public function editSubSub($id = null)
  {
    // cek id
    if (!isset($id)) show_404();
    // data
    $data['title'] = $this->judul->title();
    $data['subsubmenu'] = $this->subsubmenu->get($id);
    // validasi
    $validation = $this->form_validation->set_rules($this->subsubmenu->rules());
    if ($validation->run()) {
      //query
      $this->subsubmenu->edit($id);
      redirect('menu');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('menu/editSubSub', $data);
    $this->load->view('template/footer');
  }
}
