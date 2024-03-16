<!DOCTYPE html>
<html lang="en">

<head>
	<title style="text-transform: capitalize;">Prescription - {{ $appointment->patients->id }}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		* {
			box-sizing: border-box;
		}

		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		/* Style the header */
		.header {
			padding: 5px;
			text-align: center;
		}

		/* Create three unequal columns that floats next to each other */
		.column {
			float: left;
			padding: 10px;
		}

		/* Left and right column */
		.column.side {
			width: 50%;
		}

		/* Middle column */
		.column.middle {
			width: 100%;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		/* Style the footer */
		.footer {
			padding: 10px;
			text-align: start;
		}

		.end {
			padding: 10px;
			position: absolute;
			right: 0;
			bottom: 0;
		}

		/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
		@media (max-width: 600px) {

			.column.side,
			.column.middle {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	@php
		use Carbon\Carbon;
		$now = Carbon::now();
	@endphp
	<div class="header">
		<strong style="margin-bottom: -20px">
			Dr. {{ $appointment->doctors->first_name }} {{ $appointment->doctors->last_name }}
		</strong><br>
		<img src="{{ public_path('assets/img/logo-full.png') }}" alt="Diagcare" style="width:50%; margin-bottom: -20px">
		{{-- <p style="margin-bottom: -20px"><i>{{ $appointment->clinics->address }}</i></p> --}}
	</div>
	<div class="row">
		<div class="column side">
			<h5 style="margin-bottom: -20px">Name: {{ $appointment->patients->name }}</h5>
			<h5 style="margin-bottom: -20px">Gender: {{ $appointment->patients->genders->name ?? '' }}</h5>
		</div>
		<div class="column side">
			<h5 style="margin-bottom: -20px">Age: {{ $appointment->patients->age ?? '' }}</h5>
			<h5 style="margin-bottom: -20px">Date: {{ Carbon::parse($now)->isoFormat('MMM DD, YYYY') }}</h5>
		</div>
	</div>
	<hr>
	<img src="{{ public_path('img/prescription/rx.png') }}" alt="Rx" style="height:80px;width:80px">
	<br>
	<div class="footer">
		@php
			$i = 1;
		@endphp
		@foreach ($prescriptions as $pres)
			<p>
				<strong><i>{{ $i }}) </i></strong> <strong>{{ $pres->inscription }}</strong>
				<i>{{ $pres->subscription }}</i> <span>{{ $pres->transcription }}</span>
			</p>
			@php
				$i++;
			@endphp
		@endforeach
	</div>
	<div class="end">
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>
				{{ $appointment->doctors->first_name }} {{ $appointment->doctors->last_name }}
			</strong>
		</p>
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>License No.:</strong>_____________________
		</p>
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>PTR No.:</strong>________________________
		</p>
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>TIN:</strong>____________________________
		</p>
	</div>
</body>

</html>
