@extends('adminlte::page')
@section('adminlte_css')
<style>
    .select2-offscreen {width:460px;}
    .select2-offscreen-qty {
        width:130px;
    }
    .select2-offscreen-total-harga {
      width: 150px;
    }
    .tipe_spk {
      width: 70px;
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
                     Input Surat Perintah Kerja
                    <small class="float-right"></small>
                </h4>
            </div>

            <!-- Form GR-->
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-sm-4">
                        <form class="dataHeader">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="no_so" class="col-sm-5 col-form-label">NO SALES ORDER</label>
                                <div class="col-sm">
                                    <input type="text" readonly class="form-control-plaintext" id="no_so" name="no_so" required value="{{$id_so}}">
                                    <input type="hidden" readonly class="form-control-plaintext" id="no_spk" name="no_spk" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_spk" class="col-sm-5 col-form-label">TGL SPK</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control" id="tgl_spk" name="tgl_spk">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="durasi" class="col-sm-5 col-form-label">DURASI</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" id="durasi" name="durasi">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm">

                    </div>
                </div>
              <!-- row detail GR-->
                <div class="row">
                    <form name="form_detail">
                        {{ method_field('POST') }}
                        <div class="row table-detail-input">
                          <table class="table text-center" id="detail-table">
                            <thead class="thead-light">
                              <tr>
                                <th class="select2-offscreen">NAMA BARANG</th>
                                <th class="select2-offscreen-qty">QTY SO</th>
                                <th class="select2-offscreen-total-harga">QTY</th>
				<th class="tipe_spk">TIPE SPK</th>
                                <th>Action</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($detail_spk as $detspk)
                              <tr class="dataDetail" name="data_detail">
                                <input type="hidden" class="form-control" name="no_spk" value="" readonly>
                                <td><input class="kode_barang form-control" name="kode_barang_show" value="{{$detspk->nama_barang}} / {{$detspk->ukuran}} / {{$detspk->spesifikasi_barang}}" readonly required></td>
                                    <input type="hidden" class="kode_barang form-control" name="kode_barang" value="{{$detspk->kode_barang}}" readonly required>
                                                        <td><input type="number" class="qty_sisa form-control" name="qty_sisa" value="{{$detspk->sisa}}"></td>
                                                        <td><input type="number" class="qty form-control" name="qty" value="{{$detspk->sisa}}" required></td> <!-- placeholder="isi qty" -->
                                <td><select type="text" class="tipe_spk form-control" name="tipe_spk">
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="AA">AA</option>
                                  <option value="BB">BB</option>
                                  <option value="AB">AB</option>
                                  <option value="BA">BA</option>
                                    </select>
                                      </td>
                                <input type="hidden" class="counter_detail_sales_order" name="counter_detail_sales_order" value="{{$detspk->counter_detail_sales_order}}">
                                <td><i class="btn btn-danger btn-sm fas fa-times-circle remove"></i></td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      <div class="row no-print">
                        <div class="col-6">
                          <button type="button" class="btn btn-danger float-left" id="simpan_masal"></i>
                            Simpan SPK
                          </button>

	                        <!--</div>
			                    <div class="col-6">
                          <button type="button" class="btn btn-success float-right" id="simpan"></i>
                            Simpan
                          </button>
	                        </div>-->

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
                    no_spk: $(this).find('[name="no_spk"]').val(),
                    tgl_spk: $(this).find('[name="tgl_spk"]').val(),
                    no_sales_order: $(this).find('[name="no_so"]').val(),
                    durasi: $(this).find('[name="durasi"]').val()
		   
                };
                }).get();

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    no_spk: $(this).find('[name="no_spk"]').val(),
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    qty: $(this).find('[name="qty"]').val(),
                    no_detail_sales_order: $(this).find('[name="counter_detail_sales_order"]').val(),
                    tipe_spk: $(this).find('[name="tipe_spk"]').val()
                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader.concat(dataDetail);
                console.log(data);
                if(data){
                  $.ajax({
                      url: '{{url('/spk/store_detail_spk')}}',
                      type: 'post',
                      data: JSON.stringify(data),
                      dataType: "json",
                      success: function(data){
                        // console.log(Response);
                        window.location = "{{url('/spk')}}";
                      }
                  });
                }else{
                    alert('Fill all fields');
                }
              }else {
                  alert('Tidak bisa menyimpan data . Harap isi data dengan benar !!!');
              }
            });


	    //simpan masal
            //validasi form kosong
            $('#simpan_masal').click(function(e) {
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
                    no_spk: $(this).find('[name="no_spk"]').val(),
                    tgl_spk: $(this).find('[name="tgl_spk"]').val(),
                    no_sales_order: $(this).find('[name="no_so"]').val(),
                    durasi: $(this).find('[name="durasi"]').val(),
		    tipe_spk: $(this).find('[name="tipe_spk"]').val()
                };
                }).get();

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    no_spk: $(this).find('[name="no_spk"]').val(),
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    qty: $(this).find('[name="qty"]').val(),
		    tipe_spk: $(this).find('[name="tipe_spk"]').val(),
                    no_detail_sales_order: $(this).find('[name="counter_detail_sales_order"]').val()
                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader.concat(dataDetail);
                console.log(data);
                if(data){
                  $.ajax({
                      url: '{{url('/spk/simpan-masal')}}',
                      type: 'post',
                      data: JSON.stringify(data),
                      dataType: "json",
                      beforeSend: function(){
			  $('#simpan_masal').html("Processing ...").attr('disabled', true);
			},
                      success: function(data){
                        alert(data.status);
                        window.location = "{{url('/spk')}}";
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
