<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <!-- <div class="card">
          <div class="card-body"> -->
        <?php foreach ($tahun as $t) : ?>
          <a href="<?= base_url('monitoring/index/') . $t['tahun']; ?>" class="btn btn-sm btn-outline-success <?= $t['tahun'] == $thn ? 'active' : '' ?> ml-1 mt-1 mb-1"><?= $t['tahun']; ?></a>
        <?php endforeach; ?>
        <!-- </div>
        </div> -->
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4>Permintaan</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>Bulan</th>
                    <th>Saldo</th>
                    <th>Permintaan</th>
                    <th>Jumlah</th>
                    <th>Peg</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $j1 = 0;
                  $j2 = 0;
                  $j3 = 0;
                  $kdsatker = getSatker();
                  foreach ($bulan as $b) : ?>
                    <tr>
                      <td><?= $b['nama']; ?></td>
                      <?php $r = $this->db->get_where('data_laporan', ['kdsatker' => $kdsatker, 'bulan' => $b['kode'], 'tahun' => $thn])->row_array(); ?>
                      <td class="text-right"><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['permintaan'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['saldo_awal'] + $r['permintaan'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['jumlah_pegawai'], 0, ',', '.'); ?></td>
                    </tr>
                  <?php
                    $j1 += $r['saldo_awal'];
                    $j2 += $r['permintaan'];
                    $j3 += $r['jumlah_pegawai'];
                  endforeach; ?>
                </tbody>
                <thead>
                  <tr>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right"><?= number_format($j1, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j2, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j1 + $j2, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j3, 0, ',', '.'); ?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h4>LPP</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>Bulan</th>
                    <th>Saldo Awal</th>
                    <th>Droping</th>
                    <th>PPh Terutang</th>
                    <th>PPh Disetor</th>
                    <th>Pembayaran</th>
                    <th>Saldo Akhir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $j1 = 0;
                  $j2 = 0;
                  $j3 = 0;
                  $j4 = 0;
                  $j5 = 0;
                  $j6 = 0;
                  $kdsatker = getSatker();
                  foreach ($bulan as $b) : ?>
                    <tr>
                      <td><?= $b['nama']; ?></td>
                      <?php $r = $this->db->get_where('data_laporan', ['kdsatker' => $kdsatker, 'bulan' => $b['kode'], 'tahun' => $thn])->row_array(); ?>
                      <td class="text-right"><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['droping'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['pph_terutang'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['pph_disetor'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['pembayaran'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['saldo_akhir'], 0, ',', '.'); ?></td>
                    </tr>
                  <?php
                    $j1 += $r['saldo_awal'];
                    $j2 += $r['droping'];
                    $j3 += $r['pph_terutang'];
                    $j4 += $r['pph_disetor'];
                    $j5 += $r['pembayaran'];
                    $j6 += $r['saldo_akhir'];
                  endforeach; ?>
                </tbody>
                <thead>
                  <tr>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right"><?= number_format($j1, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j2, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j3, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j4, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j5, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j6, 0, ',', '.'); ?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>