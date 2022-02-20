<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>login - {{ env('APP_NAME') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon.ico') }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('uploads/logo.png') }}" alt="logo" width="100" class="shadow-light">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>{{ __('Login') }}</h4></div>

              <div class="card-body">

               <form method="POST" class="loginform" class="needs-validation" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <label for="email">{{ __('E-Mail Address') }}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label">{{ __('Password') }}</label>
                    @if (Route::has('password.request'))
                    <div class="float-right">
                      <a href="{{ route('password.request') }}" class="text-small">
                       {{ __(' Forgot Password?') }}
                      </a>
                    </div>
                    @endif
                  </div>
                  <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                     <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                     <label class="custom-control-label" for="remember-me">{{ __('Remember Me') }}</label>
                   </div>
                 </div>

                 <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block basicbtn" tabindex="4">
                    {{ __('Login') }}
                  </button>
                </div>
              </form>


   

          <div class="simple-footer">
            {{ __('Copyright') }} &copy; {{ env('APP_NAME') }} {{ date('Y') }}
          </div>
       
      </div>
    </div>
  </section>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
</body>
</html>




