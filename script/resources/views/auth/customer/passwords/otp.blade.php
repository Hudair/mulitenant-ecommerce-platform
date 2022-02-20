<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ env('APP_NAME') }}</title>
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
              <div class="card-header">{{ __('Reset Password') }}</div>

              <div class="card-body">
              @if (session('success'))
               <div class="alert alert-success" role="alert">
                {{ session('success') }}
               </div>
              @endif
              @if (session('error'))
               <div class="alert alert-danger" role="alert">
                {{ session('error') }}
               </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              <form method="POST" action="{{ url('/user/password/reset') }}">
                @csrf

                
                <div class="form-group">
                 <label for="otp" class="col-form-label text-md-right">{{ __('OTP') }}</label>
                 <input id="otp" type="number" class="form-control @error('otp') is-invalid @enderror" name="otp_num" required placeholder="Enter Otp Code" autocomplete="off">
                 @error('otp')
                 <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror               
               </div>

                <div class="form-group">
                 <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                 <input id="password" type="password" min="8" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                 @error('password')
                 <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror               
              </div>
              <div class="form-group">                
               <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>      
               <input id="password-confirm" type="password" min="8" class="form-control" name="password_confirmation" required autocomplete="new-password">     
             </div>
             <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
               {{ __('Reset Password') }}
             </button>
           </div>
         </form>




         <div class="simple-footer">
          Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}
        </div>

      </div>
    </div>
  </section>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>





