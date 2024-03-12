@extends('adminlte::page')
@section('adminlte_css')
<style>
    .data-header{
        border: 1px solid #f5f5ef;
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
                <h4 class="text-center">
                    DAILY REPORT PEMAKAIAN MEDIUM DAN KRAFT
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
              <div class="row data-header">
                      <div class="col-sm-3">
                          <form class="dataHeader">
                              {{ csrf_field() }}
                            
                              <div class="form-group row">
                                  <label for="penerima" class="col-sm-5 col-form-label">TGL PEMAKAIAN : </label>
                                  <div class="col-sm">
                                      <input type="date" class="form-control" id="tgl_pemakaian" name="tgl_pemakaian" value="{{$show_header->tgl_pemakaian}}" required>

                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="id_pengadaan" class="col-sm-5 col-form-label">IN CHARGE</label>
                                  <div class="col-sm">
                                      <input type="text" class="form-control" id="in_charge" name="in_charge" value="{{$show_header->in_charge}}">
                                  </div>
                              </div>
                          </form>
                      </div>
                      <div class="col-sm">
                      
                      </div>
                  </div> 
                <!-- row detail pengadaan-->
                <form name="form_detail"> 
                  <!--{{ csrf_field() }} --> 
                  <div class="row msg" style="display:none">Saved</div>
                  <div class="row table-detail-input">
                      <div class="col-md-7">
                          <table class="table table-bordered">
        	              <thead>
          		          <tr>
            		              <th scope="col">No</th>
                                      <th scope="col">Jenis Barang</th>
                                      <th scope="col">Masuk Mesin (kg)</th>
                                      <th scope="col">Sisa Timbangan (kg)</th>
                                      <th scope="col">Terpakai (kg)</th>
                                  </tr>
                              </thead>
                              <tbody>
          			  @foreach($show_detail as $show)
                              <tr class="dataDetail" name="data_detail">
				<td>{{$show->no_mesin}}</td>
                                <td>{{$show->nama_barang}} {{$show->ukuran}}</td>
                                <td>{{$show->masuk_mesin}}</td>
                                <td>{{$show->sisa_timbangan}}</td>
                           	<td>{{$show->terpakai}}</td>
                              </tr>
                            @endforeach
                              </tbody>
                         </table>
                      </div>
		      
                  </div>
                </form>
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <button type="button" class="btn btn-success float-right" id="simpan"></i>
                      Print
                    </button>
                  </div>
                </div>
              </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection
