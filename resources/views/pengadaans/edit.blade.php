@extends('adminlte::page')
@section('adminlte_css')
<style>
    .select2-offscreen {
        width:460px;
    }
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
                     EDIT PENGADAAN  
                    <small class="float-right">NO. {{$header->id_pengadaan}}</small>
                </h4>
            </div>
      
            <!-- Form Input pengadaan-->
            <div class="invoice p-3 mb-3">
              <form class="dataHeader">
                  {{ csrf_field() }}
                
                <div class="row">          
                  <div class="col-sm-3 invoice-col">
                      <div class="form-group">
                          <label>Kode Supplier</label>
                          <select type="text" class="form-control" name="kode_supplier" id="kode_supplier">
			      <option value="{{$header->kode_supplier}}" selected="selected">{{$header->nama_supplier}}</option>			  
			  </select>
			  <input type="hidden" name="id_pengadaan" class="form-control" value="{{$header->id_pengadaan}}" required>
                      </div>
                  </div>
                  
                  <div class="col-sm-2 invoice-col">
                      <div class="form-group">
                          <label>Tgl Pembelian</label>
                          <input type="date" name="tgl_pembelian" class="form-control" value="{{$header->tgl_pembelian}}" required>  
                      </div>
                  </div>
                  
                  <div class="col-sm-2 invoice-col">
                      <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="status">
                              <option value="OPEN" <?php if ($header->status == 'OPEN') echo "selected"; ?>>OPEN</option>
                              <option value="CLOSE" <?php if ($header->status == 'CLOSE') echo "selected"; ?>>CLOSE</option>
                              <option value="CANCEL" <?php if ($header->status == 'CANCEL') echo "selected"; ?>>CANCEL</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-1 invoice-col">
                      <div class="form-group">
                          <label>Pajak</label>
                          <select class="form-control" name="pajak" id="pajak" value="V0">
                               <option value="V0" <?php if ($header->pajak == 'V0') echo "selected";?>>V0</option>
                               <option value="V1" <?php if ($header->pajak == 'V1') echo "selected";?>>V1</option>
                          </select>
                      </div>
                  </div> 
                </div>
               
              </form> 
	      <div class="row mt-4">
                  <div>EDIT DETAIL</h4>
                  </div>
              </div>

              <!-- row detail pengadaan-->
              <form class=""> 
                <table id="pengadaan" class="table table-responsive">
                  <thead>
                      <tr class="text-center">
                        <th class="select2-offscreen">Kode Barang</th>
                        <th class="select2-offscreen-qty">Qty (Kg)</th>
                        <th class="select2-offscreen-qty">Harga Satuan</th>
                        <th align="center"><span id="amount" class="amount">Total</span> </th>
                        <th><i class="btn btn-primary addRow">+</i></th>
                      </tr>
                  </thead>
                  <tbody class="table-body">
                    @foreach($detail as $data)
                      <tr class="dataDetail">
                          <td><select type="text" class="kode_barang form-control" name="kode_barang">
				  <option value="{{$data->kode_barang}}" selected="selected">{{$data->nama_barang}}{{$data->ukuran}}</option>
			      </select></td>
                          <td><input type="number" class="qty form-control" name="qty" value="{{$data->qty}}"></td>
                          <td><input type="number" class="harga_satuan form-control" name="harga_satuan" value="{{$data->harga_satuan}}"></td>
                          <td align="right"  class="jumlah" name="jumlah_item" id="jumlah" style="width: 159px;"></td>
                          <input type="hidden" class="form-control" name="kode_pembelian" value="{{$data->id_pengadaan}}">
                          <td><i class="btn btn-danger remove">-</i></td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                      <tr class="text-center"><td colspan="2"></td>
                          <td align="right">
                              <h5><span class="text-success">Sub Total</span></h3>
                          </td>
                          <td align="right" id="subtotal" class="subtotal"></td>
                      </tr class="text-center">
                      <tr class="text-center"><td colspan="2"></td>
                          <td align="right">
                              <h5><span class="text-success">pajak (11%)</span></h3>
                          </td>
                          <td align="right" id="tot_pajak" class="tot_pajak"></td>
                      </tr class="text-center">
                      <tr class="text-center"><td colspan="2"></td>
                          <td align="right">
                              <h5><span class="text-success">Grand Total</span></h3>
                          </td>
                          <td align="right" id="grand_total" class="grand_total"></td>
                      </tr>
                  </tfoot>
                </table>
                <div class="row no-print">
                  <div class="col-12">
                    <button type="button" class="btn btn-success float-right" id="update"></i>
                      Update
                    </button>
                  </div>
                </div>
              </form>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>  
  </section>
            
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

$('#kode_supplier').select2({
    placeholder: '- Pilih Supplier -',
    ajax: {
      url: '{{url('/getDataSupplier')}}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              id: item.kode_supplier,
              text: item.kode_supplier +"/"+ item.nama_supplier
            
            }
          })
        };
      },
      cache: true
    }
  });

