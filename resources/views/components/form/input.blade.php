@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'placeholder' => '',
    'type' => 'text',
    'required' => false,
    'class' => 'col-12 col-lg-6 mb-4',
])

<div id="{{ $name }}_div" class="{{ $class }}">

    @if ($label != null && strlen($label) > 0)
        <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>
    @endif
    <input type="{{ $type }}" class="form-control form-control-solid" placeholder="{{ $placeholder }}"
        id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value ?? '') }}">



    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>

</div>
