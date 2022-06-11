<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('judul_model', 'judul');
    // $this->load->model('user_model', 'user');
  }

  public function index()
  {
    if ($this->session->userdata('nip')) {
      redirect('home');
    } else {
      redirect('../landing/auth');
    }

    // membuka file JSON
    // $source = file_get_contents("http://localhost/portal/landing/internal/api");
    // $nip = json_decode($source, true);
    // $data = [
    //   'nip' => $nip
    // ];
    // $this->session->set_userdata($data);
    // redirect('home');
  }

  public function logout()
  {
    $this->session->unset_userdata('nip');
    $this->session->sess_destroy();
    redirect('../landing/auth');
  }

  public function blocked()
  {
    $data['title'] = $this->judul->title();

    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('auth/blocked');
    $this->load->view('template/footer');
  }

  public function blockedAll()
  {
    $this->load->view('auth/blocked-all');
  }
}
