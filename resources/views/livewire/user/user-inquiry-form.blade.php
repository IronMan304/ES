<div class="modal-content">
	<div class="modal-header">
		<h1 class="modal-title fs-5">
			Company
		</h1>
		<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	@if ($errors->any())
		<span class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</span>
	@endif
	<form wire:submit.prevent="store" enctype="multipart/form-data">
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group local-forms">
						<label>Company</label>
						<select class="form-control" wire:model="company_id">
							<option selected value="">--select--</option>
							@foreach ($companies as $company)
								<option value="{{ $company->id }}">
									{{ $company->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
</div>
