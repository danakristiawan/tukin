<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <?= form_open(); ?>
          <div class="card-header">

          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="">Menu :</label>
              <select name="menu_id" class="form-control">
                <?php foreach ($menu as $m) : ?>
                  <option value="<?= $m['id']; ?>"><?= $m['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="card-footer">
            <input type="hidden" name="role_id" value="<?= $role_id; ?>">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>