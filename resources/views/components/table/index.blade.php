@props([
    'title' => 'No Title',
])
@extends('layouts.app')


@section('page_title')
    {{ $title }}
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



            <!--begin::Card-->
            <div class="card">


                @if ( isset($header)  || isset($header_toolbar))
                    <div class="card-header pt-6">
                        <div class="card-title gap-2">
                        {{ $header ?? '' }}
                        </div>

                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end gap-2">
                            {{ $header_toolbar ?? '' }}
                            </div>
                        </div>
                    </div>
                    @endif

                <div class="card-body">
            

                    <!--begin::Card header-->
                    <div class="row">
                        <!--begin::Card title-->
                        <div class="col-12 col-lg-2">
                            <x-table.search />
                        </div>

                        <div class="col-12 col-lg-10">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end gap-2" data-kt-customer-table-toolbar="base">
                                {{ $toolbar ?? '' }}
                            </div>

                        </div>
                        <!--end::Card toolbar-->
                    </div>



                    {{ $body ?? '' }}
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection
