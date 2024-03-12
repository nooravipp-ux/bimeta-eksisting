@extends('adminlte::page')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
                <h4>
                     Input Progress Produksi Individu
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
                                <label for="tgl_period" class="col-sm-3 col-form-label">TGL PERIODE</label>
                                <div class="col-sm">
                        		<input type="date" class="form-control" id="tgl_period" name="tgl_period" required>
                                </div>
                            </div>
			     <div class="form-group row">
                                <label for="nama_operator" class="col-sm-3 col-form-label">NAMA OPERATOR</label>
                                <div class="col-sm">
                        		<input type="text" class="form-control" id="nama_operator" name="nama_operator" required>
                                </div>
                            </div>

			    <div class="form-group row">
                                <label for="status_progres" class="col-sm-3 col-form-label">STATUS PROGRESS</label>
                                <div class="col-sm">
                  			<select class="form-control" name="status_progres">
						<option value="cor">COR</option>
						<option value="slitter">SLITTER</option>
						<option value="pon">PON</option>
						<option value="coak">COAK</option>
						<option value="print">PRINT</option>
						<option value="slotter">SLOTTER</option>
						<option value="lem">LEM</option>
						<option value="kancing">KANCING</option>
                        <option value="laminasi">LAMINASI</option>
						<option value="kupas">KUPAS</option>
						<option value="triple">TRIPLE</option>
					</select>
                	                               
				</div>
				<div class="col-sm-3">
                                    <div class="input-group mb-3">
                  			<div class="input-group-prepend">
                    				<span class="input-group-text">HASIL</span>
                 			 </div>
                  			<input type="number" class="form-control" name="hasil">
                		    </div>                                
				</div>
                            </div>
			    <div class="form-group row">
                                <label for="keterangan" class="col-sm-3 col-form-label">KETERANGAN</label>
                                <div class="col-sm">
                        		<input type="text" class="form-control" id="keterangan" name="keterangan" required>
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
                    tgl_period: $(this).find('[name="tgl_period"]').val(),
     		        nama_operator: $(this).find('[name="nama_operator"]').val(),
                    status_progres: $(this).find('[name="status_progres"]').val(),
                    hasil: $(this).find('[name="hasil"]').val(),
		    keterangan: $(this).find('[name="keterangan"]').val()
                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader;
                if(data){
                  $.ajax({
                      url: '{{url('/production/progres-produksi/store_progres_harian')}}',
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
