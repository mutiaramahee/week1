@extends('layouts.content')

@section('content')
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">Home</span> - Dashboard</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
				<!-- Dashboard content -->
				<div class="row">
					<div class="col-xl-12">

						<!-- Quick stats boxes -->
						<div class="row">
							<div class="col-lg-3">
								<!-- Provinsi -->
								<div class="card bg-teal-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{ $provinsi }}</h3>
											<div class="list-icons ml-auto">
						                		<a class="list-icons-item" data-action="reload"></a>
						                	</div>
					                	</div>
					                	<div>
											Total Provinsi
											<div class="font-size-sm opacity-75"></div>
										</div>
									</div>
								</div>
								<!-- /Provinsi -->
							</div>

							<div class="col-lg-3">
								<!-- Kabupaten/ Kota -->
								<div class="card bg-pink-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{ $kab }}</h3>
											<div class="list-icons ml-auto">
						                		<a class="list-icons-item" data-action="reload"></a>
						                	</div>
					                	</div>
					                	<div>
											Total Kabupaten/ Kota
											<div class="font-size-sm opacity-75"></div>
										</div>
									</div>
								</div>
								<!-- /Kabupaten/ Kota -->
							</div>

							<div class="col-lg-3">
								<!-- Kecamatan -->
								<div class="card bg-blue-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{ $kecamatan }}</h3>
											<div class="list-icons ml-auto">
						                		<a class="list-icons-item" data-action="reload"></a>
						                	</div>
					                	</div>
					                	<div>
											Total Kecamatan
											<div class="font-size-sm opacity-75"></div>
										</div>
									</div>
								</div>
								<!-- /Kecamatan -->
							</div>

							<div class="col-lg-3">
								<!-- Kelurahan -->
								<div class="card bg-orange-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{ $kelurahan }}</h3>
											<div class="list-icons ml-auto">
						                		<a class="list-icons-item" data-action="reload"></a>
						                	</div>
					                	</div>
					                	<div>
											Total Kelurahan
											<div class="font-size-sm opacity-75"></div>
										</div>
									</div>
								</div>
								<!-- /Kelurahan -->
							</div>

							<div class="col-lg-3">
								<!-- Participant -->
								<div class="card bg-green-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{ $participant }}</h3>
											<div class="list-icons ml-auto">
						                		<a class="list-icons-item" data-action="reload"></a>
						                	</div>
					                	</div>
					                	<div>
											Total Participant
											<div class="font-size-sm opacity-75"></div>
										</div>
									</div>
								</div>
								<!-- /Participant -->
							</div>

						</div>
						<!-- /quick stats boxes -->


						

					</div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->

@endsection