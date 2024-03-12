@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>Input Adjustment Stock Lebih</strong> 
                </div>
                <div class="card-body">
                    <form method="post" name="Form" onsubmit="return validateForm()" action="{{ route('logistik.store_adjustment') }}">
 
                        {{ csrf_field() }}
                      
                        <div class="form-group">

                            <div class="section colm colm20">
                                
                                    <label>Nama Barang</label>
                                    <select class="form-control" name="nama_barang" id="nama_barang">
          
                                    </select>
                                        @if($errors->has('kode_supplier'))
                                            <div class="text-danger">
                                                {{ $errors->first('kode_supplier')}}
                                            </div>
                                        @endif
            
                                
                            </div>
                            <br>
                            <div class="section colm colm20">
                                
                                <label>Stock Adjusment</label>

                                <input type= text class="form-control" name="jumlah_stock" id="jumlah_stock" style="width:200px;" placeholder="masukan quantity ...">
      
                                    @if($errors->has('kode_supplier'))
                                        <div class="text-danger">
                                            {{ $errors->first('kode_supplier')}}
                                        </div>
                                    @endif
                        </div>
 
                        <label></label>

                        
                        

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" onsubmit="return validateForm()" value="Simpan">
                        </div>
 
                    
                    </form>
 
                </div>
            </div>
        </div>
@endsection

@section('plugin_js')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
//select 2 untuk akun debit
$('#nama_barang').select2({
    placeholder: '- Cari Barang -',
    ajax: {
     
      url:  '{{url('/getKodeBarang')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (barang) {
            $nama = barang.nama_barang;
	    $ukuran = barang.ukuran;
            return {
              id: barang.kode_barang,
              text: barang.kode_barang +" / "+ barang.nama_barang +" / "+ barang.ukuran +" / "+ barang.spesifikasi_barang
            
            }
          })
        };
      },
      cache: true
    }
  });

 

</script>

@endsection
