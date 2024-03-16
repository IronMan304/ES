<!DOCTYPE html>
<html lang="en">

<head>
	<title style="text-transform: capitalize;">{{ $data->service->name }} - {{ $data->booking->barcode }}</title>
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

		table,
		th,
		td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
</head>

<body>
	@php
		use Carbon\Carbon;
		$now = Carbon::now();
	@endphp
	<div class="header">
		<img src="{{ public_path('assets/img/logo-full.png') }}" alt="Diagcare"
			style="width:50%; margin-bottom: -20px; margin-top: -20px">
        <p style="font-size:xx-small; margin-bottom:-10px">Dr. V. Locsin Street, Dumaguete City</p>
        <p style="font-size:xx-small; margin-bottom:-10px">Website: https://diag.care</p>
        <p style="font-size:xx-small; margin-bottom:-10px">Tel. No.: +63 035 421-0838 / 035-421-0259 / 09177250891</p>
        <p style="font-size:xx-small; margin-bottom:-10px">Email Address: contact@diag.care</p>
	</div>
	<br>
	<table style="width: 100%">
		<tbody>
			<tr>
				<td>
					Patient Name: <strong>{{ $data->booking->patient->name }}</strong>
				</td>
				<td>
					Code: {{ $data->booking->barcode }}
				</td>
			</tr>
			<tr>
				<td>
					Age: {{ $data->booking->patient->age ?? '' }}
				</td>
				<td>
					Gender: {{ $data->booking->patient->genders->name ?? '' }}
				</td>
			</tr>
			<tr>
				<td>
					Birthdate: {{ Carbon::parse($data->booking->patient->birthdate)->format('F d, Y') ?? '' }}
				</td>
				<td>
					Contact Number: {{ $data->booking->patient->contact_number ?? '' }}
				</td>
			</tr>
			<tr>
				<td colspan="2"><small>Result printed on: {{ $now->format('F d, Y') }}, {{ $now->format('h:i a') }}</small></td>
			</tr>
		</tbody>
	</table>
	<div class="header" style="margin-top: -15px; margin-bottom:-15px">
		<h4>{{ $data->service->name }}</h4>
	</div>
	<table style="width:100%">
		<thead>
			@if ($has_unit == true)
				<th>Test</th>
				<th>Result</th>
				<th>Unit</th>
			@elseif ($has_range == true)
				<th>Test</th>
				<th>Result</th>
				<th>Normal Range</th>
			@elseif ($has_both == true)
				<th>Test</th>
				<th>Result</th>
				<th>Unit</th>
				<th>Normal Range</th>
			@else
				<th>Test</th>
				<th>Result</th>
			@endif
		</thead>
		<tbody>
			@if ($has_unit == true)
				@foreach ($results as $res)
					<tr>
						<td>
							{{ $res->results->name }}
						</td>
						<td>
							{{ $res->result_value }}
						</td>
						<td>
							{{ $res->results->units->name }}
						</td>
					</tr>
				@endforeach
			@elseif ($has_range == true)
				@foreach ($results as $res)
					<tr>
						<td>
							{{ $res->results->name }}
						</td>
						<td>
							{{ $res->result_value }}
						</td>
						<td>
							{{ $res->results->range }}
						</td>
					</tr>
				@endforeach
			@elseif ($has_both == true)
				@foreach ($results as $res)
					<tr>
						<td>
							{{ $res->results->name }}
						</td>
						<td>
							{{ $res->result_value }}
						</td>
						<td>
							{{ $res->results->units->name }}
						</td>
						<td>
							{{ $res->results->range }}
						</td>
					</tr>
				@endforeach
			@else
				@foreach ($results as $res)
					<tr>
						<td>
							{{ $res->results->name }}
						</td>
						<td>
							{{ $res->result_value }}
						</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</body>

</html>
