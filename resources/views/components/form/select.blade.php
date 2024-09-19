@props([
    'name' => '',
    'label' => '',
    'value' => null,
    'list' => [],
    'required'  => false,
])

<div class="col-12 col-lg-6 mb-4" id="{{ $name }}_div">

    <label class="{{ $required == true ? 'required ' : '' }} fs-6 fw-bold mb-2">{{ __($label) }}</label>


    <select class="form-select form-select-solid" id="{{ $name }}" name="{{ $name }}" data-control="select2" data-placeholder="{{ __('Select an option') }}">
        <option></option>
        @foreach ($list as $key => $val)
            <option value="{{ $key }}" {{ $key == $value ? ' selected ' : '' }}>{{ $val ?? '-' }}</option>
        @endforeach
    </select>


    <div class="fv-plugins-message-container invalid-feedback {{ $name }}-error">
        @error($name)
            {{ $message }}
        @enderror
    </div>
</div>
