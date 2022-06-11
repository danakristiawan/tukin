<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <form action="" method="post" autocomplete="off">
            <div class="card-header">
              <h4>Kirim Data LPP</h4>
            </div>
            <div class="card-body">
              <div class="responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Dokumen</th>
                      <th>File</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($dokumen as $r) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $r['nama']; ?></td>
                        <?php
                        $dokumen_id = $r['id'];
                        $upload = $this->db->get_where('data_upload', ['laporan_id' => $laporan_id, 'dokumen_id' => $dokumen_id])->row_array();
                        ?>
                        <?php if ($upload) : ?>
                          <td class="text-center"><a href="<?= base_url('assets/files/') . $upload['file']; ?>" class="badge badge-success" target="_blank" data-toggle="tooltip" data-placement="bottom" title="File"><i class="fa fa-file-text"></i></a></td>
                          <td class="text-center"><a href="<?= base_url('lpp/delete-file/') . $laporan_id . '/' . $upload['id'] . '/' . $upload['file']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin akan menghapus file ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a></td>
                        <?php else : ?>
                          <td></td>
                          <td class="text-center"><a href="<?= base_url('lpp/upload/') . $laporan_id . '/' . $dokumen_id; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="bottom" title="Upload"><i class="fa fa-upload"></i></a></td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <?php
              $dokumen = $this->db->get_where('ref_dokumen', ['jns' => 2, 'opt' => 0])->num_rows();
              $upload = $this->db->query("SELECT a.file FROM data_upload a LEFT JOIN ref_dokumen b ON a.dokumen_id=b.id WHERE a.laporan_id='$laporan_id' AND a.jns='2' AND b.opt='0'")->num_rows();
              ?>
              <?php if ($dokumen === $upload) : ?>
                <button type="submit" class="btn btn-sm btn-info float-right ml-2" onclick="return confirm('Apakah Anda yakin akan mengirim data ini?');" data-toggle="tooltip" data-placement="bottom" title="Kirim"><i class="fa fa-send"></i> Kirim</button>
              <?php endif; ?>
              <a href="<?= base_url('lpp'); ?>" class="btn btn-sm btn-warning float-right"><i class="fa fa-undo"></i> Batal</a>
              <input type="hidden" name="status_lpp" value="1">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>