$('.kode_barang').select2({
                  placeholder: 'Cari...',
                  ajax: {
                    url: '{{url('/getKodeBarangRW')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+' '+barang.ukuran
                          
                          }
                        })
                      };
                    },
                    cache: true
                  }
                });



$(document).ready(function(){
    $('.addRow').on('click', function() {
        addRow();
            total();
            $('.qty').on('keyup', function() {
                total();
            });
            $('.harga_satuan').on('keyup', function() {
                total();
            });
            pajak();
              
    });
            function addRow(params) {
              var tr = '<tr class="dataDetail">'+
                          '<td><select class="kode_barang form-control" name="kode_barang" id="kode_barang"></select></td>'+
                          '<td><input type="number" class="qty form-control" name="qty" id="qty1" required></td>'+
                          '<td><input type="number" class="harga_satuan form-control" name="harga_satuan" required></td>'+
                          '<td align="right" class="jumlah" name="jumlah_item" id="jumlah"></td>'+
                          '<input type="hidden" class="form-control" name="kode_pembelian" value="{{$data->id_pengadaan}}">'+
                          '<td><i class="btn btn-danger remove">-</i></td>'+
                      '</tr>';
                $('tbody.table-body').append(tr);

                $('.kode_barang').select2({
                  placeholder: 'Cari...',
                  ajax: {
                    url: '{{url('/getKodeBarangRW')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (barang) {
                          $nama = barang.nama_barang;
                          return {
                            id: barang.kode_barang,
                            text: barang.nama_barang+' '+barang.ukuran                          
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
              total();
              $('.qty').on('keyup', function() {
                  total();
              });
              $('.harga_satuan').on('keyup', function() {
                  total();
              });
              pajak();
            });

            $('#update').click(function(){

                var dataHeader = $('.dataHeader').map(function() {
                    return {
                    id_pengadaan: $(this).find('[name="id_pengadaan"]').val(),
                    kode_supplier: $(this).find('[name="kode_supplier"]').val(),
                    tgl_pembelian: $(this).find('[name="tgl_pembelian"]').val(),
                    status: $(this).find('[name="status"]').val(),
                    pajak: $(this).find('[name="pajak"]').val(),
                    tax_total: $('.tot_pajak').text(),
                    sub_total: $('.subtotal').text()
                };
                }).get(); 

                var dataDetail = $('.dataDetail').map(function() {
                    return {
                    kode_pembelian: $(this).find('[name="kode_pembelian"]').val(),
                    kode_barang: $(this).find('[name="kode_barang"]').val(),
                    qty: $(this).find('[name="qty"]').val(),
                    harga_satuan: $(this).find('[name="harga_satuan"]').val()
                };
                }).get();

                console.log(dataHeader);
                var data = dataHeader.concat(dataDetail);
                console.log(data);
                
                
                if(data){
                  $.ajax({
                      url: '{{url('/pengadaans/update-detail')}}',
                      type: 'post',
                      data: JSON.stringify(data),
                      dataType: "json",
                      success: function(data){
                        // console.log(Response);
                        alert('Data was Updated !!!');
                        window.location = "{{url('/pengadaans')}}";
                      }
                  });
                }else{
                    alert('Fill all fields');
                } 
            });

            //perhitungan pajak
            $("#pajak").ready(function(){
                if($(this).val() == "V0"){
                    $('.tot_pajak').val($('.sub_total').val()*0);
                    var sub_total = parseInt($('.sub_total').val());
                    $('.jumlah_total').val(sub_total + parseInt($('.tot_pajak').val()));
                }else{
                    $('.tot_pajak').val($('.sub_total').val()*11/100);
                    var sub_total = parseInt($('.sub_total').val());
                    $('.jumlah_total').val(sub_total + parseInt($('.tot_pajak').val())); 
                    
                }
            });
            //perhitungan sub_total
          total();
          $('.qty').on('keyup', function() {
              total();
          });
          $('.harga_satuan').on('keyup', function() {
              total();
          });

          pajak();

});
//fungsi untuk menghitung total item dan sub total
function total(){
    var sum = 0;
    $('#pengadaan > tbody  > tr').each(function() {
        var qty = $(this).find('.qty').val();
        var harga_satuan = $(this).find('.harga_satuan').val();
        var jumlah = (qty*harga_satuan)
        sum+=jumlah;
        $(this).find('.jumlah').text(''+jumlah);
    });
    $('#subtotal').text(sum);
}

function pajak(){
    $("#pajak").change(function(){
        if($(this).val() == "V0"){
            $('#tot_pajak').text(parseInt($('#subtotal').text())*0);
            var sub_total = parseInt($('#subtotal').text());
            $('#grand_total').text(sub_total + parseInt($('#tot_pajak').text()));
        }else{
            var sub_total = parseInt($('#subtotal').text());
            $('#tot_pajak').text(sub_total*11/100);
            var tot_pajak = parseInt($('#tot_pajak').text());
            $('#grand_total').text(sub_total+tot_pajak); 
                
        }
    });
}
</script>
@endsection