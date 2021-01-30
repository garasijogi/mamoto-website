{{-- styles --}}
@if (Request::route()->getPrefix()=='/admin')
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css"
  rel="stylesheet">
<link href="{{ asset('css/algorithm/admin-styles.css') }}" rel="stylesheet">
@else
<link href="{{ asset('css/algorithm/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
@endif