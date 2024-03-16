<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<style>
		p,
		span {
			font-size: small;
			margin-bottom: -5px;
			margin-top: -5px;
		}

		tr td {
			font-size: small;
			padding: 0 !important;
			margin: 0 !important;
		}

		table {
			width: 100% !important;
		}
	</style>
</head>

<body onload="window.print()">
	@php
		use App\Models\BookingServiceKey;
		use App\Models\ServiceResultKey;
		use App\Models\LaboratoryExamination;
	@endphp
	<table class="table table-bordered border-dark">
		<thead>
			<td colspan="6">
				<div class="row">
					<div class="col-6 d-flex justify-content-start p-2">
						<img src="{{ asset('assets/img/logo-full.png') }}" alt="Diagcare"
							style="width:70%; margin-bottom: -10px; margin-top:-17px">
					</div>
					<div class="col-6 d-flex justify-content-end px-3 py-2">
						<div class="row">
							<div class="col-12 d-flex justify-content-end" style="margin-bottom:-5px">
								Maxima Limquiaco Bldg.
							</div>
							<div class="col-12 d-flex justify-content-end" style="margin-bottom:-5px">
								Dr. V. Locsin Street
							</div>
							<div class="col-12 d-flex justify-content-end" style="margin-bottom:-5px">
								Dumaguete City, Negros Oriental
							</div>
							<div class="col-12 d-flex justify-content-end" style="margin-bottom:-5px">
								Tel.Nos. 035-4210259, 421-0838
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 d-flex justify-content-center">
					<h5><strong>LABORATORY EXAMINATION REPORT</strong></h5>
				</div>
			</td>
			<tr>
				<th>
					PATIENT NAME
				</th>
				<th>
					HEMATOLOGY
				</th>
				<th>
					URINALYSIS
				</th>
				<th>
					FECALYSIS
				</th>
				<th>
					OTHER TEST
				</th>
				<th>
					DRUG TEST
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($bookings as $booking)
				<tr>
					<td>
						@if ($booking->patients->birthdate == null)
                            <span class="text-danger">{{ $booking->patients->name }}</span>
						@else
							{{ $booking->patients->name }}
						@endif
					</td>
					<td>
						@php
							$hema = BookingServiceKey::where('booking_id', $booking->id)
							    ->where('service_id', 2)
							    ->first();
						@endphp
						@if (isset($hema))
							{{ $hema->remarks ?? 'No Remarks' }}
						@else
							<span class="text-danger">No Data</span>
						@endif
					</td>
					<td>
						@php
							$urine = BookingServiceKey::where('booking_id', $booking->id)
							    ->where('service_id', 1)
							    ->first();
						@endphp
						@if (isset($urine))
							{{ $urine->remarks ?? 'No Remarks' }}
						@else
							<span class="text-danger">No Data</span>
						@endif
					</td>
					<td>
						@php
							$fecal = BookingServiceKey::where('booking_id', $booking->id)
							    ->where('service_id', 16)
							    ->first();
						@endphp
						@if (isset($fecal))
							{{ $fecal->remarks ?? 'No Remarks' }}
						@else
							<span class="text-danger">No Data</span>
						@endif
					</td>
					<td>
						@php
							$others = LaboratoryExamination::where('booking_id', $booking->id)->first();
						@endphp
						@if (isset($others))
							{{ $others->other_test ?? 'No Remarks' }}
						@else
							<span class="text-danger">No Data</span>
						@endif
					</td>
					<td>
						@php
							$drug = BookingServiceKey::where('booking_id', $booking->id)
							    ->where('service_id', 20)
							    ->first();
						@endphp
						@if (isset($drug))
							{{ $drug->remarks ?? 'No Remarks' }}
						@else
							<span class="text-danger">No Data</span>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
