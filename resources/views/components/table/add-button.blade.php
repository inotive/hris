@props([
    'href' => null,
])

<a type="button" class="btn btn-primary" href="{{ $href ?? route(explode('.',Route::currentRouteName())[0] . '.create',['redirect'    => url()->full() ])  }}">{{ __('Add') }}</a>
