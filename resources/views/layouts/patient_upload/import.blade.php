<div class="modal-content">
	<div class="modal-header">
		<h3 class="modal-title fs-5">Import Data</h3>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-12 d-flex justify-content-center align-items-center">
				<h5>Are you sure you want to upload {{ count($patients) }} patients to {{ $comp->name }}?</h5>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<form method="post" action="{{ route('patient.import') }}">
			@csrf
			<input type="text" name="company_id" value="{{ $comp->id }}" hidden>
			<input type="text" name="group_id" value="{{ $package->id }}" hidden>
			<input type="text" name="date_start" value="{{ $preview_data['date_end'] }}" hidden>
			<input type="text" name="date_end" value="{{ $preview_data['date_end'] }}" hidden>
			@php
				$i = 0;
			@endphp
			@foreach ($patients as $patient)
				@continue($patient[0] == null)
				<input type="text" name="patient[{{ $i }}][first_name]" value="{{ $patient[0] }}" hidden>
				<input type="text" name="patient[{{ $i }}][middle_name]" value="{{ $patient[1] ?? '' }}" hidden>
				<input type="text" name="patient[{{ $i }}][last_name]" value="{{ $patient[2] }}" hidden>
				<input type="text" name="patient[{{ $i }}][birthdate]"
					value="{{ Carbon\Carbon::createFromFormat('m-d-Y', $patient[3])->format('Y-m-d') }}" hidden>
				<input type="text" name="patient[{{ $i }}][gender]"
					value="@if ($patient[4] == 'M') 1 @elseif($patient[4] == 'F') 2 @else '' @endif" hidden>
				@php
					$i++;
				@endphp
			@endforeach
			<button type="submit" class="btn btn-primary">Save</button>
		</form>
	</div>
</div>
