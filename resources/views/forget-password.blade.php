<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Main Stylesheet -->
    <link rel="icon" href="{{ asset('public/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
</head>
<body>
    <div class="body-wrapper">
        <!-- SweetAlert2 for Success/Error Messages -->
        @if (session('success'))
            <script src="{{ asset('public/assets/js/sweetalert2@11.js') }}"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true,
                });
            </script>
        @endif

        @if (session('error'))
            <script src="{{ asset('public/assets/js/sweetalert2@11.js') }}"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true,
                });
            </script>
        @endif

        <!-- LOGIN AREA START (Forgot Password) -->
        <div class="ltn__login-area mb-90 mt-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-area text-center">
                            <h1>Forgot Password</h1>
                            <p>Please enter your email to send the reset password link.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="account-login-inner">
                            <form action="{{ route('forgot.password.send') }}" class="ltn__form-box contact-form-box" method="POST">
                                @csrf
                                <input type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="btn-wrapper">
                                    <button class="theme-btn-1 btn reverse-color btn-block" type="submit">Send Link</button>
                                </div>
                            </form>
                            <div class="by-agree text-center">
                                <div class="go-to-btn mt-50">
                                    <a href="{{ route('login') }}">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN AREA END -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/assets/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('public/assets/js/main.js') }}"></script>
</body>
</html>
