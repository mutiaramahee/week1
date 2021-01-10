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

					@if($errors->any())
			            <div class="alert alert-danger alert-dismissible fade show" role="alert">
			            	<strong>Terjadi kesalahan</strong>
			            	<ul>
			            		@foreach($errors->all() as $err)
			            			<li>{{ $err }}</li>
			            		@endforeach
			            	</ul>
			            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                	<span aria-hidden="true">&times;</span>
			            	</button>
			            </div>
			        @endif

					<div class="card-body">
						<form action="{{route('participant.update', $participant->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
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
											<div class="col-lg-2 font-weight-bold">Nama <span class="text-danger font-weight-bold">*</span></div>
											<div class="col-lg-4"> 
												<input type="text" class="form-control" name="name" minlength="3" maxlength="255" placeholder="Nama Participant" value="{{$participant->name}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-2 font-weight-bold">Email <span class="text-danger font-weight-bold">*</span></div>
											<div class="col-lg-4"> 
												<input type="email" class="form-control" name="email" minlength="10" maxlength="255" placeholder="Nama Provinsi" value="{{$participant->email}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-2 font-weight-bold">No Telepon <span class="text-danger font-weight-bold">*</span></div>
											<div class="col-lg-4"> 
												<input type="text" class="form-control" name="phone" minlength="8" maxlength="16" placeholder="No telepon" value="{{$participant->phone}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-2 font-weight-bold">Provinsi</div>
											<div class="col-lg-4"> 
												<select class="form-control" name="provinsi_id">
													<option value="">Pilih Provinsi</option>
													@foreach ($provinsi as $r)
														<option value="{{ $r->id }}" <?=($r->id==$participant->provinsi_id)?'selected':''?>>{{ $r->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-2 font-weight-bold">Kabupaten/ Kota</div>
											<div class="col-lg-4"> 
												<select class="form-control" name="kabupaten_kota_id">
													<option value="">Pilih Kabupaten/ Kota</option>
													@foreach ($kab as $r)
														<option value="{{ $r->id }}" <?=($r->id==$participant->kabupaten_kota_id)?'selected':''?>>{{ $r->name }}</option>
													@endforeach
												</select>
											</div>
											<div id="kab">
												<img src="{{asset('assets/global_assets/images/ajax-loader.gif')}}"> Mohon tunggu sejenak..
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-2 font-weight-bold">Kecamatan</div>
											<div class="col-lg-4"> 
												<select class="form-control" name="kecamatan_id">
													<option value="">Pilih Kecamatan</option>
													@foreach ($kecamatan as $r)
														<option value="{{ $r->id }}" <?=($r->id==$participant->kecamatan_id)?'selected':''?>>{{ $r->name }}</option>
													@endforeach
												</select>
											</div>
											<div id="kec">
												<img src="{{asset('assets/global_assets/images/ajax-loader.gif')}}"> Mohon tunggu sejenak..
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-2 font-weight-bold">Kelurahan</div>
											<div class="col-lg-4"> 
												<select class="form-control" name="kelurahan_id">
													<option value="">Pilih Kelurahan</option>
													@foreach ($kelurahan as $r)
														<option value="{{ $r->id }}" <?=($r->id==$participant->kelurahan_id)?'selected':''?>>{{ $r->name }}</option>
													@endforeach
												</select>
											</div>
											<div id="kel">
												<img src="{{asset('assets/global_assets/images/ajax-loader.gif')}}"> Mohon tunggu sejenak..
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-2 font-weight-bold">Foto</div>
											<div class="col-lg-4"> 
												<input type="file" class="form-control" name="image" accept="image/*">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2 text-danger font-weight-bold"><i>* Wajib diisi</i></label>
										</div>
										<div class="form-group row">
											<div class="col-lg-6">
												<button type="submit" class="btn btn-primary">Update</button>
												<a class="btn btn-warning" href="{{ route('participant.index') }}">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>	
				</div>

			</div>
			<!-- /content area -->

@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#kab').hide();
			$('#kec').hide();
			$('#kel').hide();
			$('select[name="provinsi_id"]').on('change', function() {
	            var provinsi = $(this).val();
	            $('#kab').show();
	            if(provinsi) {
	                $.ajax({
	                    url: "{{ url('/participant/create/provinsi') }}"+'/'+provinsi,
	                    type: "GET",
	                    dataType: "json",
	                    success:function(data) {
	                        $('select[name="kabupaten_kota_id"]').empty();
	                        $.each(data, function(i, item) {
	                            $('select[name="kabupaten_kota_id"]').append('<option value="'+ data[i].id +'">'+ data[i].name +'</option>');
	                        });
	                    },
	                    complete: function () { 
			                $('#kab').hide();
			            }
	                });
	            }else{
	                $('select[name="kabupaten_kota_id"]').empty();
	            }
        	});


        	$('select[name="kabupaten_kota_id"]').on('click', function() {
	            var kab = $(this).val();
	            $('#kec').show();
	            if(kab) {
	                $.ajax({
	                    url: "{{ url('/participant/create/kab') }}"+'/'+kab,
	                    type: "GET",
	                    dataType: "json",
	                    success:function(data) {
	                        $('select[name="kecamatan_id"]').empty();
	                        $.each(data, function(i, item) {
	                            $('select[name="kecamatan_id"]').append('<option value="'+ data[i].id +'">'+ data[i].name +'</option>');
	                        });
	                    },
	                    complete: function () { 
			                $('#kec').hide();
			            }
	                });
	            }else{
	                $('select[name="kecamatan_id"]').empty();
	            }
        	});

        	$('select[name="kecamatan_id"]').on('click', function() {
	            var kecamatan = $(this).val();
	            $('#kel').show();
	            if(kecamatan) {
	                $.ajax({
	                    url: "{{ url('/participant/create/kecamatan') }}"+'/'+kecamatan,
	                    type: "GET",
	                    dataType: "json",
	                    success:function(data) {
	                        $('select[name="kelurahan_id"]').empty();
	                        $.each(data, function(i, item) {
	                            $('select[name="kelurahan_id"]').append('<option value="'+ data[i].id +'">'+ data[i].name +'</option>');
	                        });
	                    },
	                    complete: function () { 
			                $('#kel').hide();
			            }
	                });
	            }else{
	                $('select[name="kelurahan_id"]').empty();
	            }
        	});
    	});
	</script>
@endsection