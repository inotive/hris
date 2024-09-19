@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'required' => false,
])

<div class="col-12 col-lg-6 mb-4">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ $label }}</label>

    <div class="form-check form-switch form-check-custom form-check-solid">
        <input class="form-check-input" type="checkbox" id="{{ $name }}" name="{{ $name }}" value="1"
            {{ $value == 1 ? ' selected ' : '' }} />
        
    </div>

    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>
</div>
