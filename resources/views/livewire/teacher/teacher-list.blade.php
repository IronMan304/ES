<div class="content">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
					<li class="breadcrumb-item active">Teacher List</li>
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
									<h3>Teacher List</h3>
									<div class="doctor-search-blk">
										<div class="add-group">
											<a wire:click="createTeacher" class="btn btn-primary ms-2"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
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
						<table id="Teacher-table" class="table border-0 custom-table comman-table mb-0">
							<thead>
								<tr>
									<th>Teacher</th>
									<th>Id Number</th>
									<th>Contact Number</th>
									<th>Gender</th>
									<th>Action</th>

								</tr>
							</thead>
							<tbody>

								@foreach ($teachers as $teacher)
								<tr>
									<td>
										{{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->last_name }}
									</td>
									<td>
										{{ $teacher->id_number}}
									</td>
									<td>
										{{ $teacher->contact_number}}
									</td>
									<td>
										{{ $teacher->gender->name ?? ''}}
									</td>

									<td class="text-center">
										<div class="btn-group" role="group">

											@if(auth()->user()->hasRole('admin'))
											@if ($teacher->user_id == null)
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="createTeacherAccount({{ $teacher->id }})" title="Add">
										
												<i class="fa-solid fa-user-plus"></i>
											</button>
											@endif
											@endif
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editTeacher({{ $teacher->id }})" title="Edit">
												<i class='fa fa-pen-to-square'></i>
											</button>
											<a class="btn btn-danger btn-sm mx-1" wire:click="deleteTeacher({{ $teacher->id }})" title="Delete">
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

			<div wire.ignore.self class="modal fade" id="teacherModal" tabindex="-1" role="dialog" aria-labelledby="teacherModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-dialog-centered">
					<livewire:teacher.teacher-form />
				</div>
			</div>
			<div wire.ignore.self class="modal fade" id="teacherAccountModal" tabindex="-1" role="dialog" aria-labelledby="teacherAccountModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-dialog-centered">
					<livewire:teacher.teacher-account-form />
				</div>
			</div>
			@section('custom_script')
			@include('layouts.scripts.teacher-scripts')
			@endsection

		</div>
		<!-- Pagination links -->
		{{ $teachers->links() }}
	</div>
</div>