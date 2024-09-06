<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div style="background-color:#82ae46;color:white;" class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="form-group text-center">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.scripts')
</body>
</html>
