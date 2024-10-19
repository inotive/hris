<div id="kt_header" class="header align-items-stretch">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_aside_mobile_toggle">
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                            fill="black" />
                        <path opacity="0.3"
                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                            fill="black" />
                    </svg>
                </span>
            </div>
        </div>

        <div class="d-flex align-items-center flex-wrap  w-100" style="padding-left:16px">
            <!-- <a href="#" class="d-lg-none">
                <img alt="Logo" src="{{ asset('template/media/logos/logo-2.svg') }}" class="h-30px" />
            </a> -->
            @php
                $menus = config('sidebar.menus');
                $current_menu = null;
                foreach ($menus as $key => $value) {
                    $is_active = \App\Services\SidebarService::isActive($value);

                    if ($is_active == true) {
                        $current_menu = $value;
                    }
                }
            @endphp

            <div class="">

                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                    @if ($current_menu != null)
                        {{ __($current_menu['label']) }}
                    @else
                        @yield('page_title')
                    @endif
                </h1>

                {{-- asdasd --}}
            </div>
            <span class="h-20px border-gray-300 border-start mx-4 d-none d-lg-flex"></span>
            <x-tab-sidebar-menu />
        </div>

        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav">

            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <!--begin::Menu wrapper-->
                    <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                        data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">

                        <img class="w-20px h-20px rounded-1 ms-2" src="{{ asset(session('app_locale')['flag'] ?? '') }}"
                            alt="">

                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-200px" data-kt-menu="true" style="">

                        @foreach (config('locale.locales') as $key => $value)
                            <div class="menu-item px-3 py-2 bg-hover-light">
                                <a href="{{ route('change-language', $value['code']) }}"
                                    class="menu-link d-flex px-5 {{ session('app_locale') == $value['code'] ? ' active ' : '' }}">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{ asset($value['flag'] ?? '') }}" alt="">
                                    </span>
                                    <span class="text-black">{{ $value['language'] }}</span>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>

                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <a class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                        href="">
                        <i class="fonticon-sun fs-2"></i>
                    </a>
                </div>
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="{{ auth()->user()->image != null ? Storage::url(auth()->user()->image) : asset('template/media/avatars/300-1.jpg') }}"
                            alt="user" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo"
                                        src="{{ auth()->user()->image != null ? Storage::url(auth()->user()->image) : asset('template/media/avatars/300-1.jpg') }}" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                        {{ auth()->user()->first_name ?? '' }}

                                    </div>
                                    <a href="#"
                                        class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email ?? '-' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="{{ route('user.change-password') }}"
                                class="menu-link px-5">{{ __('My Profile') }}</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-text">{{ __('Subscription') }}</span>
                                <span class="menu-badge">
                                    <span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                                </span>
                            </a>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">{{ __('Language') }}
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">{{ session('app_locale')['language'] }}
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset(session('app_locale')['flag'] ?? '') }}"
                                            alt=""></span></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4" style="">

                                @foreach (config('locale.locales') as $key => $value)
                                    <div class="menu-item px-3">
                                        <a href="{{ route('change-language', $value['code']) }}"
                                            class="menu-link d-flex px-5 {{ session('app_locale') == $value['code'] ? ' active ' : '' }}">
                                            <span class="symbol symbol-20px me-4">
                                                <img class="rounded-1" src="{{ asset($value['flag'] ?? '') }}"
                                                    alt="">
                                            </span>{{ $value['language'] }}</a>
                                    </div>
                                @endforeach


                                <!--end::Menu item-->

                            </div>
                            <!--end::Menu sub-->
                        </div>

                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" class="menu-link px-5"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Sign Out') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf

                            </form>
                        </div>
                        <div class="separator my-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
