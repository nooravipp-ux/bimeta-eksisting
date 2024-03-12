@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>Input Jurnal Harian</strong> 
                </div>
                <div class="card-body">
                    <form method="post" name="Form" onsubmit="return validateForm()" action="{{ route('finance.simpan_pengeluaran_kas') }}">
 
                        {{ csrf_field() }}
                      
                        <div class="form-group">
                            <div class="section colm colm20">
                                <label>Tanggal Transaksi</label>
                            </div>
                            <div class="section colm colm20">
                                <input type="date" id="tanggal" name="tanggal">
                            </div>
                            <div class="section colm colm20">

                                    <label>Akun Kredit</label>
                                    <select class="form-control" name="akun_kredit" id="akun_kredit">
          
                                    </select>
                                        @if($errors->has('kode_supplier'))
                                            <div class="text-danger">
                                                {{ $errors->first('kode_supplier')}}
                                            </div>
                                        @endif
            
                                
                            </div>
                            <div class="section colm colm20">
                                
                                <label>Akun Debit</label>
                                <select class="form-control" name="akun_debit" id="akun_debit">
      
                                </select>
                                    @if($errors->has('kode_supplier'))
                                        <div class="text-danger">
                                            {{ $errors->first('kode_supplier')}}
                                        </div>
                                    @endif
                        </div>

                        <div class="form-group">
                            <label>Deskripsi </label>
                            <input class="form-control" name="deskripsi_jurnal" id="deskripsi_jurnal" style="min-width: 200px;max-width: 600px;">
                                @if($errors->has('status'))
                                    <div class="text-danger">
                                        {{ $errors->first('status')}}
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                            <label>Nominal </label>
                            <input class="form-control" name="nominal_jurnal" id="nominal_jurnal" style="min-width: 200px;max-width: 400px;">
                                @if($errors->has('status'))
                                    <div class="text-danger">
                                        {{ $errors->first('status')}}
                                    </div>
                                @endif
                        </div>
                      

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
$('#akun_debit').select2({
    placeholder: '- Cari Akun -',
    ajax: {
      type: "POST", 
     data: function (params) {
    return {
      searchTerm: params.term // search term
    };
   },
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url:  '{{url('/finance/get_coa_number')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (coa) {
            $nama = coa.kode_akun;
            return {
              id: coa.NO_COA,
              text: coa.NO_COA +" / "+coa.DESKRIPSI_COA
            
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
      type: "POST", 
     data: function (params) {
    return {
      searchTerm: params.term // search term
    };
   },
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url:  '{{url('/finance/get_coa_number')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (coa) {
            $nama = coa.kode_akun;
            return {
              id: coa.NO_COA,
              text: coa.NO_COA +" / "+coa.DESKRIPSI_COA
            
            }
          })
        };
      },
      cache: true
    }
  }); 

</script>

@endsection
