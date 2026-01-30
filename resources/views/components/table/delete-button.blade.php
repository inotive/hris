@props([
    'id'    => null,
    'href'  => null,
    'route_name'    => explode('.',Route::currentRouteName())[0] . '.destroy',
])

@if (\App\Services\AuthService::isValid($route_name))
<div class="menu-item px-3">
<a  href="#" data-delete-url="{{ $href ?? route($route_name, $id)  }}"  class="menu-link px-3 delete-button">{{ __('Delete') }}</a>
</div>
@else

@endif