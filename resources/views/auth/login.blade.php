<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', env('APP_NAME'))</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">
    @include('layout.partials.head')
    @stack('styles')

  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-center p-5">
                <div class="d-flex justify-content-center py-4">
                  <div class="brand-logo">
                      <img src="{{ URL::asset('assets/img/logo.png') }}" alt="">
                  </div>
                </div><!-- End Logo -->
                <h3>SMKN 1 Cirebon</h3>
                <h4>Sistem Jadwal Konseling BK</h4>
                <h6 class="font-weight-light">Masuk untuk melanjutkan.</h6>

                <x-alert />
                <form class="pt-3" action="{{ route('login.process') }}" method="POST">
                @csrf
                  <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror" placeholder="Username" autofocus>
                    @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>

                  <div class="mt-3 d-grid gap-2">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">
                      MASUK
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <!-- Vendor JS Files -->
    @include('layout.partials.footer-scripts')
    @stack('scripts')
  </body>
</html>