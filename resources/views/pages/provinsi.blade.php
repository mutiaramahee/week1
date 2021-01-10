@extends('layouts.content')

@section('content')
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<div class="content">

				<!-- Basic datatable -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Data Provinsi</h5>
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
						<form action="{{route('provinsi.store')}}" method="POST">
							@csrf
							<fieldset class="mb-0">
								<div class="form-group row">
									<div class="col-lg-3">
										<input type="text" class="form-control" name="name" minlength="3" maxlength="255" placeholder="Nama Provinsi" required>
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
								<th>Nama Provinsi</th>
								<th class="text-center" colspan="4">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($provinsi as $row)
							<tr>
								<td>{{ $row->id }}</td>
								<td>{{ $row->name }}</td>
								<td></td>
								<td class="text-center">
									<form action="{{ route('provinsi.destroy', $row->id) }}" method="POST">
										<a href="{{ route('provinsi.edit', $row->id) }}" class="btn btn-warning"><i class="icon-pencil7"></i> Edit</a>
			                            @csrf
			                            @method('DELETE')
			                            <button type="submit" class="btn btn-danger"><i class="icon-trash-alt"></i> Hapus</button>
			                        </form>
								</td>
								<td></td>
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