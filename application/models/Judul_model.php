<?php defined('BASEPATH') or exit('No direct script access allowed');

class Judul_model extends CI_Model
{
  public function title()
  {
    $uri = $this->uri->segment(1);
    $uri2 = $this->uri->segment(1) . '/' . $this->uri->segment(2);
    $qry1 = $this->db->query("SELECT * FROM system_sub_menu WHERE url = '$uri'")->row_array();
    if ($qry1) {
      $data['url'] = $qry1['url'];
      $data['judul'] = $qry1['name'];
      $data['subjudul'] = $qry1['name'];
    } else {
      $qry2 = $this->db->query("SELECT a.url,a.name,b.name AS subname FROM system_sub_sub_menu a LEFT JOIN system_sub_menu b ON a.sub_menu_id = b.id WHERE a.url = '$uri' OR a.url = '$uri2'")->row_array();
      if ($qry2) {
        $data['url'] = $qry2['url'];
        $data['judul'] = $qry2['name'];
        $data['subjudul'] = $qry2['subname'];
      } else {
        $data['url'] = $this->uri->segment(1);
        $data['judul'] = $this->uri->segment(1);
        $data['subjudul'] = $this->uri->segment(1);
      }
    }
    $data['subsubjudul'] = $this->uri->segment(2);

    return [
      'url' => $data['url'],
      'judul' => $data['judul'],
      'subjudul' => $data['subjudul'],
      'subsubjudul' => $data['subsubjudul']
    ];
  }
}
