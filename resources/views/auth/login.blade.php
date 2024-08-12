@extends('adminlte.layouts.auth')

@section('content')
<body class="hold-transition login-page" style="background: linear-gradient(135deg, #ff758c, #ff7eb3, #6a11cb, #2575fc); background-size: 400% 400%; animation: gradient 15s ease infinite;">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('home') }}" style="font-size: 36px; font-weight: bold; color: #ffffff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: rgba(255, 255, 255, 0.9);">
            <div class="card-body login-card-body" style="padding: 2rem;">
                <p class="login-box-msg" style="font-size: 18px; color: #333; margin-bottom: 1.5rem;">Silakan masuk untuk memulai sesi Anda</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" style="border-radius: 10px; border: 1px solid #ced4da; transition: border-color 0.3s;">
                        <div class="input-group-append">
                            <div class="input-group-text" style="border-radius: 10px; border: 1px solid #ced4da; background: #ffffff;">
                                <span class="fas fa-envelope" style="color: #007bff;"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" style="border-radius: 10px; border: 1px solid #ced4da; transition: border-color 0.3s;">
                        <div class="input-group-append">
                            <div class="input-group-text" style="border-radius: 10px; border: 1px solid #ced4da; background: #ffffff;">
                                <span class="fas fa-lock" style="color: #007bff;"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary" style="margin-top: 0.5rem;">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} style="cursor: pointer;">
                                <label for="remember" style="font-size: 14px; color: #333;">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; font-size: 16px; transition: background-color 0.3s, transform 0.3s;">{{ __('Login') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->
                @if (Route::has('password.request'))
                <p class="mb-1" style="margin-top: 1rem;">
                    <a href="{{ route('password.request') }}" style="color: #000000; text-decoration: none; font-size: 14px; transition: color 0.3s;">{{ __('Forgot Your Password?') }}</a>
                </p>
                @endif
                @if (Route::has('register'))
                <p class="mb-0" style="margin-top: 0.5rem;">
                    <a href="{{ route('register') }}" class="text-center" style="color: #000000; text-decoration: none; font-size: 14px; transition: color 0.3s;">{{ __('Register') }}</a>
                </p>
                @endif
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- Add some custom JavaScript for animations -->
    <script>
      document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', () => {
          input.style.borderColor = '#007bff';
        });
        input.addEventListener('blur', () => {
          input.style.borderColor = '#ced4da';
        });
      });

      document.querySelector('.btn-primary').addEventListener('mouseover', () => {
        document.querySelector('.btn-primary').style.backgroundColor = '#0056b3';
        document.querySelector('.btn-primary').style.transform = 'scale(1.05)';
      });

      document.querySelector('.btn-primary').addEventListener('mouseout', () => {
        document.querySelector('.btn-primary').style.backgroundColor = '#007bff';
        document.querySelector('.btn-primary').style.transform = 'scale(1)';
      });
    </script>

    <!-- Gradient Animation -->
    <style>
      @keyframes gradient {
        0% { background-position: 0% 0%; }
        50% { background-position: 100% 100%; }
        100% { background-position: 0% 0%; }
      }
    </style>
@endsection
