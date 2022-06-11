<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition lockscreen">

  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="error-page">
          <h2 class="headline text-danger">400</h2>
          <div class="error-content">
            <h3><i class="fa fa-warning text-danger"></i> Oops! Halaman tidak ditemukan.</h3>
            <p>
              Kami tidak bisa menemukan halaman yang Anda cari.
              User Anda belum terdaftar di modul ini. Hubungi administrator untuk mendapatkan bantuan.
              atau <a href="<?= base_url(); ?>../internal">kembali ke halaman internal</a>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>