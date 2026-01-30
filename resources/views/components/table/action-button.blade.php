
@props([

    'href' => null,
    'label' => '',
])

<div class="menu-item px-3 text-start">
    <a href="{{ $href ?? '' }}" class="menu-link px-3 text-left">{{ __($label) }}</a>
</div>