<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <form action="" method="post" autocomplete="off">
            <div class="card-header">

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Saldo Awal</th>
                      <th>Droping</th>
                      <th>PPh Terutang</th>
                      <th>PPh Disetor</th>
                      <th>Pembayaran</th>
                      <th>Saldo Akhir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    $j1 = 0;
                    $j2 = 0;
                    $j3 = 0;
                    $j4 = 0;
                    $j5 = 0;
                    $j6 = 0;
                    foreach ($eselon2 as $s) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $s['nama']; ?></td>
                        <?php
                        $where = [
                          'eselon2_id' => $s['id'],
                          'bulan' => $bulan['kode'],
                          'tahun' => $tahun['nama']
                        ];
                        $r = $this->db->get_where('data_laporan_kanwil', $where)->row_array();
                        ?>
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
                      ?>
                    <?php endforeach; ?>
                  </tbody>
                  <thead>
                    <tr>
                      <th class="text-center" colspan="2">Jumlah</th>
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
            <div class="card-footer">
              <input type="hidden" name="droping" value="<?= $j2; ?>">
              <input type="hidden" name="pph_terutang" value="<?= $j3; ?>">
              <input type="hidden" name="pph_disetor" value="<?= $j4; ?>">
              <input type="hidden" name="pembayaran" value="<?= $j5; ?>">
              <input type="hidden" name="saldo_akhir" value="<?= $j6; ?>">
              <button type="submit" class="btn btn-sm btn-success float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <a href="<?= base_url('lpp-pusat'); ?>" class="btn btn-sm btn-warning float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>