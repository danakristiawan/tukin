<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-success elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('home'); ?>" class="brand-link">
    <img src="<?= base_url(); ?>assets/img/Mind-Map-Paper-128.png" alt="Alika Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">e-Tukin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
        $nip = $this->session->userdata('nip');
        $row = $this->db->query("SELECT nama FROM landing_ref_pegawai WHERE nip='$nip'")->row_array();
        $nama = $row['nama'];
        ?>

        <li class="nav-header ml-2"><i class="nav-icon fa fa-user"></i> &nbsp;<?= $nama; ?></li>
        <div class="user-panel pb-2"></div>

        <!-- cetak menu -->
        <?php
        $nip = $this->session->userdata('nip');
        $query = $this->db->query("SELECT role_id FROM system_user WHERE nip='$nip'")->row_array();
        if ($query) {
          $role_id = $query['role_id'];
          $queryMenu = "SELECT a.menu_id, b.name
                      FROM system_access a
                      LEFT JOIN system_menu b
                      ON a.menu_id = b.id
                      WHERE a.role_id = $role_id
                      ORDER BY a.menu_id ASC";
          $menu = $this->db->query($queryMenu)->result_array();
        } else {
          redirect('auth/blockedAll');
        }
        ?>
        <?php
        // $menu = $this->db->query("SELECT * FROM system_menu")->result_array();
        ?>
        <?php foreach ($menu as $m) : ?>
          <li class="nav-header"><?= $m['name']; ?></li>
          <!-- cetak sub menu -->
          <?php
            $menu_id = $m['menu_id'];
            $submenu = $this->db->query("SELECT a.id,a.name AS submenu,a.url,a.icon,COUNT(b.id) AS jml FROM system_sub_menu a LEFT JOIN system_sub_sub_menu b ON a.id=b.sub_menu_id WHERE a.menu_id='$menu_id' GROUP BY a.id,a.name,a.icon,a.url")->result_array();
            ?>
          <?php foreach ($submenu as $sm) : ?>
            <li class="nav-item has-treeview <?= $sm['submenu'] == $title['subjudul'] ? 'menu-open' : ''; ?>">
              <a href="<?= base_url() . $sm['url']; ?>" class="nav-link <?= $sm['submenu'] == $title['subjudul'] || $sm['submenu'] == $title['judul'] ? 'active' : ''; ?>">
                <i class="<?= $sm['icon']; ?>"></i>
                <p><?= $sm['submenu']; ?> <?= $sm['jml'] > 0 ? '<i class="right fa fa-angle-left"></i>' : ''; ?></p>
              </a>
              <?= $sm['jml'] > 0 ? '<ul class="nav nav-treeview">' : ''; ?>
              <!-- cetak sub sub menu -->
              <?php
                  $submenu_id = $sm['id'];
                  $subsubmenu = $this->db->query("SELECT url,icon,name AS subsubmenu FROM system_sub_sub_menu WHERE sub_menu_id='$submenu_id'")->result_array();
                  ?>
              <?php foreach ($subsubmenu as $ssm) : ?>
            <li class="nav-item">
              <a href="<?= base_url() . $ssm['url']; ?>" class="nav-link <?= $ssm['subsubmenu'] == $title['judul'] ? 'active' : ''; ?>">
                <i class="<?= $ssm['icon']; ?>"></i>
                <p><?= $ssm['subsubmenu']; ?></p>
              </a>
            </li>
          <?php endforeach; ?>
          <?= $sm['jml'] > 0 ? '</ul>' : ''; ?>
          </li>
        <?php endforeach; ?>
      <?php endforeach; ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

    </div>
  </div>
  <!-- /.sidebar -->
</aside>