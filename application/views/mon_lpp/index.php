<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <?php foreach ($tahun as $t) : ?>
                  <a href="<?= base_url('mon-lpp/index/') . $t['tahun'] . '/' . $bln; ?>" class="btn btn-sm btn-outline-success <?= $t['tahun'] == $thn ? 'active' : '' ?> ml-1 mt-1 mb-1"><?= $t['tahun']; ?></a>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <?php foreach ($bulan as $b) : ?>
                  <a href="<?= base_url('mon-lpp/index/') . $thn . '/' . $b['bulan']; ?>" class="btn btn-sm btn-outline-success <?= $b['bulan'] == $bln ? 'active' : '' ?> ml-1 mt-1 mb-1"><?= $b['bulan']; ?></a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm table-bordered table-hover">
                <thead>
                  <tr class="text-center">
                    <th class="pb-3">No</th>
                    <th class="pb-3">Kode</th>
                    <th class="pb-3">Nama</th>
                    <th>Saldo Awal</th>
                    <th class="pb-3">Droping</th>
                    <th>PPh Terutang</th>
                    <th>PPh Disetor</th>
                    <th class="pb-3">Pembayaran</th>
                    <th>Saldo Akhir</th>
                    <th class="pb-3">Berkas</th>
                    <th class="pb-3">Info Kirim</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $j1 = 0;
                  $j2 = 0;
                  $j3 = 0;
                  $j4 = 0;
                  $j5 = 0;
                  $j6 = 0;
                  ?>

                  <?php foreach ($lpp as $r) : ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="text-center"><?= $r['kdsatker']; ?></td>
                      <td><?= $r['nmsatker']; ?></td>
                      <td class="text-right"><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['droping'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['pph_terutang'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['pph_disetor'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['pembayaran'], 0, ',', '.'); ?></td>
                      <td class="text-right"><?= number_format($r['saldo_akhir'], 0, ',', '.'); ?></td>
                      <td>
                        <?php $this->db->select('a.file,b.nama'); ?>
                        <?php $this->db->from('data_upload a'); ?>
                        <?php $this->db->join('ref_dokumen b', 'a.dokumen_id=b.id', 'left'); ?>
                        <?php $this->db->where(['a.laporan_id' => $r['id'], 'a.jns' => 2]); ?>
                        <?php $upload = $this->db->get()->result_array(); ?>
                        <ul class="mb-0 pl-4">
                          <?php foreach ($upload as $u) : ?>
                            <li><a href="<?= base_url('assets/files/') . $u['file']; ?>" target="_blank"><?= $u['nama']; ?></a></li>
                          <?php endforeach; ?>
                        </ul>
                      </td>
                      <td>
                        <i><?= $r['date_created_lpp'] == null ? '' : date('d-m-Y H:i:s', $r['date_created_lpp']); ?></i>
                        <?php if ($r['date_created_lpp']) : ?>
                          <a href="<?= base_url('mon-lpp/delete/') . $thn . '/' . $bln . '/' . $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin akan mereset data ini?');" data-toggle="tooltip" data-placement="bottom" title="Reset"><i class="fa fa-trash"></i></a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php $j1 += $r['saldo_awal']; ?>
                    <?php $j2 += $r['droping']; ?>
                    <?php $j3 += $r['pph_terutang']; ?>
                    <?php $j4 += $r['pph_disetor']; ?>
                    <?php $j5 += $r['pembayaran']; ?>
                    <?php $j6 += $r['saldo_akhir']; ?>
                  <?php endforeach; ?>
                </tbody>
                <thead>
                  <tr>
                    <th colspan="3" class="text-center">Jumlah</th>
                    <th class="text-right"><?= number_format($j1, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j2, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j3, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j4, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j5, 0, ',', '.'); ?></th>
                    <th class="text-right"><?= number_format($j6, 0, ',', '.'); ?></th>
                    <th colspan="2" class="text-center"></th>
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