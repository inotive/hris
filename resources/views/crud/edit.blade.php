@extends('layouts.app')


@section('page_title')
    {{ __($page_title) }}
@stop

@section('content')


    <div class="post" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <x-back href="{{ $back_route ?? route(explode('.', Route::currentRouteName())[0] . '.index') }}" />
            <form id="crud-form"
                action="{{ $action ?? route(explode('.', Route::currentRouteName())[0] . '.update', $form->id) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="card border border-light">
                    <div class="card-body">
                        @include($view)
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ $back_route ?? route(explode('.', Route::currentRouteName())[0] . '.index') }}"
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
