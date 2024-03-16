<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item">Revert Doctor List</li>
					</ul>
				</div>
			</div>
		</div>
		@include('layouts.shared.flash')
		<div class="row d-flex justify-content-center">
			<div class="col-sm-8">
				<div class="card card-table show-entire">
					<div class="card-body">
						<div class="page-table-header mb-2">
							<div class="row align-items-center">
								<div class="col">
									<div class="doctor-table-blk">
										<h3>{{ $doc->first_name }} {{ $doc->middle_name ?? '' }} {{ $doc->last_name }}</h3>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table border-0 custom-table comman-table datatable mb-0">
								<thead>
									<tr>
										<th style="width: 20%">ID</th>
										<th>Doctor</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($lab_exams as $exam)
										<tr>
											<form action="{{ route('revertdoc.update', $exam->id) }}" method="POST">
												@method('PUT')
												@csrf

												<td>
													{{ $exam->id }}
												</td>
												<td>
													<div class="form-group local-forms">
														<select id="doctor_id" name="doctor_id" class="form-control select">
															<option selected="" value="">--select--</option>
															@foreach ($doctors as $doctor)
																<option {{ old('doctor_id', isset($exam) && $exam->doctor_id == $doctor->id ? 'selected' : '') }}
																	value="{{ $doctor->id }}">
																	{{ $doctor->first_name }} {{ $doctor->middle_name ?? '' }} {{ $doctor->last_name }}
																</option>
															@endforeach
														</select>
													</div>
												</td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                                </td>
											</form>
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
