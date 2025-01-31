@extends('layout.errorlayout')
@section('content')
  <div class="col-lg-6 text-lg-right pr-lg-4">
    <h1 class="display-1 mb-0">400</h1>
  </div>
  <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
    <h2>Oops!</h2>
    <h3 class="font-weight-light">{{ $exception->getMessage() }}</h3>
  </div>
  </div>
  <div class="row mt-5">
    <div class="col-12 text-center mt-xl-2">
      <a class="text-white font-weight-medium" href="{{ route('mgt.dashboard.index') }}">Kembali ke beranda</a>
    </div>
@endsection