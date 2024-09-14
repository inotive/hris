@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder'   => '',

])

<div class="fv-row mb-7 fv-plugins-icon-container">

    <label class="required fs-6 fw-bold mb-2">{{ $label }}</label>

    <input type="number" min="6"  class="form-control form-control-solid" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ $value }}">


    @error($name)
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
    @enderror
</div>