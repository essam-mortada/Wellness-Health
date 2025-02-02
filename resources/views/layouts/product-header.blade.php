<html lang="en">
  <head>
    <title>{{$product->name}} - Wellnez mart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- SEO Meta Tags -->
        <meta name="description" content="{{ Str::limit($product->description, 160) }}">
        <meta name="keywords" content="{{ $product->name }}, wellness, health, skincare, organic products, natural remedies, Wellnez Mart">
        <meta name="author" content="Wellnez Mart">

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="{{ $product->name }} - Wellnez Mart">
        <meta property="og:description" content="{{ Str::limit($product->description, 160) }}">
        <meta property="og:image" content="{{ asset('public/products_uploads/'.$product->images->first()->image_path) }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="product">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $product->name }} - Wellnez Mart">
        <meta name="twitter:description" content="{{ Str::limit($product->description, 160) }}">
        <meta name="twitter:image" content="{{ asset('public/products_uploads/'.$product->images->first()->image_path) }}">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}" />

        <!-- Structured Data (Schema.org) -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "Product",
          "name": "{{ $product->name }}",
          "description": "{{ $product->description }}",
          "image": "{{ asset('public/products_uploads/'.$product->images->first()->image_path) }}",
          "brand": {
            "@type": "Brand",
            "name": "Wellnez Mart"
          },
          "offers": {
            "@type": "Offer",
            "priceCurrency": "EGP",
            "price": "{{ $product->price }}",
            "availability": "https://schema.org/{{ $product->quantity > 0 ? 'InStock' : 'OutOfStock' }}",
            "url": "{{ url()->current() }}"
          }
        }
        </script>
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
          <div class="header-search-wrap ">
            <div class="header-search-1">
                <div class="search-icon">
                    <i class="oi oi-magnifying-glass"></i>
                    <i class="icon-magnifier-remove  for-search-close"></i>
                </div>
            </div>
            <div class="header-search-1-form">
                <form id="search-form" method="get" action="{{route('search.products')}}">
                    <div class="search-input-container">
                        <input type="text" name="name" value="" placeholder=" search for product " />
                        <button type="submit" class="search-submit-icon">
                            <i class="oi oi-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
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

      @if (isset($newsBar))
<!-- ltn__header-top-area start -->
<div class="ltn__header-top-area top-area-color-white ">
    <ul>
        <li><strong> {{$newsBar->content}} </strong></li>
        <li><strong> {{$newsBar->content}} </strong></li>
        <li><strong> {{$newsBar->content}} </strong></li>
        <li><strong> {{$newsBar->content}} </strong></li>
        <li><strong> {{$newsBar->content}} </strong></li>
        <li><strong> {{$newsBar->content}} </strong></li>
    </ul>
</div>
<!-- ltn__header-top-area end -->
@endif
    <!-- END nav -->
