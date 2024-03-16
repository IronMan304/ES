@php
	use App\Models\ServiceResultKey;
@endphp

<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item"><a href="/booking">Booking List</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item">Service List</li>
					</ul>
				</div>
			</div>
		</div>
		@include('layouts.shared.flash')
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12">
				<div class="card card-table show-entire mb-4">
					<div class="card-body">
						<form action="{{ route('print.result', $booking->id) }}" method="GET" target="_blank">
							<div class="page-table-header mb-2">
								<div class="row align-items-center">
									<div class="col">
										<div class="doctor-table-blk">
											<h3><strong>{{ $booking->patients->name }}</strong> |
												{{ $booking->barcode }}</h3>
											<div class="department-search-blk">
												<div class="add-group">
													<button type="submit" class="btn btn-primary ms-2 bt-sty">
														<i class="fa-solid fa-print"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table border-0 custom-table comman-table datatable mb-0">
									<tbody>
										@foreach ($depart as $serv)
											@continue(count($serv) == 1)
											@foreach ($serv as $service)
												@php
													$is_empty = false;
												@endphp
												@if (is_string($service))
													<tr>
														<td colspan="3">
															<h5 class="fw-bold">{{ $service }} Department</h5>
														</td>
													</tr>
												@else
													<tr>
														@php
															$results = ServiceResultKey::where('booking_service_key_id', $service->id)->get();
														@endphp
														<td style="width: 10%">
															@if ($results->count() == 0)
																<input type="checkbox" name="check[]" id="check[]" class="form-check-input"
																	value="{{ $service->id }}" disabled>
															@else
																<input type="checkbox" name="check[]" id="check[]" class="form-check-input"
																	value="{{ $service->id }}">
															@endif
														</td>
														<td style="width: 30%">{{ $service->service->name }}</td>
														<td style="width: 30%">
															@if ($service->status_id == 1)
																<a class="btn btn-success" href="{{ route('service.accept', $service->id) }}" title="Accept">
																	<i class="fa-solid fa-check-to-slot"></i>
																</a>
															@else
																@if ($service->dt_collected == null)
																	<a class="btn btn-success" href="{{ route('service.collect', $service->id) }}" title="Collect">
																		<i class="fa-solid fa-hand-holding-droplet"></i>
																	</a>
																	@hasrole('admin')
																		<a class="btn btn-danger" href="{{ route('service.revert', $service->id) }}" title="Revert">
																			<i class="fa-solid fa-rotate"></i>
																		</a>
																	@endhasrole
																@else
																	@if ($service->date_start == null)
																		<a class="btn btn-primary" href="{{ route('service.start', $service->id) }}" title="Start">
																			<i class="fa-solid fa-play"></i>
																		</a>
																		@hasrole('admin')
																			<a class="btn btn-danger" href="{{ route('service.revert', $service->id) }}" title="Revert">
																				<i class="fa-solid fa-rotate"></i>
																			</a>
																		@endhasrole
																	@elseif ($service->result_printed_on == null)
																		@if ($results->count() == 0)
																			<a class="btn btn-warning" href="{{ route('service.result', $service->id) }}" title="Result">
																				<i class="fa-solid fa-file-waveform"></i>
																			</a>
																		@else
																			<a class="btn btn-secondary" href="{{ route('service.result_edit', $service->id) }}"
																				title="Edit Result">
																				<i class="fa-solid fa-file-waveform"></i>
																			</a>
																		@endif
																		<a class="btn btn-info" href="{{ route('service.end', $service->id) }}" title="End">
																			<i class="fa-solid fa-circle-stop"></i>
																		</a>
																		@hasrole('admin')
																			<a class="btn btn-danger" href="{{ route('service.revert', $service->id) }}" title="Revert">
																				<i class="fa-solid fa-rotate"></i>
																			</a>
																		@endhasrole
																	@else
																		@if ($results->count() == 0)
																			<a class="btn btn-warning" href="{{ route('service.result', $service->id) }}" title="Result">
																				<i class="fa-solid fa-file-waveform"></i>
																			</a>
																		@else
																			<a class="btn btn-secondary" href="{{ route('service.result_edit', $service->id) }}"
																				title="Edit Result">
																				<i class="fa-solid fa-file-waveform"></i>
																			</a>
																			<a class="btn btn-secondary" href="{{ route('service.print', $service->id) }}" title="Print Result">
																				<i class="fa-solid fa-print"></i>
																			</a>
																		@endif
																	@endif
																@endif
															@endif
														</td>
													</tr>
												@endif
											@endforeach
										@endforeach
										@if ($is_empty == true)
											<div class="row">
												<div class="col-12 d-flex justify-content-center">
													<h4 class="text-danger"><strong>No service available for your affiliated department</strong></h4>
												</div>
                                                <div class="col-12 d-flex justify-content-center">
                                                    <a href="/booking" class="btn btn-primary btn-sm">Return to Booking</a>
                                                </div>
											</div>
										@endif
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
