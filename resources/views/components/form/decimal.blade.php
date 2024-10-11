@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder'   => '',
    'min'   => '',
    'max'   => '',
    'step'  => 1,
    'required'  => false,
])

<div class="col-12 col-lg-6 mb-4">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ $label }}</label>

    <input type="number" step="{{$step}}" min="{{ $min }}" max="{{ $max }}" oninput="formatDecimal(this)" class="form-control form-control-solid" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ $value }}">


        <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
            @error($name)
                {{ $message }}
            @enderror
        </div>
</div>