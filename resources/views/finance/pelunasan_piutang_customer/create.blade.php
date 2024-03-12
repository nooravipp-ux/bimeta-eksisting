@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <strong>Pelunasan Piutang Customer</strong>
            </div>
            <div class="card-body">
                <form method="POST" onsubmit="return validateForm()" action="{{ route('finance.storejurnalpiutang') }}">

                    {{ csrf_field() }}

                    <div class="row">


                        <div class="col-md-1">

                            <label>No Faktur</label>
                        </div>
                        <div class="col-md-3">
                            <input type ="text" class="form-control" name="no_po" id="nomor_po" required>
                        </div>
                        <div class="col-md-1">
                            <input type="button" value="Load" onclick='load_data_piutang()'>


                        </div>
                        <div class="col-md-1">
                            <label>Total </label>
                        </div>
                        <div class="col-md-2">
                            <input type ="text" class="form-control" name="total_hutang" id="total_hutang" required>
                        </div>
                        <div class="col-md-2">
                            <label>Sisa Piutang</label>
                        </div>
                        <div class="col-md-2">
                            <input type ="text" class="form-control" name="sisa_hutang" id="sisa_hutang" required>
                        </div>


                    </div>
                    <div class="section colm colm20">

                        <label>Masuk Ke Akun Kas :</label>
                        <select class="form-control" name="akun_debit" id="akun_debit" required>

                        </select>
                        @if($errors->has('akun_debit'))
                            <div class="text-danger">
                                {{ $errors->first('akun_debit')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Deskripsi </label>
                        <input class="form-control" name="keterangan_pembayaran" id="keterangan_pembayaran" style="min-width: 200px;max-width: 600px;" required>
                        @if($errors->has('deskripsi_jurnal'))
                            <div class="text-danger">
                                {{ $errors->first('deskripsi_jurnal')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Tanggal </label>
                        <input class="form-control" type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" style="min-width: 200px;max-width: 600px;" required>
                        @if($errors->has('tanggal_jurnal'))
                            <div class="text-danger">
                                {{ $errors->first('tanggal_jurnal')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Nominal </label>
                        <input class="form-control" name="nominal_pembayaran" id="nominal_pembayaran" style="min-width: 200px;max-width: 400px;" required>
                        @if($errors->has('nominal_jurnal'))
                            <div class="text-danger">
                                {{ $errors->first('nominal_jurnal')}}
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Posting">
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

        function load_data_piutang(){

            var nim = $("#nomor_po").val();

            $.ajax({
                type: "GET",
                url: '{{url('/finance/get_sisa_piutang_customer')}}',
                dataType: 'json',
                data:{'q':nim},
            }).success(function (data) {
                var sisa_hutang_supplier = data[0].sisa_piutang;
                var total_hutang_supplier = data[0].total_piutang;

                if ( sisa_hutang_supplier > 0) {
                    document.getElementById('total_hutang').value = data[0].total_piutang;
                    document.getElementById('sisa_hutang').value = data[0].sisa_piutang;
                    document.getElementById('sisa_hutang').readOnly = true;
                    document.getElementById('total_hutang').readOnly = true;
                } else
                {
                    document.getElementById('total_hutang').value = total_hutang_supplier;
                    document.getElementById('sisa_hutang').value = 0;
                    document.getElementById('sisa_hutang').readOnly = true;
                    document.getElementById('total_hutang').readOnly = true;
                    alert('Hutang Sudah Lunas');
                }

            });

        }

        function validateForm() {

            var sisa_hutang_supplier = parseFloat(document.getElementById('sisa_hutang').value);
            var nominal_pembayaran = parseFloat(document.getElementById('nominal_pembayaran').value);
            var total = sisa_hutang_supplier + nominal_pembayaran;

            if (sisa_hutang_supplier < nominal_pembayaran) {

                alert("pembayaran meelebihi nominal hutang");
                return false;
            }


        }



        $('#akun_kredit').select2({
            placeholder: '- Cari Akun -',
            ajax: {
                url:  '{{url('/finance/getnopo')}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (pengadaan) {
                            $nama = pengadaan.id_pengadaan;
                            return {
                                id: pengadaan.id_pengadaan,
                                text: pengadaan.id_pengadaan
                            }
                        })
                    };
                },
                cache: true
            }
        });

    </script>

@endsection

