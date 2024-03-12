@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Edit Material Request
                    <small class="float-right"><b> Date: {{date("d/m/Y")}} </b></small>
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
                          <label>ID Material Request</label>
                          <input type="text" name="idmaterial" class="form-control" value="{{$header->id_material_request}}" readonly required>
                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>Tanggal</label>
                          <input type="date" class="form-control" name="tglreq" id="tglreq" value="{{$header->tgl_material_request}}">
                      </div>
                  </div>

                  <div class="col-sm-4 invoice-col">
                      <div class="form-group">
                          <label>peminta</label>
                          <input type="text" name="peminta" class="form-control" value="{{$header->peminta}}" required>
                      </div>
                  </div>
                </div>

                <div class="col-sm-4 invoice-col">
                        <div class="form-group">
                            <label>No SPK</label>
                            <input type="text" name="nospk" class="form-control" value="{{$header->no_spk}}" required>
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
                        <th scope="col">ID Material Request</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col"><button type="button" class="btn btn-primary addRow" id="add_row">+</i>
                  </button></th>
                      </tr>
                    </thead>
                    <tbody class="table-body">
                    @foreach($detail as $data)
                      <tr class="dataDetail" name="data_detail">
                        <td><input type="text" class="form-control" name="idmatreq" id="idmatreq" value="{{$data->id_material_request}}" readonly required></td>
                        <td><input class="form-control" name="kodebarangreq" id="kodebarangreq" value="{{$data->kode_barang}}" style="min-width: 200px;max-width: 200px;"></td>
                        <td><input type="text" class="qtydet form-control" name="qtyreqdet" id="qtyreqdet" value="{{$data->qty}}" required></td>
                        <td><i class="btn btn-danger btn-sm fas fa-times-circle remove"></i></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              <div class="row no-print">
                <div class="col-12">

                  <button type="button" class="btn btn-success float-right" id="update"></i>
                    Update
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
  </section>

@endsection

@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $('.addRow').on('click', function() {
              addRow();
            });
            function addRow(params) {
              var tr = '<tr class="dataDetail" name="data_detail">'+
                        '<td><input type="text" class="form-control" name="idmatreq" id="idmatreq" value="{{$data->id_material_request}}" readonly required></td>'+
                        '<td><select class="kodebarangreq form-control" name="kodebarangreq" id="kodebarangreq" style="min-width: 200px;max-width: 200px;"></select></td>'+
                        '<td><input type="text" class="form-control" name="qtyreqdet" id="qtyreqdet" required></td>'+
                        '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                      '</tr>';
                $('tbody.table-body').append(tr);

                $('.kodebarangreq').select2({
                  placeholder: 'Cari...',
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

            $('tbody').on('click', '.remove', function(){
              $(this).parent().parent().remove();
            });

            $('#update').click(function(){

                var dataHeader = $('.dataHeader').map(function() {
                    return {
                    id_material_request: $(this).find('[name="idmaterial"]').val(),
                    tgl_material_request: $(this).find('[name="tglreq"]').val(),
                    peminta: $(this).find('[name="peminta"]').val(),
                    no_spk: $(this).find('[name="nospk"]').val()
                };
                }).get();

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    id_material_request: $(this).find('[name="idmatreq"]').val(),
                    kode_barang: $(this).find('[name="kodebarangreq"]').val(),
                    qty: $(this).find('[name="qtyreqdet"]').val()
                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader.concat(dataDetail);
                console.log(data);


                if(data){
                  $.ajax({
                      url: 'http://localhost/bimeta/bimeta-master-v1/public/request/update',
                      type: 'post',
                      data: JSON.stringify(data),
                      dataType: "json",
                      success: function(data){
                        // console.log(Response);
                        window.location = "http://localhost/bimeta/bimeta-master-v1/public/request";
                        alert('Data was Updated !!!');
                      }
                  });
                }else{
                    alert('Fill all fields');
                }
            });
        });




    </script>
@endsection
