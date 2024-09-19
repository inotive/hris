@props([
    'href' => null,
    'label' => __('Add'),
])

<a type="button" class="btn btn-primary" href="{{ $href ?? route(explode('.',Route::currentRouteName())[0] . '.create',[ ])  }}">{{ $label }}</a>
