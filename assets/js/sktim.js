$(function () {

  $('#btnTambah').click(function () {
    $('#sktimModalLabel').html('Tambah Data');
    $('#btnSimpan').html('Tambah');
    $('#btnSimpan').attr('class', 'btn btn-primary');
    $('#sktimForm').attr('action', 'http://10.10.1.74/pembayaran/sktim/tambah');
    $('#kode').val('');
    $('#nomor').val('');
    $('#tanggal').val('');
    $('#uraian').val('');
    $('#id').val('');
    $('#kode').removeAttr('readonly');
    $('#nomor').removeAttr('readonly');
    $('#tanggal').removeAttr('readonly');
    $('#uraian').removeAttr('readonly');
  });

  $('.btnUbah').click(function () {
    $('#sktimModalLabel').html('Ubah Data');
    $('#btnSimpan').html('Ubah');
    $('#btnSimpan').attr('class', 'btn btn-success');
    $('#sktimForm').attr('action', 'http://10.10.1.74/pembayaran/sktim/ubah');
    $('#kode').removeAttr('readonly');
    $('#nomor').removeAttr('readonly');
    $('#tanggal').removeAttr('readonly');
    $('#uraian').removeAttr('readonly');
    let id = $(this).data('id');
    $.ajax({
      url: 'http://10.10.1.74/pembayaran/sktim/getubah',
      data: {
        id: id
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        $('#kode').val(data.kode);
        $('#nomor').val(data.nomor);
        $('#tanggal').val(data.tanggal);
        $('#uraian').val(data.uraian);
        $('#id').val(data.id);
      }
    });
  });

  $('.btnHapus').click(function () {
    $('#sktimModalLabel').html('Hapus Data');
    $('#btnSimpan').html('Hapus');
    $('#btnSimpan').attr('class', 'btn btn-danger');
    $('#sktimForm').attr('action', 'http://10.10.1.74/pembayaran/sktim/hapus');
    $('#kode').attr('readonly', 'readonly');
    $('#nomor').attr('readonly', 'readonly');
    $('#tanggal').attr('readonly', 'readonly');
    $('#uraian').attr('readonly', 'readonly');
    let id = $(this).data('id');
    $.ajax({
      url: 'http://10.10.1.74/pembayaran/sktim/getubah',
      data: {
        id: id
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        $('#kode').val(data.kode);
        $('#nomor').val(data.uraian);
        $('#tanggal').val(data.nip);
        $('#uraian').val(data.nama);
        $('#id').val(data.id);
      }
    });
  });




});
