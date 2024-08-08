<!--<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<div class="container mt-5 text-center">
    <h1 class="text-primary">payment confirmation</h1>

     <div class="row justify-content-center">
        <div class="col-md-6 col-sm-10 col-12">
            <img src="{{asset('assets/images/confirm-payment.svg')}}" class="img-fluid" alt="confirm payment">

    <form action="{{route('credit')}}" method="POST">
        @csrf
        <button class="btn btn-primary " type="submit">Click To Confirm Payment</button>
    </form>
</div>
    </div>
</div>
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
    <form id="redirectForm" action="{{ $route }}" method="POST">
        @csrf
    </form>
    <script>
        document.getElementById("redirectForm").submit();
    </script>
</body>
</html>

