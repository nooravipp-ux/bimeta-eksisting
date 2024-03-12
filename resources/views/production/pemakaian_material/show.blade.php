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
                <h4>
                    Detail Pemakaian Material
                    <small class="float-right">NO. {{$show_header->id_pemakaian_material}}</small>
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
              <div class="row data-header">
                      <div class="col-sm-4">
                          <form class="dataHeader">
                              {{ csrf_field() }}
                            
                              <div class="form-group row">
                                  <label for="penerima" class="col-sm-5 col-form-label">TGL PEMAKAIAN</label>
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
                              <div class="form-group row">
                                  <label for="tgl_gr" class="col-sm-5 col-form-label">TOTAL PEMAKAIAN BARANG</label>
                                  <div class="col-sm">
                                      <input type="number" class="form-control" id="total_pemakaian_material" name="total_pemakaian_material" value="{{$show_header->total_pemakaian_material}}">
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
                      <div class="col-md-5">
                          <table class="table table-sm text-center" id="detail-table">
                            <thead class="thead-light">
                              <tr>
                                <th>Kode Barang</th>
                                <th>Qty (Kg)</th>
                                <th>Harga Satuan</th>
                              </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($show_detail as $show)
                              <tr class="dataDetail" name="data_detail">
                                <td><input type="text" class="kode_barang form-control" name="kode_barang" id="kode_barang" value="{{$show->nama_barang}} {{$show->ukuran}}"></td>
                                <td><input type="number" class="qty form-control" name="qty" id="qty1" value="{{$show->qty}}" required></td>
                                <td><input type="number" class="harga_satuan form-control" name="harga_satuan" id="harga_satuan1" value="{{$show->harga_satuan}}" required></td>
                                <input type="hidden" class="form-control" name="id_pemakaian_material" id="kode_pembelian1" value="{{$show_header->id_pemakaian_material}}" required>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-1"></div>
                    	<div class="col-md-3">
                          <table class="table table-sm text-center" id="detail-table">
                            <thead class="thead-light">
                              <tr>
                                <th>No SPK</th>
                                <th>Harga Satuan</th>
                              </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($spk_pemakaian as $show)
                              <tr class="dataDetail" name="data_detail">
                                <td><input type="text" class="kode_barang form-control" name="kode_barang" id="kode_barang" value="{{$show->no_spk}}"></td>
                                <td><input type="number" class="qty form-control" name="qty" id="qty1" value="{{$show->harga_satuan}}" required></td>
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
                      Update
                    </button>
                  </div>
                </div>
              </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection
