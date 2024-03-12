@extends('adminlte::page')

@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Input Goods Receipt  
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
                                <label for="id_gr" class="col-sm-5 col-form-label">ID GR</label>
                                <div class="col-sm">
                                    <input type="text" readonly class="form-control-plaintext" id="id_gr" name="id_gr" value="{{}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_pengadaan" class="col-sm-5 col-form-label">ID PENGADAAN</label>
                                <div class="col-sm">
                                    <input type="text" readonly class="form-control-plaintext" id="id_pengadaan" name="id_pengadaan" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="penerima" class="col-sm-5 col-form-label">PENERIMA</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" id="penerima" name="penerima" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_gr" class="col-sm-5 col-form-label">TANGGAL GR</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control" id="tgl_gr" name="tgl_gr">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-5 col-form-label">STATUS</label>
                                <div class="col-sm">
                                    <select class="form-control" name="status">
                                        <option value="OPEN">OPEN</option>
                                        <option value="CLOSE">CLOSE</option>
                                        <option value="CANCEL">CANCEL</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm">
                    
                    </div>
                </div>
              <!-- row detail pengadaan--> 
                
                <div class="row msg" style="display:none">Saved</div>
                <form name="form_detail"> 
                    <div class="row table-detail-input">
                      <table class="table text-center" id="detail-table">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Qty</th>
                            <th></th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-body">
                        
                          <tr class="dataDetail" name="data_detail">
                            <input type="hidden" class="form-control" name="kode_pembelian" value="">
                            <td><input class="form-control" name="kode_barang" value="" readonly></td>
                            <td><input type="number" class="qty_sisa form-control" name="qty_sisa" value="" readonly required></td>
                            <td><input type="number" class="qty form-control" name="qty" value="" placeholder="isi qty" required></td>
                            <input type="hidden" class="harga_satuan form-control" name="harga_satuan" value="">
                            <input type="hidden" class="id_detail_pembelian form-control" name="id_detail_pembelian" value="">
                            <td><i class="btn btn-danger btn-sm fas fa-times-circle remove"></i></td>
                          </tr>
                        
                        </tbody>
                      </table>	 
                    </div>
                    

                  <div class="row no-print">
                    <div class="col-12">
                        
                      <button type="button" class="btn btn-success float-right" id="simpan"></i>
                        Simpan
                      </button>
                    </div>
                  </div>
                </div>
            </form>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
            
@endsection

@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{asset('js/jautocalc.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $('.addRow').on('click', function() {
              addRow();
              autoCalcSetup();
            });

            $('tbody').on('click', '.remove', function(){
              $(this).parent().parent().remove();
            });

            //validasi form kosong
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
                    id_gr: $(this).find('[name="id_gr"]').val(),
                    penerima: $(this).find('[name="penerima"]').val(),
                    tgl_gr: $(this).find('[name="tgl_gr"]').val(),
                    status: $(this).find('[name="status"]').val(),
                    id_pengadaan: $(this).find('[name="id_pengadaan"]').val()
                };
                }).get(); 

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    kode_pembelian: $(this).find('[name="kode_pembelian"]').val(),
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    qty: $(this).find('[name="qty"]').val(),
                    harga_satuan: $(this).find('[name="harga_satuan"]').val(),
                    id_detail_pembelian: $(this).find('[name="id_detail_pembelian"]').val()
                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader.concat(dataDetail);
                console.log(data);
                
                
                if(data){
                  $.ajax({
                      url: 'http://localhost/bimeta/bimeta-master-v1/public/logistik/store_detail_gr',
                      type: 'post',
                      data: JSON.stringify(data),
                      dataType: "json",
                      success: function(data){
                        // console.log(Response);
                        window.location = "http://localhost/bimeta/bimeta-master-v1/public/logistik";
                      }
                  });
                }else{
                    alert('Fill all fields');
                } 
              } else {
                  alert('Tidak bisa menyimpan data . Harap isi data dengan benar !!!');
              }
        });

            
      });
  </script>
@endsection