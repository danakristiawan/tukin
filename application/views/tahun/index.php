<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-4">
        <!-- isi -->
        <div class="card">
          <div class="card-header">

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Uraian</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($tahun as $r) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $r['nama']; ?></td>
                      <td>
                        <?php if ($r['default'] == 1) : ?>
                          <span class="badge badge-success">active</span>
                        <?php else : ?>
                          <a href="<?= base_url('tahun/active/') . $r['id']; ?>" class="badge badge-danger">nonactive</a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </div>



  </div>
</section>