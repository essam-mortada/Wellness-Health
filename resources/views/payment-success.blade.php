<link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">

<div class="container mt-5 text-center">
    <h1 class="text-primary">Your Order Has Been Placed Successfully!</h1>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-10 col-12">
            <img src="{{asset('public/assets/images/payment.svg')}}" class="img-fluid" alt="Payment Success">
        </div>
    </div>
    <a href="{{route('home')}}" class="btn btn-lg btn-primary mt-3">Back to Home</a>
</div>
