@extends('layouts.content')

@section('content')
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<div class="content">

				<!-- Basic datatable -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Data Kecamatan</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                	</div>
	                	</div>
					</div>
					@if(session('success'))
			            <div class="alert alert-success alert-dismissible fade show" role="alert">
			            	<span class="alert-text">{{ session('success') }}</span>
			            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                	<span aria-hidden="true">&times;</span>
			            	</button>
			            </div>
			        @endif
			        @if(session('failed'))
			            <div class="alert alert-danger alert-dismissible fade show" role="alert">
			            	<span class="alert-text">{{ session('failed') }}</span>
			            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                	<span aria-hidden="true">&times;</span>
			            	</button>
			            </div>
			        @endif

					<div class="card-body">
						<form action="{{route('kecamatan.store')}}" method="POST">
							@csrf
							<fieldset class="mb-0">
								<div class="row">
									<div class="col-lg-3">
										<label class="col-form-label">Kabupaten/ Kota</label>		
									</div>
									<div class="col-lg-3">
										<label class="col-form-label">Kecamatan <span class="text-danger font-weight-bold"><i>*<small>Wajib diisi</small></i></span></label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-3">
										<select class="form-control" name="kabupaten_kota_id" required>
											@foreach ($kab as $r)
												<option value="{{ $r->id }}">{{ $r->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-3">
										<input type="text" class="form-control" name="name" minlength="3" maxlength="255" placeholder="Nama Kecamatan" required>
									</div>
									<div class="text-right">
										<button type="submit" class="btn btn-primary">Tambah</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nama Kecamatan</th>
								<th>Nama Kabupaten/ Kota</th>
								<th class="text-center" colspan="3">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($kecamatan as $row)
							<tr>
								<td>{{ $row->id }}</td>			
								<td>{{ $row->name }}</td>		
								<td>{{ $row->kab_name }}</td>
								<td></td>
								<td class="text-center">
									<form action="{{ route('kecamatan.destroy', $row->id) }}" method="POST">
										<a href="{{ route('kecamatan.edit', $row->id) }}" class="btn btn-warning"><i class="icon-pencil7"></i> Edit</a>
			                            @csrf
			                            @method('DELETE')
			                            <button type="submit" class="btn btn-danger"><i class="icon-trash-alt"></i> Hapus</button>
			                        </form>
								</td>
								<td></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<br>
				</div>
				<!-- /basic datatable -->

			</div>
			<!-- /content area -->

@endsection