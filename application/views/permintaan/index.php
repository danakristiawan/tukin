<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <a href="<?= base_url('permintaan/add'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus" data-toggle="tooltip" data-placement="bottom" title="Tambah"></i></a>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <?php foreach ($tahun as $t) : ?>
                  <a href="<?= base_url('permintaan/index/') . $t['tahun']; ?>" class="btn btn-sm btn-outline-success <?= $t['tahun'] == $thn ? 'active' : '' ?> ml-1 mt-1 mb-1"><?= $t['tahun']; ?></a>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <div class="table-responsive">
                  <table class="table table-sm table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Saldo Awal</th>
                        <th>Permintaan</th>
                        <th>Pengeluaran</th>
                        <th>Pegawai</th>
                        <th>Berkas</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($laporan as $r) :
                        $pengeluaran = $r['saldo_awal'] + $r['permintaan'];
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $r['nama_bulan'] . ' ' . $r['tahun']; ?></td>
                          <td><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                          <td><?= number_format($r['permintaan'], 0, ',', '.'); ?></td>
                          <td><?= number_format($pengeluaran, 0, ',', '.'); ?></td>
                          <td><?= number_format($r['jumlah_pegawai'], 0, ',', '.'); ?></td>
                          <?php if ($r['status_minta'] == 1) : ?>
                            <td>
                              <?php
                              $this->db->select('a.file,b.nama');
                              $this->db->from('data_upload a');
                              $this->db->join('ref_dokumen b', 'a.dokumen_id=b.id', 'left');
                              $this->db->where(['a.laporan_id' => $r['id'], 'a.jns' => 1]);
                              $upload = $this->db->get()->result_array(); ?>
                              <ul>
                                <?php foreach ($upload as $u) : ?>
                                  <li><a href="<?= base_url('assets/files/') . $u['file']; ?>" target="_blank"><?= $u['nama']; ?></a></li>
                                <?php endforeach; ?>
                              </ul>
                            </td>
                            <td><i>Terkirim pada <?= date('d-m-Y H:i:s', $r['date_created_minta']); ?></i></td>
                          <?php else : ?>
                            <td></td>
                            <td>
                              <a href="<?= base_url('permintaan/edit/') . $r['id']; ?>" class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fa fa-edit"></i></a>
                              <a href="<?= base_url('permintaan/delete/') . $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-trash"></i></a>
                              <a href="<?= base_url('permintaan/kirim/') . $r['id']; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="bottom" title="Kirim"><i class="fa fa-send"></i></a>
                            </td>
                          <?php endif; ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </div>

  </div>
</section>