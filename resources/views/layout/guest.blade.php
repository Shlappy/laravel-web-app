<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Authentication</title>

  <!-- Styles -->
  <link rel="stylesheet" href="/css/app.css">
  <link href="http://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
</head>

<body>
  <div>
    {{ $slot }}
  </div>
</body>

</html>