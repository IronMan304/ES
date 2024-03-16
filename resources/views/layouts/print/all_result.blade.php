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
		table {
			width: 100% !important;
		}

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

		.result-header {
			border-color: green black black black;
		}
	</style>
</head>

<body onload="window.print()">
	@php
		use Carbon\Carbon;
		$now = Carbon::now();
	@endphp
	<header>
		<table class="table table-bordered">
			<thead>
				<tr style="border-color: white">
					<th colspan="2">
						<div class="row">
							<div class="col-12 d-flex justify-content-end">
								<img src="{{ asset('assets/img/favicon.png') }}" alt="Diagcare" style="width:100%; border: 2px solid green">
							</div>
						</div>
					</th>
					<td colspan="10">
						<div class="row">
							<div class="col-12 d-flex justify-content-start mb-1">
								<strong>DIAGCARE - DIAGNOSTIC CARE AND LABORATORY SERVICES</strong>
							</div>
							<div class="col-12 d-flex justify-content-start mb-1">
								<p>Dr. V. Locsin Street, Dumaguete City</p>
							</div>
							<div class="col-12 d-flex justify-content-start mb-1">
								<p>Website: https://diag.care</p>
							</div>
							<div class="col-12 d-flex justify-content-start mb-1">
								<p>Tel. No.: +63 035 421-0838 / 035-421-0259 / 09177250891</p>
							</div>
							<div class="col-12 d-flex justify-content-start mb-1">
								<p>Email Address: contact@diag.care</p>
							</div>
						</div>
					</td>
				</tr>
			</thead>
		</table>
		<table class="table table-bordered border-dark">
			<tbody>
				<tr style="border-color: LightGray LightGray black LightGray">
					<td class="px-2">
						Patient Name: <b
							style="font-size:large; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ $booking->patient->name }}</b>
					</td>
					<td class="px-2">
						Code: {{ $booking->barcode }}
					</td>
				</tr>
				<tr style="border-color: LightGray LightGray black LightGray">
					<td class="px-2">
						Age: {{ $booking->patient->age ?? '' }} years old
					</td>
					<td class="px-2">
						Gender: {{ $booking->patient->genders->name ?? '' }}
					</td>
				</tr>
				<tr style="border-color: LightGray LightGray black LightGray">
					<td class="px-2">
						Birthdate: {{ Carbon::parse($booking->patient->birthdate)->format('F d, Y') ?? '' }}
					</td>
					<td class="px-2">
						Contact Number: {{ $booking->patient->contact_number ?? '' }}
					</td>
				</tr>
			</tbody>
		</table>
	</header>
	@if ($xray_check == true)
		<div class="row">
			@php
				$i = 0;
				$x = 1;
			@endphp
			@foreach ($results as $result)
				<div class="col-12">
					<div class="row">
						<div class="col-12">
							<table class="table table-bordered border-dark" style="width: 100%">
								<thead>
									<tr class="result-header" style="border-width: 4px 3px 1px 3px">
										<th colspan="2">
											<div class="row">
												<div class="col-12 d-flex justify-content-center">
													<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
												</div>
											</div>
										</th>
									</tr>
									<tr style="border-width: 1px 3px">
										<td colspan="2">
											<table>
												<tbody>
													<tr>
														<td style="width:50%; border-right:1px solid black" class="p-2">
															<div class="row">
																<div class="col-12 d-flex justify-content-start">
																	<span style="font-size: small">
																		<p>Type of View: <strong>{{ $result[2]->result_value ?? 'Chest PA View' }}</strong> </p>
																	</span>
																</div>
															</div>
														</td>
														<td style="width:50%" class="p-2">
															<div class="row">
																<div class="col-12 d-flex justify-content-end">
																	<span style="font-size: small">Result Date/Time:
																		{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</thead>
								<tbody>
									<tr style="border-width: 1px 3px">
										<td class="px-2">
											{{ $result[0]->results->name }}
										</td>
										<td>
											<div class="row">
												<div class="col-12 d-flex justify-content-center">
													<strong>{{ $result[0]->result_value }}</strong>
												</div>
											</div>
										</td>
									</tr>
									<tr style="border-width: 1px 3px 3px 3px">
										<td class="px-2" style="width:10%">
											{{ $result[1]->results->name }}
										</td>
										<td style="width:90%">
											<div class="row">
												<div class="col-12 d-flex justify-content-center">
													<strong>{{ $result[1]->result_value }}</strong>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				@php
					$i++;
					$x++;
				@endphp
			@endforeach
		</div>
	@else
		<div class="row">
			@php
				$i = 0;
				$x = 1;
			@endphp
			@foreach ($results as $result)
				@if (count($results) == $x)
					@if (count($results) % 2 != 0)
						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<table class="table table-bordered border-dark" style="width: 100%">
										<thead>
											@if ($has_unit[$i] == true)
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<th colspan="3">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px">
													<td colspan="3" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Unit
															</div>
														</div>
													</th>
												</tr>
											@elseif ($has_range[$i] == true)
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<td colspan="3">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px">
													<th colspan="3" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
													<th>
														Normal Range
													</th>
												</tr>
											@elseif ($has_both[$i] == true)
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<th colspan="4">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px">
													<td colspan="4" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Unit
															</div>
														</div>
													</th>
													<th>
														Normal Range
													</th>
												</tr>
											@else
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<th colspan="2">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px">
													<td colspan="2" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
												</tr>
											@endif
										</thead>
										<tbody>
											@php
												$y = 1;
											@endphp
											@if ($has_unit[$i] == true)
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@elseif ($has_range[$i] == true)
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@elseif ($has_both[$i] == true)
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@else
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@else
						<div class="col-6">
							<div class="row">
								<div class="col-12">
									<table class="table table-bordered border-dark" style="width: 100%">
										<thead>
											@if ($has_unit[$i] == true)
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<th colspan="3">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px">
													<td colspan="3" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Unit
															</div>
														</div>
													</th>
												</tr>
											@elseif ($has_range[$i] == true)
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<td colspan="3">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px">
													<th colspan="3" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
													<th>
														Normal Range
													</th>
												</tr>
											@elseif ($has_both[$i] == true)
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<th colspan="4">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px">
													<td colspan="4" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Unit
															</div>
														</div>
													</th>
													<th>
														Normal Range
													</th>
												</tr>
											@else
												<tr class="result-header" style="border-width: 4px 3px 1px 3px">
													<th colspan="2">
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
															</div>
														</div>
													</th>
												</tr>
												<tr style="border-width: 1px 3px">
													<td colspan="2" class="p-2">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<span style="font-size: small">Result Date/Time:
																	{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
															</div>
														</div>
													</td>
												</tr>
												<tr style="border-width: 1px 3px 3px 3px">
													<th>Test</th>
													<th>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																Result
															</div>
														</div>
													</th>
												</tr>
											@endif
										</thead>
										<tbody>
											@php
												$y = 1;
											@endphp
											@if ($has_unit[$i] == true)
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@elseif ($has_range[$i] == true)
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@elseif ($has_both[$i] == true)
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		{{ $res->results->units->name }}
																	</div>
																</div>
															</td>
															<td class="px-2">
																{{ $res->results->range }}
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@else
												@foreach ($result as $res)
													@if (count($result) == $y)
														<tr style="border-width: 1px 3px 3px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
														</tr>
													@else
														<tr style="border-width: 1px 3px">
															<td class="px-2">
																{{ $res->results->name }}
															</td>
															<td>
																<div class="row">
																	<div class="col-12 d-flex justify-content-center">
																		<strong>{{ $res->result_value }}</strong>
																	</div>
																</div>
															</td>
														</tr>
													@endif
													@php
														$y++;
													@endphp
												@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@endif
				@else
					<div class="col-6">
						<div class="row">
							<div class="col-12">
								<table class="table table-bordered border-dark" style="width: 100%">
									<thead>
										@if ($has_unit[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="3" class="p-2">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Unit
														</div>
													</div>
												</th>
											</tr>
										@elseif ($has_range[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<td colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px">
												<th colspan="3" class="p-2">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													Normal Range
												</th>
											</tr>
										@elseif ($has_both[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="4">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="4" class="p-2">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Unit
														</div>
													</div>
												</th>
												<th>
													Normal Range
												</th>
											</tr>
										@else
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="2">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h6 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h6>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="2" class="p-2">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
											</tr>
										@endif
									</thead>
									<tbody>
										@php
											$y = 1;
										@endphp
										@if ($has_unit[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@elseif ($has_range[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td class="px-2">
															{{ $res->results->range }}
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td class="px-2">
															{{ $res->results->range }}
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@elseif ($has_both[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
														<td class="px-2">
															{{ $res->results->range }}
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
														<td class="px-2">
															{{ $res->results->range }}
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@else
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td class="px-2">
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				@endif

				@php
					$i++;
					$x++;
				@endphp
			@endforeach
		</div>
	@endif
	@if ($xray_check == true)
		<footer>
			<div class="row d-flex justify-content-center">
				<div class="col-12">
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<img src="{{ asset('/storage/' . $rad->signature) }}" alt="e_signature"
								style="width:8%; margin-bottom:-45px">
						</div>
						<div class="col-12 d-flex justify-content-center mb-1">
							<span style="text-decoration: underline" class="text-uppercase">{{ $rad->name }}</span><br>
						</div>
						<div class="col-12 d-flex justify-content-center" style="margin-bottom: 2px">
							<span style="font-size: small">{{ $rad->license_num }}</span><br>
						</div>
						<div class="col-12 d-flex justify-content-center mb-4">
							<span><strong>RADIOLOGIST</strong></span><br>
						</div>
					</div>
				</div>
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
						<span>Always seek advice of a Physician with any questions you may have regarding a medical condition. </span>
					</div>
				</div>
			</div>
			<div class="row mb-2" style="margin-bottom:5px">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<span>This Clinic will not take legal responsibilities if the patient provides wrong information regarding his/her
							true identity.</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<span style="font-size: xx-small">Note*: This is a computer-generated report signature is not required.</span>
				</div>
			</div>
		</footer>
	@else
		<footer>
			<div class="row" style="margin-bottom:-5px">
				<div class="col-6">
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<img src="{{ asset('img/result/abad.jpg') }}" alt="Jennifer P. Abad, RMT" style="width:20%">
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<img src="{{ asset('img/result/dr_mcintire.jpg') }}" alt="Dr. Rogelio S. McIntire, MD, FPSP"
								style="width:10%">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<span style="text-decoration:underline">Jennifer P. Abad, RMT</span>
						</div>
						<div class="col-12 d-flex justify-content-center" style="font-size: xx-small">Medical Technologist</div>
						<div class="col-12 d-flex justify-content-center" style="font-size: x-small">PRC No.0016019</div>
					</div>
				</div>
				<div class="col-6">
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<span style="text-decoration:underline">Dr. Rogelio S. McIntire, MD, FPSP</span>
						</div>
						<div class="col-12 d-flex justify-content-center" style="font-size: xx-small">Pathologist</div>
						<div class="col-12 d-flex justify-content-center" style="font-size: x-small">PRC No.0074961</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<span style="font-size: xx-small">Note*: This is a computer-generated report signature is not required.</span>
				</div>
			</div>
		</footer>
	@endif

	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
