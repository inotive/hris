@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder'   => '',
    'required'     => false,
    'class' => 'col-12 col-lg-6 mb-4',
])

<div class="{{ $class ?? '' }}">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>

    <textarea class="form-control form-control-solid summernote" rows="5" placeholder="{{ $placeholder }}" name="{{ $name }}">{{ $value }}</textarea>

    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>
</div>