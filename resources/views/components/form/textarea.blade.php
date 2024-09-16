@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder'   => '',
    'required'     => false,
])

<div class="fv-row mb-7 fv-plugins-icon-container">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ $label }}</label>

    <textarea class="form-control form-control-solid" rows="5" placeholder="{{ $placeholder }}" name="{{ $name }}">{{ $value }}</textarea>

    @error($name)
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
    @enderror
</div>