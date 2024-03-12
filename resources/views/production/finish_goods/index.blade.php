@extends('adminlte::page')
@section('adminlte_css')
<style>
    .detail-fg{
        border: 1px solid #f5f5ef;
    }
    .header-fg{
        border: 1px solid #f5f5ef;
    }
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
                <h4>Finish Goods</h4>
            </div>
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-5">
                        <form action="{{ route('input.fg')}}" method="get">
                            <div class="form-group row">
                                <div class="col-sm">
                                    <select class="png form-control" id="no_spk" name="no_spk" required></select>
                                </div>  
                                <button type="submit" class="col-sm-5 col-form-label btn btn-primary btn-sm">Input Finish Goods</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
			<div class="col-md-12 text-center">
                        @if(session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
			</div>
                </div>
                <table id="data_FG" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>NO FINISH GOODS</th>
                            <th>TGL FG</th>
                            <th>NO SPK</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_fg as $fg)
                        <tr>
                            <td>{{$fg->id_finished_good}}</td>
                            <td>{{$fg->tgl_finish_good}}</td>
                            <td>{{$fg->no_spk}}</td>
                            <td>
                                <a href="{{route('finish-goods.show', $fg->id_finished_good)}}" class="btn btn-secondary btn-sm">Detail FG</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <!-- /.invoice -->
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </section>

@endsection

@section('plugin_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#data_FG').DataTable({
            "order": [[0, 'desc' ]],
        });

        $('#no_spk').select2({
            placeholder: '- Pilih Kode SPK -',
            ajax: {
            url: '{{url('/production/get-spk-pemakaian')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (spk) {
                    return {
                    id: spk.no_spk,
                    text: spk.no_spk
                    
                    }
                })
                };
            },
            cache: true
            }
        });

    </script>

@endsection



