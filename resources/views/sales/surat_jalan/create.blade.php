@extends('adminlte::page')
@section('adminlte_css')
<style>
    .select2-offscreen {
        width:460px;
    }
    .select2-offscreen-qty {
        width:130px;
    }
    .select2-offscreen-total-harga {
      width: 150px;
    }
    .select2-offscreen-action {
      width: 100px;
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
                    Buat Surat Jalan
                    @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                    @endif
                    <small class="float-right"></small>
                    <div class="msg"></div>
                </h4>
            </div>

            <!-- Form Input pengadaan-->
              <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-4">
                        <form class="dataHeader">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="no_surat_jalan" class="col-sm-5 col-form-label">NO SURAT JALAN</label>
                                <div class="col-sm">
                                    <h1><input type="text" name="no_surat_jalan" class="form-control-plaintext" value="{{$no_sj}}" readonly required></h1>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_surat_jalan" class="col-sm-5 col-form-label">TANGGAL</label>
                                <div class="col-sm">
                                    <input type="date" name="tgl_surat_jalan" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="supir" class="col-sm-5 col-form-label">SUPIR</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" name="supir" id="supir">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="plat_nomor" class="col-sm-5 col-form-label">PLAT NO</label>
                                <div class="col-sm">
                                    <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" required>
                                    <input type="hidden" name="no_sales_order" id="no_sales_order" class="form-control" value="{{$header_so->id_sales_order}}" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm">
                    
                    </div>
                </div>
            <div class="row">
              <!-- row detail pengadaan-->
              <form name="form_detail"> 
                <!--{{ csrf_field() }} --> 
                <div class="row table-detail-input">
                  <table class="table text-center" id="detail-table">
                    <thead>
                      <tr>
                        <th class="select2-offscreen">Nama Barang</th>
                        <th class="select2-offscreen-qty">Stock Qty</th>
                        <th class="select2-offscreen-qty">Order Qty</th>
			<th class="select2-offscreen-qty">keterangan</th>
                        <th class="select2-offscreen-action">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-body">
                    @foreach($detail_so as $det)
                      <tr class="dataDetail" name="data_detail">
                        <input type="hidden" class="form-control" name="no_surat_jalan" value="{{$no_sj}}" required>
                        <td><input type="text" class="kode_barang form-control" name="kode_barang_show" value="{{$det->nama_barang}} {{$det->ukuran}}" readonly></td>
				<input type="hidden" class="kode_barang form-control" name="kode_barang" value="{{$det->kode_barang}}" readonly>
                        <td><input type="number" class="qty_sisa form-control" name="qty_sisa" value="{{$det->sisa}}" readonly required></td>
                        <td><input type="number" class="qty form-control" name="qty" placeholder="isi qty" required></td>
                        <input type="hidden" class="no_sales_order form-control" name="no_sales_order" value="{{$det->id_sales_order}}" readonly required>
                        <input type="hidden" class="status form-control" name="status" required>
			<td><select name="keterangan" class="form-control"><option value="tidak ada" selected>Tidak Ada</option><option value="ada">Ada</option></select></td>
                        <td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>
                        <input type="hidden" name="no_detail_sales_order" class="no_detail_sales_order form-control" value="{{$det->counter_detail_sales_order}}">
                      </tr>
                    @endforeach
                    </tbody>
                  </table>	 
                </div>
                <div class="row no-print">
                  <div class="col-12">
                    <button type="button" class="btn btn-success float-right" id="simpan"></i>
                      simpan
                    </button>
                  </div>
                </div>
              </form>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('js/jautocalc.js')}}"></script>
<script type="text/JavaScript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var urutan = 1;

