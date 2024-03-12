
@extends('adminlte::page')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h4>
                            Data Laporan Jurnal Harian
                            <small class="float-right"></small>
                        </h4>
                    </div>

                    <!-- Form GR-->
                    <div class=""
                    <div class="">
                        <tr>
                            <td><input type="button" value="Load" onclick='load_data_hutang()'></td>
                            <td>Kode Akun</td>
                            <td><input type="text" id="no_coa" name="no_coa"'></td>
                            <td>Tanggal Dari</td>
                            <td><input type="date"  id="dari" name="dari"'></td>
                            <td>Tanggal Sampai</td>
                            <td><input type="date" id="sampai" name="sampai"'></td>
                        </tr>
                        <tr></tr>
                    </div>
                    </form>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Kode Akun</th>
                    <th>Deksripsi Akun</th>
                    <th>Tanggal Transaksi</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Saldo Awal</th>
                    <th>Saldo Akhir</th>

                </tr>
                </thead>
                <tbody id="data-update">

                </tbody>

            </table>
        </div>
        @endsection

        @section('plugin_js')
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
            <script type="text/javascript">

                function load_data_hutang(){

                    var nim = $("#no_coa").val();
                    var dari = $("#dari").val();
                    var sampai = $("#sampai").val();

                    $.ajax({
                        method: "GET",
                        url: '{{url('/finance/get_data_jurnal_laporan')}}',
                        dataType: 'json',
                        data:{'no_coa':nim,'dari':dari,'sampai':sampai},
                    }).success(function (data) {

                        $('#data-update').html(data.table_data);
                        $('#total_records').text(data.total_data);

                    });

                }


                $('#cari').click(function(){
                    $.ajax({
                        type: 'get',
                        url: "{{ route('finance.daftar_hutang_pembayaran_supplier') }}",

                        data:{'q':nim},

                        dataType: 'json',
                        success: function (result) {
                            $("#statusText").html("Google Status: Working");
                        },
                        error: function (result) {
                            $("#statusText").html("Google Status: Failed");
                        }
                    });
                });









            </script>
@endsection


