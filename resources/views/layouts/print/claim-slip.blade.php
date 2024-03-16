<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title style="text-transform: capitalize;">Claim Slip - {{ $booking->patients->name }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        .indent {
            padding-left: 75px;
        }

        .service-item {
            display: flex;
            justify-content: space-between !important;
        }

        .colspan-6 {
            width: 50%;
            float: left;
        }

        .header-font {
            font-size: small;
        }

        .claim-slip-container {
            width: 50%;
            margin: 0 auto;
            float: left;
        }

        .logo {
            width: 75%;
            margin-bottom: -10px;
            margin-top: -17px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="claim-slip-container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center p-2">
                <img class="logo" src="{{ asset('assets/img/logo-full.png') }}" alt="Diagcare">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center header-font" style="margin-bottom:-5px">
                        Maxima Limquiaco Bldg.
                    </div>
                    <div class="col-12 d-flex justify-content-center header-font" style="margin-bottom:-5px">
                        Dr. V. Locsin Street
                    </div>
                    <div class="col-12 d-flex justify-content-center header-font" style="margin-bottom:-5px">
                        Dumaguete City, Negros Oriental
                    </div>
                    <div class="col-12 d-flex justify-content-center header-font" style="margin-bottom:-5px">
                        Tel.Nos. 035-4210259, 421-0838
                    </div>
                    <div class="col-12 mt-2"><strong><h4 class="text-center">Claim Slip</h3></strong></div>
                </div>
            </div>
            <hr>
        </div>
       

        <div class="row">

            <div class="colspan-12">NAME: <strong>{{ $billing->patients->name }}</strong></div>
            
            <div class="colspan-12">SERVICES AVAILED:</div>
            <div class="colspan-12">
                @foreach ($services as $service)
                    <div class="indent service-item">
                        <div><strong>{{ $service->name }}</strong></div>
                        <div><strong>{{ number_format($service->price, 2)}}</strong></div>
                    </div>
                @endforeach
                <hr>
            </div>
            <div class="colspan-12 service-item">TOTAL AMOUNT <strong>₱{{ number_format($billing->total_amt, 2)}}</strong></div>
            <div class="text-center mt-2 d-flex flex-column align-items-end">
                @php
                    echo DNS1D::getBarcodeHTML($booking->barcode, 'C128', 3, 33);
                @endphp
                <div style="padding-right: 85px" class="fw-bold">{{ $booking->barcode }}</div>
            </div>
        </div>
    </div>
</body>
</html>
