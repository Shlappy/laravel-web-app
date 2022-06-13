<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>eCommerce Showcase</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <x-layout.header></x-layout.header>

    {{ $slot }}

    {{-- <x-layout.footer></x-layout.footer> --}}
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>