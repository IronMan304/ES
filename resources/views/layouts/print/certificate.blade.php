<!DOCTYPE html>
<html lang="en">

<head>
	<title style="text-transform: capitalize;">Medical Certificate - {{ $appointment->patients->id }}</title>
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

		.column.side1 {
			width: 30%;
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
		<img src="{{ public_path('assets/img/logo-full.png') }}" alt="Diagcare" style="width:50%; margin-bottom: -20px">
	</div>
	<div class="row">
		<div class="column side1">
		</div>
		<div class="column side1">
		</div>
		<div class="column side1">
			<h5 style="margin-bottom: -20px">
				Date: {{ Carbon::parse($now)->isoFormat('MMM DD, YYYY') }}
			</h5>
		</div>
	</div>
	<br>
	<div class="header">
		<h3 style="text-decoration: underline; font-family:'Times New Roman', Times, serif">MEDICAL CERTIFICATE</h3>
	</div>
	<div class="footer">
		<span>To whom it may concern: </span><br>
	</div>
	<div class="footer" style="text-indent: 50px">
		<span>
			This is to certify that
			@if ($appointment->patients->gender_id == 1)
				Mr.
			@else
				Ms./Mrs.
			@endif
			<span style="text-decoration: underline"> {{ $appointment->patients->name }} </span>,
			<span style="text-decoration: underline"> {{ $appointment->patients->age }} years old </span>,
			<span style="text-decoration: underline"> {{ $appointment->patients->genders->name }} </span>,
			has been examined by the undersigned and found
			@if ($appointment->patients->gender_id == 1)
				him
			@else
				her
			@endif
			<span style="text-decoration: underline"> {{ $certificate->diagnosis }} </span>
			@if (isset($certificate->recovery_days))
				and is advised to <span style="text-decoration: underline"> {{ $certificate->recovery_days }} </span>
			@else
			@endif
		</span>
	</div>
	<div class="footer" style="text-indent: 50px">
		<span>
			This certification is being issued upon request by the interested party for: 
			<span style="text-decoration: underline"> {{ $certificate->request_reason }} .</span>
		</span>
	</div>
	<div class="end">
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>
				{{ $appointment->doctors->first_name }} {{ $appointment->doctors->last_name }}
			</strong>
		</p>
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>License No.:</strong>________________________
		</p>
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>PTR No.:</strong>___________________________
		</p>
		<p style="font-size: 14px;margin-bottom: -15px">
			<strong>TIN:</strong>_______________________________
		</p>
	</div>
</body>

</html>
