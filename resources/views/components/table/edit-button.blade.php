
@props([
    'id'    => null,
    'href' => null,
])

<div class="menu-item px-3">
    <a href="{{ $href ?? route(explode('.',Route::currentRouteName())[0] . '.edit', [$id, 'redirect'=> url()->full()]) }}" class="menu-link px-3">{{ __('Edit') }}</a>
</div>