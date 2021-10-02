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
<body style="background-image: url('{{ asset('images/default/contact-background.jpg') }}')">
  <div class="container">
    <div class="row mt-4 justify-content-center">
          {{-- social photo profile --}}
      <div class="col-auto">
        <a href="{{ $contact_instagram['link'] }}">
            <div class="d-flex justify-content-center">
              <div class="contact-profile">
                <div class="contact-img" style="background-image: url({{ asset('images/mamoto_picture_logo.png') }});"></div>
              </div>
            </div>
        </a>
        {{-- <a href="{{ $contact_instagram['link'] }}">
          <p class="contact-profile-text">
            {{ '@'.$contact_instagram['contact'] }}
          </p>
        </a> --}}
      </div>
    </div>
    <div class="row mt-2 mb-5 justify-content-center">
      {{-- links --}}
      <div class="col-lg-6">
        @foreach ($contacts as $value)
          <a href="{{ $value['link'] }}">
            <div class="d-flex justify-content-center my-3">
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
