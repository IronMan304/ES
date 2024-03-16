<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item">Service Result</li>
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
							<div class="row">
								<div class="col">
									<div class="doctor-table-blk">
										<h3>{{ $service_key->service->name }} - {{ $service_key->booking->patients->name }}</h3>
									</div>
								</div>
							</div>
						</div>

						<form action="{{ route('service.result_update', $service_key->id) }}" method="post">
                            @method('put')
							@csrf
							<div class="table-responsive">
								<table class="table border-0 custom-table comman-table mb-0">
									<thead>
										<tr>
											<th style="width: 25%">Name</th>
											<th style="width: 35%">Result</th>
											<th style="width: 10%">Unit</th>
											<th style="width: 30%">Normal Range</th>
										</tr>
									</thead>
									<tbody>
										@php
											$i = 0;
										@endphp
										@foreach ($service_results as $result)
											<tr>
												<td>{{ $result->name }}</td>
												<td><input class="form-control" name="result[{{ $i }}]" type="text" value="{{ $sresults[$i]->result_value ?? '' }}"></td>
												<td>{{ $result->units->name ?? '' }}</td>
												<td>
													{{ $result->range ?? '' }}
												</td>
											</tr>
											@php
												$i++;
											@endphp
										@endforeach
									</tbody>
								</table>
                                <div class="row p-4">
                                    <label for="remarks" class="mb-1"><strong>Remarks</strong></label>
                                    {{-- <textarea name="remarks" id="remarks" cols="10" rows="10" class="form-control">{{ $service_key->remarks }}</textarea> --}}
                                    <input type="text" name="remarks" id="remarks" class="form-control" value="{{ $service_key->remarks }}">
                                </div>
								<div class="d-flex justify-content-end">
									<button class="btn btn-primary m-3" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
