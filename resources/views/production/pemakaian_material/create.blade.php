@extends('adminlte::page')
@section('adminlte_css')
<style>
    .data-header{
        border: 1px solid #f5f5ef;
    }
    .select2-offscreen {
        width:240px;
    }
    .select2-offscreen-qty {
        width:130px;
    }

    .select2-offscreen-no {
        width:70px;
    }
    .select2-offscreen-total-harga {
      width: 180px;
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
                    Input Pemakaian Material
                    <!-- <small class="float-right">NO. {{$no_pemakaian}}</small> -->
                </h4>
            </div>

            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
                <div class="row data-header">
                    <div class="col-sm-6">
                        <form class="dataHeader">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="penerima" class="col-sm-5 col-form-label">TGL PEMAKAIAN</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control" id="tgl_pemakaian" name="tgl_pemakaian" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_pengadaan" class="col-sm-5 col-form-label">IN CHARGE</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" id="in_charge" name="in_charge">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_pengadaan" class="col-sm-5 col-form-label">TOTAL SPK</label>
                                <div class="col-sm">
                                    <input type="number" class="form-control" id="total_spk" name="total_spk" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_gr" class="col-sm-5 col-form-label">TOTAL PEMAKAIAN MATERIAL (KG)</label>
                                <div class="col-sm">
                                    <input type="number" class="form-control" id="total_pemakaian_material" name="total_pemakaian_material" readonly>
                                    <input type="hidden" clas="form0-contro">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                    
                    </div>
                </div> 
                <!-- row detail spk-->
                <div class="row">
                    <div class="col-md-6">
                      <form name="form_detail_spk"> 
                      <!--{{ csrf_field() }} --> 
                      <div class="row msg" style="display:none">Saved</div>
                      <div class="row table-detail-input">
                        <table class="table table-sm" id="detail-table">
                          <thead>
                            <tr class="text-center">
                              <th class="select2-offscreen">SPK</th>
                              <th class="select2-offscreen-qty">Qty</th>
                              <th class="select2-offscreen-qty">Persentase</th>
                              <th class="select2-offscreen-qty">Medium (Kg)</th>
                              <th class="select2-offscreen-qty">Kraft (Kg)</th>
                              <!--<th class="select2-offscreen-total-harga">Harga Satuan</th>-->
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="table-body-spk">
                            <tr class="dataDetail" name="data_detail">
                              <td style="width:320px"><select type="text" class="no_spk form-control" name="no_spk"></select></td>
                              <td><input type="number" class="qty form-control" name="qty" required></td>
                              <td><input type="number" class="persentase form-control" name="persentase" required></td>
                              <td><input type="number" class="medium form-control" name="medium" required></td>
                              <td><input type="number" class="kraft form-control" name="kraft" required></td>
                              <input type="hidden" class="harga_satuan form-control" name="harga_satuan">
                              <td><i class="btn btn-primary addRowSpk">+</i></td>
                              
                            </tr>
                          </tbody>
                          <tfoot>
                              <tr>
                                  <td><input type="text" class="form-control-plaintext" value="Jumlah Total :"></td>
                                  <td><input type="text" class="form-control-plaintext" id="total-spk"></td>
                                  <td><input type="text" class="form-control-plaintext" id="persen"></td>
                                  <td><input type="text" class="form-control-plaintext" id="total-medium"></td>
                                  <td><input type="text" class="form-control-plaintext" id="total-kraft"></td>
                              </tr>
                          </tfoot>
                        </table>	 
                      </div>
                      <div class="row no-print">
                          <div class="col-6">
                            <button type="button" class="btn btn-primary" id="simpan"></i>
                              SIMPAN
                            </button>
                          </div>
                          <div class="col-6">
                            <button type="button" class="btn btn-success float-right" id="hitung-spk"></i>
                              HITUNG
                            </button>
                          </div>
                      </div>
                    </form><br>
                </div>
      
                </div>
                <!-- end of detail spk -->

                <!-- row medium -->
                <div class="row">
                    <div class="col-md-7">
                    <form name="form_detail"> 
                      <!--{{ csrf_field() }} --> 
                      <div class="row msg" style="display:none">Saved</div>
                      <div class="row table-detail-input">
                        <table class="table table-sm" id="detail-table">
                          <thead>
                            <tr class="text-center">
                              <th class="select2-offscreen-no">No.</th>
                              <th class="select2-offscreen">Jenis Barang (Medium)</th>
                              <th class="select2-offscreen-qty">Masuk Mesin (Kg)</th>
                              <th class="select2-offscreen-qty">Sisa Timbangan(Kg)</th>
                              <th class="select2-offscreen-qty">Terpakai (Kg)</th>
                              <!--<th class="select2-offscreen-total-harga">Harga Satuan</th>-->
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="table-body-raw">
                            <tr class="dataDetailMedium" name="data_detail">
                              <td><input type="number" class="no form-control" name="no" required></td>
                              <td style="width:420px"><select type="text" class="kode_barang form-control" name="kode_barang"></select></td>
                              <td><input type="number" class="masuk-mesin form-control" name="masuk-mesin" required></td>
                              <td><input type="text" class="sisa-timbangan form-control" name="sisa-timbangan" required></td>
                              <td><input type="number" class="qty form-control" name="qty" required></td>
                              <td><i class="btn btn-primary addRowRaw">+</i></td>
                              
                            </tr>
                          </tbody>
                        </table>	 
                      </div>
                      <div class="row no-print">
                          <div class="col-12">
                            <button type="button" class="btn btn-success float-right" id="hitung_medium"></i>
                              HITUNG
                            </button>
                          </div>
                      </div>
                    </form>
                    </div>
                </div>
                <!-- end of row medium -->

                <!--  row craft -->
                <div class="row">
                    <div class="col-md-7">
                      <form name="form_detail"> 
                        <!--{{ csrf_field() }} --> 
                        <div class="row msg" style="display:none">Saved</div>
                        <div class="row table-detail-input">
                          <table class="table table-sm" id="detail-table">
                            <thead>
                              <tr class="text-center">
                                <th class="select2-offscreen-no">No.</th>
                                <th class="select2-offscreen">Jenis Barang (Kraft)</th>
                                <th class="select2-offscreen-qty">Masuk Mesin (Kg)</th>
                                <th class="select2-offscreen-qty">Sisa Timbangan(Kg)</th>
                                <th class="select2-offscreen-qty">Terpakai (Kg)</th>
                                <!--<th class="select2-offscreen-total-harga">Harga Satuan</th>-->
                                <th></th>
                              </tr>
                            </thead>
                            <tbody class="table-body-kraft">
                              <tr class="dataDetailKraft" name="data_detail">
                                <td><input type="number" class="no form-control" name="no" required></td>
                                <td style="width:420px"><select type="text" class="kode_barang form-control" name="kode_barang"></select></td>
                                <td><input type="number" class="masuk-mesin form-control" name="masuk-mesin" required></td>
                                <td><input type="text" class="sisa-timbangan form-control" name="sisa-timbangan" required></td>
                                <td><input type="number" class="qty form-control" name="qty" required></td>
                                <td><i class="btn btn-primary addRowKraft">+</i></td>
                                
                              </tr>
                            </tbody>
                          </table>	 
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                              <button type="button" class="btn btn-success float-right" id="hitung_kraft"></i>
                                HITUNG
                              </button>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
                <!-- end of row craft -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div> 

	 
            
@endsection

@section('plugin_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/JavaScript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var urutan = 1;

$(document).ready(function() {
        //add row of table
        $('.addRowSpk').on('click', function() {
              addRowSpk();
        });
	
	      $('.addRowRaw').on('click', function() {
              addRowRaw();
        });
	
	      $('.addRowKraft').on('click', function() {
              addRowKraft();
        });
        $('.kode_barang').select2({
                  placeholder: '- Pilih Barang -',
                  ajax: {
		    
                    url: '{{url('/getKodeBarangRW')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+' / '+barang.ukuran+' / '+barang.spesifikasi_barang
                          
                          }
                        })
                      };
                    },
                    cache: true
                  }
                });

	$('.no_spk').select2({
                  placeholder: '- No SPK -',
                  ajax: {
		    
                    url: '{{url('/production/get_no_spk')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (spk) {
                          return {
                            id: spk.no_spk,
                            text: spk.no_spk                          
                          }
                        })
                      };
                    },
                    cache: true
                  }
                });


        function addRowSpk(params) {
              var tr = '<tr class="dataDetail" name="data_detail">'+
                        '<td><select class="no_spk form-control" name="no_spk"></select></td>'+
                        '<td><input type="number" class="qty form-control" name="qty" required></td>'+
                        '<td><input type="number" class="persentase form-control" name="persentase" required></td>'+
                        '<td><input type="number" class="medium form-control" name="medium" required></td>'+
                        '<td><input type="number" class="kraft form-control" name="kraft" required></td>'+
                        '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                      '</tr>';
              $('tbody.table-body-spk').append(tr);
              //ajax for get kode barang on select box
              $('.no_spk').select2({
                  placeholder: '- No SPK -',
                  ajax: {
                    url: '{{url('/production/get_no_spk')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (spk) {
                          return {
                            id: spk.no_spk,
                            text: spk.no_spk                          
                          }
                        })
                      };
                    },
                    cache: true
                  }
                });
        };
	
	function addRowRaw(params) {
              var tr = '<tr class="dataDetailMedium" name="data_detail">'+
                        '<td><input type="number" class="no form-control" name="no" required></td>'+
                        '<td><select type="text" class="kode_barang form-control" name="kode_barang"></select></td>'+
                        '<td><input type="number" class="masuk-mesin form-control" name="masuk-mesin" required></td>'+
                        '<td><input type="text" class="sisa-timbangan form-control" name="sisa-timbangan" required></td>'+
                        '<td><input type="number" class="form-control" name="qty" required></td>'+
                        '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                      '</tr>';
              $('tbody.table-body-raw').append(tr);
              //ajax for get kode barang on select box
              $('.kode_barang').select2({
                  placeholder: '- Pilih Barang -',
                  ajax: {
                    url: '{{url('/getKodeBarangRW')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+' / '+barang.ukuran+' / '+barang.spesifikasi_barang                          
                          }
                        })
                      };
                    },
                    cache: true
                  }
                });
        };
	
	function addRowKraft(params) {
              var tr = '<tr class="dataDetailKraft" name="data_detail">'+
                '<td><input type="number" class="no form-control" name="no" required></td>'+
                        '<td><select type="text" class="kode_barang form-control" name="kode_barang"></select></td>'+
                        '<td><input type="number" class="masuk-mesin form-control" name="masuk-mesin" required></td>'+
                        '<td><input type="text" class="sisa-timbangan form-control" name="sisa-timbangan" required></td>'+
                        '<td><input type="number" class="form-control" name="qty" required></td>'+
                        '<td><i class="btn btn-danger btn-sm fas fa-times-circle remove"> </i></td>'+
                      '</tr>';
              $('tbody.table-body-kraft').append(tr);
              //ajax for get kode barang on select box
              $('.kode_barang').select2({
                  placeholder: '- Pilih Barang -',
                  ajax: {
                    url: '{{url('/getKodeBarangRW')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+' / '+barang.ukuran+' / '+barang.spesifikasi_barang
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
        $('#hitung-spk').click(function(e) {
              e.preventDefault();
              var $fields = [ $('tr input.qty')];
              var $emptyFields;
              
              for(var i=0;i< $fields.length;i++){
              $emptyFields = $fields[i].filter(function(i,element) {
                  return $.trim($(this).val()) === 'u';
              });
              }
              if (!$emptyFields.length) {
                  //collect data form input detail
           

                var dataDetail = $('.dataDetail').map(function() {
                    return {
		                    no_spk: $(this).find('[name="no_spk"]').val()
                    };
                }).get();

                var data = dataDetail;
                if(data){
                    $.ajax({
                        url: '{{url('/production/pemakaian-material/store')}}',
                        type: 'post',
                        data: JSON.stringify(data),
                        dataType: "json",
                        success: function(data){
                          if(data.error){
                              alert(data.error);
                          }else{
                              var jumlah_qty_spk = 0;
                              $('.dataDetail').map(function(i) {
                                  $(this).find('[name="qty"]').val(data[i]["qty"]);
                                  jumlah_qty_spk = jumlah_qty_spk + parseInt(data[i]["qty"]);
                              });
                              $('#total-spk').val(jumlah_qty_spk);
                              $('#total_spk').val(jumlah_qty_spk);
                              $('.dataDetail').map(function(i) {
                                  var qty = $(this).find('[name="qty"]').val();
                                  var num = parseFloat(qty)/jumlah_qty_spk * 100;
                                  $(this).find('[name="persentase"]').val(num.toFixed(2));
					
                   		        });
                              $('#persen').val("100 %");
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
	
	

	$('#hitung_medium').click(function(){
	    var jumlah_medium = 0;
	    $('.dataDetailMedium').map(function() {
          var qty = $(this).find('[name="qty"]').val();
          jumlah_medium = jumlah_medium + parseInt(qty);
      });
	    $('#total-medium').val(jumlah_medium);
	    
      $('.dataDetail').map(function(i) {
          var persentase = $(this).find('[name="persentase"]').val();
          var num = parseFloat(persentase)*jumlah_medium/100;
		      $(this).find('[name="medium"]').val(num.toFixed(2));
					
      });
		
	});

	$('#hitung_kraft').click(function(){
	    var jumlah_kraft = 0;
	    $('.dataDetailKraft').map(function() {
          var qty = $(this).find('[name="qty"]').val();
          jumlah_kraft = jumlah_kraft + parseInt(qty);
      });
	    $('#total-kraft').val(jumlah_kraft);
	    
      $('.dataDetail').map(function(i) {
          var persentase = $(this).find('[name="persentase"]').val();
          var num = parseFloat(persentase)*jumlah_kraft/100;
          $(this).find('[name="kraft"]').val(num.toFixed(2));
					
      });
		
	});

	$('#simpan').click(function(){
      var jumlah_medium = 0;
      var jumlah_kraft = 0;
      
      $('.dataDetailMedium').map(function() {
          var qty = $(this).find('[name="qty"]').val();
          jumlah_medium = jumlah_medium + parseInt(qty);
      });
      $('.dataDetailKraft').map(function() {
          var qty = $(this).find('[name="qty"]').val();
          jumlah_kraft = jumlah_kraft + parseInt(qty);
      });
      
      $('#total_pemakaian_material').val(jumlah_medium + jumlah_kraft);
	    var dataHeader = $('.dataHeader').map(function() {
                    return {
                    id_pemakaian_material: $(this).find('[name="id_pemakaian_material"]').val(),
                    tgl_pemakaian: $(this).find('[name="tgl_pemakaian"]').val(),
                    in_charge: $(this).find('[name="in_charge"]').val(),
                    total_spk: $(this).find('[name="total_spk"]').val()
                };
              }).get();	
      var dataDetailSpk = $('.dataDetail').map(function() {
                    return {
                    no_spk: $(this).find('[name="no_spk"]').val(),
                    qty_spk: $(this).find('[name="qty"]').val(),
                    persentase: $(this).find('[name="persentase"]').val(),
                    medium: $(this).find('[name="medium"]').val(),
                    kraft: $(this).find('[name="kraft"]').val()
                };
              }).get();
      var dataDetailMedium = $('.dataDetailMedium').map(function() {
                    return {
                    no: $(this).find('[name="no"]').val(),
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    masuk_mesin: $(this).find('[name="masuk-mesin"]').val(),
                    sisa_timbangan: $(this).find('[name="sisa-timbangan"]').val(),
                    qty: $(this).find('[name="qty"]').val()
                };
              }).get();
      var dataDetailKraft = $('.dataDetailKraft').map(function() {
                    return {
                    no: $(this).find('[name="no"]').val(),
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    masuk_mesin: $(this).find('[name="masuk-mesin"]').val(),
                    sisa_timbangan: $(this).find('[name="sisa-timbangan"]').val(),
                    qty: $(this).find('[name="qty"]').val()
                };
              }).get();

      //var data = JSON.stringify(dataHeader);

      var dataMaterial = dataDetailMedium.concat(dataDetailKraft);
      var data = dataHeader.concat(dataDetailSpk);
      var data1 = data.concat(dataMaterial);

      console.log(data1);      
      $.ajax({
          url: '{{url('/production/pemakaian-material/store-pemakaian')}}',
          type: 'post',
          data: JSON.stringify(data1),
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
                  window.location = "{{url('/production/pemakaian-material')}}";
              }
          }
      });
      
	});

});
</script>

@endsection

