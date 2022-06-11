<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lpp extends CI_Controller
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
    $kdsatker = getSatker();
    $data['title'] = $this->judul->title();
    $this->db->select('a.id,a.tahun,a.saldo_awal,a.droping,a.pph_terutang,a.pph_disetor,a.pembayaran,a.saldo_akhir,a.status_lpp,a.date_created_lpp, b.nama AS nama_bulan');
    $this->db->from('data_laporan a');
    $this->db->join('ref_bulan b', 'a.bulan=b.kode', 'left');
    $this->db->where(['a.kdsatker' => $kdsatker, 'a.tahun' => $thn]);
    $query = $this->db->get();
    $data['laporan'] = $query->result_array();
    $data['tahun'] = $this->db->query("SELECT nama AS tahun from ref_tahun ORDER BY nama DESC")->result_array();
    $data['thn'] = $thn;

    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('lpp/index', $data);
    $this->load->view('template/footer');
  }

  public function edit($id = null)
  {
    // cek id
    if (!isset($id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['laporan'] = $this->db->get_where('data_laporan', ['id' => $id])->row_array();
    $saldo_awal = $data['laporan']['saldo_awal'];
    // validasi
    $rules = [
      [
        'field' => 'droping',
        'label' => 'Droping',
        'rules' => 'required|trim|numeric'
      ],
      [
        'field' => 'pph_terutang',
        'label' => 'PPh Terutang',
        'rules' => 'required|trim|numeric'
      ],
      [
        'field' => 'pph_disetor',
        'label' => 'PPh Disetor',
        'rules' => 'required|trim|numeric'
      ],
      [
        'field' => 'pembayaran',
        'label' => 'Pembayaran',
        'rules' => 'required|trim|numeric'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $saldo_akhir = ($saldo_awal + htmlspecialchars($this->input->post('droping', true))) - (htmlspecialchars($this->input->post('pph_disetor', true)) + htmlspecialchars($this->input->post('pembayaran', true)));
      $data = [
        'droping' => htmlspecialchars($this->input->post('droping', true)),
        'pph_terutang' => htmlspecialchars($this->input->post('pph_terutang', true)),
        'pph_disetor' => htmlspecialchars($this->input->post('pph_disetor', true)),
        'pembayaran' => htmlspecialchars($this->input->post('pembayaran', true)),
        'saldo_akhir' => $saldo_akhir,
        'date_created_lpp' => time()
      ];
      $this->db->update('data_laporan', $data, ['id' => $id]);
      redirect('lpp');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('lpp/edit', $data);
    $this->load->view('template/footer');
  }

  public function kirim($laporan_id = null)
  {
    // cek id
    if (!isset($laporan_id)) redirect('auth/blocked');
    // data
    $data['title'] = $this->judul->title();
    $data['laporan_id'] = $laporan_id;
    $data['dokumen'] = $this->db->get_where('ref_dokumen', ['jns' => 2])->result_array();
    // validasi
    $rules = [
      [
        'field' => 'status_lpp',
        'label' => 'Status',
        'rules' => 'trim'
      ]
    ];
    $validation = $this->form_validation->set_rules($rules);
    if ($validation->run()) {
      //query
      $data = [
        'status_lpp' => 1,
        'date_created_lpp' => time()
      ];
      $this->db->update('data_laporan', $data, ['id' => $laporan_id]);
      redirect('lpp');
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('lpp/kirim', $data);
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
            redirect('lpp/upload/' . $laporan_id . '/' . $dokumen_id . '');
          }
        }
        //cek dok udh ada apa blm ada
        $qry = $this->db->get_where('data_upload', ['laporan_id' => $laporan_id, 'dokumen_id' => $dokumen_id, 'jns' => 2])->result_array();
        //query
        if ($qry) $this->db->delete('data_upload', ['laporan_id' => $laporan_id, 'dokumen_id' => $dokumen_id, 'jns' => 2]);
        $data = [
          'laporan_id' => $laporan_id,
          'dokumen_id' => $dokumen_id,
          'jns' => 2,
          'date_created' => time()
        ];

        $this->db->insert('data_upload', $data);
        redirect('lpp/kirim/' . $laporan_id . '');
      }
    }
    // form
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('template/topbar', $data);
    $this->load->view('lpp/upload', $data);
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
      redirect('lpp/kirim/' . $laporan_id . '');
    }
  }
}
