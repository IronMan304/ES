<!DOCTYPE html>
<html lang="en">

<head>
	<title style="text-transform: capitalize;">Barcode - {{ $booking->patients->name }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	{{-- <style>
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
	</style> --}}
</head>

<body onload="window.print()">
	@php
		use Carbon\Carbon;
		$now = Carbon::now();
	@endphp
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center">
			@php
				echo DNS1D::getBarcodeHTML($booking->barcode, 'C128',3,33);
			@endphp
		</div>
        <div class="col-md-12 d-flex justify-content-center">
			<h5>{{ $booking->barcode }}</h5>
		</div>
		<div class="col-md-12 d-flex justify-content-center">
			<h4>{{ $booking->patients->name }}</h4>
		</div>
		<div class="col-md-12 d-flex justify-content-center">
			<h5>
				{{ $booking->patients->age }} /
                @if ($booking->patients->gender_id == 1)
					M
				@else
					F
				@endif
			</h5>
		</div>
	</div>
</body>

</html>
