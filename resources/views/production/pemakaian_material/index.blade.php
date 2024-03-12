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
                <h4>Pemakaian Material</h4>
            </div>
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-7">
      			<a href="{{url('/production/pemakaian-material/create')}}" class="col-sm-5 col-form-label btn btn-primary btn-sm">Input Pemakaian Material</a>
                    </div>
                    <div class="col-sm">
                    
                    </div>
                </div>
                <table id="data_SO" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>NO PEMAKAIAN</th>
                            <th>TGL PEMAKAIAN</th>
                            <th>IN CHARGE</th>
                            <th>TOTAL PEMAKAIAN BARANG</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_pemakaian as $dt)
                        <tr>
                            <td>{{date("Y/m/d", strtotime($dt->tgl_pemakaian))}}</td>
                            <td>{{$dt->id_pemakaian_material}}</td>
                            <td>{{$dt->in_charge}}</td>
                            <td>{{$dt->total_pemakaian_material}}</td>
                            <td>
				<a href="{{route('material.report', $dt->id_pemakaian_material)}}" class="btn btn-secondary btn-sm">Report</a> | 
                                <a href="{{route('material.show', $dt->id_pemakaian_material)}}" class="btn btn-secondary btn-sm">Detail Material</a>
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
        $('#data_SO').DataTable();

        $('#no_spk').select2({
            placeholder: '- Pilih Kode SPK -',
            ajax: {
            url: '{{url('/production/get_no_spk')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (spk) {
                    return {
                    id: spk.no_spk,
                    text: spk.no_spk+' / '+spk.no_po_customer
                    
                    }
                })
                };
            },
            cache: true
            }
        });
    </script>

@endsection



