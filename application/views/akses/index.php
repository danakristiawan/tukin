<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <a href="<?= base_url('akses/add'); ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fa fa-plus"></i></a>
      </div>
    </div>
    <hr>
    <div class="row">
      <?php foreach ($role as $r) : ?>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-success-gradient">
              <?= $r['name']; ?>
              <a href="<?= base_url('akses/delete/') . $r['id']; ?>" class="badge badge-sm badge-danger float-right ml-1" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>
              <a href="<?= base_url('akses/edit/') . $r['id']; ?>" class="badge badge-sm badge-success float-right ml-1" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fa fa-edit"></i></a>
              <a href="<?= base_url('akses/addMenu/') . $r['id']; ?>" class="badge badge-sm badge-primary float-right ml-1" data-toggle="tooltip" data-placement="bottom" title="Tambah"><i class="fa fa-plus"></i></a>
            </div>
            <div class="card-body">
              <table class="table table-borderless table-sm">
                <tbody>
                  <?php foreach ($access as $a) : ?>
                    <?php if ($a['role_id'] == $r['id']) : ?>
                      <tr>
                        <td>
                          <?= $a['name']; ?>
                          <a href="<?= base_url('akses/deleteMenu/') . $a['id']; ?>" class="badge badge-danger float-right" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>