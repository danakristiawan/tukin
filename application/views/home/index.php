<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <!-- isi -->
        <div class="card">
          <div class="card-header">
            <h2 style="font-weight:200;"><i class="fa fa-building-o"></i> &nbsp; <?= $user['nmsatker']; ?></h2>
            <span class="ml-5" style="font-weight:200;"><i class="fa fa-user-o"></i>&nbsp;<?= $user['role']; ?></span>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <?php foreach ($tahun as $t) : ?>
                  <a href="<?= base_url('home/index/') . $t['tahun']; ?>" class="btn btn-sm btn-outline-success <?= $t['tahun'] == $thn ? 'active' : '' ?> ml-1 mt-1 mb-1"><?= $t['tahun']; ?></a>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <div class="table-responsive">
                  <table class="table table-sm table-bordered table-hover">
                    <thead>
                      <tr class="text-center">
                        <th rowspan="2" class="pb-4">No</th>
                        <th rowspan="2" class="pb-4">Bulan</th>
                        <th rowspan="2" class="pb-4">Peg</th>
                        <th rowspan="2" class="pb-4">Permintaan</th>
                        <th colspan="3">Penerimaan</th>
                        <th colspan="4">Pengeluaran</th>
                        <th rowspan="2" class="pb-4">Saldo Akhir</th>
                        <th rowspan="2" class="pb-4">Status Kirim</th>
                      </tr>
                      <tr class="text-center">
                        <th>Saldo</th>
                        <th>Droping</th>
                        <th>Jumlah</th>
                        <th>PPh Terutang</th>
                        <th>PPh Disetor</th>
                        <th>Pembayaran</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($laporan as $r) : ?>
                        <tr>
                          <td class="text-center pt-3"><?= $no++; ?></td>
                          <td class="pt-3"><?= $r['nama_bulan'] . ' ' . $r['tahun']; ?></td>
                          <td class="text-right pt-3"><?= number_format($r['jumlah_pegawai'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['permintaan'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['droping'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['saldo_awal'] + $r['droping'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['pph_terutang'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['pph_disetor'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['pembayaran'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['pph_disetor'] + $r['pembayaran'], 0, ',', '.'); ?></td>
                          <td class="text-right pt-3"><?= number_format($r['saldo_akhir'], 0, ',', '.'); ?></td>
                          <td>
                            <?php if ($r['status_minta'] == 1) : ?>
                              <p class="mb-0"><i>Permintaan: <?= date('d-m-Y H:i:s', $r['date_created_minta']); ?></i></p>
                            <?php endif; ?>
                            <?php if ($r['status_lpp'] == 1) : ?>
                              <p class="mb-0"><i>LPP: <?= date('d-m-Y H:i:s', $r['date_created_lpp']); ?></i></p>
                            <?php endif; ?>
                          </td>
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