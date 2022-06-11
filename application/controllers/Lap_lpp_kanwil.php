<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_lpp_kanwil extends CI_Controller
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
    $data['lpp'] = $this->db->query("SELECT a.kode AS kdsatker,a.nama AS nmsatker,b.id,b.saldo_awal,b.droping,b.pph_terutang,b.pph_disetor,b.pembayaran,b.saldo_akhir,b.status_lpp,b.date_created_lpp FROM landing_ref_eselon2 a LEFT JOIN data_laporan_kanwil b ON a.id=b.eselon2_id WHERE b.tahun ='$thn' AND b.bulan='$bln' ORDER BY a.id ASC")->result_array();
    $data['bln'] = $bln;
    $data['thn'] = $thn;
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('lap_lpp_kanwil/index', $data);
    $this->load->view('template/footer');
  }

  public function delete($thn = null, $bln = null, $id = null)
  {
    // check url
    if (!isset($bln)) $bln = date('m');
    if (!isset($thn)) $thn = date('Y');
    if (!isset($id)) redirect('auth/blocked');
    // query
    // query
    $data = [
      'status_lpp' => null,
      'date_created_lpp' => null
    ];
    $this->db->update('data_laporan_kanwil', $data, ['id' => $id]);
    redirect('lap-lpp-kanwil/index/' . $thn . '/' . $bln . '');
  }
}
