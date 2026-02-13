<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Todo App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield("style")
  </head>
  <body class="flex min-h-full flex-col bg-gray-900 scheme-dark">
        @include('include.header')
        @yield("content")
        @include('include.footer')
  </body>
</html>