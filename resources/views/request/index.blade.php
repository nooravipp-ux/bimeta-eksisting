@extends('adminlte::page')

@section('content')

    <div class="card mt-5">
        <div class="card-body">
            <a href="{{route('request.create')}}" class="btn btn-primary">Input Request</a>
                <br/>
                <br/>
            <table id="data_request" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID Material Request</th>
                        <th>Tgl Request</th>
                        <th>Peminta</th>
                        <th>No SPK</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_req as $req)
                    <tr>
                        <td>{{ $req->id_material_request }}</td>
                        <td>{{ $req->tgl_material_request }}</td>
                        <td>{{ $req->peminta }}</td>
                        <td>{{ $req->no_spk }}</td>
                        <td><a href="{{route('request.edit',$req->id_material_request)}}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{route('request.delete',$req->id_material_request)}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau menghapus data')">Delete</a></<a>
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </div>
    </div>

@endsection

@section('plugin_js')
    <script>
        $('#data_request').DataTable();
    </script>

@endsection



