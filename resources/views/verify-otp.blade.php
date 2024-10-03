<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('public/assets/images/favicon.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Verify OTP sent to your E-mail</h2>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('verifyOTP.post') }}">
    @csrf
    <div class="form-group">
        <label for="otp">Enter OTP</label>
        <input type="text" name="otp" id="otp" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Verify OTP</button>
</form>


   
</div>

<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/js/main.js') }}"></script>

</body>
</html>
