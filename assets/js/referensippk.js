$( function () {

  $( '#btnTambah' ).click( function () {
    $( '#refppkModalLabel' ).html( 'Tambah Data' );
    $( '#btnSimpan' ).html( 'Tambah' );
    $( '#btnSimpan' ).attr( 'class', 'btn btn-primary' );
    $( '#modalForm' ).attr( 'action', 'http://10.10.1.74/pembayaran/refppk/tambah' );
    $( '#kode' ).val( '' );
    $( '#uraian' ).val( '' );
    $( '#nip' ).val( '' );
    $( '#nama' ).val( '' );
    $( '#gol' ).val( '' );
    $( '#id' ).val( '' );
    $( '#kode' ).removeAttr( 'readonly' );
    $( '#uraian' ).removeAttr( 'readonly' );
    $( '#nip' ).removeAttr( 'readonly' );
    $( '#nama' ).removeAttr( 'readonly' );
    $( '#gol' ).removeAttr( 'readonly' );
  } );

  $( '.btnUbah' ).click( function () {
    $( '#refppkModalLabel' ).html( 'Ubah Data' );
    $( '#btnSimpan' ).html( 'Ubah' );
    $( '#btnSimpan' ).attr( 'class', 'btn btn-success' );
    $( '#modalForm' ).attr( 'action', 'http://10.10.1.74/pembayaran/refppk/ubah' );
    $( '#kode' ).removeAttr( 'readonly' );
    $( '#uraian' ).removeAttr( 'readonly' );
    $( '#nip' ).removeAttr( 'readonly' );
    $( '#nama' ).removeAttr( 'readonly' );
    $( '#gol' ).removeAttr( 'readonly' );
    let id = $( this ).data( 'id' );
    $.ajax( {
      url: 'http://10.10.1.74/pembayaran/refppk/getubah',
      data: {
        id: id
      },
      method: 'post',
      dataType: 'json',
      success: function ( data ) {
        $( '#kode' ).val( data.kode );
        $( '#uraian' ).val( data.uraian );
        $( '#nip' ).val( data.nip );
        $( '#nama' ).val( data.nama );
        $( '#gol' ).val( data.gol );
        $( '#id' ).val( data.id );
      }
    } );
  } );

  $( '.btnHapus' ).click( function () {
    $( '#refppkModalLabel' ).html( 'Hapus Data' );
    $( '#btnSimpan' ).html( 'Hapus' );
    $( '#btnSimpan' ).attr( 'class', 'btn btn-danger' );
    $( '#modalForm' ).attr( 'action', 'http://10.10.1.74/pembayaran/refppk/hapus' );
    $( '#kode' ).attr( 'readonly', 'readonly' );
    $( '#uraian' ).attr( 'readonly', 'readonly' );
    $( '#nip' ).attr( 'readonly', 'readonly' );
    $( '#nama' ).attr( 'readonly', 'readonly' );
    $( '#gol' ).attr( 'readonly', 'readonly' );
    let id = $( this ).data( 'id' );
    $.ajax( {
      url: 'http://10.10.1.74/pembayaran/refppk/getubah',
      data: {
        id: id
      },
      method: 'post',
      dataType: 'json',
      success: function ( data ) {
        $( '#kode' ).val( data.kode );
        $( '#uraian' ).val( data.uraian );
        $( '#nip' ).val( data.nip );
        $( '#nama' ).val( data.nama );
        $( '#gol' ).val( data.gol );
        $( '#id' ).val( data.id );
      }
    } );
  } );



} );