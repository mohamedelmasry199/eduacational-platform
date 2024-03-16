<?php
session_start();
if (!isset($_SESSION['code'])) {
  $signInButtonStyle = '';
  $signUpButtonStyle = '';
  $logoutButtonStyle = 'display:none';
} else {
  $signInButtonStyle = 'display:none';
  $signUpButtonStyle = 'display:none';
  $logoutButtonStyle = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Medical DZ</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,100;1,300;1,400&display=swap"
    rel="stylesheet" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<style>.custom-card-body {
    background-color: #f0f0f0;
    padding: 10px;
    display: flex;
    justify-content: center;
}
</style>
<body>
  <header>
    <nav class="navbar navbar-expand-lg px-md-5 d-flex m-0 justify-content-between">
      <div class="container-fluid header">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-lg-5">
            <li class="nav-item">
                <img src="{{ asset('IMG-20240314-WA0217-removebg-preview.png') }}" style="width: 130px; height: 130px; margin:-37px 0 -50px 0" alt="MCQ Lab Logo">

            </li>
            {{-- @guest
            <a href="{{ route('login') }}" class="btn login mx-3 btn-outline-primary"
               style="{{ $signInButtonStyle }}">Sign in</a>
            @endguest --}}
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <body style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">{{ __('Generated Code') }}</div>
            <div class="card-body" style="background-color: #f0f0f0; padding: 10px; text-align: center;">
             <p> Le code généré est : <a href="{{ route('link') }}"class="get-code">dans ce lien</a></p>
              {{-- @guest
              <a href="{{ route('login') }}" class="btn login mx-3 btn-outline-primary"
                 style="margin-top: 20px; padding: 10px 20px; font-size: 16px; text-decoration: none; color: #007bff; border: 1px solid #007bff; border-radius: 5px;">Connexion</a>
              @endguest --}}
            </div>
          </div>
        </div>
      </div>
    </div>






          @error('code')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php // This is the missing closing PHP tag
