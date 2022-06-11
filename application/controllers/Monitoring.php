<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('judul_model', 'judul');
  }

  public function index($thn = null)
  {
    // check url
    if (!isset($thn)) $thn = date('Y');
    // data
    $data['title'] = $this->judul->title();
    $data['bulan'] = $this->db->get('ref_bulan')->result_array();
    $data['tahun'] = $this->db->query("SELECT nama AS tahun from ref_tahun ORDER BY nama DESC")->result_array();
    $data['thn'] = $thn;
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('monitoring/index', $data);
    $this->load->view('template/footer');
  }
}
