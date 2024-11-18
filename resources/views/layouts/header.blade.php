<html lang="en">
  <head>
    <title>Wellnez Mart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('public/assets/images/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/assets/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('public/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('public/assets/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('public/assets/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('public/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
  </head>
  <body class="goto-here">

    <nav style="z-index: 515154412125; overlay:hidden" class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{route('home')}}">Wellnez Mart</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item cta-colored"><a href="{{route('home')}}" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="{{route('shop')}}" class="nav-link">Products</a></li>
              <li class="nav-item"><a href="{{route('blog')}}" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="{{route('about')}}" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact</a></li>
	          <li class="nav-item cta cta-colored"><a href="{{route('cart.view')}}" class="nav-link"><span class="icon-shopping_cart"></span>@if (session('cart')) [{{count(session('cart'))}}] @else[0] @endif</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>


    <!-- END nav -->
