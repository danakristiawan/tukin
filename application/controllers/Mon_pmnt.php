<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mon_pmnt extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('judul_model', 'judul');
  }

  public function index($thn = null, $bln = null)
  {
    // check url
    if (!isset($bln)) $bln = date('m');
    if (!isset($thn)) $thn = date('Y');
    // data
    $eselon2_id = getWilayah();
    $data['title'] = $this->judul->title();
    $data['bulan'] = $this->db->query("SELECT kode AS bulan from ref_bulan")->result_array();
    $data['tahun'] = $this->db->query("SELECT nama AS tahun from ref_tahun ORDER BY nama DESC")->result_array();
    $data['pmnt'] = $this->db->query("SELECT a.kode AS kdsatker, a.nama AS nmsatker, b.id,b.saldo_awal,b.permintaan,b.jumlah_pegawai,b.status_minta,b.date_created_minta FROM landing_ref_eselon3 a LEFT JOIN data_laporan b ON a.kode=b.kdsatker WHERE b.bulan='$bln' AND b.tahun='$thn' AND a.eselon2_id='$eselon2_id'")->result_array();
    $data['bln'] = $bln;
    $data['thn'] = $thn;
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('mon_pmnt/index', $data);
    $this->load->view('template/footer');
  }

  public function delete($thn = null, $bln = null, $id = null)
  {
    // check url
    if (!isset($bln)) $bln = date('m');
    if (!isset($thn)) $thn = date('Y');
    if (!isset($id)) redirect('auth/blocked');
    // query
    $data = [
      'status_minta' => null,
      'date_created_minta' => null
    ];
    $this->db->update('data_laporan', $data, ['id' => $id]);
    redirect('mon-pmnt/index/' . $thn . '/' . $bln . '');
  }

  public function delete_lpp($thn = null, $bln = null, $id = null)
  {
    // check url
    if (!isset($bln)) $bln = date('m');
    if (!isset($thn)) $thn = date('Y');
    if (!isset($id)) redirect('auth/blocked');
    // query
    $data = [
      'status_lpp' => null,
      'date_created_lpp' => null
    ];
    $this->db->update('data_laporan', $data, ['id' => $id]);
    redirect('mon-pmnt/index/' . $thn . '/' . $bln . '');
  }
}
