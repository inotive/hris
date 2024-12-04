@props([
    'name' => '',
    'value' => null,
])
    <input type="hidden"
        name="{{ $name }}" class="{{ $name }}" value="{{ $value ?? ''}}">
