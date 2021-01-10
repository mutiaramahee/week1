@extends('layouts.content')

@section('content')
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<div class="content">

				<!-- Basic datatable -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Detail Data Participant</h5>
					</div>

					<div class="card-body">
						<fieldset class="mb-3">
							<div class="row">
								<div class="col-lg-2 text-center">
									@if ($participant->image == '')
										<img src="{{url('uploads').'/no-image.jpg'}}" class="img-fluid img-thumbnail mb-1"><br>
										<i>Gambar belum diatur</i>
									@else
										<img src="{{url('uploads').'/'.$participant->image}}" class="img-fluid img-thumbnail">
									@endif
								</div>
								<div class="col-lg-10">
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">ID Participant</div>
										<div class="col-lg-4">: 
											{{ $participant->id }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">Nama</div>
										<div class="col-lg-4">: 
											{{ $participant->name }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">Email</div>
										<div class="col-lg-4">: 
											{{ $participant->email }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">No Telepon</div>
										<div class="col-lg-4">: 
											{{ $participant->phone }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">Provinsi</div>
										<div class="col-lg-4">: 
											{{ ($participant->provinsi_name == '') ? '-' : $participant->provinsi_name }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">Kabupaten/ Kota</div>
										<div class="col-lg-4">: 
											{{ ($participant->kab_name == '') ? '-' : $participant->kab_name }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">Kecamatan</div>
										<div class="col-lg-4">: 
											{{ ($participant->kecamatan_name == '') ? '-' : $participant->kecamatan_name }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-2 font-weight-bold">Kelurahan</div>
										<div class="col-lg-4">: 
											{{ ($participant->kelurahan_name == '') ? '-' : $participant->kelurahan_name }}
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-6 "> 
											<a class="btn btn-warning" href="{{ route('participant.index') }}">Kembali</a>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>	
				</div>

			</div>
			<!-- /content area -->

@endsection