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
                    Detail SPK
                    <small class="float-right">NO. {{$show_header->no_spk}}</small>
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
            <div class="row data-header">
                    <div class="col-sm-4">
                        <form class="dataHeader">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="id_pengadaan" class="col-sm-5 col-form-label">NO SO</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" name="no_so" value="{{$show_header->no_sales_order}}" readonly>
                                    <input type="hidden" class="form-control" name="no_spk" value="{{$show_header->no_spk}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="penerima" class="col-sm-5 col-form-label">TGL SPK</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control" name="tgl_spk" value="{{$show_header->tgl_spk}}" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="durasi" class="col-sm-5 col-form-label">DURASI</label>
                                <div class="col-sm">
                                    <input type="number" class="form-control" name="durasi" value="{{$show_header->durasi}}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm">
                    
                    </div>
                </div> 
              <!-- row detail pengadaan-->
	    <div class="row">
              <form name="form_detail"> 
                <!--{{ csrf_field() }} --> 
                <div class="row msg" style="display:none">Saved</div>
                <div class="row table-detail-input">
                  <table class="table table-sm text-center" id="detail-table">
                    <thead class="thead-light">
                      <tr>
                        <th class="select2-offscreen">NAMA BARANG</th>
                        <th class="select2-offscreen-total-harga">QTY</th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody class="table-body">
                    @foreach($show_detail as $show)
                      <tr class="dataDetail" name="data_detail">
			    <input type="hidden" class="form-control" name="no_spk" value="{{$show_header->no_spk}}" readonly>
                        <td><input type="text" class="kode_barang form-control" name="kode_barang_show" value="{{$show->nama_barang}} / {{$show->ukuran}}" readonly></td>
			    <input type="hidden" name="kode_barang" value="{{$show->kode_barang}}">
                        <td><input type="number" class="qty form-control" name="qty" value="{{$show->qty}}" required></td>
			<td>
			    <select type="text" class="tipe_spk form-control" name="tipe_spk">
				<option value="A" <?php if ($show->tipe_spk == 'A') echo "selected";?>>A</option>
				<option value="B" <?php if ($show->tipe_spk == 'B') echo "selected";?>>B</option>
				<option value="AA" <?php if ($show->tipe_spk == 'AA') echo "selected";?>>AA</option>
				<option value="BB" <?php if ($show->tipe_spk == 'BB') echo "selected";?>>BB</option>
				<option value="AB" <?php if ($show->tipe_spk == 'AB') echo "selected";?>>AB</option>
				<option value="BA" <?php if ($show->tipe_spk == 'BA') echo "selected";?>>BA</option>
		           </select>
			</td>
			    <input type="hidden" class="counter_detail_sales_order" name="counter_detail_sales_order" value="{{$show->no_detail_sales_order}}">
			<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"></i></td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>	 
                </div>
              </form>
	    </div>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
		    <button type="text" class="btn btn-success float-right" id="update" onClick="this.form.submit();this.disable=true;this.value='Sending ...';"></i>
                        Update
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
            $('#update').click(function(e) {
	      $('#update').attr('disabled', true);
              e.preventDefault();
              var $fields = [ $('tr input.qty')];
              var $emptyFields;
		var $button = $(this).find('button');

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
		    tipe_spk: $(this).find('[name="tipe_spk"]').val(),
                    no_detail_sales_order: $(this).find('[name="counter_detail_sales_order"]').val()
                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader.concat(dataDetail);
                console.log(data);
                if(data){
                  $.ajax({
                      url: '{{url('/production/spk/update-spk')}}',
                      type: 'post',
                      data: JSON.stringify(data),
                      dataType: "json",
                      success: function(data){
                        // console.log(Response);
			$button.attr('disabled', 'disabled').text('Sending ...');
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
