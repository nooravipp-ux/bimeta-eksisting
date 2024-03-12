@extends('adminlte::page')

@section('content')
<div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <strong>Chart Of Account</strong> 
                </div>
                <div class="card-body">
                    <form method="post" name="Form" onsubmit="return validateForm()" action="{{ route('finance.store') }}">
 
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Jenis</label>
                        
                        

                        <div class="section colm colm20">
                            <label class="field select">
                                <select id="jenis" name="jenis" onchange = "change_id()"required>
                                    <option value="-" > - </option>
                                     <option value='ASET' >Aset</option>
                                     <option value='KEWAJIBAN' >Kewajiban</option>
                                     <option value='HPP' >Harga Pokok Penjualan</option>
                                     <option value='BIAYA OPERASIONAL'>Biaya Operasional</option>
                                  </select>
                                                          
                            </label>
                         </div> 
                        <div class="form-group">




                            <label>Sub Jenis</label>
                            
                         <div class="section colm colm20">
                             <label class="field select">
                                 <select id="SUB" name ="sub" >
                                     <option value='-'>-</option>
                                     <option value='ASET LANCAR'>Aset Lancar</option>
                                     <option value='ASET TETAP'>Aset Tetap</option>
                                     <option value='KEWAJIBAN'>Kewajiban</option>
                                     <option value='EKUITAS'>Ekuitas</option>
                                     <option value='PENJUALAN'>Penjualan</option>
                                     <option value='HPP'>Harga Pokok Penjualan</option>
                                     <option value='BIAYA OPERASIONAL'>Biaya Operasional</option>
                                 </select>
                                </label>

                                <div class="form-group">
                            <label>Saldo Normal</label>
                            
                         <div class="section colm colm20">
                             <label class="field select">
                                 <select id="header" name ="header" >
                                     <option value='-'>-</option>
                                     <option value='D'>Debit</option>
                                     <option value='K'>Kredit</option>
                                 </select>
                                </label>



                        <div class="form-group">
                            <label>Kode Perkiraan</label>
                            <p></p>
                            <input id="no_coa_header" maxlength="4" size="4" type = "text" name="no_coa_header" >&nbsp;&nbsp;&nbsp;<input id="no_coa" type="text" name="no_coa" >
                            
    
                         
                        </div>
                        <div class="form-group">
                                <label>Deskripsi Kode Perkiraan</label>
                                <input type="text" name="deskripsi_coa" class="form-control">
                            </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" onsubmit="return validateForm()" value="Simpan">
                        </div>
 
                    
                    </form>
 
                </div>
            </div>
        </div>
@endsection

@section('plugin_js')
<script>
function change_id()
{
//Please add Jquery 
var jenis_coa = document.getElementById('jenis');
var input_value_coa 
//document.write(agung.value);
if(jenis_coa.value=="ASET")
{
    document.getElementById("no_coa_header").value = "1";
        }else if(jenis_coa.value=="KEWAJIBAN") {
            document.getElementById("no_coa_header").value = "2";
        }else if(jenis_coa.value=="HPP"){
            document.getElementById("no_coa_header").value = "4";
        }else if(jenis_coa.value=="BIAYA OPERASIONAL"){
            document.getElementById("no_coa_header").value = "6";
        }

}

</script>
<script type="text/javascript">
  function validateForm() {
      //document.write("agung prayogo");
      var jenis_coa = document.getElementById('jenis');
    // document.write(document.getElementById('jenis'));
    var a = document.forms["Form"]["jenis"].value;
    //document.write(a);
    var b = document.forms["Form"]["sub"].value;
    //document.write(b);
    var c = document.forms["Form"]["header"].value;
    //document.write(c);
    var d = document.forms["Form"]["no_coa_header"].value;
    //document.write(d);
    var f = document.forms["Form"]["no_coa"].value;
    //document.write(f);
    var e = document.forms["Form"]["deskripsi_coa"].value;
    //document.write(e);
    if (a == null || a == "-", b == null || b == "-", c == null || c == "-", d == null || d == "", e == null || e == "", f=="" || f=="") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
</script>

@endsection
