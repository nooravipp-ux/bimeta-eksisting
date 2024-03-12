
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
                    Simpan Finish Goods
                    <small class="float-right">NO.{{$no_fg}}</small>
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
                                    <input type="text" class="form-control" id="no_spk" name="no_spk" value="{{$no_spk}}" readonly>
                                    <input type="hidden" readonly class="form-control-plaintext" id="id_finished_good" name="id_finished_good" value="{{$no_fg}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="penerima" class="col-sm-5 col-form-label">TGL FINISH GOODS</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control" id="tgl_finish_good" name="tgl_finish_good" required>
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
                        <div class="col-md-9">
                            <table class="table table-sm text-center" id="detail-table">
                                <thead class="thead-light">
                                  <tr>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>   
                                  </tr>
                                </thead>
                                <tbody class="table-body">
                                @foreach($data_spk as $fg)
                                  <tr class="dataDetail" name="data_detail">
                                    <td><input type="text" class="kode_barang form-control" name="kode_barang_show" value="{{$fg->nama_barang}} {{$fg->ukuran}}"></td>
                                        <input type="hidden" class="kode_barang form-control" name="kode_barang" value="{{$fg->kode_barang}}">
                                    <td><input type="number" class="qty form-control" name="qty" value="{{$fg->qty}}" required></td>
                                    <td><input type="number" class="harga_satuan form-control" name="harga_satuan" value="{{$fg->harga_satuan}}" required></td>
                                    <input type="hidden" class="id_fg form-control" value="{{$no_fg}}" name="id_fg">  
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
<script type="text/JavaScript">
$(document).ready(function() {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //add data_detail with ajax
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
                    id_finished_good: $(this).find('[name="id_finished_good"]').val(),
                    no_spk: $(this).find('[name="no_spk"]').val(),
                    tgl_finish_good: $(this).find('[name="tgl_finish_good"]').val()
                };
                }).get(); 

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    qty: $(this).find('[name="qty"]').val(),
                    harga_satuan: $(this).find('[name="harga_satuan"]').val(),
                    id_fg: $(this).find('[name="id_fg"]').val() 
                };
                }).get();

                console.log(dataHeader);
                console.log(dataDetail);

                var data = dataHeader.concat(dataDetail);
                console.log(data);
                if(data){
                    $.ajax({
                        url: '{{url('production/finish-goods/store')}}',
                        type: 'post',
                        data: JSON.stringify(data),
                        dataType: "json",
                        beforeSend: function(){
                            $('#simpan').html("Processing ...").attr('disabled', true);
                        },
                        success: function(data){
                          if(data.error){
                              alert(data.error);
                              $('#simpan').html("Simpan").attr('disabled', false);
                          }else{
                              alert("Data berhasil di simpan");
                              $('#simpan').html("Simpan").attr('disabled', false);
                              window.location = "{{url('/production/finish-goods')}}";
                          }
                            
                        }
                    });
                }else{
                  alert('Fill all fields');
                } 
              }else {
                  alert('Tidak bisa menyimpan data . Harap isi data dengan benar !!!');
              } 
        });
});
</script>

@endsection

