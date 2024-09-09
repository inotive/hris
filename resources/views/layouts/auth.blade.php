<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <link href="{{asset('template/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>
  <body id="kt_body" class="bg-body">
    <div id="app">
      <main class="py-4">@yield('content')</main>
    </div>
    @yield('j-auth')
  </body>
</html>
