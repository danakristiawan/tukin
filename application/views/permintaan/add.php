<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <form action="" method="post" autocomplete="off">
            <div class="card-header">

            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="">Jumlah Pegawai :</label>
                <input type="text" name="jumlah_pegawai" class="form-control <?= form_error('jumlah_pegawai') ? 'is-invalid' : '' ?>" value="<?= set_value('jumlah_pegawai'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('jumlah_pegawai') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Saldo Awal :</label>
                <input type="text" name="saldo_awal" class="form-control <?= form_error('saldo_awal') ? 'is-invalid' : '' ?>" value="<?= set_value('saldo_awal'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('saldo_awal') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Permintaan :</label>
                <input type="text" name="permintaan" class="form-control <?= form_error('permintaan') ? 'is-invalid' : '' ?>" value="<?= set_value('permintaan'); ?>">
                <div class="invalid-feedback">
                  <?= form_error('permintaan') ?>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-success float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <a href="<?= base_url('permintaan'); ?>" class="btn btn-sm btn-warning float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>