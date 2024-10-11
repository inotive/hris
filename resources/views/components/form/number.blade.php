@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder'   => '',
    'min'   => '',
    'max'   => '',
    'required'  => false,
])

<div id="{{ $name }}_div" class="col-12 col-lg-6 mb-4">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ $label }}</label>

    <input type="number" min="{{ $min }}" max="{{ $max }}" class="form-control form-control-solid" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ $value }}">


        <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
            @error($name)
                {{ $message }}
            @enderror
        </div>
</div>