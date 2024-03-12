@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                <strong>CLOSING LAPORAN KEUANGAN</strong>
            </div>
            <div class="card-body">
                <form method="get" name="Form" onsubmit="return validateForm()" action="{{ route('finance.posting_finance') }}">

                    <h1 style="text-align: center;"><span style="color: #ff0000;"><em>PENTING!!!!!</em></span></h1>
                    <h3 style="text-align: center;"><strong><span style="color: #ff0000;">SEBELUM KLIK TOMBOL POSTING HARAP SELESAIKAN TRANSAKSI YANG BELUM TERSELESAIKAN SAMPAI TIDAK ADA TRANSAKSI YANG TERTINGGAL!!!!</span></strong></h3>
                    <p style="text-align: center;"><strong><span style="color: #ff0000;">PADA SAAT ANDA KLIK POSTING DATA TIDAK BISA KEMBALI!!!!</span></strong></p>
                    <p style="text-align: center;"><strong><span style="color: #ff0000;">PERGUNAKANLAH DENGAN BIJAK</span></strong></p>
                        <div class="form-group">
                            <center><input type="submit" class="btn btn-success" value="POSTING!!!"></center>
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
