<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>eCommerce Showcase</title>

  <!-- Styles -->
  <link rel="stylesheet" href="/css/app.css">
  <link href="http://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
</head>

<body>
  <x-layout.header></x-layout.header>

  {{ $slot }}

  {{-- <x-layout.footer></x-layout.footer> --}}
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- move to main.js -->
  <script>
    var sliderFilter = document.querySelectorAll('.slider-filter');
    sliderFilter.forEach((el) => {
      nouislider.create(el, {
        start: [20, 80],
        connect: true,
        range: {
          'min': 0,
          'max': 100
        }
      });
    })
  </script>
</body>

</html>