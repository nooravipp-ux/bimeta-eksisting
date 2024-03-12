@extends('adminlte::page')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Input Progress Produksi
                    <small class="float-right"></small>
                </h4>
            </div>

            <!-- Form GR-->
            <div class="invoice p-3 mb-3">
		<form class="dataHeader">
                   {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-8">
                            <div class="form-group row">
                                <label for="no_so" class="col-sm-3 col-form-label">NO SPK</label>
                                <div class="col-sm">
                                    <select type="text" class="form-control" id="no_spk" name="no_spk" required></select>
                                </div>
                            </div>
			    <div class="form-group row">
                                <label for="tgl_period" class="col-sm-3 col-form-label">TGL PRODUKSI</label>
                                <div class="col-sm">
                        		<input type="date" class="form-control" id="tgl_prod" name="tgl_prod" required>
                                </div>
                            </div>
			     <div class="form-group row">
                                <label for="SPESIFIKASI" class="col-sm-3 col-form-label">SPESIFIKASI</label>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                  			<div class="input-group-prepend">
                    				<span class="input-group-text">L</span>
                 			 </div>
                  			<input type="text" class="form-control" name="lebar" placeholder="Lebar">
                		    </div>                                
				</div>
				<div class="col-sm-3">
                                    <div class="input-group mb-3">
                  			<div class="input-group-prepend">
                    				<span class="input-group-text">P</span>
                 			 </div>
                  			<input type="text" class="form-control" name="panjang" placeholder="Panjang">
                		    </div>                                
				</div>
				<div class="col-sm-3">
                                    <div class="input-group mb-3">
                  			<div class="input-group-prepend">
                    				<span class="input-group-text">K</span>
                 			 </div>
                  			<input type="text" class="form-control" name="kualitas" placeholder="Kualitas">
                		    </div>                                
				</div>

                            </div>

			    <div class="form-group row">
                                <label for="jumlah" class="col-sm-3 col-form-label">JUMLAH</label>
				<div class="col-sm-3">
                                    <div class="input-group mb-3">
                  			<div class="input-group-prepend">
                    				<span class="input-group-text">SHEET</span>
                 			 </div>
                  			<input type="text" class="form-control" name="jumlah_sheet">
                		    </div>                                
				</div>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                  			<div class="input-group-prepend">
                    				<span class="input-group-text">BOX</span>
                 			 </div>
                  			<input type="text" class="form-control" name="jumlah_box">
                		    </div>                                
				</div>
                            </div>
			    <div class="form-group row">
                                <label for="jumlah" class="col-sm-3 col-form-label">NO.INV</label>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                    			<input type="text" class="form-control" name="no_inv">
                		    </div>                                
				</div>
                            </div>
			    <div class="form-group row">
                                <label for="jumlah" class="col-sm-3 col-form-label">TGL PENGIRIMAN</label>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                    			<input type="date" class="form-control" name="tgl_pengiriman">
                		    </div>                                
				</div>
                            </div>

                    </div>
                </div>
		<div class="">
		    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
		</div>
	     </form>
            </div><!-- /.col -->
        </div><!-- /.row -->
      </div>

@endsection

@section('plugin_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
	$('#no_spk').select2({
            placeholder: '- Pilih Kode SPK -',
            ajax: {
            url: '{{url('/production/get_no_spk')}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (spk) {
                    return {
                    id: spk.no_spk,
                    text: spk.no_spk+' / '+spk.no_po_customer
                    
                    }
                })
                };
            },
            cache: true
            }
        });

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
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
                    tgl_prod: $(this).find('[name="tgl_prod"]').val(),
     		    lebar: $(this).find('[name="lebar"]').val(),
                    panjang: $(this).find('[name="panjang"]').val(),
                    kualitas: $(this).find('[name="kualitas"]').val(),
		    jumlah_box: $(this).find('[name="jumlah_box"]').val(),
		    jumlah_sheet: $(this).find('[name="jumlah_sheet"]').val(),
		    no_inv: $(this).find('[name="no_inv"]').val(),
		    tgl_pengiriman: $(this).find('[name="tgl_pengiriman"]').val()

                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader;
                if(data){
                  $.ajax({
                      url: '{{url('/production/progres-produksi/store')}}',
                      type: 'post',
                      data: JSON.stringify(data),
                      dataType: "json",
                      beforeSend: function(){
			  $('#simpan').html("Processing ...").attr('disabled', true);
			},
                      success: function(data){
                          if(data.error){
                              alert(data.error)	
                          }else{
                              alert(data.status);
                              window.location = "{{url('/production/progres-produksi')}}";
                          }
                          
                      }
                  });
                }else{
                    alert('Harap isi data dengan benar !!!');
                }
              }else {
                  alert('Tidak bisa menyimpan data . Harap isi data dengan benar !!!');
              }
            });	    
      });
</script>
@endsection
