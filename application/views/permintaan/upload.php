<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
          <?= form_open_multipart(); ?>
          <div class="card-header">
            <h4>Upload Dokumen</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="">File :</label>
              <div class="custom-file">
                <input type="file" class="form-control custom" name="file">
              </div>
              <span><small class="text-muted">file dengan format .pdf, ukuran maksimal 5 Mb</small></span>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-success float-right ml-1"><i class="fa fa-save"></i> Simpan</button>
            <a href="<?= base_url('permintaan/kirim/') . $laporan_id; ?>" class="btn btn-sm btn-warning float-right"><i class="fa fa-undo"></i> Batal</a>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>