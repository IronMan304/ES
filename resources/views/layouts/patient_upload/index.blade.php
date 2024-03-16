@php
	use Carbon\Carbon;
@endphp
<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item"><a href="/patient">Patient List</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item active">PE Upload from Masterlist</li>
					</ul>
				</div>
			</div>
		</div>
		@include('layouts.shared.flash')
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12">
				<div class="card card-table show-entire">
					<div class="card-body">
						<div class="page-table-header mb-2">
							<div class="row align-items-center">
								<div class="col">
									<div class="doctor-table-blk">
										<h3>Patient Upload</h3>
										<div class="doctor-search-blk">
											<div class="add-group">
												<button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#uploadModal">
													<img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
												</button>
												@if ($preview_data != null)
													<button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#importModal">
														<i class="fa-solid fa-upload fs-6"></i>
													</button>
												@endif
											</div>
										</div>
									</div>
								</div>
								@if ($preview_data != null)
									<div class="col-auto text-end float-end ms-auto download-grp">
										<div class="top-nav-search table-search-blk">
											<span>Company: {{ $comp->name }} | {{ Carbon::parse($preview_data['date_start'])->format('M d, Y') }} to
												{{ Carbon::parse($preview_data['date_end'])->format('M d, Y') }}</span>
										</div>
									</div>
								@endif
							</div>
						</div>
						@if ($preview_data != null)
							<div class="page-table-header">
								<div class="row align-items-center">
									<div class="col-12">
										<div class="doctor-table-blk">
											<span>Services:</span>
											@foreach ($services as $service)
												{{ $service->name }},
											@endforeach
										</div>
									</div>
								</div>
							</div>
						@endif
						<div class="table-responsive">
							<table class="table border-0 custom-table comman-table datatable mb-0">
								<thead>
									<tr>
										<th style="width: 60%">Name</th>
										<th style="width: 60%">Gender</th>
										<th style="width: 60%">Birthdate</th>
									</tr>
								</thead>
								<tbody>
									@if ($preview_data != null)
										@foreach ($patients as $patient)
											<tr>
												<td>{{ $patient[0] }} {{ $patient[1] ?? '' }} {{ $patient[2] }}</td>
												<td>
													@if ($patient[4] == 'M')
														Male
													@else
														Female
													@endif
												</td>
												<td>{{ Carbon::createFromFormat('m-d-Y', $patient[3])->format('M d, Y') }}</td>
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModal" aria-hidden="true" tabindex="-1"
		role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered">
			@include('layouts.patient_upload.upload')
		</div>
	</div>
	@if ($preview_data != null)
		<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModal" aria-hidden="true"
			tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
			<div class="modal-dialog modal-dialog-centered">
				@include('layouts.patient_upload.import')
			</div>
		</div>
	@endif
</x-app-layout>
