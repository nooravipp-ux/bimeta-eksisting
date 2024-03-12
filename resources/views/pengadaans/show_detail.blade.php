@extends('adminlte::page')

@section('adminlte_css')
<style>
  .invoice {
    font-size: large;
  }
  .header-bimeta {
    border-bottom: 5px double green;
  }

  .kop-surat {
    margin-top: 65px;
  }
</style>
@endsection
@section('content')
<section class="invoice">
<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row header text-center font-weight-bold text-success">
                <div class="col-md-1">
                  
                </div>
                <div class="col-md-10">
                  <div class="header-bimeta">
                    <h2><b>PT. BIMETA KARNUSA</b></h2>
                    <div class="text-desc">
                      CORRUGATED CARTON BOARD & BOX MFG. CO.
                    </div>
                    <div class="address">
                      <small>Jl. Raya Batujajar No 98 Cimareme Kec. Ngamprah Kab. Bandung Barat - Indonesia</small>
                    </div>
                    <div class="email-1">
                      <small>Phone/Fax : (022) 6866526 E-Mail : bimeta98@yahoo.com</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  
                </div>
              </div>
              <div class="row kop-surat">
                  <div class="col-sm">
                     
                        Kepada Yth<br>
                        <b>{{$header->nama_supplier}}</b><br>
                        Up. {{$header->pic_supplier}}<br>
                        <p>PO No : {{str_replace("-","/",$header->id_pengadaan)}}</p>
                        <p>Dengan hormat,</p>
                        <p>Dengan ini kami memesan barang dengan rincian berikut :</p>
                  </div>
              </div>
              <!-- /.row -->
                
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered" id="tabel_detail">
                    <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Qty</th>
                      <th>Satuan</th>
		      <th>Harga</th>
                      <th>Quality</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($detail as $det)
                    <tr>
                      <td>{{$det->nama_barang}} / {{$det->ukuran}}</td>
                      <td>{{$det->qty}}</td>
                      <td>Rol</td>
		      <td>{{$det->harga_satuan}}</td>
                      <td>{{$det->spesifikasi_barang}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <p>Demikian pesanan kami, atas perhatiannya kami ucapkan terimakasih.</p>
              <!-- /.row -->
              <div class="row">
                  <div class="col-sm">
                    <p>Bandung, {{date("d-m-Y")}}</p>
                    <p>Hormat kami, </p>
                  </div>
                  <div class="col-sm text-center">
                    
                  </div>
                  <div class="col-sm text-center">
                    
                  </div>
              
              </div>
              <br><br>
              <div class="row">
                  <div class="col-sm">
                    <p>Paulus A</p>
                  </div>
                  <div class="col-sm text-center">
                  
                  </div>
                  <div class="col-sm text-center">
                  
                  </div>
              
              </div>

              <div class="row">
                  <div class="col-sm ">
                    <strong>Catatan : Pembayaran 2 bulan setelah penerimaan barang.</strong>
                    
                  </div>      
              </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
@endsection

@section('plugin_js')
<script type="text/javascript"> 
    

    
</script>

@endsection