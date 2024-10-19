@props([
    'title' => 'No Title',
    'action' => null,
    'cancel' => null,
])
@extends('layouts.app')


@section('page_title')
    {{ $title }}
@stop

@section('content')

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">

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


            <form action="{{ $action }}" method="POST" id="crud-form">
                @csrf

                {{ $top_header ?? '' }}

                <!--begin::Card-->
                <div class="card">

                    @if (isset($header) || isset($toolbar))
                        <div class="card-header pt-6">
                            <div class="card-title gap-2">
                                {{ $header ?? '' }}
                            </div>

                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end gap-2">
                                    {{ $toolbar ?? '' }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        {{ $body ?? '' }}
                    </div>


                    <div class="card-footer text-end">
                        <a href="{{ $cancel }}" class="btn btn-light me-3">{{ __('Cancel') }}</a>

                        <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('Save') }}</span>
                        </button>
                    </div>
                </div>
                <!--end::Card-->

            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection



@section('js')
    {{ $js ?? '' }}
@stop
