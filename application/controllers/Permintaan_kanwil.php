<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan_kanwil extends CI_Controller
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
    $eselon2_id = getWilayah();
    $data['title'] = $this->judul->title();
    $this->db->select('a.id,a.tahun,a.saldo_awal,a.permintaan,a.jumlah_pegawai,a.status_minta,a.date_created_minta, b.nama AS nama_bulan');
    $this->db->from('data_laporan_kanwil a');
    $this->db->join('ref_bulan b', 'a.bulan=b.kode', 'left');
    $this->db->where(['a.eselon2_id' => $eselon2_id, 'a.tahun' => $thn]);
    $query = $this->db->get();
    $data['laporan'] = $query->result_array();
    $data['tahun'] = $this->db->query("SELECT nama AS tahun from ref_tahun ORDER BY nama DESC")->result_array();
    $data['thn'] = $thn;

    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('permintaan_kanwil/index', $data);
    $this->load->view('template/footer');
  }

  public function add()
  {
    // data
    $data['eselon2_id'] = getWilayah();
    $data['satker'] = $this->db->get_where('landing_ref_eselon3', ['eselon2_id' => $data['eselon2_id']])->result_array();
    $data['tahun'] = $this->db->get_where('ref_tahun', ['default' => 1])->row_array();
    $data['bulan'] = $this->db->get_where('ref_bulan', ['default' => 1])->row_array();
    $data['title'] = $this->judul->title();
    // validasi
    $rules = [
      [
        'field' => 'jumlah_pegawai',
        'label' => 'Jumlah Pegawai',
        'rules' => 'required|trim|numeric'
      ],
      [
        'field' => 'saldo_awal',
        'label' => 'Saldo Awal',
        'rules' => 'required|trim|numeric'
      ],
      [
        'field' => 'permintaan',
        'label' => 'Jumlah Permintaan',
        'rules' => 'required|trim|numeric'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'eselon2_id' => $data['eselon2_id'],
        'bulan' => $data['bulan']['kode'],
        'tahun' => $data['tahun']['nama'],
        'jumlah_pegawai' => htmlspecialchars($this->input->post('jumlah_pegawai', true)),
        'saldo_awal' => htmlspecialchars($this->input->post('saldo_awal', true)),
        'permintaan' => htmlspecialchars($this->input->post('permintaan', true))
      ];
      $this->db->insert('data_laporan_kanwil', $data);
      redirect('permintaan-kanwil');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('permintaan_kanwil/add', $data);
    $this->load->view('template/footer');
  }

  public function delete($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('data_laporan_kanwil', ['id' => $id])) {
      $upload = $this->db->get_where('data_upload', ['laporan_id' => $id])->result_array();
      foreach ($upload as $r) {
        unlink('assets/files/' . $r['file'] . '');
        $this->db->delete('data_upload', ['id' => $r['id']]);
      }
      redirect('permintaan-kanwil');
    }
  }

  public function kirim($laporan_id = null)
  {
    // cek id
    if (!isset($laporan_id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['laporan_id'] = $laporan_id;
    $data['dokumen'] = $this->db->get_where('ref_dokumen', ['jns' => 3])->result_array();
    // validasi
    $rules = [
      [
        'field' => 'status_minta',
        'label' => 'Status',
        'rules' => 'trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'status_minta' => 1,
        'date_created_minta' => time()
      ];
      $this->db->update('data_laporan_kanwil', $data, ['id' => $laporan_id]);
      redirect('permintaan-kanwil');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('permintaan_kanwil/kirim', $data);
    $this->load->view('template/footer');
  }

  public function upload($laporan_id = null, $dokumen_id = null)
  {
    // cek id
    if (!isset($laporan_id)) redirect('auth/blocked');
    if (!isset($dokumen_id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['laporan_id'] = $laporan_id;
    // validasi
    $rules = [
      [
        'field' => 'file',
        'label' => 'file',
        'rules' => 'trim'
      ]
    ];
    if (!empty($_FILES["file"]["name"])) {
      $validation = $this->form_validation->set_rules($rules);
      if ($validation->run()) {
        // upload publikasi
        $upload_file = $_FILES['file']['name'];
        if ($upload_file) {
          $config['allowed_types'] = 'pdf';
          $config['remove_spaces'] = TRUE;
          $config['max_size']     = '5000';
          $config['encrypt_name']     = TRUE;
          $config['upload_path'] = 'assets/files/';

          $this->load->library('upload', $config);

          if ($this->upload->do_upload('file')) {
            $new_file = $this->upload->data('file_name');
            $this->db->set('file', $new_file);
          } else {
            echo $this->upload->display_errors();
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Upload file gagal, mohon sesuaikan format dan ukuran!</div>');
            redirect('permintaan-kanwil/upload/' . $laporan_id . '/' . $dokumen_id . '');
          }
        }
        //query
        $data = [
          'laporan_id' => $laporan_id,
          'dokumen_id' => $dokumen_id,
          'jns' => 3,
          'date_created' => time()
        ];
        $this->db->insert('data_upload', $data);
        redirect('permintaan-kanwil/kirim/' . $laporan_id . '');
      }
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('permintaan_kanwil/upload', $data);
    $this->load->view('template/footer');
  }

  public function delete_file($laporan_id = null, $id = null, $file = null)
  {
    // cek id
    if (!isset($laporan_id)) redirect('auth/blocked');
    if (!isset($id)) redirect('auth/blocked');
    // query
    if ($this->db->delete('data_upload', ['id' => $id])) {
      unlink('assets/files/' . $file . '');
      redirect('permintaan-kanwil/kirim/' . $laporan_id . '');
    }
  }
}