$(document).ready(function() {
          $('#simpan').click(function(e) {
              e.preventDefault();
              var $fields = [ $('tr input.qty')];
              var $emptyFields;
              
              for(var i=0;i< $fields.length;i++){
              $emptyFields = $fields[i].filter(function(i,element) {
                  return $.trim($(this).val()) === '';
              });
              }
              if (!$emptyFields.length) {
                  //collect data form input detail
                  var dataHeader = $('.dataHeader').map(function() {
                      return {
                      no_surat_jalan: $(this).find('[name="no_surat_jalan"]').val(),
                      tgl_surat_jalan: $(this).find('[name="tgl_surat_jalan"]').val(),
                      supir: $(this).find('[name="supir"]').val(),
                      plat_nomor: $(this).find('[name="plat_nomor"]').val(),
                      no_sales_order: $(this).find('[name="no_sales_order"]').val()
                  };
                  }).get(); 

                  var dataDetail = $('.dataDetail').map(function() {
                      return {
                      no_surat_jalan: $(this).find('[name="no_surat_jalan"]').val(),
                      kode_barang: $(this).find('[name="kode_barang"]').val(),
                      qty: $(this).find('[name="qty"]').val(),
                      no_sales_order: $(this).find('[name="no_sales_order"]').val(),
                      keterangan: $(this).find('[name="keterangan"]').val(),
                      no_detail_sales_order: $(this).find('[name="no_detail_sales_order"]').val()

                  };
                  }).get();

                  console.log(dataHeader);
                  console.log(dataDetail);

                  var data = dataHeader.concat(dataDetail);
                  console.log(data);
                  if(data){
                      $.ajax({
                          url: '{{url('/sales/surat-jalan/store')}}',
                          type: 'post',
                          data: JSON.stringify(data),
                          dataType: "json",
                          success: function(data){
                            if(data.error){
                              alert(data.error);
                            }else{
                              alert("data disimpan");
                              window.location = "{{url('/sales/surat-jalan')}}";
                            }
                          }
                      });
                      
                  }else{
                    alert("Data gagal di simpan !!!");
                  }
              } else {
                  alert('Tidak bisa menyimpan data . Harap isi data dengan benar !!!');
              }
        });
        //validasi perbandingan QTY max
        //$("#detail-table").on("change", "input", function(){    
            //var $qty_sisa = $(this).closest("tr").find("td input.qty_sisa"),
                //$qty = $(this).closest("tr").find("td input.qty");
               // $qty.each(function() {
                    //if ($(this).val() > $qty_sisa.val() || $(this).val() <= 0) { 
                       // alert("qty lebih dari max sisa");
                       // $(this).val("");
                    //}
       // });
                  
           //   });
        //JS untuk kalkulasi form harga detail
        function autoCalcSetup() {
            
            $('form[name=form_detail] tr[name=data_detail]').jAutoCalc({keyEventsFire: true, decimalPlaces: 0, smartIntegers: true});
            $('form[name=form_detail]').jAutoCalc({decimalPlaces: 0, smartIntegers: true});
        }

        autoCalcSetup();
        //add row of table
        $('.addRow').on('click', function() {
              addRow();
              autoCalcSetup();
              
        });

        function addRow(params) {
              var tr = '<tr class="dataDetail" name="data_detail">'+
                        '<input type="hidden" class="form-control" name="no_surat_jalan" id="no_surat_jalan" value="{{$no_sj}}" required>'+
                        '<td>'+
                          '<select class="kode_barang form-control" name="kode_barang" id="kode_barang">'+
                              '@foreach($detail_so as $det)'+
                                  '<option value="{{$det->kode_barang}}">{{$det->kode_barang}}</option>'+
                              '@endforeach'+
                          '</select>'+
                        '</td>'+
                        '<td><input type="number" class="qty form-control" name="qty" id="qty" value="0" required></td>'+
                        '<td><input type="text" class="no_sales_order form-control" name="no_sales_order" id="no_sales_order" value="{{$det->counter_detail_sales_order}}" readonly required></td>'+
                        '<td><input type="text" class="status form-control" name="status" id="status" required></td>'+
                        '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                      '</tr>';
              $('tbody.table-body').append(tr);
        };
        //remove row table
        $('tbody').on('click', '.remove', function(){
              $(this).parent().parent().remove();
              autoCalcSetup();
        });
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
});

</script>

@endsection
