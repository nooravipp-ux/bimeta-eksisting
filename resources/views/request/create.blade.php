@extends('adminlte::page')

@section('content-header')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/bom">Request Material</a></li>
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
                    Input Detail Request Materail
                    <div class="msg"></div>
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
              <form class="dataHeader">
                  {{ csrf_field() }}
                <div class="row">
                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>ID Request Materail</label>
                          <input type="text" name="idreq" class="form-control" value="{{ $no_urutreq }}" readonly required>

                              @if($errors->has('idreq'))
                                  <div class="text-danger">
                                      {{ $errors->first('idreq')}}
                                  </div>
                              @endif

                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>Tanggal</label>
                          <input type="date" class="form-control" name="tglreq" id="tglreq">

                              @if($errors->has('tglreq'))
                                  <div class="text-danger">
                                      {{ $errors->first('tglreq')}}
                                  </div>
                              @endif

                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>Peminta</label>
                          <input type="text" name="peminta" class="form-control" required>

                              @if($errors->has('peminta'))
                                  <div class="text-danger">
                                      {{ $errors->first('peminta')}}
                                  </div>
                              @endif

                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                        <div class="form-group">
                            <label>No SPK</label>
                            <input type="text" name="nospk" class="form-control" required>

                                @if($errors->has('nospk'))
                                    <div class="text-danger">
                                        {{ $errors->first('nospk')}}
                                    </div>
                                @endif

                        </div>
                    </div>
                </div>
              </form>
              <!-- row detail pengadaan-->
              <form name="form_detail">
                <!--{{ csrf_field() }} -->
                <div class="row msg" style="display:none">Saved</div>
                <div class="row table-detail-input">
                  <table class="table text-center" id="detail-table">
                    <thead class="thead-light">
                      <tr>
                        <th>ID Bill of Material</th>
                        <th>Kode Barang</th>
                        <th>Qty</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-body">
                      <tr class="dataDetail" name="data_detail">
                        <td><input type="text" class="idreqdet form-control" name="idreqdet" id="idreqdet" value="{{ $no_urutreq }}" readonly required></td>
                        <td><select class="kodebarangreq form-control" name="kodebarangreq" id="kodebarangreq" style="min-width: 200px;max-width: 200px;"></select></td>
                        <td><input type="text" class="qtyreq form-control" name="qtyreq" id="qtyreq" required></td>
                        <td><i class="btn btn-primary addRow">+</i></td>
                      </tr>
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

@section('plugin_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('js/jautocalc.js')}}"></script>
<script type="text/javascript">
  //format currency
  const formatter = new Intl.NumberFormat('en-IN');
  //fetch data id pengadaan with ajax select2 jquery plugin
  $('#kodebarangreq').select2({
    placeholder: '- Pilih Barang -',
    ajax: {
      url: 'http://localhost/bimeta/bimeta-master-v1/public/reqKodeBarang',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (barang) {
            return {
              id: barang.kode_barang,
              text: barang.kode_barang

            }
          })
        };
      },
      cache: true
    }
  });

</script>

<script type="text/JavaScript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var urutan = 1;

$(document).ready(function() {

        //add row of table
        $('.addRow').on('click', function() {
              addRow();

        });

        function addRow(params) {
              var tr = '<tr class="dataDetail" name="data_detail">'+
                        '<td><input type="text" class="idreqdet form-control" name="idreqdet" id="idreqdet" value="{{ $no_urutreq }}" readonly required></td>'+
                        '<td><select class="kodebarangreq form-control" name="kodebarangreq" id="kodebarangreq" style="min-width: 200px;max-width: 200px;"></select></td>'+
                        '<td><input type="text" class="qtyreq form-control" name="qtyreq" id="qtyreq" required></td>'+
                        '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                      '</tr>';
              $('tbody.table-body').append(tr);

              $('.kodebarangreq').select2({
                  placeholder: '- Pilih Barang -',
                  ajax: {
                    url: 'http://localhost/bimeta/bimeta-master-v1/public/reqKodeBarang',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                            return {
                            id: barang.kode_barang,
                            text: barang.kode_barang
                        }
                        })
                      };
                    },
                    cache: true
                  }
                });
        };
        //remove row table
        $('tbody').on('click', '.remove', function(){
              $(this).parent().parent().remove();
              // autoCalcSetup();
        });
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //add data_detail with ajax
        $('#simpan').click(function(){

                var dataHeader = $('.dataHeader').map(function() {
                    return {
                    id_material_request: $(this).find('[name="idreq"]').val(),
                    tgl_material_request: $(this).find('[name="tglreq"]').val(),
                    peminta: $(this).find('[name="peminta"]').val(),
                    no_spk: $(this).find('[name="nospk"]').val()
                };
                }).get();

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    id_material_request: $(this).find('[name="idreqdet"]').val(),
                    kode_barang: $(this).find('[name="kodebarangreq"]').val(),
                    qty: $(this).find('[name="qtyreq"]').val()
                };
                }).get();

                console.log(dataHeader);
                console.log(dataDetail);

                var data = dataHeader.concat(dataDetail);
                console.log(data);
                if(data){
                    $.ajax({
                        url: 'http://localhost/bimeta/bimeta-master-v1/public/reqaddDetail',
                        type: 'post',
                        data: JSON.stringify(data),
                        dataType: "json",
                        success: function(data){
                          window.location = "http://localhost/bimeta/bimeta-master-v1/public/request";
                        }
                    });
                }else{
                  alert('Fill all fields');
                }
        });
});

</script>

@endsection

