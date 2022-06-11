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
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>Saldo</th>
                      <th>Permintaan</th>
                      <th>Pengeluaran</th>
                      <th>Pegawai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    $j1 = 0;
                    $j2 = 0;
                    $j3 = 0;
                    $j4 = 0;
                    foreach ($satker as $s) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $s['kode']; ?></td>
                        <td><?= $s['nama']; ?></td>
                        <?php
                        $where = [
                          'kdsatker' => $s['kode'],
                          'bulan' => $bulan['kode'],
                          'tahun' => $tahun['nama'],
                          'status_minta' => 1
                        ];
                        $r = $this->db->get_where('data_laporan', $where)->row_array();
                        ?>
                        <td class="text-right"><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                        <td class="text-right"><?= number_format($r['permintaan'], 0, ',', '.'); ?></td>
                        <td class="text-right"><?= number_format($r['saldo_awal'] + $r['permintaan'], 0, ',', '.'); ?></td>
                        <td class="text-right"><?= number_format($r['jumlah_pegawai'], 0, ',', '.'); ?></td>
                      </tr>
                      <?php
                      $j1 += $r['saldo_awal'];
                      $j2 += $r['permintaan'];
                      $j3 += $r['saldo_awal'] + $r['permintaan'];
                      $j4 += $r['jumlah_pegawai'];
                      ?>
                    <?php endforeach; ?>
                  </tbody>
                  <thead>
                    <tr>
                      <th class="text-center" colspan="3">Jumlah</th>
                      <th class="text-right"><?= number_format($j1, 0, ',', '.'); ?></th>
                      <th class="text-right"><?= number_format($j2, 0, ',', '.'); ?></th>
                      <th class="text-right"><?= number_format($j3, 0, ',', '.'); ?></th>
                      <th class="text-right"><?= number_format($j4, 0, ',', '.'); ?></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <input type="hidden" name="saldo_awal" value="<?= $j1; ?>">
              <input type="hidden" name="permintaan" value="<?= $j2; ?>">
              <input type="hidden" name="jumlah_pegawai" value="<?= $j4; ?>">
              <?php
              $bln = $bulan['kode'];
              $thn = $tahun['nama'];
              $satker = $this->db->get_where('landing_ref_eselon3', ['eselon2_id' => $eselon2_id])->num_rows();
              $laporan = $this->db->query("SELECT a.kdsatker FROM data_laporan a LEFT JOIN landing_ref_eselon3 b ON a.kdsatker=b.kode WHERE b.eselon2_id='$eselon2_id' AND a.bulan=$bln AND a.tahun='$thn' AND a.status_minta=1")->num_rows();
              ?>
              <?php if ($satker === $laporan) : ?>
                <button type="submit" class="btn btn-sm btn-success float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <?php endif; ?>
              <a href="<?= base_url('permintaan-kanwil'); ?>" class="btn btn-sm btn-warning float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>