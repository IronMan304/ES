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
	<table class="table table-bordered border-dark">
		<thead>
			<td colspan="2">
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
					<h5><strong>MEDICAL EXAMINATION REPORT</strong></h5>
				</div>
			</td>
		</thead>
		<tbody>
			<tr>
				<td style="width: 50%">
					<span class="p-2">
						NAME: <span style="font-size: large"><strong>{{ $patient->name }}</strong></span>
					</span>
				</td>
				@if ($examination == null)
					<td style="width: 50%">
						<span class="p-2">
							DATE OF EXAMINATION:
						</span>
					</td>
				@else
					<td style="width: 50%">
						<span class="p-2">
							DATE OF EXAMINATION: {{ Carbon\Carbon::parse($examination->created_at)->format('F d, Y') }}
						</span>
					</td>
				@endif
			</tr>
			<tr>
				<td style="width: 50%">
					<span class="p-2">
						ADDRESS: <span style="text-transform: capitalize">{{ $patient->address ?? '' }}</span>
					</span>
				</td>
				<td style="width: 50%">
					<span class="p-2">
						SEX: {{ $patient->genders->name ?? '' }}
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<div class="row p-2">
						<div class="col-6">
							COMPANY: {{ $company->name }}
						</div>
						<div class="col-6">
							CONTACT NO: {{ $patient->contact_number }}
						</div>
					</div>
				</td>
				<td>
					<table>
						<tbody>
							<tr style="border-bottom: 1px solid #000;">
								<td style=" width: 50%;">
									<span class="p-2">
										CIVIL STATUS: {{ $patient->civil_statuses->name ?? '' }}
									</span>
								</td>
								<td class="ps-1" style=" width: 50%;border-left: 1px solid #000">
									<span class="p-2">
										AGE: {{ $patient->age ?? '' }}
									</span>
								</td>
							</tr>
							<tr>
								<td style=" width: 50%">
									<span class="p-2">
										BIRTHDATE:
										<span>{{ Carbon\Carbon::parse($patient->birthdate)->format('F d, Y') ?? '' }}</span>
									</span>
								</td>
								<td class="ps-1" style=" width: 50%; border-left: 1px solid #000">
									<span class="p-2">
										BLOOD TYPE:
										<span>{{ $patient->blood_types->name ?? '' }}</span>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 50%">
					<div class="p-2">
						<div>NATURE OF EXAMINATION:</div>
						<div class="text-center">
							@php
								$selectedNatureId = $examination->nature_of_examination_id;
							@endphp
							@foreach ($nature_of_examinations as $noe)
								@php
									$checked = $selectedNatureId == $noe->id ? 'checked' : '';
									$disabled = $selectedNatureId ? 'disabled' : '';
								@endphp
								@if ($selectedNatureId)
									@if ($checked)
										(<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:2%">) {{ $noe->name }}
									@else
										(<span style="color: white">__</span>)
										{{ $noe->name }}
									@endif
								@else
									@if ($noe->id == 2)
										(<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:2%">)
										{{ $noe->name }}
									@else
										(<span style="color: white">__</span>)
										{{ $noe->name }}
									@endif
								@endif
							@endforeach
						</div>
					</div>
				</td>

				<td style="width: 50%">
					<div class="row p-2">
						<div class="col-12 fw-bold">LAST MENSTRUAL PERIOD (FOR WOMEN):
							<span
								class="fw-normal">{{ Carbon\Carbon::parse($examination->menstrual_period)->format('F d, Y') ? $examination->menstrual_period : ' ' }}</span>
						</div>
						<div class="col-6">GRAVIDA: {{ $examination->gravida ?? ' ' }}</div>
						<div class="col-6">PARA: {{ $examination->para ?? ' ' }}</div>
						<div class="col-6">ABORTION: {{ $examination->abortion ?? ' ' }}</div>
						<div class="col-6">LIVING: {{ $examination->living ?? ' ' }}</div>
					</div>
				</td>
			</tr>
			<tr>
				@if ($history)
					<td style="width: 50%">
						<div class="p-2">
							<div>PAST MEDICAL HISTORY: <span>{{ $history->medical_history }}</span></div>
							<div>PRESENT ILLNESS: <span>{{ $history->present_illness }}</span></div>
							<div>FAMILY HISTORY: <span>{{ $history->family_history }}</span></div>
							<div>PERSONAL AND SOCIAL HISTORY: <span>{{ $history->personal_social_history }}</span></div>
						</div>
					</td>
				@else
					<td style="width: 50%">
						<div class="p-2">
							<div>PAST MEDICAL HISTORY:</div>
							<div>PRESENT ILLNESS:</div>
							<div>FAMILY HISTORY:</div>
							<div>PERSONAL AND SOCIAL HISTORY:</span></div>
						</div>
					</td>
				@endif
				@if ($habit)
					<td style="width: 50%">
						<div class="p-2">
							<div>SMOKER? @if ($habit->smoker == 'yes')
									<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:2%"> Yes
									___ No
								@else
									___ Yes
									<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:2%"> No
								@endif
							</div>
							<div class="mb-1">
								NO. OF PACKS/DAY:
								<span style="text-decoration: underline">{{ $habit->packs_per_day ? $habit->packs_per_day : '___' }}</span>
								/YEAR
								<span style="text-decoration: underline">{{ $habit->packs_per_year ? $habit->packs_per_year : '___' }}</span>
							</div>
							<div>ALCOHOLIC DRINKER? @if ($habit->alcoholic == 'yes')
									<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:2%"> Yes
									___ No
								@else
									___ Yes
									<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:2%"> No
								@endif
							</div>
							<div>
								AMOUNT OF ALCOHOL CONSUMED: <span
									style="text-decoration: underline">{{ $habit->alcohol_consummed ? $habit->alcohol_consummed : '___' }}
								</span>
							</div>
						</div>
					</td>
				@else
					<td style="width: 50%">
						<div class="p-2">
							<div>SMOKER?
								___ Yes
								___ No</div>
							<div class="mb-1">
								NO. OF PACKS/DAY: __

								/YEAR __

							</div>

							<div>ALCOHOLIC DRINKER?
								___ Yes
								___ No
							</div>
							<div>
								AMOUNT OF ALCOHOL CONSUMED:
							</div>
						</div>
					</td>
				@endif
			</tr>
			<tr>
				<td>
					<div class="px-2">
						<strong>I. PHYSICAL EXAMINATION</strong>
					</div>
					<table>
						<tbody>
							<tr>
								<td>
									<div class="px-2">
										HEIGHT: <span style="text-decoration: underline">{{ $examination->height ?? '' }}</span>
									</div>
								</td>
								<td>
									<div class="px-2">
										WEIGHT: <span style="text-decoration: underline">{{ $examination->weight ?? '' }}</span>
									</div>
								</td>
								<td>
									<div class="px-2">
										TEMPERATURE: <span style="text-decoration: underline">{{ $examination->temperature ?? '' }}</span>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="row">
										<div class="col-7 text-end">
											PULSE RATE: <span style="text-decoration: underline">{{ $examination->pulse_rate ?? '' }}</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="row">
										<div class="col-7 text-end">
											BLOOD PRESSURE: <span style="text-decoration: underline">{{ $examination->blood_pressure ?? '' }}</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="row">
										<div class="col-7 text-end">
											VISUAL ACUITY ( R ): <span
												style="text-decoration: underline">{{ $examination->visual_acuity_right ?? '' }}</span>
										</div>
										<div class="col-5">
											( L ):
											<span style="text-decoration: underline">{{ $examination->visual_acuity_left ?? '' }}
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<div class="row">
										<div class="col-7 text-end">
											HEARING ( R ): <span style="text-decoration: underline">{{ $examination->hearing_right ?? '' }}</span>
										</div>
										<div class="col-5">
											( L ): <span style="text-decoration: underline">{{ $examination->hearing_left ?? '' }}</span>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td class="text-center">
					<strong>COVID-19 VACCINATION CARD</strong>
					<table>
						<thead>
							<th style="width: 30%; border-top: 1px; border-top: 1px solid black"><i>DOSAGE SEQ.</i></th>
							<th style="width: 40%; border-top: 1px solid black;  border-left: 1px solid black"><i>DATE</i></th>
							<th style="width: 30%; border-top: 1px solid black;   border-left: 1px solid black"><i>BRAND</i></th>
						</thead>
						<tbody>
							@foreach ($vaccines as $vacc)
								@php
									$vacc_data = App\Models\Vaccination::where('vaccine_id', $vacc->id)
									    ->where('booking_id', $booking->id)
									    ->first();
								@endphp

								<tr>
									<td style="width: 30%; border-top: 1px solid black;" class="text-center">{{ $vacc->name }}</td>
									<td style="width: 30%; border-top: 1px solid black;   border-left: 1px solid black">
										@if ($vacc_data)
											{{ $vacc_data->vaccine_date ? Carbon\Carbon::parse($vacc_data->vaccine_date)->format('M d, Y') : ' ' }}
										@else
										@endif
									</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black">
										@if ($vacc_data)
											{{ $vacc_data->brand }}
										@else
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table>
						<thead style="border-bottom: 1px solid #000; border-collapse: collapse;" class="fw-bold">
							<th style="background-color: lightblue; width:60%">
								<div class="px-2">
									FINDINGS (FOR DOCTOR'S USE ONLY)
								</div>
							</th>
							<th style="background-color: lightblue; border-left: 1px solid #000; width:20%" class="text-center">NORMAL</th>
							<th style="background-color: lightblue; border-left: 1px solid #000; width:20%" class="text-center">POSITIVE
							</th>
						</thead>
						<tbody>
							@php $letter = 'A'; @endphp
							@foreach ($finds as $find)
								<tr style="border-top: 1px solid #000">
									<td>
										<div class="px-2">
											{{ $letter }}. {{ $find->name }}
										</div>
									</td>
									@php
										$f = App\Models\DoctorFindings::where('finding_id', $find->id)
										    ->where('booking_id', $booking->id)
										    ->first();
									@endphp
									<td style="border-left: 1px solid #000">
										@if ($f)
											@if ($f->findings == 0)
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:10%">
													</div>
												</div>
											@endif
										@endif
									</td>
									<td style="border-left: 1px solid #000">
										@if ($f)
											@if ($f->findings == 1)
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:10%">
													</div>
												</div>
											@endif
										@endif
									</td>
								</tr>
								@php $letter++; @endphp
							@endforeach
						</tbody>

					</table>
				</td>
				<td>
					<table>
						<thead class="text-justify-center" style="border-bottom: 1px solid #000">
							<th class="fw-bold text-center" style="background-color: lightblue">MENTAL HEALTH ASSESSMENT</th>
						</thead>
						<tbody style="font-size: 10px;">
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											1.) A poor appetite or overeating?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->appetite_overeating == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->appetite_overeating == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											2.) Insomia or oversleeping?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->insomia == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->insomia == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											3.) Chronic fatigue or low energy?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->chronic_fatigue == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->chronic_fatigue == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											4.) Less active or talkative than usual?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->less_active == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->less_active == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											5.) Restless or agitated?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->restless == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->restless == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											6.) Avoiding company of people?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->avoid_people == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->avoid_people == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											7.) Lost interest in activities?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->lost_interest == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->lost_interest == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											8.) Decreased feeling of self-esteem?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->self_esteem == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->self_esteem == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											9.) Shows evidence of suicidal attempts?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->suicidal_attempts == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->suicidal_attempts == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="row px-2">
										<div class="col-8">
											10.) Poor concentration and difficulty in making decisions?
										</div>
										<div class="col-4">
											<span>
												@if ($mental)
													@if ($mental->poor_concentration == 'yes')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> Yes
													@else
														__ Yes
													@endif
												@else
													__ Yes
												@endif
											</span>
											<span>
												@if ($mental)
													@if ($mental->poor_concentration == 'no')
														<img src="{{ asset('assets/img/check.png') }}" alt="check"
															style="width:7%; border-bottom:1px #000 solid"> No
													@else
														__ No
													@endif
												@else
													__ No
												@endif
											</span>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="p-2">
						<div class="fw-bold">REMARKS:</div>
						{{ $diag->remarks ?? '' }}
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<table>
										<thead>
											<th style="width: 33%">
												<div class="px-2">
													II. LABORATORY EXAMINATION
												</div>
											</th>
											<th style="width: 32%;border-left: 1px solid black; border-right: 1px solid black">
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														REMARKS
													</div>
												</div>
											</th>
											<th style="width: 35%;border-left: 1px solid black">
												<div class="px-2">
													III. DIAGNOSTIC EXAMINATION
												</div>
											</th>
										</thead>
										<tbody>
											<tr>
												<td style="border-width: 1px 0px 1px 0px">
													<div class="px-2">
														COMPLETE BLOOD COUNT (Blood)
													</div>
												</td>
												<td style="border-width: 1px 1px 1px 1px">
													<div class="px-2">
														@php
															$hema = App\Models\BookingServiceKey::where('booking_id', $booking->id)
															    ->where('service_id', 2)
															    ->first();
														@endphp
														<span>
															@if (isset($hema))
																{{ $hema->remarks ?? 'Unremarkable' }}
															@endif
														</span>
													</div>
												</td>
												<td style="border-width: 1px 0px 1px 1px">
													<div class="px-2">
														CHEST XRAY
													</div>
												</td>
											</tr>
											<tr>
												<td style="border-width: 1px 0px 1px 0px">
													<div class="px-2">
														URINALYSIS (Urine)
													</div>
												</td>
												<td style="border-width: 1px 1px 1px 1px">
													<div class="px-2">
														@php
															$urine = App\Models\BookingServiceKey::where('booking_id', $booking->id)
															    ->where('service_id', 1)
															    ->first();
														@endphp
														<span>
															@if (isset($urine))
																{{ $urine->remarks ?? 'Unremarkable' }}
															@endif
														</span>
													</div>
												</td>
												<td style="border-width: 1px 0px 1px 1px">
													<div class="px-2">
														IMPRESSION
													</div>
												</td>
											</tr>
											<tr>
												<td style="border-width: 1px 0px 1px 0px">
													<div class="px-2">
														FECALYSIS (Stool)
													</div>
												</td>
												<td style="border-width: 1px 1px 1px 1px">
													<div class="px-2">
														@php
															$fecal = App\Models\BookingServiceKey::where('booking_id', $booking->id)
															    ->where('service_id', 16)
															    ->first();
														@endphp
														<span>
															@if (isset($fecal))
																{{ $fecal->remarks ?? 'Unremarkable' }}
															@endif
														</span>
													</div>
												</td>
												<td style="border-width: 1px 0px 0px 1px">
													<div class="px-2">
														@php
															$xray = App\Models\BookingServiceKey::where('booking_id', $booking->id)
															    ->where('service_id', 19)
															    ->first();
														@endphp
														@if (isset($xray))
															<span>{{ $xray->remarks ?? 'Negative Chest Findings' }}</span>
														@endif
													</div>
												</td>
											</tr>
											<tr>
												<td style="border-width: 1px 0px 1px 0px">
													<div class="px-2">
														OTHER TEST
													</div>
												</td>
												<td style="border-width: 1px 1px 1px 1px">
													<div class="px-2">
														{{ $lab_test->other_test ?? 'Unremarkable' }}
													</div>
												</td>
												<td style="border-width: 0px 0px 0px 0px">

												</td>
											</tr>
											<tr>
												<td style="border-width: 1px 0px 0px 0px">
													<div class="px-2">
														DRUG TEST
													</div>
												</td>
												<td style="border-width: 1px 1px 0px 1px">
													<div class="px-2">
														@php
															$drug = App\Models\BookingServiceKey::where('booking_id', $booking->id)
															    ->where('service_id', 20)
															    ->first();
														@endphp
														<span>
															@if (isset($drug))
																{{ $drug->remarks ?? 'Unremarkable' }}
															@endif
														</span>
													</div>
												</td>
												<td style="border-width: 0px 0px 0px 1px">

												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="row mb-2" style="margin-top:-15px; margin-bottom:5px">
		<span><strong>CONCLUSION: Please check appropriate box.</strong></span>
	</div>
	<div class="row d-flex justify-content-center">
		<div class="col-8">
			<table>
				<tbody>
					@foreach ($conclusions as $con)
						<tr>
							<td style="width: 80%; border-width:1px">
								<div class="px-2">
									{{ $con->name }}
								</div>
							</td>
							<td style="width: 10%; border-width:1px">
								<div class="row">
									<div class="col-12 d-flex justify-content-center">
										<strong>{{ $con->char_rep }}</strong>
									</div>
								</div>
							</td>
							<td style="width: 10%; border-width:1px">
								@if ($lab_test)
									@if ($con->id == $lab_test->conclusion_id)
										<div class="row">
											<div class="col-12 d-flex justify-content-center">
												<img src="{{ asset('assets/img/check.png') }}" alt="check" style="width:15%">
											</div>
										</div>
									@endif
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="row mb-1">
		<span><strong>COMMENTS:</strong> {{ $lab_test->comment ?? '' }}</span>
	</div>
	<div class="row">
		<div class="col-8">
		</div>
		<div class="col-4 d-flex justify-content-center">
			<div class="row">
				@if ($lab_test)
					@if ($lab_test->doctor_id == null)
						<div class="col-12 d-flex justify-content-center">
							<br>
							<span style="text-decoration: overline">EXAMINING PHYSICIAN</span>
						</div>
					@else
						@if (isset($lab_test->doctors->esignature))
							<div class="col-12 d-flex justify-content-center">
								<img src="{{ asset('/storage/' . $lab_test->doctors->esignature) }}" alt="e_signature" style="width:30%; margin-bottom:-60px">
							</div>
						@endif
						<div class="col-12 d-flex justify-content-center">
							<span style="text-decoration: underline" class="text-uppercase">Dr. {{ $lab_test->doctors->first_name }}
								{{ $lab_test->doctors->middle_name ?? '' }} {{ $lab_test->doctors->last_name }}</span><br>
						</div>
						<div class="col-12 d-flex justify-content-center mt-2">
							<p>EXAMINING PHYSICIAN</p>
						</div>
					@endif
				@else
					<div class="col-12 d-flex justify-content-center">
						<br>
						<span style="text-decoration: overline">EXAMINING PHYSICIAN</span>
					</div>
				@endif
			</div>
		</div>
	</div>

	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
