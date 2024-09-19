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
        <div id="kt_content_container" class="container-xxl">

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

            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title gap-2">
                        <x-table.search />
                        @yield('toolbar_left')
                    </div>

                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end gap-2" data-kt-customer-table-toolbar="base">
                           {{-- FILTER --}}
                           {{-- @include('crud.filter') --}}

                           
                            {{-- EXPORT --}}
                            {{-- @include('crud.export-button') --}}

                            @yield('toolbar')

                            {{-- GENERATE DUMMY --}}
                            <x-table.generate-dummy-button rows_count="{{ $rows_count ?? '0' }}" />
                            {{-- ADD BUTTON --}}
                            <x-table.add-button :href="$add_button_href??null" label="{{ __('Add') . ' ' . __($action_title ?? $page_title) }}" />
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-customer-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-customer-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="table-responsive">
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
                    <!--end::Table-->

                    {{ $list->links() }}
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection
