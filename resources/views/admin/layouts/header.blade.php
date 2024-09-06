<html lang="en">
  <head>
    <title>Wellness Health admin</title>
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

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{route('home')}}">Wellness Health Admin</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item "><a href="{{route('home')}}" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="{{route('products.index')}}" class="nav-link">Products</a></li>
	          <li class="nav-item"><a href="{{route('orders.index')}}" class="nav-link">Orders</a></li>
	          <li class="nav-item"><a href="{{route('blogs.index')}}" class="nav-link">Blogs</a></li>
	          <li class="nav-item"><a href="{{route('messages.index')}}" class="nav-link">Users Messages</a></li>
              <li class="nav-item"><a href="{{route('reviews.index')}}" class="nav-link">Reviews</a></li>
              <li class="nav-item"><a href="{{route('admins.index')}}" class="nav-link">Admins</a></li>
              <div class="dropdown mt-3">
                <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="icon-person lg"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item " href="{{route('admins.edit',Auth::user()->id)}}">Edit profile</a></li>
                  <li><a class="dropdown-item " href="{{route('password.change.form',Auth::user()->id)}}">Change Password</a></li>
                  <li><form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item ">Logout</button>
                </form>
            </li>
                </ul>
              </div>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
