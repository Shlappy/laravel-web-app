<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>eCommerce Showcase</title>

  <!-- Styles -->
  <link rel="stylesheet" href="/css/app.css?{{ time() }}">
  <link href="http://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
</head>

<body>
  <div id="app">
    <x-layout.header></x-layout.header>

    <main>
      {{ $slot }}
    </main>

    <x-modals></x-modals>

    @include ('layout.footer')
  </div>

  <script src="{{ mix('/js/app.js') }}?{{ time() }}"></script>
</body>

</html>