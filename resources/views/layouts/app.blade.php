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
  @include('layouts.css.al-styles')
  @include('layouts.css.rr-styles')
  @include('layouts.css.ns-styles')

</head>

<body class="user-body">
  @include('layouts.navigation')
  <div id="app">
    @include('layouts.floating_button')
    <div class="content">
      @yield('content')
    </div>
    @include('layouts.footer')
  </div>

  @yield('modals')

  {{-- scripts --}}
  @include('layouts.js.al-scripts')
  @include('layouts.js.rr-scripts')
  @include('layouts.js.ns-scripts')

</body>

</html>