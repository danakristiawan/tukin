<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring_per_kanwil extends CI_Controller
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
    $data['bln'] = $this->db->get('ref_bulan')->result_array();
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('monitoring_per_kanwil/index', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    $data = [
      'status_minta' => null,
      'date_created_minta' => null
    ];
    $this->db->update('data_laporan_kanwil', $data, ['id' => $id]);
    redirect('monitoring-per-kanwil');
  }

  public function delete_lpp($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    $data = [
      'status_lpp' => null,
      'date_created_lpp' => null
    ];
    $this->db->update('data_laporan_kanwil', $data, ['id' => $id]);
    redirect('monitoring-per-kanwil');
  }
}
