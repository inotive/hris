<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config("app.name", "Laravel") }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

   
    <link href="{{asset('template/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('template/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/flash.css')}}" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
      var defaultThemeMode = "light";
      var themeMode;
      if (document.documentElement) {
        if (
          document.documentElement.hasAttribute("data-bs-theme-mode")
        ) {
          themeMode =
            document.documentElement.getAttribute(
              "data-bs-theme-mode"
            );
        } else {
          if (localStorage.getItem("data-bs-theme") !== null) {
            themeMode = localStorage.getItem("data-bs-theme");
          } else {
            themeMode = defaultThemeMode;
          }
        }
        if (themeMode === "system") {
          themeMode = window.matchMedia(
            "(prefers-color-scheme: dark)"
          ).matches
            ? "dark"
            : "light";
        }
        document.documentElement.setAttribute(
          "data-bs-theme",
          themeMode
        );
      }
    </script>
  </head>
  <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				@include('layouts.sidebar')
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					@include('layouts.header')
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            @include('layouts.toolbar')
            @yield('content')
					</div>
          @include('layouts.footer')
				</div>
			</div>
		</div>
		
    @include('layouts.js') 
    @yield('js')
  </body>
</html>
