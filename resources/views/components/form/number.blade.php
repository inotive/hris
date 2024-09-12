@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder'   => '',
    'min'   => '',
    'max'   => '',
])

<div class="fv-row mb-7 fv-plugins-icon-container">

    <label class="required fs-6 fw-bold mb-2">{{ $label }}</label>

    <input type="number" min="{{ $min }}" max="{{ $max }}" class="form-control form-control-solid" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ $value }}">


    @error($name)
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
    @enderror
</div>