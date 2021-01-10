@extends('layouts.content')

@section('content')
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<div class="content">

				<!-- Basic datatable -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Data Participant</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                	</div>
	                	</div>
					</div>

					@if(session('failed'))
			            <div class="alert alert-danger alert-dismissible fade show" role="alert">
			            	<span class="alert-text">{{ session('failed') }}</span>
			            	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                	<span aria-hidden="true">&times;</span>
			            	</button>
			            </div>
			        @endif

					<div class="card-body">
						<a href="{{ route('participant.create') }}" class="btn btn-info">Tambah Data</a>
					</div>
					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Email</th>
								<th>Phone</th>
								<th class="text-center" colspan="3">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($participant as $row)
								<tr>
									<td>{{ $row->name }}</td>
									<td>{{ $row->email }}</td>
									<td>{{ $row->phone }}</td>
									<td></td>
									<td class="text-center">
										<form action="{{ route('participant.destroy', $row->id) }}" method="POST">
											<a href="{{ route('participant.show', $row->id) }}" class="btn btn-sm btn-info"><i class="icon-eye"></i> Detail</a>
											<a href="{{ route('participant.edit', $row->id) }}" class="btn btn-sm btn-warning"><i class="icon-pencil7"></i> Edit</a>
				                            @csrf
				                            @method('DELETE')
				                            <button type="submit" class="btn btn-sm btn-danger"><i class="icon-trash-alt"></i> Hapus</button>
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