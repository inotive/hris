
@props([
    'id'    => null,
    'href' => null,
    'route_name'    => explode('.',Route::currentRouteName())[0] . '.edit',
])

@if (\App\Services\AuthService::isValid($route_name))
<div class="menu-item px-3">
    <a href="{{ $href ?? route($route_name, $id)  }}"  class="menu-link px-3">{{ __('Edit') }}</a>
</div>
@else

@endif