<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item active">Company Patients List</li>
					</ul>
				</div>
			</div>
		</div>
		@include('layouts.shared.flash')
		<div class="row d-flex justify-content-center">
			<div class="col-md-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 d-flex justify-content-center">
								<h5>Urinalysis</h5>
							</div>
							<div class="col-12 d-flex justify-content-center">
								<strong>{{ $urine }} / {{ count($patients) }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 d-flex justify-content-center">
								<h5>Hematology</h5>
							</div>
							<div class="col-12 d-flex justify-content-center">
								<strong>{{ $hema }} / {{ count($patients) }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 d-flex justify-content-center">
								<h5>Fecalysis</h5>
							</div>
							<div class="col-12 d-flex justify-content-center">
								<strong>{{ $fecal }} / {{ count($patients) }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 d-flex justify-content-center">
								<h5>Xray</h5>
							</div>
							<div class="col-12 d-flex justify-content-center">
								<strong>{{ $xray }} / {{ count($patients) }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 d-flex justify-content-center">
								<h5>Physical Exam</h5>
							</div>
							<div class="col-12 d-flex justify-content-center">
								<strong>{{ $pe }} / {{ count($patients) }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 d-flex justify-content-center">
								<h5>Drug Test</h5>
							</div>
							<div class="col-12 d-flex justify-content-center">
								<strong>{{ $drug }} / {{ count($patients) }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12">
				<div class="card card-table show-entire">
					<div class="card-body">
						<div class="page-table-header mb-2">
							<div class="row align-items-center">
								<div class="col">
									<div class="doctor-table-blk">
										<h3>Company Patients List</h3>
										<div class="doctor-search-blk">
											<div class="add-group">
												{{-- <a href="{{ route('company.hydrate', $cpe->id) }}" class="btn btn-primary add-pluss ms-2"><img
														src="{{ asset('assets/img/icons/plus.svg') }}"></a> --}}
												{{-- @if (count($patients) == 0)
													<a href="{{ route('company.uploader', $cpe->id) }}" class="btn btn-primary add-pluss ms-2"><img
															src="{{ asset('assets/img/icons/plus.svg') }}"></a>
												@endif --}}
												@hasrole('inquiry')
												@else
													<a href="{{ route('company.remarks', $cpe->id) }}" class="btn btn-primary ms-2 bt-sty">
														<i class="fa-solid fa-print"></i>
													</a>
													<a href="{{ route('company.excel', $cpe->id) }}" class="btn btn-primary ms-2 bt-sty">
														<i class="fa-solid fa-file-excel"></i>
													</a>
												@endhasrole
											</div>
										</div>
									</div>
								</div>
								<div class="col-auto text-end float-end ms-auto download-grp">
									<div class="top-nav-search table-search-blk">
										<p style="margin-bottom:0">Registered: {{ count($registered) }} / {{ count($patients) }}</p>
										<p>Unregistered: {{ count($unregistered) }}</p>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table border-0 custom-table datatable comman-table mb-0">
								<thead>
									<tr>
										<th style="width: 25%">Name</th>
										{{-- <th style="width: 20%">Action</th> --}}
									</tr>
								</thead>
								<tbody>
									@foreach ($patients as $patient)
										<tr>
											<td>
												{{ $patient->patients->name }}
												@if ($patient->patients->civil_status_id == null)
													- <span style="color: red">Unregistered</span>
												@endif
											</td>
											{{-- <td class="text-center">
												<div class="btn-group" role="group">
													<a href="/booking" class="btn btn-info btn-sm mx-1"><i class="fa fa-pen-to-square"></i></a>
												</div>
											</td> --}}
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
