@extends('adminlte::page')
@section('adminlte_css')
<style>
    .cari-so {
        width:330px;
    }
</style>
@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h4>
                            Surat Perintah Kerja
                            <div class="msg"></div>
                        </h4>
                    </div>

                    <!-- Form Input pengadaan-->
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-sm-7">
                                <form action="{{ route('spk.create') }}" method="get">
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <select class="cari-so form-control" id="kd_so" name="kd_so" required></select>
                                        </div>
                                        <button type="submit" class="col-sm-3 col-form-label btn btn-primary btn-sm">Buat SPK</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm">
                            <form action="{{ route('spk.batal') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">NO SPK</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="no_spk" name="no_spk" required></select>
                                    </div>
                                    <button type="submit" class="col-sm-2 col-form-label btn btn-danger btn-sm">BATAL</button>
                                </div>
                            </form>
                            </div>
                        </div>
            <table id="spk" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>NO SPK</th>
                        <th>Tgl Surat Perintah Kerja</th>
                        <th>No Sales Order</th>
			            <th>No PO</th>
                        <th>Tipe SPK</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spk as $SPK)
                    <tr>
                        <td>{{ $SPK->no_spk }}</td>
                        <td>{{ $SPK->tgl_spk }}</td>
                        <td>{{ $SPK->no_sales_order }}</td>
			            <td>{{ $SPK->no_po_customer }}</td>
                        <td>{{ $SPK->tipe_spk }}</td>
                        <td><a href="{{route('spk.show', $SPK->no_spk)}}" class="btn btn-primary btn-sm">Edit SPK</a>
			    @if($SPK->tipe_spk == "A" || $SPK->tipe_spk == "B")
				 <a href="{{route('spk.detail-print', $SPK->no_spk)}}" class="btn btn-secondary btn-sm">Print SPK</a>
			    @else
				 <a href="{{route('spk.double-detail-print', $SPK->no_spk)}}" class="btn btn-secondary btn-sm">Print SPK D</a>
			    @endif
                <!-- <a href="{{route('spk.convert', $SPK->no_spk)}}" class="btn btn-warning btn-sm">Convert to IG</a> -->
			    @if(auth()->user()->role == 'admin')
			    	<a href="{{route('spk.delete',$SPK->no_spk)}}" class="btn btn-danger btn-sm">Delete SPK</a>
			    @endif
			</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
    	$('#spk').DataTable({
            "order": [[0, 'DESC' ]]
        });
        $('#kd_so').select2({
            placeholder: '- Pilih Sales Order -',
            ajax: {
            url: '{{url('/production/spk/get-id-so')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (id) {
                    return {
                    id: id.id_so,
                    text: id.id_so+' / '+id.no_po_customer

                    }
                })
                };
            },
            cache: true
            }
        });   

        $('#no_spk').select2({
            placeholder: '- Pilih SPK -',
            ajax: {
            url: '{{url('/production/get_no_spk')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (id) {
                    return {
                    id: id.no_spk,
                    text: id.no_spk

                    }
                })
                };
            },
            cache: true
            }
        }); 
    </script>

@endsection
