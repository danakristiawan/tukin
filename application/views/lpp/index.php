<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <?php foreach ($tahun as $t) : ?>
                  <a href="<?= base_url('lpp/index/') . $t['tahun']; ?>" class="btn btn-sm btn-outline-success <?= $t['tahun'] == $thn ? 'active' : '' ?> ml-1 mt-1 mb-1"><?= $t['tahun']; ?></a>
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
                        <th>Droping</th>
                        <th>PPh Terutang</th>
                        <th>PPh Disetor</th>
                        <th>Pembayaran</th>
                        <th>Saldo Akhir</th>
                        <th>Berkas</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($laporan as $r) :
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $r['nama_bulan'] . ' ' . $r['tahun']; ?></td>
                          <td><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                          <td><?= number_format($r['droping'], 0, ',', '.'); ?></td>
                          <td><?= number_format($r['pph_terutang'], 0, ',', '.'); ?></td>
                          <td><?= number_format($r['pph_disetor'], 0, ',', '.'); ?></td>
                          <td><?= number_format($r['pembayaran'], 0, ',', '.'); ?></td>
                          <td><?= number_format($r['saldo_akhir'], 0, ',', '.'); ?></td>
                          <?php if ($r['status_lpp'] == 1) : ?>
                            <td>
                              <?php
                              $this->db->select('a.file,b.nama');
                              $this->db->from('data_upload a');
                              $this->db->join('ref_dokumen b', 'a.dokumen_id=b.id', 'left');
                              $this->db->where(['a.laporan_id' => $r['id'], 'a.jns' => 2]);
                              $upload = $this->db->get()->result_array(); ?>
                              <ul>
                                <?php foreach ($upload as $u) : ?>
                                  <li><a href="<?= base_url('assets/files/') . $u['file']; ?>" target="_blank"><?= $u['nama']; ?></a></li>
                                <?php endforeach; ?>
                              </ul>
                            </td>
                            <td><i>Terkirim pada <?= date('d-m-Y H:i:s', $r['date_created_lpp']); ?></i></td>
                          <?php else : ?>
                            <td></td>
                            <td>
                              <a href="<?= base_url('lpp/edit/') . $r['id']; ?>" class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="Ubah"><i class="fa fa-edit"></i></a>
                              <a href="<?= base_url('lpp/kirim/') . $r['id']; ?>" class="badge badge-info" data-toggle="tooltip" data-placement="bottom" title="Kirim"><i class="fa fa-send"></i></a>
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