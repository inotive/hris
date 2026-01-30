@props([
    'name' => '',
    'value' => null,
])
    <input type="hidden"
        name="{{ $name }}" id="{{ $name }}" class="{{ $name }}" value="{{ $value ?? ''}}">
