@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                    Detail Sales Order
                    <small class="float-right">NO. {{$header_so->id_so}}</small>
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
              <form class="dataHeader">
                  {{ csrf_field() }}
                <div class="row">          
                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>ID Customer</label>
                          <input class="form-control" name="id_customer" id="id_customer" value="{{$header_so->id_customer}}/{{$header_so->nama_customer}}"></input>
                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>Tgl Pengiriman</label>
                          <input type="date" class="form-control" name="top" id="top" value="{{$header_so->top}}">
                      </div>
                  </div>
                  
                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>Tgl Pemesanan</label>
                          <input type="date" name="tgl_pemesanan" class="form-control" value="{{$header_so->tgl_pemesanan}}" required>
                      </div>
                  </div>
                  
                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>Total Penjualan</label>
                          <input name="total_penjualan" id="total" class="form-control" value="{{$header_so->total_penjualan}}" required>
                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>Status</label>
                          <input class="form-control" name="status" value="{{$header_so->status}}"></input>
                      </div>
                  </div>
                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>No P.O Customer</label>
                          <input class="form-control" name="no_po_customer" value="{{$header_so->no_po_customer}}" style="min-width: 200px;max-width: 200px;">
                      </div>
                  </div>

                </div>
              </form> 
              <!-- row detail pengadaan-->
              <form name="form_detail"> 
                <!--{{ csrf_field() }} --> 
                <div class="row msg" style="display:none">Saved</div>
                <div class="row table-detail-input">
                  <table id="tabel_detail" class="table table-bordered table-striped" id="detail-table">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga Satuan</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody class="table-body">
                    @php
                      $no = 1
                    @endphp
                    @foreach($detail_so as $det)
                      <tr class="dataDetail" name="data_detail">
                        <input type="hidden" class="form-control" name="id_sales_order" id="id_sales_order" value="{{$det->id_sales_order}}" required>
                        <td>{{$no++}}</td>
                        <td>{{$det->nama_barang}} / {{$det->ukuran}}</td>
                        <td class="harga">{{$det->qty}}</td>
                        <td class="harga">{{$det->harga_satuan}}</td>
                        <td class="total_item" id="total_item"></td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>	 
                </div>
              </form>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')
<script type="text/javascript">
    $(document).ready(function () {   
      $('#tabel_detail > tbody > tr').each(function () {
            var sum = 1; 
            $(this).find('.harga').each(function () {
                var harga = $(this).text();
                if (!isNaN(harga) && harga.length !== 0) {
                    sum *= parseInt(harga);
                }
            });
            $('.total_item', this).html(sum);
        }); 
        
    });
</script>

@endsection

