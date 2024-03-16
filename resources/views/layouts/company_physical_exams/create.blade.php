<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item">Hydrate Masterlist</li>
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
										<h3>Hydrate Masterlist from Booking</h3>
									</div>
								</div>
							</div>
						</div>
						<br>
						<form action="{{ route('hydration.save', $cpe->id) }}" method="post" class="px-5">
							@csrf
							<div class="row">
								<div class="col-md-5">
									<div class="form-group local-forms">
										<label>Start Date
											<span class="login-danger">*</span></label>
										<input class="form-control" type="text" name="date_start" autocomplete="off" placeholder="yyyy-mm-dd hh:mm:ss" />
									</div>
								</div>
								<div class="col-md-2 d-flex justify-content-center">
									To
								</div>
								<div class="col-md-5">
									<div class="form-group local-forms">
										<label>End Date
											<span class="login-danger">*</span></label>
										<input class="form-control" type="text" name="date_end" autocomplete="off" placeholder="yyyy-mm-dd hh:mm:ss" />
									</div>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button class="btn btn-primary m-3" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
