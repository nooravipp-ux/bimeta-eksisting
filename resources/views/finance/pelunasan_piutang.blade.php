@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>Pelunasan Piutang</strong> 
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('finance.storejurnalpiutang') }}">
 
                        {{ csrf_field() }}
                      
                        <div class="form-group">

                            <div class="section colm colm20">
                                
                                    <label>Nomor Pembayaran</label>
                                    <select class="form-control" name="akun_kredit" id="akun_kredit" required>
          
                                    </select>
                                        @if($errors->has('akun_kredit'))
                                            <div class="text-danger">
                                                {{ $errors->first('akun_kredit')}}
                                            </div>
                                        @endif
            
                                
                            </div>
                            <div class="section colm colm20">
                                
                                <label>Akun Debit</label>
                                <select class="form-control" name="akun_debit" id="akun_debit" required>
      
                                </select>
                                    @if($errors->has('akun_debit'))
                                        <div class="text-danger">
                                            {{ $errors->first('akun_debit')}}
                                        </div>
                                    @endif
                        </div>

			<div class="form-group">
                            <label>Tanggal </label>
                            <input class="form-control" type="date" name="tanggal_jurnal" id="tanggal_jurnal" style="min-width: 200px;max-width: 600px;" required>
                                @if($errors->has('tanggal_jurnal'))
                                    <div class="text-danger">
                                        {{ $errors->first('tanggal_jurnal')}}
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                            <label>Nominal </label>
                            <input class="form-control" name="nominal_jurnal" id="nominal_jurnal" style="min-width: 200px;max-width: 400px;" required>
                                @if($errors->has('nominal_jurnal'))
                                    <div class="text-danger">
                                        {{ $errors->first('nominal_jurnal')}}
                                    </div>
                                @endif
                        </div>
                      

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
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
$('#akun_debit').select2({
    placeholder: '- Cari Akun -',
    ajax: {
      url:  '{{url('/finance/get_coa_number')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (coa) {
            $nama = coa.DESKRIPSI_COA;
            return {
              id: coa.NO_COA,
              text: coa.NO_COA +" / "+$nama
            
            }
          })
        };
      },
      cache: true
    }
  });

 $('#akun_kredit').select2({
    placeholder: '- Cari Akun -',
    ajax: {
      url:  '{{url('/finance/getnoso')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (sales_order) {
            $nama = sales_order.id_so;
            return {
              id: sales_order.id_so,
              text: sales_order.id_so        
            }
          })
        };
      },
      cache: true
    }
  }); 

</script>

@endsection
