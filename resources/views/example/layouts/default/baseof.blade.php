<!doctype html>
<html lang="en" class="dark">
  <head>
    @include('example.layouts.partials.header')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  @php
    $whiteBg = isset($params['white_bg']) && $params['white_bg'];
  @endphp

<body class="{{ $whiteBg ? 'bg-white' : 'bg-gray-50' }}">

  @yield('main')
  @include('example.layouts.partials.scripts')
</body>
</html>
