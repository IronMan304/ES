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
		body {
			overflow: hidden;
			position: relative;
		}

		p,
		span {
			font-size: medium;
			margin-bottom: -5px;
			margin-top: -5px;
		}

		tr td {
			font-size: medium;
			padding: 0 !important;
			margin: 0 !important;
		}

		table {
			width: 100% !important;
			position: relative;
		}

		.bg-image {
			opacity: 0.5;
			height: 150px;
			width: 150px;
			position: absolute;
			left: 50%;
			margin-left: -50px;
			top: 50%;
			margin-top: -50px;
		}
	</style>
</head>

<body onload="window.print()">
	@php
		use Carbon\Carbon;
	@endphp
	<img src="{{ asset('assets/img/favicon.png') }}" alt="Diagcare" class="bg-image">
	<table class="table table-bordered" style="border: 1px solid white">
		<thead>
			<tr>
				<td>
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
						<h5><strong>IMAGING DEPARTMENT</strong></h5>
					</div>
				</td>
			</tr>
			<tr>
				<td class="wbg">
					<table>
						<tbody>
							<tr>
								<td colspan="3">
									<div class="row d-flex justify-content-end pb-2">
										<div class="col-1 d-flex justify-content-end">
											Date:
										</div>
										<div class="col-3 d-flex justify-content-center text-uppercase" style="border-bottom: 1px solid black">
											@if (count($xray) != 0)
												{{ Carbon::parse($xray[0]->created_at)->format('F d, Y') }}
											@endif
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="row pb-2">
										<div class="col-auto">
											Name:
										</div>
										<div class="col text-uppercase" style="border-bottom: 1px solid black; font-size: larger">
											<strong>{{ $booking->patients->name }}</strong>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row pb-2">
										<div class="col-auto">
											Age:
										</div>
										<div class="col" style="border-bottom: 1px solid black">
											{{ $booking->patients->age }}
										</div>
									</div>
								</td>
								<td>
									<div class="row pb-2">
										<div class="col-4 d-flex justify-content-end">
											Sex:
										</div>
										<div class="col-8" style="border-bottom: 1px solid black">
											{{ $booking->patients->genders->name }}
										</div>
									</div>
								</td>
								<td>
									<div class="row pb-2">
										<div class="col-4 d-flex justify-content-end">
											Plate No.:
										</div>
										<div class="col-8" style="border-bottom: 1px solid black">
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="row pb-2">
										<div class="col-auto">
											Type of Examination:
										</div>
										{{-- <div class="col" style="border-bottom: 1px solid black">
											@if (count($xray) != 0)
												{{ $xray[0]->result_value }}
											@endif
										</div> --}}
										<div class="col" style="border-bottom: 1px solid black">
											Chest PA View
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="row pb-2">
										<div class="col-auto">
											Requested by:
										</div>
										<div class="col text-uppercase" style="border-bottom: 1px solid black">
											{{ $booking->patients->name }}
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<div class="col-md-12 d-flex justify-content-center mb-3">
						<h5>RESULT</h5>
					</div>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="wbg">
					<div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <h5>Chest PA View</h5>
                        </div>
						@foreach ($xray as $item)
							<div class="col-12 d-flex justify-content-center">
								<h5>{{ $item->result_value }}</h5>
							</div>
						@endforeach
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="row d-flex justify-content-center">
		<div class="col-12">
			<div class="row">
				<div class="col-12 d-flex justify-content-center">
					<img src="{{ asset('/storage/' . $rad->signature) }}" alt="e_signature"
						style="width:20%; margin-bottom:-90px">
				</div>
				<div class="col-12 d-flex justify-content-center mb-1">
					<span style="text-decoration: underline" class="text-uppercase">{{ $rad->name }}</span><br>
				</div>
				<div class="col-12 d-flex justify-content-center mb-1">
					<span style="font-size: small">{{ $rad->license_num }}</span><br>
				</div>
				<div class="col-12 d-flex justify-content-center mb-4">
					<span><strong>RADIOLOGIST</strong></span><br>
				</div>
			</div>
		</div>
	</div>
	<div class="row d-flex justify-content-center">

	</div>
	<div class="row mb-2" style="margin-bottom:5px">
		<div class="row">
			<div class="col-12 d-flex justify-content-center">
				<span><strong>PLEASE CORRELATE CLINICALLY.</strong></span>
			</div>
		</div>
	</div>
	<br>
	<div class="row mb-2" style="margin-bottom:5px">
		<div class="row">
			<div class="col-12 d-flex justify-content-center">
				<span>Always seek advice of a Physician with any questions you may have regarding a medical</span>
			</div>
		</div>
	</div>
	<div class="row mb-2" style="margin-bottom:5px">
		<div class="row">
			<div class="col-12 d-flex justify-content-center">
				<span>condition. This Clinic will not take legal responsibilities if the patient provides wrong</span>
			</div>
		</div>
	</div>
	<div class="row mb-2" style="margin-bottom:5px">
		<div class="row">
			<div class="col-12 d-flex justify-content-center">
				<span>information regarding his/her true identity. </span>
			</div>
		</div>
	</div>
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
