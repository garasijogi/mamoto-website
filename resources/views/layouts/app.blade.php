<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    @yield('title')
  </title>

  {{-- styles --}}
  <link href="{{ asset('css/algorithm/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
</head>

<body class="{{request()->routeIs('home') ? 'al-home-body' : ''}}">
  @include('layouts.navigation')
  <div id="app">
    <div class="m-4 al-full-content {{request()->routeIs('home') ? '' : 'al-bg-img'}}">
      @yield('content')
    </div>
  </div>
</body>

</html>