<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_pmnt_kanwil extends CI_Controller
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
    $data['title'] = $this->judul->title();
    $data['bulan'] = $this->db->query("SELECT kode AS bulan from ref_bulan")->result_array();
    $data['tahun'] = $this->db->query("SELECT nama AS tahun from ref_tahun ORDER BY nama DESC")->result_array();
    $data['pmnt'] = $this->db->query("SELECT a.kode AS kdsatker, a.nama AS nmsatker, b.id,b.saldo_awal,b.permintaan,b.jumlah_pegawai,b.status_minta,b.date_created_minta FROM landing_ref_eselon2 a LEFT JOIN data_laporan_kanwil b ON a.id=b.eselon2_id WHERE b.bulan='$bln' AND b.tahun='$thn' ORDER BY a.id ASC")->result_array();
    $data['bln'] = $bln;
    $data['thn'] = $thn;
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('lap_pmnt_kanwil/index', $data);
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
    $this->db->update('data_laporan_kanwil', $data, ['id' => $id]);
    redirect('lap-pmnt-kanwil/index/' . $thn . '/' . $bln . '');
  }
}
