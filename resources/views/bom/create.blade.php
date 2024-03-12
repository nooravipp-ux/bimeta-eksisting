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
              <li class="breadcrumb-item"><a href="/bom">Bill of material</a></li>
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
                    Input Detail Bill Of Material
                    <div class="msg"></div>
                </h4>
            </div>

            <div class="invoice p-3 mb-3">
              <form class="dataHeader" name="dataHeader">
                  {{ csrf_field() }}
                <div class="row">
                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>ID Bill of Material</label>
                          <input type="text" name="idbom" class="form-control" value="{{ $no_urutbom }}" readonly required>

                              @if($errors->has('idbom'))
                                  <span class="help-block">{{$errors->firts('idbom')}}</span>
                              @endif

                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group{{$errors->has('kodebarang') ? 'has-errors':''}}">
                          <label>Kode Barang</label>
                          <select class="form-control" name="kodebarang" id="kodebarang">

                          </select>
                              @if($errors->has('kodebarang'))
                                 <span class="help-block">{{$errors->firts('kodebarang')}}</span>
                              @endif

                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group{{$errors->has('dscmaterial') ? 'has-errors':''}}">
                          <label>Deskripsi Material</label>
                          <input type="text" name="dscmaterial" class="form-control" required>

                              @if($errors->has('dscmaterial'))
                                <span class="help-block">{{$errors->firts('dscmaterial')}}</span>
                              @endif

                      </div>
                  </div>
                </div>
              </form>
              <!-- row detail pengadaan-->
              <form name="form_detail" name="form_detail">
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
                        <td><input type="text" class="idbomdet form-control" name="idbomdet" id="idbomdet" value="{{ $no_urutbom }}" readonly required></td>
                        <td><select class="kodebarangdet form-control" name="kodebarangdet" id="kodebarangdet" style="min-width: 200px;max-width: 200px;"></select></td>
                        <td><input type="text" class="qtydet form-control" name="qtydet" id="qtydet" required></td>
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

function IsEmpty() {
  if (document.forms['dataHeader'].question.value === "") {
    alert("empty");
    return false;
  }
  return true;
}

  //format currency
  const formatter = new Intl.NumberFormat('en-IN');
  //fetch data id pengadaan with ajax select2 jquery plugin
  $('#kodebarang').select2({
    placeholder: '- Pilih Barang -',
    ajax: {
      url: 'http://localhost/bimeta/bimeta-master-v1/public/bomKodeBarang',
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

  $('.kodebarangdet').select2({
    placeholder: '- Pilih Barang -',
    ajax: {
      url: 'http://localhost/bimeta/bimeta-master-v1/public/bomKodeBarang',
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
                        '<td><input type="text" class="idbomdet form-control" name="idbomdet" id="idbomdet" value="{{ $no_urutbom }}" readonly required></td>'+
                        '<td><select class="kodebarangdet form-control" name="kodebarangdet" id="kodebarangdet" style="min-width: 200px;max-width: 200px;"></select></td>'+
                        '<td><input type="text" class="qtydet form-control" name="qtydet" id="qtydet" required></td>'+
                        '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                      '</tr>';
              $('tbody.table-body').append(tr);
              //ajax for get kode barang on select box
              $('.kodebarangdet').select2({
                  placeholder: '- Pilih Barang -',
                  ajax: {
                    url: 'http://localhost/bimeta/bimeta-master-v1/public/bomKodeBarang',
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
                    id_bom: $(this).find('[name="idbom"]').val(),
                    kode_barang: $(this).find('[name="kodebarang"]').val(),
                    deskripsi_material: $(this).find('[name="dscmaterial"]').val()
                };
                }).get();

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    id_bom: $(this).find('[name="idbomdet"]').val(),
                    kode_barang: $(this).find('[name="kodebarangdet"]').val(),
                    qty: $(this).find('[name="qtydet"]').val()
                };
                }).get();

                console.log(dataHeader);
                console.log(dataDetail);

                var data = dataHeader.concat(dataDetail);
                console.log(data);
                if(data){
                    $.ajax({
                        url: 'http://localhost/bimeta/bimeta-master-v1/public/bomaddDetail',
                        type: 'post',
                        data: JSON.stringify(data),
                        dataType: "json",
                        success: function(data){
                          window.location = "http://localhost/bimeta/bimeta-master-v1/public/bom";
                        }
                    });
                }else{
                  alert('Fill all fields');
                }
        });
});

</script>

@endsection

