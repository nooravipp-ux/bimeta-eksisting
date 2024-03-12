
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
                            Faktur
                            <div class="msg"></div>
                        </h4>
                    </div>

                    <!-- Form Input GR  -->
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="/finance/membuat_faktur_pilihan" method="get">
                                    <div class="form-group row">
                                        <label for="no_so" class="col-sm-3 col-form-label">NO SURAT JALAN</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="no_faktur" name="no_surat_jalan" required></input>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Buat faktur</button>
                                </form>
                            </div>
                            <div class="col-sm-4">
                                <form class="navbar-form navbar-left">
                                    <div class="input-group">
                                        <input type="text" name="cari" class="form-control" placeholder="Search dashboard...">
                                        <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"> <br>
                                

                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>

            @endsection

            @section('plugin_js')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
                

@endsection

