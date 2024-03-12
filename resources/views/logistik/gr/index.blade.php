
@extends('adminlte::page')
@section('adminlte_css')
<style>
    .png {
	width:330px;
    }

</style>
@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Goods Receipt  
                    <div class="msg"></div>
                </h4>
            </div>
      
            <!-- Form Input GR  -->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-7">
                        <form action="{{ route('logistik.create-gr') }}" method="get">
    
                            <div class="form-group row">
                                <div class="col-sm">
                                    <select class="png form-control" id="id_pengadaan" name="id_pengadaan" required></select>
                                </div>  
                                <button type="submit" class="col-sm-5 col-form-label btn btn-primary btn-sm">Buat GR</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm">
                    
                    </div>
                </div>
                <table id="data_pengadaan" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID GR</th>
                        <th>TGL GR</th>
                        <th>KD PEMBELIAN</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_gr as $gr)
                    <tr>
                        <td>{{ $gr->id_gr}}</td>
                        <td>{{ $gr->tgl_gr}}</td>
                        <td>{{ $gr->id_pengadaan}}</td>
                        <td>{{ $gr->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#data_pengadaan').DataTable();
        $('#id_pengadaan').select2({
            placeholder: '- Pilih Kode Pembelian -',
            ajax: {
            url: '{{url('/logistik/get-id-pengadaan')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (id) {
                    return {
                    id: id.id_pengadaan,
                    text: id.id_pengadaan
                    
                    }
                })
                };
            },
            cache: true
            }
        });
    </script>


@endsection

