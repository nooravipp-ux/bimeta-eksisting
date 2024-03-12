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
			<form method="POST" action="{{url('/production/progres-produksi/update')}}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-8">
								<div class="form-group row">
									<label for="no_so" class="col-sm-3 col-form-label">NO SPK</label>
									<div class="col-sm">
										<input type="text" class="form-control" id="no_spk" name="no_spk" value="{{$dataed->no_spk}}" readonly required>
									</div>
								</div>
								<div class="form-group row">
									<label for="tgl_period" class="col-sm-3 col-form-label">TGL PRODUKSI</label>
									<div class="col-sm">
									<input type="date" class="form-control" id="tgl_prod" name="tgl_prod" value="{{$dataed->tgl_prod}}" readonly required>
									</div>
								</div>
								<div class="form-group row">
									<label for="SPESIFIKASI" class="col-sm-3 col-form-label">SPESIFIKASI</label>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">L</span>
											</div>
											<input type="text" class="form-control" name="lebar" value="{{$dataed->lebar}}" placeholder="Lebar">
										</div>                                
									</div>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">P</span>
											</div>
											<input type="text" class="form-control" name="panjang" value="{{$dataed->panjang}}" placeholder="Panjang">
										</div>                                
									</div>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
													<span class="input-group-text">K</span>
											</div>
											<input type="text" class="form-control" name="kwalitas" value="{{$dataed->kwalitas}}" placeholder="Kualitas">
										</div>                                
									</div>
								</div>

								<div class="form-group row">
									<label for="jumlah" class="col-sm-3 col-form-label">JUMLAH</label>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">BOX</span>
											</div>
											<input type="text" class="form-control" name="jumlah_box" value="{{$dataed->jumlah_box}}">
										</div>                                
									</div>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">SHEET</span>
											</div>
											<input type="text" class="form-control" name="jumlah_sheet" value="{{$dataed->jumlah_sheet}}">
										</div>                                
									</div>
								</div>
								<div class="form-group row">
									<label for="STATUS PROGRES" class="col-sm-3 col-form-label">Status Progress</label>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">COR</span>
											</div>
											<input type="text" class="form-control" name="cor" value="{{$dataed->cor}}">
										</div>                                
									</div>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">SLITTER</span>
											</div>
											<input type="text" class="form-control" name="slitter" value="{{$dataed->slitter}}">
										</div>                                
									</div>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
													<span class="input-group-text">PON</span>
											</div>
											<input type="text" class="form-control" name="pon" value="{{$dataed->pon}}">
										</div>                                
									</div>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
													<span class="input-group-text">COAK</span>
											</div>
											<input type="text" class="form-control" name="coak" value="{{$dataed->coak}}">
										</div>                                
									</div>
								</div>
								<div class="form-group row">
									<label for="STATUS PROGRES" class="col-sm-3 col-form-label"></label>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">PRINT</span>
											</div>
											<input type="text" class="form-control" name="print" value="{{$dataed->print}}">
										</div>                                
									</div>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">SLOTTER</span>
											</div>
											<input type="text" class="form-control" name="slotter" value="{{$dataed->slotter}}">
										</div>                                
									</div>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
													<span class="input-group-text">LEM</span>
											</div>
											<input type="text" class="form-control" name="lem" value="{{$dataed->lem}}">
										</div>                                
									</div>
									<div class="col-sm">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
													<span class="input-group-text">KANCING</span>
											</div>
											<input type="text" class="form-control" name="kancing" value="{{$dataed->kancing}}">
										</div>                                
									</div>
								</div>
								<div class="form-group row">
									<label for="jumlah" class="col-sm-3 col-form-label"></label>
									<div class="col-sm-2">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">LAMINASI</span>
											</div>
											<input type="text" class="form-control" name="laminasi" value="{{$dataed->laminasi}}">
										</div>                                
									</div>
									<div class="col-sm-2">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">KUPAS</span>
											</div>
											<input type="text" class="form-control" name="kupas" value="{{$dataed->kupas}}">
										</div>                                
									</div>
									<div class="col-sm-2">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">TRIPLE</span>
											</div>
											<input type="text" class="form-control" name="triple" value="{{$dataed->triple}}">
										</div>                                
									</div>
								</div>
								<div class="form-group row">
									<label for="jumlah" class="col-sm-3 col-form-label">JUMLAH KIRIM</label>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name="jml_kirim" value="{{$dataed->jml_kirim}}">
										</div>                                
									</div>
								</div>

								<div class="form-group row">
									<label for="jumlah" class="col-sm-3 col-form-label">NO.INV</label>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name="no_inv" value="{{$dataed->no_inv}}">
										</div>                                
									</div>
								</div>
								<div class="form-group row">
									<label for="jumlah" class="col-sm-3 col-form-label">TGL PENGIRIMAN</label>
									<div class="col-sm-3">
										<div class="input-group mb-3">
											<input type="date" class="form-control" name="tgl_pengiriman" value="{{$dataed->tgl_pengiriman}}">
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
