@extends('layouts.app')


@section('page_title')
    @if (isset($page_title))
        {{ __($page_title) }}
    @else
        @yield('page_title')
    @endif
@stop

@section('content')


    <div class="post" id="kt_post">

        <div id="kt_content_container" class="container-fluid">
            <x-back href="{{ route(explode('.', Route::currentRouteName())[0] . '.index') }}" />
            <form id="crud-form" action="{{ route(explode('.', Route::currentRouteName())[0] . '.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        @include($view)
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route(explode('.', Route::currentRouteName())[0] . '.index') }}"
                            class="btn btn-light me-3">{{ __('Cancel') }}</a>

                        <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('Save') }}</span>
                        </button>
                    </div>



                </div>

            </form>

        </div>

    </div>
@stop
