<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#permintaan" data-toggle="tab">Permintaan</a></li>
              <li class="nav-item"><a class="nav-link" href="#lpp" data-toggle="tab">LPP</a></li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="active tab-pane" id="permintaan">
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-around" id="myTab" role="tablist">
                  <?php foreach ($bulan as $b) : ?>
                    <li class="nav-item">
                      <a class="nav-link <?= $b['default'] == 1 ? 'active' : ''; ?>" id="<?= $b['kode']; ?>-tab" data-toggle="tab" href="#<?= $b['kode']; ?>" role="tab" aria-controls="<?= $b['kode']; ?>" aria-selected="false"><?= $b['kode']; ?></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <?php foreach ($bulan as $b) : ?>
                    <div class="tab-pane fade <?= $b['default'] == 1 ? 'show active' : ''; ?>" id="<?= $b['kode']; ?>" role="tabpanel" aria-labelledby="<?= $b['kode']; ?>-tab">
                      <div class="card-body">
                        <div class="row">
                          <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                              <thead>
                                <tr class="text-center">
                                  <th>No</th>
                                  <th>Kode</th>
                                  <th>Nama</th>
                                  <th>Saldo Awal</th>
                                  <th>Permintaan</th>
                                  <th>Pengeluaran</th>
                                  <th>Pegawai</th>
                                  <th>Berkas</th>
                                  <th>Info Kirim</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $bulan = $b['kode']; ?>
                                <?php $query1 = "SELECT * FROM landing_ref_eselon3 WHERE eselon2_id='$eselon2_id'"; ?>
                                <?php $satker = $this->db->query($query1)->result_array();
                                ?>
                                <?php $no = 1; ?> <?php $j1 = 0; ?>
                                <?php $j2 = 0; ?>
                                <?php $j3 = 0; ?>
                                <?php $j4 = 0; ?>

                                <?php foreach ($satker as $s) : ?>
                                  <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $s['kode']; ?></td>
                                    <td><?= $s['nama']; ?></td>
                                    <?php $kdsatker = $s['kode']; ?>
                                    <?php $query2 = "SELECT id,saldo_awal,permintaan,jumlah_pegawai,status_minta,date_created_minta FROM data_laporan WHERE kdsatker='$kdsatker' AND bulan='$bulan'"; ?>
                                    <?php $r = $this->db->query($query2)->row_array(); ?>
                                    <?php $pengeluaran = $r['saldo_awal'] + $r['permintaan'];
                                    ?>
                                    <td class="text-right"><?= number_format($r['saldo_awal'], 0, ',', '.'); ?></td>
                                    <td class="text-right"><?= number_format($r['permintaan'], 0, ',', '.'); ?></td>
                                    <td class="text-right"><?= number_format($pengeluaran, 0, ',', '.'); ?></td>
                                    <td class="text-right"><?= number_format($r['jumlah_pegawai'], 0, ',', '.'); ?></td>
                                    <td>
                                      <?php $this->db->select('a.file,b.nama'); ?>
                                      <?php $this->db->from('data_upload a'); ?>
                                      <?php $this->db->join('ref_dokumen b', 'a.dokumen_id=b.id', 'left'); ?>
                                      <?php $this->db->where(['a.laporan_id' => $r['id'], 'a.jns' => 1]); ?>
                                      <?php $upload = $this->db->get()->result_array(); ?>
                                      <ul class="mb-0 pl-4">
                                        <?php foreach ($upload as $u) : ?>
                                          <li><a href="<?= base_url('assets/files/') . $u['file']; ?>" target="_blank"><?= $u['nama']; ?></a></li>
                                        <?php endforeach; ?>
                                      </ul>
                                    </td>
                                    <?php if ($r['status_minta'] == null) : ?>
                                      <td></td>
                                    <?php else : ?>
                                      <td>
                                        <i><?= date('d-m-Y H:i:s', $r['date_created_minta']); ?></i>
                                        <a href="<?= base_url('monitoring-satker/delete/') . $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin akan mereset data ini?');" data-toggle="tooltip" data-placement="bottom" title="Reset"><i class="fa fa-trash"></i></a>
                                      </td>
                                    <?php endif; ?>
                                  </tr>
                                  <?php $j1 += $r['saldo_awal']; ?>
                                  <?php $j2 += $r['permintaan']; ?>
                                  <?php $j3 += $pengeluaran; ?>
                                  <?php $j4 += $r['jumlah_pegawai']; ?>
                                <?php endforeach; ?>
                              </tbody>
                              <thead>
                                <tr>
                                  <th colspan="3" class="text-center">Jumlah</th>
                                  <th class="text-right"><?= number_format($j1, 0, ',', '.'); ?></th>
                                  <th class="text-right"><?= number_format($j2, 0, ',', '.'); ?></th>
                                  <th class="text-right"><?= number_format($j3, 0, ',', '.'); ?></th>
                                  <th class="text-right"><?= number_format($j4, 0, ',', '.'); ?></th>
                                  <th colspan="2" class="text-center"></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="lpp">
              <div class="card-body">
                <ul class="nav nav-tabs justify-content-around" id="Tab" role="tablist">
                  <?php foreach ($bln as $b) : ?>
                    <li class="nav-item">
                      <a class="nav-link <?= $b['default'] == 1 ? 'active' : ''; ?>" id="<?= $b['kode']; ?>-tab" data-toggle="tab" href="#l<?= $b['kode']; ?>" role="tab" aria-controls="<?= $b['kode']; ?>" aria-selected="false"><?= $b['kode']; ?></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <div class="tab-content" id="TabContent">
                  <?php foreach ($bln as $b) : ?>
                    <div class="tab-pane fade <?= $b['default'] == 1 ? 'show active' : ''; ?>" id="l<?= $b['kode']; ?>" role="tabpanel" aria-labelledby="<?= $b['kode']; ?>-tab">
                      <div class="card-body">
                        <div class="row">
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
                                <?php $bulan = $b['kode']; ?>
                                <?php $query1 = "SELECT * FROM landing_ref_eselon3 WHERE eselon2_id='$eselon2_id'"; ?>
                                <?php $satker = $this->db->query($query1)->result_array();
                                ?>
                                <?php
                                $no = 1;
                                $j1 = 0;
                                $j2 = 0;
                                $j3 = 0;
                                $j4 = 0;
                                $j5 = 0;
                                $j6 = 0;
                                ?>

                                <?php foreach ($satker as $s) : ?>
                                  <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $s['kode']; ?></td>
                                    <td><?= $s['nama']; ?></td>
                                    <?php $kdsatker = $s['kode']; ?>
                                    <?php $query2 = "SELECT id,saldo_awal,droping,pph_terutang,pph_disetor,pembayaran,saldo_akhir,status_lpp,date_created_lpp FROM data_laporan WHERE kdsatker='$kdsatker' AND bulan='$bulan'"; ?>
                                    <?php $r = $this->db->query($query2)->row_array(); ?>
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
                                    <?php if ($r['status_lpp'] == null) : ?>
                                      <td></td>
                                    <?php else : ?>
                                      <td>
                                        <i><?= date('d-m-Y H:i:s', $r['date_created_lpp']); ?></i>
                                        <a href="<?= base_url('monitoring-satker/delete-lpp/') . $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin akan mereset data ini?');" data-toggle="tooltip" data-placement="bottom" title="Reset"><i class="fa fa-trash"></i></a>
                                      </td>
                                    <?php endif; ?>
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
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>