{{-- // FIXME to follow another --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact Us</title>
  @include('layouts.css.al-styles')
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body style="background-image: url('{{ asset('images/contact_bg.svg') }}')">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-6 order-lg-2 mt-2 mt-sm-3 mt-md-4 mt-lg-5">
        <a href="{{ $contact_instagram['link'] }}">
          <div class="d-flex justify-content-center">
            <div class="bg-white contact-profile">
              <div class="contact-img" style="background-image: url({{ asset('images/mamoto_logo_hitam.svg') }});"></div>
            </div>
          </div>
        </a>
        <a href="{{ $contact_instagram['link'] }}">
          <p class="contact-profile-text">
            {{ '@'.$contact_instagram['contact'] }}
          </p>
        </a>
      </div>
      <div class="col-lg-6 order-lg-1 mt-5">
        @foreach ($contacts as $value)
          <a href="{{ $value['link'] }}">
            <div class="d-flex justify-content-center my-lg-5 my-3">
              <div class="contact-list w-100 px-5">
                <p class="contact-list-text d-flex">
                  <span class="d-flex align-items-center"><i class="{{ $value['logo'] }} fa-2x"></i></span>
                  <span class="d-flex align-items-center justify-content-center w-100">{{ $value['text'] }}</span>
                </p>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>