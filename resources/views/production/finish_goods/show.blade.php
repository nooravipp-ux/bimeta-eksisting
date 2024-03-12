@extends('adminlte::page')
@section('adminlte_css')
<style>
    .data-header{
        border: 1px solid #f5f5ef;
    }
</style>
@endsection

@section('content-header')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/pengadaan">pengadaan</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                    Detail Finished Goods
                    <small class="float-right">NO. {{$show_header->id_finished_good}}</small>
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
            <div class="row data-header">
                    <div class="col-sm-4">
                        <form class="dataHeader">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="id_pengadaan" class="col-sm-5 col-form-label">NO SPK</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" id="id_spk" name="id_spk" value="{{$show_header->no_spk}}">
                                    <input type="hidden" readonly class="form-control-plaintext" id="id_pemakaian_material" name="id_pemakaian_material" value="{{$show_header->id_finished_good}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="penerima" class="col-sm-5 col-form-label">TGL FINISHED GOODS</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control" id="tgl_pemakaian" name="tgl_pemakaian" value="{{$show_header->tgl_finish_good}}" required>
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
                  <table class="table table-sm text-center" id="detail-table">
                    <thead class="thead-light">
                      <tr>
                        <th>Kode Barang</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                      </tr>
                    </thead>
                    <tbody class="table-body">
                    @foreach($show_detail as $show)
                      <tr class="dataDetail" name="data_detail">
                        <td><input type="text" class="kode_barang form-control" name="kode_barang" value="{{$show->kode_barang}}/{{$show->nama_barang}}"></td>
                        <td><input type="number" class="qty form-control" name="qty" value="{{$show->qty}}" required></td>
                        <td><input type="number" class="harga_satuan form-control" name="harga_satuan" value="{{$show->harga_satuan}}" required></td>
			                  <input type="hidden" class="form-control" name="id_pemakaian_material" id="kode_pembelian1" value="" required>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>	 
                </div>
              </form>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="btn btn-success float-right" id="simpan"></i>
                    simpan
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection