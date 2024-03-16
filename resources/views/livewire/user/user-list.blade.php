<div class="content">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
					<li class="breadcrumb-item active">User List</li>
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
									<h3>User List</h3>
									<div class="doctor-search-blk">
										<div class="add-group">
											<a wire:click="createUser" class="btn btn-primary ms-2"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								<div class="top-nav-search table-search-blk">
									<form>
										<input type="text" class="form-control" placeholder="Search here" wire:model.debounce.500ms="search" name="search">
										<a class="btn"><img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt></a>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div>
						<div class="row">
							<div class="col-sm-2">

							</div>
							<div class="col-sm-2">

							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table border-0 custom-table comman-table datatable mb-0">
							<thead>
								<tr>
									<th style="width: 30%">Name</th>

									<th style="width: 20%">Position</th>
									<th style="width: 25%">Email</th>
									<th>Role</th>
									<th style="width: 15%">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
								<tr>
									<td class="text-capitalize">
										{{ $user->first_name }} {{ $user->middle_name ?? '' }}
										{{ $user->last_name }}
									</td>

									<td>
										{{ $user->position }}
									</td>
									<td>
										{{ $user->email }}
									</td>
									<td>
										@foreach($user->roles as $role)
										<li>{{ $role->name }}</li>
										@endforeach
									</td>
									<td class="text-center">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editUser({{ $user->id }})" title="Edit">
												<i class='fa fa-pen-to-square'></i>
											</button>


											{{-- <a class="btn btn-danger btn-sm mx-1"
                                                    wire:click="deleteUser({{ $user->id }})" title="Delete">
											<i class="fa fa-trash"></i>
											</a> --}}
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		{{-- Modal --}}
		<div wire.ignore.self class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<livewire:user.user-form />
			</div>
		</div>
		@section('custom_script')
		@include('layouts.scripts.user-scripts')
		@endsection