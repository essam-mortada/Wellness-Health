<head>
    <title>Reset Password</title>

    <!-- Main Stylesheet -->
    <link rel="icon" href="{{ asset('public/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">

</head>


<div class="body-wrapper">

    <!-- LOGIN AREA START (Register) -->
    <div class="ltn__login-area mb-90 mt-90" style="height: 70vh; align-items: center; display: flex;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center" >
                        <h1> Reset Your Password</h1>
                        <p>  Enter the new Password.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="account-login-inner">
                        <form  action="{{ route('update.password') }}" class="ltn__form-box contact-form-box" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <input type="text" name="email" placeholder="Email " value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

                            <div class="btn-wrapper">
                                <button class="theme-btn-1 btn reverse-color btn-block" type="submit">  Confirm </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGIN AREA END -->
</div>

<script src="{{asset('public/assets/js/sweetalert2@11.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('public/assets/js/main.js')}}"></script>
