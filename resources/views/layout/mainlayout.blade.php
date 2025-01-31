<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title', env('APP_NAME'))</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">
    @include('layout.partials.head')
    @stack('styles')
</head>

<body class="{{ isset($miniSidebar) ? 'mini-sidebar' : '' }}">
    <!-- Main Wrapper -->
    <div class="container-scroller">
        @include('layout.partials.header')
        <div class="container-fluid page-body-wrapper">
          @include('layout.partials.nav')
          <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
          </div>
        </div>
    </div>

    @stack('after-body')

    <!-- /Main Wrapper -->
    @include('layout.partials.footer-scripts')
    @stack('scripts')
</body>

</html>
