@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder'   => '',
    'min'   => '',
    'max'   => '',
    'required'  => false,
    'class' => 'col-12 col-lg-6 mb-4',
    'add_class' => '',
    'disabled'  => false,
])

<div class="{{ $class }}">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ $label }}</label>

    <input {{ $disabled == true ? ' disabled ' : '' }} type="text" min="{{ $min }}" max="{{ $max }}" class="form-control form-control-solid currency {{ $add_class }}" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ $value }}">


        <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
            @error($name)
                {{ $message }}
            @enderror
        </div>
</div>