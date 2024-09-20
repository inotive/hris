@props([
    'href' => null,
    'label' => __('Add'),

    'route_name'    => explode('.',Route::currentRouteName())[0] . '.create',
])

@if (\App\Services\AuthService::isValid($route_name))
<a type="button" class="btn btn-primary" href="{{ $href ?? route($route_name)  }}">{{ $label }}</a>
@else
<span></span>
@endif