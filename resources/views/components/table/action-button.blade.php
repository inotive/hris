
@props([
    'id'    => null,
    'href' => null,
    'label' => '',
])

<div class="menu-item px-3">
    <a href="{{ $href ?? '' }}" class="menu-link px-3 text-left">{{ __($label) }}</a>
</div>