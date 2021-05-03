<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Livewire Ecommerce </title>	

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/images/favicon.ico')}}">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">

	{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> --}}

<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/flexslider.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/color-03.css')}}">
	
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/custom.css')}}">
	<!-- CDN -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

	@stack('css')
    @livewireStyles
</head>
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	@include('layouts.frontend.header')

    {{-- Main --}}
    {{ $slot}}

    @include('layouts.frontend.footer')
	
	<script src="{{asset('frontend/assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{asset('frontend/assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/jquery.flexslider.js')}}"></script>
	<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/jquery.sticky.js')}}"></script>
	<script src="{{asset('frontend/assets/js/functions.js')}}"></script>
	<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
	{!! Toastr::message() !!}
	
	@stack('js')
    @livewireScripts
</body>
</html>