@extends('layouts.app')


@section('page_title')
    @if (isset($page_title))
        {{ __($page_title) }}
    @else
        @yield('page_title')
    @endif
@stop

@section('content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        
        <!--begin::Container-->
        <div id="kt_content_container" class="w-100">

            @if (session('messages.success'))
                <div class="alert alert-success">
                    {{ session('messages.success') }}
                </div>
            @endif

            @if (session('messages.warning'))
                <div class="alert alert-warning">
                    {{ session('messages.warning') }}
                </div>
            @endif

            @yield('header')
            <form method="GET">

                <!--begin::Card-->
                <div class="card card-content">

                    <!--begin::Card body-->
                    <div class="card-body">

                        

                        <div class="row">
                            <div class="col-12 col-lg-6 gap-2 d-flex">
                                <x-table.search />
                                @yield('toolbar_left')
                            </div>
                            <div class="col-12 col-lg-6 gap-2 d-flex justify-content-end">
                                @yield('toolbar')

                                {{-- GENERATE DUMMY --}}
                                <x-table.generate-dummy-button show_dummy_button="{{ $show_dummy_button ?? false }}" />
                                {{-- ADD BUTTON --}}
                                <x-table.add-button :href="$add_button_href ?? null"
                                    label="{{ __('Add') . ' ' . __($action_title ?? $page_title) }}" />
                            </div>
                        </div>

                        <!--begin::Table-->
                        @if($list->total() > 0)
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

                        {{ $list->links() }}
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
