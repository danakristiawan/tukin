<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <?= form_open(); ?>
          <div class="card-header">

          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="">Menu :</label>
              <input type="text" name="name" class="form-control <?= form_error('name') ? 'is-invalid' : '' ?>" value="<?= set_value('name'); ?>">
              <div class="invalid-feedback">
                <?= form_error('name') ?>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>