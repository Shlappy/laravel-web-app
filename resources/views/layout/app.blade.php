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

  <script src="{{ asset('js/app.js') }}"></script>

  <!-- move to main.js -->
  <script>
    var sliderFilter = document.querySelectorAll('.slider-between.slider-product');
    sliderFilter.forEach((el) => {
      const min = parseInt(el.getAttribute('min'), 10);
      const max = parseInt(el.getAttribute('max'), 10);

      console.log(el.children)
      // let minInput = el.querySelector('[name="min"]');
      // let maxInput = el.querySelector('[name="max"]');

      nouislider.create(el, {
        start: [min, max],
        connect: true,
        range: {
          'min': min,
          'max': max
        }
      });
    })
  </script>
</body>

</html>