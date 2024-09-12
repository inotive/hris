@props([
    'id'    => null,
    'href'  => null,
])

<div class="menu-item px-3">
    <a class="menu-link px-3 delete-button" data-delete-url="{{ $href ?? route(explode('.',Route::currentRouteName())[0] . '.destroy', $id) }}">Delete</a>
</div>

