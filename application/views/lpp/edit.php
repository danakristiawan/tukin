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
                <label for="">Droping :</label>
                <input type="text" name="droping" class="form-control <?= form_error('droping') ? 'is-invalid' : '' ?>" value="<?= $laporan['permintaan']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('droping') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">PPh Terutang :</label>
                <input type="text" name="pph_terutang" class="form-control <?= form_error('pph_terutang') ? 'is-invalid' : '' ?>" value="<?= $laporan['pph_terutang']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('pph_terutang') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">PPh Disetor :</label>
                <input type="text" name="pph_disetor" class="form-control <?= form_error('pph_disetor') ? 'is-invalid' : '' ?>" value="<?= $laporan['pph_disetor']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('pph_disetor') ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Pembayaran :</label>
                <input type="text" name="pembayaran" class="form-control <?= form_error('pembayaran') ? 'is-invalid' : '' ?>" value="<?= $laporan['pembayaran']; ?>">
                <div class="invalid-feedback">
                  <?= form_error('pembayaran') ?>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-success float-right ml-2"><i class="fa fa-save"></i> Simpan</button>
              <a href="<?= base_url('lpp'); ?>" class="btn btn-sm btn-warning float-right"><i class="fa fa-undo"></i> Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>