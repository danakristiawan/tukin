<?php

defined('BASEPATH') or exit('No direct script access allowed');

function is_logged_in()
{
  $ci = get_instance();
  if (!$ci->session->userdata('nip')) {
    redirect('../landing/auth');
  } else {
    $nip = $ci->session->userdata('nip');
    $result = $ci->db->query("SELECT role_id FROM system_user WHERE nip='$nip'")->row_array();
    $role_id = $result['role_id'];
    $submenu = $ci->uri->segment(1);
    $subsubmenu = $ci->uri->segment(1) . '/' . $ci->uri->segment(2);

    $queryMenu = $ci->db->get_where('system_sub_menu', ['url' => $submenu])->row_array();
    if ($queryMenu) {
      $menu_id = $queryMenu['menu_id'];
    } else {
      // $queryMenu = $ci->db->get_where('system_sub_sub_menu', ['url' => $submenu])->row_array();
      $queryMenu = $ci->db->query("SELECT menu_id FROM system_sub_sub_menu WHERE url='$submenu' OR url='$subsubmenu'")->row_array();
      $menu_id = $queryMenu['menu_id'];
    }

    $userAccess = $ci->db->get_where('system_access', [
      'role_id' => $role_id,
      'menu_id' => $menu_id
    ]);

    if ($userAccess->num_rows() < 1) {
      redirect('auth/blocked');
    }
  }
}

function getSatker()
{
  $ci = get_instance();
  if (!$ci->session->userdata('nip')) {
    redirect('auth');
  } else {
    $nip = $ci->session->userdata('nip');
    $query = $ci->db->query("SELECT b.kode FROM system_user a LEFT JOIN landing_ref_eselon3 b ON a.satker_id=b.id WHERE a.nip='$nip'")->row_array();
    $kdsatker = $query['kode'];
    return $kdsatker;
  }
}

function getWilayah()
{
  $ci = get_instance();
  if (!$ci->session->userdata('nip')) {
    redirect('auth');
  } else {
    $nip = $ci->session->userdata('nip');
    $query = $ci->db->query("SELECT b.eselon2_id FROM system_user a LEFT JOIN landing_ref_eselon3 b ON a.satker_id=b.id WHERE a.nip='$nip'")->row_array();
    $kdwilayah = $query['eselon2_id'];
    return $kdwilayah;
  }
}

function is_logged_in2()
{
  $ci = get_instance();
  if (!$ci->session->userdata('nip')) {
    redirect('../landing/auth');
  }
}

function check_nip($nip)
{
  $ci = get_instance();

  $ci->db->where('nip', $nip);
  $result = $ci->db->get('system_user');

  if ($result->num_rows() > 0) {
    return "checked='checked'";
  }
}
