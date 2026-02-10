<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>PeopleIn | #1 HR System for your company</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />


    <link href="{{ asset('template/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{--
    <link href="{{ asset('template/plugins/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" /> --}}



    <link href="{{ asset('assets/css/flash.css') }}" rel="stylesheet" type="text/css" />

    <style>
        body {
            background: white !important;
        }
    </style>
    <style>
        /* Make sure autocomplete dropdown has a high z-index and is always on top */
        #searchBox {
            position: relative;
            /* or absolute if placed manually */
            z-index: 10010;
            /* higher than map/modal */
        }

        .ui-autocomplete {
            z-index: 99999 !important;
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            background-color: white;
            border: 1px solid #ccc;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- jQuery UI (for autocomplete) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

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
                    ).matches ?
                    "dark" :
                    "light";
            }
            document.documentElement.setAttribute(
                "data-bs-theme",
                themeMode
            );
        }
    </script>
</head>

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            @include('layouts.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('layouts.header')

                {{-- class: content --}}
                <div class="content d-flex flex-column flex-column-fluid bg-white" id="kt_content">
                    @include('layouts.toolbar-new')


                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    @stack('modals')
    @include('layouts.js')
    @yield('js')
    @stack('scripts')

</body>

</html>
