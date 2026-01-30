@props([
    'search' => true,
])

@extends('layouts.app') @section('page_title')


    @if (isset($page_title))
        {{ __($page_title) }}
    @else
        @yield('page_title')
    @endif @stop @section('content')

    <!--begin::Post-->
    <div id="kt_post" class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid w-100 mt-8">
            @if (session('messages.success'))
                <div class="alert alert-success">
                    {{ session('messages.success') }}
                </div>
                @endif @if (session('messages.warning'))
                    <div class="alert alert-warning">
                        {{ session('messages.warning') }}
                    </div>
                @endif 
                
                <form method="GET">
                    <div class="w-full">
                        <h1 class="fs-2 fw-bold mb-4">
                            @yield('header')
                        </h1>
                    </div>

                    <!--begin::Card-->
                    <div class="card border round-3">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6 gap-2 mb-5 d-flex">
                                    @if ($search)
                                        <x-table.search />
                                    @endif
                                    @yield('toolbar_left')
                                </div>
                                <div class="col-12 col-lg-6 gap-2 d-flex mb-5 justify-content-end">
                                    @yield('toolbar')

                                    {{-- GENERATE DUMMY --}}
                                    <x-table.generate-dummy-button show_dummy_button="{{ $show_dummy_button ?? false }}" />
                                    {{-- ADD BUTTON --}}
                                    @php
                                        $add_button_href =
                                            $add_button_href ?? route(explode('.', Route::currentRouteName())[0] . '.create');

                                    @endphp
                                    @if (strlen($add_button_href) > 0)
                                        <x-table.add-button :href="$add_button_href ?? null"
                                            label="{{ __('Add') . ' ' . __($action_title ?? $page_title) }}" />
                                    @endif
                                </div>
                            </div>

                            <!--begin::Table-->
                            @if ($list->total() > 0)
                                <div class="table-responsive mt-10">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                        <!--begin::Table head-->
                                        <thead>
                                            <!--begin::Table row-->
                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                @yield('table_header')
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-bold text-gray-600">
                                            @yield('table_body')
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                            @else
                                <x-table.empty />
                            @endif
                            <!--end::Table-->

                            {{ $list->appends(request()->query())->links() }}
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection
