<html lang="en">

<head>
    <title>Wellnez Mart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('public/assets/images/favicon.png') }}" type="image/x-icon">

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Discover premium wellness, health, diet, and skincare products at Wellnez Mart. Shop now for natural and organic solutions to enhance your well-being.">
    <meta name="keywords"
        content="wellness, health, diet, skincare, organic products, natural remedies, healthy lifestyle, beauty care, Wellnez Mart">
    <meta name="author" content="Wellnez Mart">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="Wellnez Mart - Wellness, Health, Diet, and Skincare Products">
    <meta property="og:description"
        content="Discover premium wellness, health, diet, and skincare products at Wellnez Mart. Shop now for natural and organic solutions to enhance your well-being.">
    <meta property="og:image" content="{{ asset('public/assets/images/favicon.png') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Wellnez Mart - Wellness, Health, Diet, and Skincare Products">
    <meta name="twitter:description"
        content="Discover premium wellness, health, diet, and skincare products at Wellnez Mart. Shop now for natural and organic solutions to enhance your well-being.">
    <meta name="twitter:image" content="{{ asset('public/assets/images/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/assets/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/magnific-popup.css') }}">


    <link rel="stylesheet" href="{{ asset('public/assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('public/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
</head>

<body class="goto-here">

    <nav style="z-index: 515154412125; overlay:hidden"
    class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <a class="navbar-brand" href="{{ route('home') }}">Wellnez Mart</a>

        <div class="header-search-wrap ">
            <div class="header-search-1">
                <div class="search-icon">
                    <i class="oi oi-magnifying-glass"></i>
                    <i class="icon-magnifier-remove  for-search-close"></i>
                </div>
            </div>
            <div class="header-search-1-form">
                <form id="search-form" method="get" action="{{ route('search.products') }}">
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
                <li class="nav-item cta-colored"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link">products</a></li>
                <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>

                <li class="nav-item">

                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="oi oi-person"></i> <!-- Profile Icon -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        @auth
                            <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                </li>
            </ul>

        </div>
        <a class="nav-link" href="{{ route('wishlist.index') }}">
            <div class="wishlist-icon-wrapper">
                <i class="oi oi-heart"></i>
                @auth
                    <span class="wishlist-badge">{{ auth()->user()->wishlistProducts->count() }}</span>
                @else
                    <span class="wishlist-badge">0</span>
                @endauth
            </div>
        </a>
        <a class="nav-item position-relative">
            <div class="cart-wrapper">
                <a href="{{ route('cart.view') }}" class=" position-relative">
                    <span class="icon-shopping_cart"></span>
                    @if (session('cart'))
                        <span class="cart-badge">{{ count(session('cart')) }}</span>
                    @else
                        <span class="cart-badge">0</span>
                    @endif
                </a>
            </div>
    </div>
</nav>
    @if (isset($newsBar))
        <!-- ltn__header-top-area start -->
        <div class="ltn__header-top-area top-area-color-white ">
            <ul>
                <li><strong> {{ $newsBar->content }} </strong></li>
                <li><strong> {{ $newsBar->content }} </strong></li>
                <li><strong> {{ $newsBar->content }} </strong></li>
                <li><strong> {{ $newsBar->content }} </strong></li>
                <li><strong> {{ $newsBar->content }} </strong></li>
                <li><strong> {{ $newsBar->content }} </strong></li>
            </ul>
        </div>
        <!-- ltn__header-top-area end -->
    @endif
    <!-- END nav -->
