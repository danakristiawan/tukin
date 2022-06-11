<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <?= form_open(); ?>
          <div class="card-header">

          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="">NIP :</label>
              <input type="text" name="nip" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" value="<?= $user['nip']; ?>" readonly>
              <div class="invalid-feedback">
                <?= form_error('nip') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="">Nama :</label>
              <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" value="<?= $user['nama']; ?>" readonly>
              <div class="invalid-feedback">
                <?= form_error('nama') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="">Role :</label>
              <select name="role_id" class="form-control">
                <?php foreach ($role as $r) : ?>
                  <option value="<?= $r['id']; ?>" <?= $r['id'] == $user['role_id'] ? 'selected' : ''; ?>><?= $r['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Satker :</label>
              <select name="satker_id" class="form-control">
                <?php foreach ($satker as $s) : ?>
                  <option value="<?= $s['id']; ?>" <?= $s['id'] == $user['satker_id'] ? 'selected' : ''; ?>><?= $s['nama']; ?></option>
                <?php endforeach; ?>
              </select>
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