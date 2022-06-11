$( function () {

  $( '#btnTambah' ).click( function () {
    $( '#pegawailuarModalLabel' ).html( 'Tambah Data' );
    $( '#btnSimpan' ).html( 'Tambah' );
    $( '#btnSimpan' ).attr( 'class', 'btn btn-primary' );
    $( '#pegluarForm' ).attr( 'action', 'http://10.10.1.74/pembayaran/pegluar/tambah' );
    $( '#nama' ).val( '' );
    $( '#jabatan' ).val( '' );
    $( '#unit' ).val( '' );
    $( '#nip' ).val( '' );
    $( '#golongan' ).val( '' );
    $( '#npwp' ).val( '' );
    $( '#nama_bank' ).val( '' );
    $( '#nama_rek' ).val( '' );
    $( '#nomor_rek' ).val( '' );
    $( '#id' ).val( '' );
    $( '#nama' ).removeAttr( 'readonly' );
    $( '#jabatan' ).removeAttr( 'readonly' );
    $( '#unit' ).removeAttr( 'readonly' );
    $( '#nip' ).removeAttr( 'readonly' );
    $( '#golongan' ).removeAttr( 'readonly' );
    $( '#npwp' ).removeAttr( 'readonly' );
    $( '#nama_bank' ).removeAttr( 'readonly' );
    $( '#nama_rek' ).removeAttr( 'readonly' );
    $( '#nomor_rek' ).removeAttr( 'readonly' );
  } );

  $( '.btnUbah' ).click( function () {
    $( '#pegawailuarModalLabel' ).html( 'Ubah Data' );
    $( '#btnSimpan' ).html( 'Ubah' );
    $( '#btnSimpan' ).attr( 'class', 'btn btn-success' );
    $( '#pegluarForm' ).attr( 'action', 'http://10.10.1.74/pembayaran/pegluar/ubah' );
    $( '#nama' ).removeAttr( 'readonly' );
    $( '#jabatan' ).removeAttr( 'readonly' );
    $( '#unit' ).removeAttr( 'readonly' );
    $( '#nip' ).removeAttr( 'readonly' );
    $( '#golongan' ).removeAttr( 'readonly' );
    $( '#npwp' ).removeAttr( 'readonly' );
    $( '#nama_bank' ).removeAttr( 'readonly' );
    $( '#nama_rek' ).removeAttr( 'readonly' );
    $( '#nomor_rek' ).removeAttr( 'readonly' );
    let id = $( this ).data( 'id' );
    $.ajax( {
      url: 'http://10.10.1.74/pembayaran/pegluar/getubah',
      data: {
        id: id
      },
      method: 'post',
      dataType: 'json',
      success: function ( data ) {
        $( '#nama' ).val( data.nama );
        $( '#jabatan' ).val( data.jabatan );
        $( '#unit' ).val( data.unit );
        $( '#nip' ).val( data.nip );
        $( '#golongan' ).val( data.golongan );
        $( '#npwp' ).val( data.npwp );
        $( '#nama_bank' ).val( data.nama_bank );
        $( '#nama_rek' ).val( data.nama_rek );
        $( '#nomor_rek' ).val( data.nomor_rek );
        $( '#id' ).val( data.id );
      }
    } );
  } );


  $( '.btnHapus' ).click( function () {
    $( '#pegawailuarModalLabel' ).html( 'Hapus Data' );
    $( '#btnSimpan' ).html( 'Hapus' );
    $( '#btnSimpan' ).attr( 'class', 'btn btn-danger' );
    $( '#pegluarForm' ).attr( 'action', 'http://10.10.1.74/pembayaran/pegluar/hapus' );
    $( '#nama' ).attr( 'readonly', 'readonly' );
    $( '#jabatan' ).attr( 'readonly', 'readonly' );
    $( '#unit' ).attr( 'readonly', 'readonly' );
    $( '#nip' ).attr( 'readonly', 'readonly' );
    $( '#golongan' ).attr( 'readonly', 'readonly' );
    $( '#npwp' ).attr( 'readonly', 'readonly' );
    $( '#nama_bank' ).attr( 'readonly', 'readonly' );
    $( '#nama_rek' ).attr( 'readonly', 'readonly' );
    $( '#nomor_rek' ).attr( 'readonly', 'readonly' );
    let id = $( this ).data( 'id' );
    $.ajax( {
      url: 'http://10.10.1.74/pembayaran/pegluar/getubah',
      data: {
        id: id
      },
      method: 'post',
      dataType: 'json',
      success: function ( data ) {
        $( '#nama' ).val( data.nama );
        $( '#jabatan' ).val( data.jabatan );
        $( '#unit' ).val( data.unit );
        $( '#nip' ).val( data.nip );
        $( '#golongan' ).val( data.golongan );
        $( '#npwp' ).val( data.npwp );
        $( '#nama_bank' ).val( data.nama_bank );
        $( '#nama_rek' ).val( data.nama_rek );
        $( '#nomor_rek' ).val( data.nomor_rek );
        $( '#id' ).val( data.id );
      }
    } );
  } );

} );