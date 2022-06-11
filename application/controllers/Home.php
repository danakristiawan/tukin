<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
    $nip = $this->session->userdata('nip');
    $data['user'] = $this->db->query("SELECT a.*, b.name AS role, c.nama as nmsatker FROM system_user a LEFT JOIN system_role b ON a.role_id=b.id LEFT JOIN landing_ref_eselon3 c ON a.satker_id = c.id WHERE a.nip='$nip'")->row_array();
    // data lpp
    $kdsatker = getSatker();
    $this->db->select('a.*, b.nama AS nama_bulan');
    $this->db->from('data_laporan a');
    $this->db->join('ref_bulan b', 'a.bulan=b.kode', 'left');
    $this->db->where(['a.kdsatker' => $kdsatker, 'a.tahun' => $thn]);
    $query = $this->db->get();
    $data['laporan'] = $query->result_array();
    $data['tahun'] = $this->db->query("SELECT nama AS tahun from ref_tahun ORDER BY nama DESC")->result_array();
    $data['thn'] = $thn;
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('home/index', $data);
    $this->load->view('template/footer');
  }
}
