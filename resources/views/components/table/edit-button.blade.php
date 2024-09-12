
@props([
    'id'    => null,
    'href' => null,
])

<div class="menu-item px-3">
    <a href="{{ $href ?? route(explode('.',Route::currentRouteName())[0] . '.edit', $id) }}" class="menu-link px-3">Edit</a>
</div>