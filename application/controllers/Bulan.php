<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bulan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('judul_model', 'judul');
  }

  public function index()
  {
    // data
    $data['title'] = $this->judul->title();
    $data['bulan'] = $this->db->get('ref_bulan')->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('bulan/index', $data);
    $this->load->view('template/footer');
  }

  public function active($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    $this->db->update('ref_bulan', ['default' => 0]);
    $this->db->update('ref_bulan', ['default' => 1], ['id' => $id]);
    redirect('bulan');
  }
}
