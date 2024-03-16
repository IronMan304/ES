<div class="content">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
					<li class="breadcrumb-item active">Student List</li>
				</ul>
			</div>
		</div>
	</div>
	<livewire:flash-message.flash-message />
	<div class="row d-flex justify-content-center">
		<div class="col-sm-12">
			<div class="card card-table show-entire">
				<div class="card-body">

					<div class="page-table-header mb-2">
						<div class="row align-items-center">
							<div class="col">
								<div class="doctor-table-blk">
									<h3>Student List</h3>
									<div class="doctor-search-blk">
										<div class="add-group">
											<a wire:click="createStudent" class="btn btn-primary ms-2"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								<div class="top-nav-search table-search-blk">
									<form>
										<input type="text" class="form-control" placeholder="Search here" wire:model.debounce.500ms="search">
										<a class="btn"><img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt></a>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table id="Student-table" class="table border-0 custom-table comman-table mb-0">
							<thead>
								<tr>
									<th>Student</th>
									<th>Id Number</th>
									<th>Contact Number</th>
									<th>Gender</th>
									<th>Status</th>
									<th>Subject</th>
									<th>Action</th>

								</tr>
							</thead>
							<tbody>

								@foreach ($students as $student)
								<tr>
									<td>
										{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
									</td>
									<td>
										{{ $student->id_number}}
									</td>
									<td>
										{{ $student->contact_number}}
									</td>
									<td>
										{{ $student->gender->name ?? ''}}
									</td>
									<td>
										{{ $student->status->name ?? ''}}
									</td>
									<td>
										@if ($student->subjects->isNotEmpty())
										@foreach ($student->subjects as $subjectKey)
										{{ $subjectKey->subject->name }}@if (!$loop->last)<br> @endif
										@endforeach
										@else
										No subjects associated
										@endif
									</td>

									<td class="text-center">
										<div class="btn-group" role="group">

											@if(auth()->user()->hasRole('admin'))
											@if ($student->user_id == null)
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="createStudentAccount({{ $student->id }})" title="Add">

												<i class="fa-solid fa-user-plus"></i>
											</button>
											@endif
											@endif
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="grade({{ $student->id }})" title="Grade">
												<i class='fa fa-pen-to-square'></i>
											</button>
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editStudent({{ $student->id }})" title="Edit">
												<i class='fa fa-pen-to-square'></i>
											</button>
											<a class="btn btn-danger btn-sm mx-1" wire:click="deleteStudent({{ $student->id }})" title="Delete">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</td>

								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			{{-- Modal --}}

			<div wire.ignore.self class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-dialog-centered">
					<livewire:student.student-form />
				</div>
			</div>
			<div wire.ignore.self class="modal fade" id="studentAccountModal" tabindex="-1" role="dialog" aria-labelledby="studentAccountModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-dialog-centered">
					<livewire:student.student-account-form />
				</div>
			</div>
			<div wire.ignore.self class="modal fade" id="gradeModal" tabindex="-1" role="dialog" aria-labelledby="gradeModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<livewire:student.grade-form/>
				</div>
			</div>
			@section('custom_script')
			@include('layouts.scripts.student-scripts')
			@endsection

		</div>
		<!-- Pagination links -->
		{{ $students->links() }}
	</div>
</div>