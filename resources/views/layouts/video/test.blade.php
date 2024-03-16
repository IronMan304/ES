<x-app-layout>
	<div class="content">

		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item active">Room List</li>
					</ul>
				</div>
			</div>
		</div>
		<div>
			@if (session()->has('success'))
				<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
					<div class="text-dark">{{ session('success') }}</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif

			@if ($message = session()->has('error'))
				<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
					<div class="text-dark">{{ session('error') }}</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif

			@if ($errors->any())
				<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
					<div class="text-dark">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12">
				<div class="card card-table show-entire">
					<div class="card-body">

						<div class="page-table-header mb-2">
							<div class="row align-items-center">
								<div class="col">
									<div class="doctor-table-blk">
										<h3>Room List</h3>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table border-0 custom-table comman-table datatable mb-0">
								<thead>
									<tr>
										<th style="width: 20%">ID</th>
										<th style="width: 60%">Name</th>
										<th style="width: 20%">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($rooms as $room)
										<tr>
											<td>{{ $room->meetingId }}</td>
											<td>{{ $room->roomName }}</td>
											<td class="text-center">
												<div class="btn-group" role="group">
													<a class="btn btn-danger btn-sm mx-1" href="{{ route('test.destroy', $room->meetingId) }}">
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
			</div>
		</div>
	</div>
</x-app-layout>
