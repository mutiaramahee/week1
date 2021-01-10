@extends('layouts.content')

@section('content')
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<div class="content">

				<!-- Basic datatable -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Edit Data Kelurahan</h5>
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
						<form action="{{route('kelurahan.update', $kelurahan->id)}}" method="POST">
							@csrf
							@method('PUT')
							<fieldset class="mb-3">
								<div class="form-group row">
									<label class="col-form-label col-lg-2">ID</label>
									<div class="col-lg-3">
										<input type="text" class="form-control" name="id" minlength="1" maxlength="10" value="{{$kelurahan->id}}" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-lg-2">Nama Kecamatan <span class="text-danger font-weight-bold">*</span></label>
									<div class="col-lg-3">
										<select class="form-control" name="kecamatan_id" required>
											@foreach ($kecamatan as $r)
												<option value="{{ $r->id }}" <?=($r->id==$kelurahan->kecamatan_id)?'selected':''?>>{{ $r->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-lg-2">Nama Kelurahan <span class="text-danger font-weight-bold">*</span></label>
									<div class="col-lg-3">
										<input type="text" class="form-control" name="name" minlength="3" maxlength="255" placeholder="Nama Provinsi" value="{{$kelurahan->name}}" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-lg-2 text-danger font-weight-bold"><i>* Wajib diisi</i></label>
								</div>
								<div class="form-group row">
									<div class="col-lg-3">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>	
				</div>

			</div>
			<!-- /content area -->

@endsection