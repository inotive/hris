@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'placeholder' => '',
    'required' => false,
])

<div class="col-12 col-lg-6 mb-4">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>

    <input type="text" class="form-control form-control-solid datetimepicker" placeholder="{{ $placeholder }}"
        name="{{ $name }}" value="{{ old($name, $value ?? '') }}">



    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>

</div>
