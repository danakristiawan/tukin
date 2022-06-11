<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <a href="<?= base_url('menu/add'); ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fa fa-plus"></i></a>
      </div>
    </div>
    <hr>
    <div class="row">
      <?php foreach ($menu as $m) : ?>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-success-gradient">
              <?= $m['name']; ?>
              <a href="<?= base_url('menu/delete/') . $m['id']; ?>" class="badge badge-danger badge-sm float-right mr-1" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></i></a>
              <a href="<?= base_url('menu/edit/') . $m['id']; ?>" class="badge badge-success badge-sm float-right mr-1" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fa fa-edit"></i></i></a>
              <a href="<?= base_url('menu/addSub/') . $m['id']; ?>" class="badge badge-primary badge-sm float-right mr-1"><i class="fa fa-plus" data-toggle="tooltip" data-placement="bottom" title="Tambah"></i></i></a>
            </div>
            <div class="card-body">
              <table class="table table-sm">
                <?php foreach ($submenu as $sm) : ?>
                  <?php if ($sm['menu_id'] == $m['id']) : ?>
                    <tr>
                      <td>
                        <?= $sm['name']; ?>
                        <a href="<?= base_url('menu/deleteSub/') . $sm['id']; ?>" class="badge badge-danger badge-sm float-right ml-1" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>
                        <a href="<?= base_url('menu/editSub/') . $sm['id']; ?>" class="badge badge-success badge-sm float-right ml-1" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('menu/addSubSub/') . $m['id'] . '/' .  $sm['id']; ?>" class="badge badge-primary badge-sm float-right ml-1" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fa fa-plus"></i></a>
                        <ul class="text-secondary">
                          <?php foreach ($subsubmenu as $ssm) : ?>
                            <?php if ($ssm['sub_menu_id'] == $sm['id']) : ?>
                              <li>
                                <?= $ssm['name']; ?>
                                <a href="<?= base_url('menu/editSubSub/') . $ssm['id']; ?>" class="badge badge-success ml-2" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url('menu/deleteSubSub/') . $ssm['id']; ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');" class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>
                              </li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </ul>
                      </td>

                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>